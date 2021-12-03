DROP TABLE IF EXISTS UserInfo;
DROP TABLE IF EXISTS Friends;
DROP TABLE IF EXISTS LeaderBoard;

CREATE TABLE UserInfo (
	sno int NOT NULL AUTO_INCREMENT,
    username VARCHAR(15) NOT NULL UNIQUE,
    passcode VARCHAR(64) NOT NULL,
    profimage VARCHAR(25) NOT NULL,
    PRIMARY KEY (sno)
    
);

CREATE TABLE Friends(

    username VARCHAR(15) NOT NULL,
    numfriends int NOT NULL,
    friend1 VARCHAR(15),
    friend2 VARCHAR(15),
    friend3 VARCHAR(15),
    friend4 VARCHAR(15),
    friend5 VARCHAR(15),
    PRIMARY KEY(username)
);

ALTER TABLE UserInfo
ADD FOREIGN KEY (username) REFERENCES Friends(username);




CREATE TABLE LeaderBoard(
	sno int NOT NULL Primary key,
    rankPlayer int NOT NULL, 
    username VARCHAR(15) NOT NULL,
	Score int NOT NULL 
    );
    
    
    
