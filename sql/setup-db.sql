CREATE DATABASE IF NOT EXISTS anng15;
USE anng15;

GRANT ALL ON anng15.* TO whoever@localhost IDENTIFIED BY 'whatever';

SET NAMES utf8;

DROP TABLE IF EXISTS r1_users;
CREATE TABLE r1_users
(
    id          INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    username    VARCHAR(100) NOT NULL UNIQUE,
    password    VARCHAR(255) NOT NULL,
    email       VARCHAR(100) NOT NULL UNIQUE,
    userlevel   INT NOT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO r1_users
  (username, password, email, userlevel)
VALUES
  ('admin', '$2y$10$RCFw4V8duXyBzT2Ti5X7ae.YofcFAMyP40ZNrU3hbEhAOJE0tKhEW', 'noone@nonexistant.io', 1),
  ('doe', '$2y$10$OcmC0aLKQLCcszlnF4pd.ebFzH87oxkR2Gx7difCeT1g6UogIiUqO', 'jane@doe.io', 2),
  ('litemerafrukt', '$2y$10$0J5Zto0Cxix1z8o1DH0SuOGTf7sPue2rCmqBPd52QkpVo/Bkgq.B.', 'litemerafrukt@gmail.com', 1)
;

SELECT * FROM r1_users;

--
-- Table Book
--
DROP TABLE IF EXISTS r1_Book;
CREATE TABLE r1_Book (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `title` VARCHAR(256) NOT NULL,
    `author` VARCHAR(256) NOT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO r1_Book
  (title, author)
VALUES
  ('Magins Färg', 'Terry Pratchett'),
  ('American Gods', 'Neil Gaiman'),
  ('Den flammande bägaren', 'JK Rowling')
;

SELECT * FROM r1_Book;

--
-- Table comments
--
DROP TABLE IF EXISTS r1_comments;
CREATE TABLE r1_comments (
    `id`            INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `subject`       VARCHAR(100) NOT NULL,
    `author`        VARCHAR(100) NOT NULL,
    `authorId`      INT NOT NULL,
    `authorEmail`   VARCHAR(100) NOT NULL,
    `rawText`       TEXT NOT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO r1_comments
  (subject, author, authorId, authorEmail, rawText)
VALUES
  ('First!', 'litemerafrukt', 3, 'litemerafrukt@gmail.com', 'Direkt från `setup-db.sql`!')
;

SELECT * FROM r1_comments;
