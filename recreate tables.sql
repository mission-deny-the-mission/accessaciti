DROP DATABASE IF EXISTS accessaciti;
CREATE DATABASE accessaciti;
USE accessaciti;

CREATE TABLE Location (
    location_id int NOT NULL AUTO_INCREMENT,
    lat_loc decimal(6,3) NOT NULL,
    long_loc decimal(6,3) NOT NULL,
    PRIMARY KEY (location_id)
);

CREATE TABLE Type (
    type_id int NOT NULL,
    issue_name char(20) NOT NULL,
    symbol_ref char(100) NOT NULL,
    PRIMARY KEY (type_id)
);

CREATE TABLE Issue (
    issue_id int NOT NULL AUTO_INCREMENT,
    issue_description TEXT NOT NULL,
    illegality boolean NOT NULL,
    location_id int NOT NULL,
    type_id int,
    current_rating int NOT NULL,
    rating_count int NOT NULL,
    rating_text VARCHAR(50) NOT NULL,
    date datetime,
    PRIMARY KEY (issue_id),
    FOREIGN KEY (location_id) REFERENCES Location(location_id),
    FOREIGN KEY (type_id) REFERENCES Type(type_id)
);

CREATE TABLE User (
    user_id int NOT NULL AUTO_INCREMENT,
    username VARCHAR (128) NOT NULL,
    firstname VARCHAR (60) NOT NULL,
    lastname VARCHAR (60) NOT NULL,
    email VARCHAR (128),
    password_hash VARCHAR (60),
    PRIMARY KEY (user_id)
);

CREATE TABLE FavoriteIssues (
    user_id int NOT NULL,
    issue_id int NOT NULL,
    PRIMARY KEY (user_id, issue_id)
);
