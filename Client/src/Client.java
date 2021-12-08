import java.io.*;
import java.net.Socket;
import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.Scanner;

public class Client {
    volatile static boolean isChatTerminated;
    volatile static int ID;
    //static ArrayList<Message> unreadMessages = new ArrayList<Message>();
    //Here we run the game, and click on chat
    //connected to the server thread
    //sends and integer representing the options 1=chat 2=score
    //When click chat send chat to ST.
    //
    public static void main(String[] arg) {
        //connect and set streams
        BufferedReader br=null;
        PrintWriter pw=null;
        Socket s=null;
        try {
            s = new Socket("127.0.0.1", 3456);
            br = new BufferedReader(new InputStreamReader(s.getInputStream()));
            pw = new PrintWriter(s.getOutputStream(), true);
            Scanner scanner = new Scanner(System.in);
            System.out.println("Connected to server. \n What's your ID? ");
            ID = Integer.parseInt(scanner.nextLine());
            pw.println(String.valueOf(ID));
            while (true) {
                String option = scanner.nextLine();
                pw.println(option);
                if (option.equals("chat")) { //if click on "chat"
                    //select user and get id
                    System.out.print("Receipent ID: ");
                    int RiD = Integer.parseInt(scanner.nextLine());
                    pw.println(RiD);
                    RunChat(RiD, pw, br, scanner);
                }
                if (option.equals("quit")) break;
            }
        } catch (IOException | InterruptedException e) {
            e.printStackTrace();
        } finally {
            //close resources
        }
    }
    public static void RunChat(int rID, PrintWriter pw, BufferedReader br, Scanner scanner) throws InterruptedException {
        isChatTerminated=false;
        Thread sendMessage = new Thread(new Runnable() {
            @Override
            public void run() {
                while (!isChatTerminated) {
                    // read the message to deliver.
                    String msg = scanner.nextLine();
                    if (msg.equals("user disconnected")) {isChatTerminated = true;}
                    // write on the output stream
                    pw.println(msg);
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
        readMessage.interrupt();
        System.out.println("Chat Terminated");
    }
}
