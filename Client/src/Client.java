import java.io.*;
import java.net.Socket;
import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.Scanner;

public class Client {
    volatile static boolean isChatTerminated, isGameTerminated;
    volatile static int ID;
    //static ArrayList<Message> unreadMessages = new ArrayList<Message>();
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
            ID= Integer.parseInt(scanner.nextLine());
            pw.println(String.valueOf(ID));
            while (true) {
                String option = scanner.nextLine();
                pw.println(option);
                //selected chat from gui
                if (option.equals("chat")) { //if click on "chat"
                    //select user and get id
                    System.out.print("Receipent ID: ");
                    int RiD = Integer.parseInt(scanner.nextLine());
                    RunChat(RiD, os, br, scanner);
                }
                else if(option.equals("game")){
                    int otherPlayerID= 1;
                    //click in other player and wait for confirmation
                    RunGame(otherPlayerID, os, br);
                }
                //other functionality, game, exit, etc, all from the GUI
            }
        } catch (IOException | InterruptedException e) {
            e.printStackTrace();
        } finally {
            //Close resources and socket
        }


    }
    public static void RunChat(int rID, ObjectOutputStream os, BufferedReader br, Scanner scanner) throws InterruptedException {
        isChatTerminated=false;
        Thread sendMessage = new Thread(new Runnable() {
            @Override
            public void run() {
                while (!isChatTerminated) {
                    // read the message to deliver.
                    String msg = scanner.nextLine();
                    try {
                        // write on the output stream
                        if (msg.equals("end")) {isChatTerminated=true; os.writeObject(new Message(msg, rID, ID)); break;}
                        os.writeObject(new Message(msg, rID, ID));
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
                        //if(isChatTerminated)
                        //save them into a buffer, only when selecting a chat, all
                        //unread messages should be displayed.
                        if (msg.equals("end")) {isChatTerminated = true;}
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
    public static void RunGame(int otherPlayerID, ObjectOutputStream os, BufferedReader br) throws InterruptedException{
        isGameTerminated=false;
        try{
            while (!isGameTerminated){
                //Continually read other player score and display it to GUI
                int p2Score = Integer.parseInt(br.readLine());
                //display p2SCore to GUI
                //wait for termination
            }
        } catch (IOException e){ e.printStackTrace();}
    }
}
