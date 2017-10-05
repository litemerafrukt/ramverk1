CREATE DATABASE IF NOT EXISTS anng15;
USE anng15;

GRANT ALL ON anng15.* TO whoever@localhost IDENTIFIED BY 'whatever';

SET NAMES utf8;

DROP TABLE IF EXISTS r1_users;
CREATE TABLE r1_users
(
    id              INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    username        VARCHAR(100) NOT NULL UNIQUE,
    password        VARCHAR(255) NOT NULL,
    email           VARCHAR(100) NOT NULL UNIQUE,
    userlevel       INT NOT NULL,
    `created`       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `deleted`       DATETIME DEFAULT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO r1_users
  (username, password, email, userlevel)
VALUES
  ('admin', '$2y$10$RCFw4V8duXyBzT2Ti5X7ae.YofcFAMyP40ZNrU3hbEhAOJE0tKhEW', 'noone@nonexistant.io', 1),
  ('doe', '$2y$10$OcmC0aLKQLCcszlnF4pd.ebFzH87oxkR2Gx7difCeT1g6UogIiUqO', 'jane@doe.io', 2),
  ('litemerafrukt', '$2y$10$0J5Zto0Cxix1z8o1DH0SuOGTf7sPue2rCmqBPd52QkpVo/Bkgq.B.', 'litemerafrukt@gmail.com', 1)
;

INSERT INTO r1_users
  (username, password, email, userlevel, deleted)
VALUES
  ('deadjoe', '$2y$10$OcmC0aLKQLCcszlnF4pd.ebFzH87oxkR2Gx7difCeT1g6UogIiUqO', 'joe@doe.io', 2, NOW())
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
-- Table posts
--
DROP TABLE IF EXISTS r1_posts;
CREATE TABLE r1_posts (
    `id`            INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `subject`       VARCHAR(100) NOT NULL,
    `author`        VARCHAR(100) NOT NULL,
    `authorId`      INT NOT NULL,
    `authorEmail`   VARCHAR(100) NOT NULL,
    `rawText`       TEXT NOT NULL,
    `created`       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated`       DATETIME DEFAULT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO r1_posts
  (subject, author, authorId, authorEmail, rawText)
VALUES
  ('First!', 'litemerafrukt', 3, 'litemerafrukt@gmail.com', 'Direkt från `setup-db.sql`!'),
  ('Second', 'doe', 2, 'jane@doe.io', 'with two comments'),
  ('Third', 'admin', 2, 'admin@admin.io', 'with comment to a comment')
;

SELECT * FROM r1_posts;

--
-- Table comments
--
DROP TABLE IF EXISTS r1_comments;
CREATE TABLE r1_comments (
    `id`          INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `postId`      INT NOT NULL,
    `parentId`    INT DEFAULT 0,
    `authorId`    INT NOT NULL,
    `authorName`  VARCHAR(100) DEFAULT 'unknown',
    `text`        TEXT NOT NULL,
    `created`     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated`     DATETIME DEFAULT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

ALTER TABLE r1_comments AUTO_INCREMENT=1;

INSERT INTO r1_comments
  (postId, parentId, authorId, authorName,`text`)
VALUES
  (2, 0, 3, 'litemerafrukt', 'whatever'),
  (3, 0, 1, 'admin', 'whatnot???'),
  (3, 2, 4, 'deadjoe', 'hear hear'),
  (2, 0, 4, 'deadjoe', 'chim in')
;

select * from r1_comments;
