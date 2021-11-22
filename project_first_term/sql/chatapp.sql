DROP DATABASE chatapp;
CREATE DATABASE IF NOT EXISTS chatapp CHARSET utf8mb4 COLLATE utf8mb4_general_ci;

USE chatapp;

CREATE TABLE IF NOT EXISTS users (
  id int(10) NOT NULL AUTO_INCREMENT,
  usName varchar(30) NOT NULL,
  usSurname varchar(30) NOT NULL,
  username varchar(30) NOT NULL UNIQUE,
  email varchar(30) NOT NULL UNIQUE,
  age int NOT NULL,
  telephone varchar(16) NOT NULL,
  passwd varchar(100) NOT NULL,
  pfp varchar(100) DEFAULT './assets/files/img/default/pfp_default.jpg',
  isActive BOOLEAN NOT NULL DEFAULT 0,
  usRole enum('admin', 'client') NOT NULL DEFAULT 'client';
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS chats (
	id int(10) NOT NULL AUTO_INCREMENT,
  alias varchar(30) NOT NULL,
  pfp varchar(100) DEFAULT './assets/files/img/default/pfp_default.jpg',
  -- numUsers int NOT NULL DEFAULT 0,
  -- msgID int(10) NOT NULL,
    PRIMARY KEY (id)
    -- FOREIGN KEY (msgID) REFERENCES messages(id)
);

CREATE TABLE IF NOT EXISTS participate_users_chats(
    userID int(10) NOT NULL, 
    chatID int(10) NOT NULL,
    PRIMARY KEY (userID, chatID),
    FOREIGN KEY (userID) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (chatID) REFERENCES chats(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS messages (
  id int(10) NOT NULL AUTO_INCREMENT,
  senderID int(10) NOT NULL,
  chatID int(10) NOT NULL,
  content varchar(10000) NOT NULL,
  msgTime datetime NOT NULL,
  isRead boolean NOT NULL DEFAULT 0,
    PRIMARY KEY (id),
    FOREIGN KEY (senderID) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (chatID) REFERENCES chats(id) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO `users` (`usName`, `usSurname`, `username`, `email`, `passwd`, `isActive`) VALUES ('root', 'root', 'root', 'root', 'root', '0');
INSERT INTO `chats`(`id`, `alias`) VALUES ('1', 'root --test-chat');
-- INSERT INTO `participate_users_chats`(`userID`, `chatID`) VALUES ('2', '1');
-- INSERT INTO `participate_users_chats`(`userID`, `chatID`) VALUES ('1', '1');