DROP TABLE IF EXISTS FavoriteIssues;
DROP TABLE IF EXISTS issue;
DROP TABLE IF EXISTS type;
DROP TABLE IF EXISTS location;
DROP TABLE IF EXISTS account;
DROP TABLE IF EXISTS ContactDetails;

CREATE TABLE location (
    location_id int NOT NULL AUTO_INCREMENT,
    lat_loc decimal(25,20) NOT NULL,
    long_loc decimal(25,20) NOT NULL,
    PRIMARY KEY (location_id)
);

CREATE TABLE type (
    type_id int NOT NULL,
    issue_name char(20) NOT NULL,
    symbol_ref char(100),
    type_colour VARCHAR(7),
    PRIMARY KEY (type_id)
);

CREATE TABLE issue (
    issue_id int NOT NULL AUTO_INCREMENT,
    issue_description TEXT NOT NULL,
    illegality boolean,
    location_id int NOT NULL,
    type_id int,
    current_rating int NOT NULL,
    rating_count int NOT NULL,
    rating_text VARCHAR(50) NOT NULL,
    date_submitted datetime,
    PRIMARY KEY (issue_id),
    FOREIGN KEY (location_id) REFERENCES location(location_id),
    FOREIGN KEY (type_id) REFERENCES type(type_id)
);

CREATE TABLE account (
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
    PRIMARY KEY (user_id, issue_id),
    FOREIGN KEY (user_id) REFERENCES account(user_id),
    FOREIGN KEY (issue_id) REFERENCES issue(issue_id)
);