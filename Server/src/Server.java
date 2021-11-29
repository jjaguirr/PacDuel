import java.util.ArrayList;

public class Server {
    static int nClients=0;
    static ArrayList<ServerThread> serverThreads = new ArrayList<ServerThread>();

    public static void main(String [] args){
        //we start the server
        try {
            ServerSocket ss = new ServerSocket(3456);
            while (true){
                Socket connection = ss.accept();
                System.out.println("New client request received : " + connection.getInetAddress());
                nClients++;
                ServerThread st = new ServerThread(connection);
                serverThreads.add(st);
                //find a way to terminate
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    static class ServerThread extends Thread{
        private BufferedReader br;
        private PrintWriter pw;
        private ObjectInputStream is;
        private ObjectOutputStream os;
        int UserID;
        public boolean isOnline;

        public ServerThread(Socket s) throws IOException {
            is = new ObjectInputStream(s.getInputStream());
            br = new BufferedReader(new InputStreamReader(s.getInputStream()));
            os = new ObjectOutputStream(s.getOutputStream());
            pw = new PrintWriter(s.getOutputStream(), true);
            start();
        }

        @Override
        public void run()
        {
            try {
                this.UserID= Integer.parseInt(br.readLine());
                System.out.println("User " + UserID + " Connected");
            } catch (IOException e) {
                e.printStackTrace();
            }
            //your code here
            while (true){
                try {
                    String option = br.readLine();
                    if (option.equals("chat")) {
                        while (true){
                            Message msg = (Message) is.readObject();
                            if (msg.equals("end"));
                            System.out.println(msg.msg);
                            for (ServerThread st: serverThreads){
                                if (st.getUserID()==msg.rID)
                                    st.pw.println(msg.getMsg());
                            }
                        }
                    } else if (option.equals("game")) {
                        //score broadcast
                    }
                }catch (IOException | ClassNotFoundException ignored){}
            }

        }
        public int getUserID() {
            return UserID;
        }
    }
}
