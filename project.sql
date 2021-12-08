DROP TABLE IF EXISTS Friends;
DROP TABLE IF EXISTS UserInfo;

CREATE TABLE UserInfo (
	sno int NOT NULL AUTO_INCREMENT,
    username VARCHAR(15) NOT NULL UNIQUE,
    passcode VARCHAR(64) NOT NULL,
    profimage VARCHAR(25) NOT NULL,
    high_score int DEFAULT 0,
    game1 int DEFAULT 0,
    game2 int DEFAULT 0,
    game3 int DEFAULT 0,
    game4 int DEFAULT 0,
    game5 int DEFAULT 0,
    PRIMARY KEY (sno)
);

CREATE TABLE Friends(
    sno int NOT NULL AUTO_INCREMENT,
    numfriends int NOT NULL,
    friend1 int,
    friend2 int,
    friend3 int,
    friend4 int,
    friend5 int,
    FOREIGN KEY(sno) REFERENCES UserInfo(sno) ON DELETE CASCADE,
    FOREIGN KEY(friend1) REFERENCES UserInfo(sno) ON DELETE CASCADE,
    FOREIGN KEY(friend2) REFERENCES UserInfo(sno) ON DELETE CASCADE,
    FOREIGN KEY(friend3) REFERENCES UserInfo(sno) ON DELETE CASCADE,
    FOREIGN KEY(friend4) REFERENCES UserInfo(sno) ON DELETE CASCADE,
    FOREIGN KEY(friend5) REFERENCES UserInfo(sno) ON DELETE CASCADE,
    PRIMARY KEY(sno)
);




-- CREATE TABLE LeaderBoard(
-- 	sno int NOT NULL PRIMARY KEY,
--     rankPlayer int NOT NULL, 
--     username VARCHAR(15) NOT NULL,
-- 	Score int NOT NULL,
--     FOREIGN KEY(sno) REFERENCES UserInfo(sno) ON DELETE CASCADE
--     );