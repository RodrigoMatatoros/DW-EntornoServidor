DROP DATABASE chatapp;
CREATE DATABASE IF NOT EXISTS chatapp CHARSET utf8mb4 COLLATE utf8mb4_general_ci;

USE chatapp;

CREATE TABLE IF NOT EXISTS users (
  id int(10) NOT NULL AUTO_INCREMENT,
  usName varchar(30) NOT NULL,
  usSurname varchar(30) NOT NULL,
  username varchar(30) NOT NULL,
  email varchar(30) NOT NULL UNIQUE,
  age int NOT NULL,
  telephone varchar(16) NOT NULL,
  passwd varchar(100) NOT NULL,
    isActive BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS messages (
  id int(10) NOT NULL AUTO_INCREMENT,
  senderID int(10) NOT NULL,
  receiverID int(10) NOT NULL,
  content varchar(1000) NOT NULL,
  msgTime datetime NOT NULL,
  isRead boolean NOT NULL DEFAULT 0,
    PRIMARY KEY (id),
    FOREIGN KEY (senderID) REFERENCES users(id),
    FOREIGN KEY (receiverID) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS chat (
	id int(10) NOT NULL AUTO_INCREMENT,
    -- numUsers int NOT NULL DEFAULT 0,
    msgID int(10) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (msgID) REFERENCES messages(id)
);

CREATE TABLE IF NOT EXISTS participate_users_chats(
    senderID int(10) NOT NULL, 
    receiverID int(10) NOT NULL,
    chatID int(10) NOT NULL,
    FOREIGN KEY (chatID) REFERENCES chat(id),
    FOREIGN KEY (senderID) REFERENCES users(id),
    FOREIGN KEY (receiverID) REFERENCES users(id)
);

INSERT INTO `users` (`id`, `usName`, `usSurname`, `username`, `email`, `passwd`, `isActive`) VALUES (NULL, 'root', 'root', 'root', 'root', '', '0');