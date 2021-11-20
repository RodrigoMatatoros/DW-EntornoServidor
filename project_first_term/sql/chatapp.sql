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
  isActive BOOLEAN NOT NULL DEFAULT 0,
    CONSTRAINT pk_id_users PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS chats (
	id int(10) NOT NULL AUTO_INCREMENT,
  -- numUsers int NOT NULL DEFAULT 0,
  -- msgID int(10) NOT NULL,
    CONSTRAINT pk_id_chats PRIMARY KEY (id)
    -- fk_id_messages FOREIGN KEY (msgID) REFERENCES messages(id)
);

CREATE TABLE IF NOT EXISTS messages (
  id int(10) NOT NULL AUTO_INCREMENT,
  senderID int(10) NOT NULL,
  chatID int(10) NOT NULL,
  content varchar(10000) NOT NULL,
  msgTime datetime NOT NULL,
  isRead boolean NOT NULL DEFAULT 0,
    CONSTRAINT pk_id_messages PRIMARY KEY (id),
    CONSTRAINT fk_id_users FOREIGN KEY (senderID) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_id_chats FOREIGN KEY (chatID) REFERENCES chats(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS participate_users_chats(
    userID int(10) NOT NULL, 
    chatID int(10) NOT NULL,
    CONSTRAINT pk_id_users_chats PRIMARY KEY (userID, chatID),
    CONSTRAINT pk_fk_id_users FOREIGN KEY (userID) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT pk_fk_id_chats FOREIGN KEY (chatID) REFERENCES chats(id) ON DELETE CASCADE
);

INSERT INTO `users` (`id`, `usName`, `usSurname`, `username`, `email`, `passwd`, `isActive`) VALUES (NULL, 'root', 'root', 'root', 'root', 'root', '0');
INSERT INTO `chats`(`id`) VALUES ('1');
INSERT INTO `participate_users_chats`(`userID`, `chatID`) VALUES ('1', '1');
INSERT INTO `participate_users_chats`(`userID`, `chatID`) VALUES ('2', '1');