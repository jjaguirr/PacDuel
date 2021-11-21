

import java.io.*;
import java.net.Socket;
import java.util.Scanner;



public class ServerThread extends Thread{
    private BufferedReader br;
    private PrintWriter pw;
    private ObjectInputStream oi;
    private ObjectOutputStream os;
    private Server server;
    private int UserID;

    public int getUserID() {
        return UserID;
    }

    public Message receiveMessageFromUser(){
        try{
            Message msg = (Message) oi.readObject();
            return msg;
        } catch (IOException | ClassNotFoundException e) {
            e.printStackTrace();
        }
        return null;
    }
    public void sendMessageToUser(String str){
        try {
            os.writeObject(str);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }


    public ServerThread(String hostname, int port, Server server) throws  Exception
    {
        Socket s= new Socket(hostname, port);
        br = new BufferedReader(new InputStreamReader(s.getInputStream()));
        pw = new PrintWriter(s.getOutputStream(), true);
        server=server;
        Scanner scanner= new Scanner(System.in);
//        System.out.println("Enter your name: "); String name= scanner.nextLine();
        start();
//        while(true) {
//            String msg= scanner.nextLine();
//            pw.println(name+": "+ scanner.nextLine());
//            if(msg.equals("quit")) break;
//        }
    }


    public void run()
    {
        //your code here
        try{
            while (true){
                String option= br.readLine();
                if (option=="chat") {
                    server.Broadcast(receiveMessageFromUser());
                }
                else if(option=="game"){
                    //score broadcast
                }
            }
        } catch (IOException ignored){}
    }

}
