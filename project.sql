USE sql3452822;

DROP TABLE IF EXISTS UserInfo;
DROP TABLE IF EXISTS Friends;

CREATE TABLE UserInfo (
sno int NOT NULL,
    username VARCHAR(15) NOT NULL,
    email VARCHAR(25) UNIQUE,
    passcode VARCHAR(12) NOT NULL,
    PRIMARY KEY (sno),
    FOREIGN KEY (username) REFERENCES Friends(username)
);

CREATE TABLE Friends(

	sno int NOT NULL,
    username VARCHAR(15) NOT NULL,
    friend1 VARCHAR(15),
    friend2 VARCHAR(15),
    friend3 VARCHAR(15),
    friend4 VARCHAR(15),
    friend5 VARCHAR(15),
    PRIMARY KEY(sno)
);

CREATE TABLE LeaderBoard(

	sno int NOT NULL Primary key,
    rankPlayer int NOT NULL, 
    username VARCHAR(15) NOT NULL,
	Score int NOT NULL 
    );
    
    
    
