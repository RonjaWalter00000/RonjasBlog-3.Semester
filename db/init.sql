CREATE DATABASE IF NOT EXISTS dhbw_blog;

use dhbw_blog;

CREATE TABLE IF NOT EXISTS messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(60),
    email varchar(100),
    message varchar(4000)
);

CREATE TABLE IF NOT EXISTS user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username varchar(100) UNIQUE,
    password varchar(100)
);

CREATE TABLE IF NOT EXISTS blogentry (
    id INT PRIMARY KEY AUTO_INCREMENT,
    heading varchar(50),
    entrydate DATETIME DEFAULT CURRENT_TIMESTAMP,
    location varchar(100),
    text varchar(10000)
);

CREATE TABLE IF NOT EXISTS blogcomments (
    id INT PRIMARY key AUTO_INCREMENT,
    name varchar(100),
    text varchar(200),
    commentDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    blogId INT,

    FOREIGN KEY (blogId) REFERENCES blogentry(id) ON DELETE CASCADE
);