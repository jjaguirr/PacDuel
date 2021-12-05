import java.io.Serial;
import java.io.Serializable;

public class Message implements Serializable{
    String msg;
    int rID, sID;
    public Message (String msg, int Rid, int sID){
        this.msg=msg;
        rID=Rid;
        this.sID=sID;
    }

    public String getMsg() {
        return msg;
    }
}