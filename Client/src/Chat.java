import

import java.io.BufferedReader;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;
import java.io.Serializable;

public class Chat {
    private int receipent;
    private ObjectOutputStream pw;
    private ObjectInputStream is;
    private BufferedReader br;
    private boolean isOnline;

    public Chat(int rID, ObjectOutputStream pr, ObjectInputStream is){
        receipent = rID;
        br= br;
        pr=pr;
    }
    public void SendMessage(String message){
        Message msg= new Message(message, this.receipent);
        try{
            pw.writeObject(msg);
        } catch (Exception ignored){
        }
    }
}
