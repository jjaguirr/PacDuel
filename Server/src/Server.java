import java.util.ArrayList;

public class Server {
    ArrayList<ServerThread> serverThreads;
    public void Broadcast(Message msg){
        //if msg null do something
        for (ServerThread st: serverThreads){
            if (st.getUserID()==msg.rID)
                st.sendMessageToUser(msg.getMsg());
        }

    }
    public static void main(String [] args){
        //we start the server


        //wait for connections
            //create server thread and add to list



    }
}
