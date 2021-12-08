import java.io.*;
import java.util.ArrayList;
import java.net.*;
import java.util.concurrent.ArrayBlockingQueue;
import java.util.*;
import java.util.concurrent.ConcurrentHashMap;
import java.util.concurrent.ConcurrentLinkedQueue;

public class Server {
    static int nClients = 0;
    static ArrayList<ServerThread> serverThreads = new ArrayList<ServerThread>();
    static ConcurrentLinkedQueue<Message> undisplayedMessages = new ConcurrentLinkedQueue<Message>();

    public static void main(String[] args) {
        //we start the server
        try {
            ServerSocket ss = new ServerSocket(3456);
            while (true) {
                Socket connection = ss.accept();
                System.out.println("New chat request received : " + connection.getInetAddress());
                nClients++;
                ServerThread st = new ServerThread(connection);
                serverThreads.add(st);
                //The server does not terminate, once running, should be up for as long as possible.
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    static class ServerThread extends Thread {
        final BufferedReader br;
        final PrintWriter pw;
        int UserID;
        int chattingWith;

        public ServerThread(Socket s) throws IOException {
            br = new BufferedReader(new InputStreamReader(s.getInputStream()));
            pw = new PrintWriter(s.getOutputStream(), true);
            start();
        }
        public int getUserID(){return UserID;}
        @Override
        public void run() {
            //read this user id
            try {
                String userID = br.readLine();
                this.UserID = Integer.parseInt(userID);
                System.out.println("User " + UserID + " Connected");
            } catch (IOException | NumberFormatException e) {
                e.printStackTrace();
            }
            while (true) {
                //reads the recipient id and find the thread if exists
                ServerThread receiver = null;
                int rID = 0;
                try {
                    String option= br.readLine();
                    if (option.equals("quit")) break;
                    rID = Integer.parseInt(br.readLine());
                    for (ServerThread st : serverThreads) {
                        if (st.getUserID() == rID) {
                            receiver = st;
                        }
                    }
                } catch (NumberFormatException | IOException e) {
                    System.out.println("Incorrect recipient format");
                    e.printStackTrace();
                    break;
                }
                //find if the receiver have sent msgs to this user and send them.
                for (Message msg: undisplayedMessages){
                    if (msg.sID==rID && msg.rID==this.UserID) {
                        this.pw.println(msg.msg);
                        undisplayedMessages.remove(msg);
                    }
                }
                this.chattingWith=rID;
                //start chatting
                try {
                    while (true) {
                        String msg = br.readLine();
                        if (msg.equals("user disconnected")) break;
                        //if the receiver is disconnected or chatting with someone else
                        if (receiver == null || receiver.chattingWith!=this.UserID) {
                            //add the msg to undisplayed for receiver.
                            undisplayedMessages.add(new Message(msg, rID, this.UserID));
                            continue;
                        } //else just display it to they
                        receiver.pw.println(msg);
                    }
                    this.chattingWith=-1;
                    // TODO: 12/7/2021 Find out how does the client quits so the server can end thread.
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
            try {
                System.out.println("User " + this.getUserID() + " disconnected. Closing resources.");
                this.br.close();
                this.pw.close();
            } catch (IOException e) {
                e.printStackTrace();
            }
        }

    }
}