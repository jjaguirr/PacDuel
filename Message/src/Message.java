import java.io.Serializable;

public class Message implements Serializable {
    private String msg;
    public int rID;
    //uid shit

    public String getMsg() {
        return msg;
    }

    public Message (String msg, int Rid){
        msg=msg;
        rID=rID;
    }
}