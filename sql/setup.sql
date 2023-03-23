CREATE DATABASE project;

USE project; 

CREATE TABLE users (
    username varchar(63) NOT NULL,
    firstName varchar(63),
    lastName varchar(63),
    email varchar(63) NOT NULL,
    password varchar(127) NOT NULL,
    profileImage BLOB,
    isAdmin boolean NOT NULL DEFAULT 0,
    PRIMARY KEY (username),
    UNIQUE KEY (email)
);

CREATE TABLE friends (
    username varchar(63) NOT NULL,
    firstName varchar(63),
    lastName varchar(63),
);

CREATE TABLE blogpost(
    username varchar(63) NOT NULL,
    firstName varchar(63),
    profileImage BLOB,
    post varchar(125) NOT NULL,
    likes integer

);

CREATE TABLE trending(
    username varchar(63) NOT NULL,
    firstName varchar(63),
    profileImage BLOB,
    post varchar(125) NOT NULL,
    likes integer
);

