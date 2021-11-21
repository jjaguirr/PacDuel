import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;
import java.util.Scanner;

public class Client {
    BufferedWriter wr;
    BufferedReader br;
    ObjectInputStream oi;
    ObjectOutputStream os;
    //Here we run the game, and click on chat
    //connected to the server thread
    //sends and integer representing the options 1=chat 2=score
    //When click chat send chat to ST.
    //
    public static void main(String [] arg) {

        //connect and set streams

        String option = null;
        //set option from gui and click

        if (option.equals("chat")) {
            //select user and get id

        }
    }
    public Boolean RunChat(int rID, ObjectOutputStream os, ObjectInputStream is){
        Scanner scanner= new Scanner(System.in);
        Chat chat = new Chat(rID,os,is);
        while (){//chat not closed
            String input = scanner.nextLine();
            chat.SendMessage(input);
            //display message;
        }
    }
}
