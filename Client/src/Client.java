import java.io.*;
import java.net.Socket;
import java.util.Scanner;

public class Client {
    volatile static boolean isChatTerminated;

    //Here we run the game, and click on chat
    //connected to the server thread
    //sends and integer representing the options 1=chat 2=score
    //When click chat send chat to ST.
    //
    public static void main(String[] arg) {
        //connect and set streams
        try {
            Socket s = new Socket("127.0.0.1", 3456);
            //ObjectInputStream is = new ObjectInputStream(s.getInputStream());
            BufferedReader br = new BufferedReader(new InputStreamReader(s.getInputStream()));
            ObjectOutputStream os = new ObjectOutputStream(s.getOutputStream());
            PrintWriter pw = new PrintWriter(s.getOutputStream(), true);
            Scanner scanner = new Scanner(System.in);
            System.out.println("Connected to server. \n What's your ID? ");
            int ID= scanner.nextInt();
            pw.println(ID);
            while (true) {
                String option = scanner.nextLine();
                pw.println(option);
                //selected chat from gui
                if (option.equals("chat")) { //if click on "chat"
                    //select user and get id
                    System.out.print("Receipent ID: ");
                    int RiD = scanner.nextInt();
                    RunChat(RiD, os, br);
                }
                //other functionality, game, exit, etc, all from the GUI

            }
        } catch (IOException | InterruptedException e) {
            e.printStackTrace();
        }

    }
    public static void RunChat(int rID, ObjectOutputStream os, BufferedReader br) throws InterruptedException {
        Scanner scanner = new Scanner(System.in);
        isChatTerminated=false;
        Thread sendMessage = new Thread(new Runnable() {
            @Override
            public void run() {
                while (!isChatTerminated) {
                    // read the message to deliver.
                    String msg = scanner.nextLine();
                    try {
                        // write on the output stream
                        if (msg.equals("end")) isChatTerminated=true;
                        os.writeObject(new Message(msg, rID));
                    } catch (IOException e) {
                        e.printStackTrace();
                        break;
                    }
                }
            }
        });
        Thread readMessage = new Thread(new Runnable()
        {
            @Override
            public void run() {
                while (!isChatTerminated) {
                    try {
                        String msg = br.readLine();
                        if (msg.equals("end")) isChatTerminated = true;
                        System.out.println(msg);
                    } catch (IOException e) {
                        e.printStackTrace();
                        break;
                    }
                }
            }
        });
        sendMessage.start();
        readMessage.start();
        sendMessage.join();
        readMessage.join();
        System.out.println("Chat Terminated");
    }

}
