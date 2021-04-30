DROP TABLE IF EXISTS location;

CREATE TABLE Location (
    location_id int NOT NULL,
    lat_loc decimal(6,6) NOT NULL,
    long_loc decimal(6,6) NOT NULL
);

DROP TABLE IF EXISTS type;

CREATE TABLE Type (
    type_id int NOT NULL,
    issue_name char(20) NOT NULL,
    symbol_ref char(100) NOT NULL,
    PRIMARY KEY (type_id)
);

DROP TABLE IF EXISTS Issue;

CREATE TABLE Issue (
    issue_id int NOT NULL,
    issue_description TEXT NOT NULL,
    illegality boolean NOT NULL,
    location_id int NOT NULL,
    type_id int NOT NULL,
    PRIMARY KEY (issue_id),
    FOREIGN KEY (location_id) REFERENCES Location(location_id),
    FOREIGN KEY (type_id) REFERENCES Type(type_id)
);