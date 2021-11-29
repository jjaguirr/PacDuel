import java.io.Serial;
import java.io.Serializable;

public class Message implements Serializable{
    String msg;
    int rID;

    public Message (String msg, int Rid){
        this.msg=msg;
        rID=Rid;
    }

    public String getMsg() {
        return msg;
    }
}