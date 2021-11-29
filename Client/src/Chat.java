import

import java.io.*;

public class Chat {
    private final int recipient;
    private final ObjectOutputStream os;
    private final BufferedReader br;
    private boolean isOnline;

    public Chat(int rID, ObjectOutputStream os,BufferedReader br){
        recipient = rID;
        this.br=br;
        this.os=os;
    }
    public void SendMessage(String message){
        Message msg= new Message(message, this.receipent);
        try{
            os.writeObject(msg);
        } catch (Exception e){
            e.printStackTrace();
        }
    }
    public String ReadMessage(){
        try {
            return br.readLine();
        } catch (IOException e) {
            e.printStackTrace();
            return null;
        }
    }
}
