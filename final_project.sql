DROP DATABASE IF EXISTS graves;

CREATE DATABASE graves;
USE graves;

CREATE TABLE users (
    userID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(40) NOT NULL,
    PRIMARY KEY(userID)
) ENGINE=InnoDB;

CREATE TABLE userInfo (
    userID INT UNSIGNED NOT NULL,
    firstName VARCHAR(25) NOT NULL,
    lastName VARCHAR(25) NOT NULL,
    city VARCHAR(150),
    state VARCHAR(2),
    zip VARCHAR(10),
    email VARCHAR(255),
    dateJoined DATE,
    PRIMARY KEY(userID),
    FOREIGN KEY (userID) REFERENCES users (userID)
) ENGINE=InnoDB;

CREATE TABLE graveyards (
    graveyardID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    userID INT UNSIGNED NOT NULL,
    street VARCHAR(150),
    city VARCHAR(150),
    state VARCHAR(2),
    zip VARCHAR(10),
    phone VARCHAR(13),
    addedBy INT,
    PRIMARY KEY(graveyardID),
    FOREIGN KEY (userID) REFERENCES users (userID)
) ENGINE=InnoDB;

CREATE TABLE graves (
    graveID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(25),
    middleName VARCHAR(25),
    lastName VARCHAR(25),
    birthDate DATE,
    deathDate DATE,
    vetranStatus tinyint,
    famous tinyint,
    PhotoName VARCHAR(255),
    latitude VARCHAR(150),
    longitude VARCHAR(150),
    altitude FLOAT,
    graveyardID INT UNSIGNED NOT NULL,
    PRIMARY KEY(graveID),
    FOREIGN KEY (graveyardID) REFERENCES graveyards(graveyardID)
) ENGINE=InnoDB;

CREATE TABLE friends (
    userID INT UNSIGNED NOT NULL,
    friendUserID INT UNSIGNED NOT NULL,
    PRIMARY KEY (userID, friendUserID),
    FOREIGN KEY (userID) REFERENCES users (userID),
    FOREIGN KEY (userID) REFERENCES users (userID)
) ENGINE=InnoDB;

CREATE TABLE permission (
    permissionID INT UNSIGNED NOT NULL,
    permission VARCHAR(255),
    PRIMARY KEY (permissionID)
) ENGINE=InnoDB;

CREATE TABLE userPermissions (
    userID INT UNSIGNED NOT NULL,
    permissionID INT UNSIGNED NOT NULL,
    PRIMARY KEY (userID, permissionID),
    FOREIGN KEY (userID) REFERENCES users (userID),
    FOREIGN KEY (permissionID) REFERENCES permission (permissionID)
) ENGINE=InnoDB;

CREATE TABLE groups (
    groupID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    userID INT UNSIGNED NOT NULL,
    groupName VARCHAR(255),
    Description TEXT,
    startedBy INT,
    PRIMARY KEY (groupID),
    FOREIGN KEY (userID) REFERENCES users (userID)
) ENGINE=InnoDB;

CREATE TABLE messages (
    messageID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    userID INT UNSIGNED NOT NULL,
    messageText LONGTEXT,
    senderID INT UNSIGNED NOT NULL,
    recipientID INT UNSIGNED NOT NULL,
    date DATETIME,
    PRIMARY KEY (messageID),
    FOREIGN KEY (userID) REFERENCES users (userID),
    FOREIGN KEY (userID) REFERENCES users (userID)
) ENGINE=InnoDB;

CREATE TABLE groupMembers (
    groupID INT UNSIGNED NOT NULL,
    userID INT UNSIGNED NOT NULL,
    PRIMARY KEY (groupID, userID),
    FOREIGN KEY (groupID) REFERENCES groups (groupID),
    FOREIGN KEY (userID) REFERENCES users (userID)
) ENGINE=InnoDB;

CREATE TABLE posts (
    postID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    userID INT UNSIGNED NOT NULL,
    postDate DATETIME,
    postText LONGTEXT,
    PRIMARY KEY (postID),
    FOREIGN KEY (userID) REFERENCES users (userID)
) ENGINE=InnoDB;

CREATE TABLE threads (
    threadID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(150),
    userID INT UNSIGNED NOT NULL,
    date DATETIME,
    PRIMARY KEY (threadID),
    FOREIGN KEY (userID) REFERENCES users (userID)
) ENGINE=InnoDB;

CREATE TABLE threadPosts (
    threadID INT UNSIGNED NOT NULL,
    postID INT UNSIGNED NOT NULL,
    PRIMARY KEY (threadID, postID),
    FOREIGN KEY (threadID) REFERENCES threads (threadID),
    FOREIGN KEY (postID) REFERENCES posts (postID)
) ENGINE=InnoDB;

CREATE TABLE wishlist (
    wishlistID INT UNSIGNED,
    userID INT UNSIGNED NOT NULL,
    graveID INT UNSIGNED NOT NULL,
    graveyardID INT UNSIGNED NOT NULL
) ENGINE=InnoDB;

