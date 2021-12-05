import java.io.*;
import java.util.ArrayList;
import java.net.*;
import java.util.concurrent.ArrayBlockingQueue;
import java.util.*;
import java.util.concurrent.ConcurrentLinkedQueue;

public class Server {
    static int nClients = 0;
    static ArrayList<ServerThread> serverThreads = new ArrayList<ServerThread>();
    static ConcurrentLinkedQueue<Message> unsentMessages = new ConcurrentLinkedQueue<Message>();

    public static void main(String[] args) {
        //we start the server
        try {
            ServerSocket ss = new ServerSocket(3456);
            while (true) {
                Socket connection = ss.accept();
                System.out.println("New client request received : " + connection.getInetAddress());
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
        private ObjectInputStream is;
        private ObjectOutputStream os;
        int UserID;
        public boolean isOnline;

        public ServerThread(Socket s) throws IOException {
            is = new ObjectInputStream(s.getInputStream());
            br = new BufferedReader(new InputStreamReader(s.getInputStream()));
            os = new ObjectOutputStream(s.getOutputStream());
            pw = new PrintWriter(s.getOutputStream(), true);
            start();
        }
        public int getUserID(){return UserID;}
        @Override
        public void run() {
            try {
                String received = br.readLine();
                this.UserID = Integer.parseInt(received);
                System.out.println("User " + UserID + " Connected");
            } catch (IOException e) {
                e.printStackTrace();
            }
//            //Find if any msg not delivered belongs to this user.
//            try {
//                for (Message m: unsentMessages){
//                    if (this.UserID==m.rID);
//
//                }
//            } catch (Exception e) {e.printStackTrace();};

            try {
                //start reading client options, should implement with GUI instead of console input.

                while (true) { //stops when user quits game. GUI implementation.
                    String option = br.readLine();
                    if (option.equals("chat")) { //if user clicked on chat. GUI.
                        while (true) {
                            //this server thread will send a message to someone
                            Message msg = (Message) is.readObject();
                            //the msg object has a recipient.
                            for (ServerThread st : serverThreads) {
                                //find the recipient if connected and send it.
                                if (st.getUserID() == msg.rID) {
                                    //the client side decides how to display each message
                                    st.pw.println(this.UserID + ": " + msg.msg);
                                } else { //not connected
                                    unsentMessages.add(msg);
                                }
                            }
                        }
                    } else if (option.equals("game")) {
                        //send invitation to player 2.
                        //run game (player 1, player 2)
                        //read score from API
                        //Send p1 score to p2, and viceversa.
                        //wait for someone to loose and communicate the other that they won.
                    }
                }
            } catch (IOException | ClassNotFoundException ignored) {
            } finally {
                try {
                    is.close();
                    br.close();
                    os.close();
                    pw.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }


            }
        }

    }
}