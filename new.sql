CREATE TABLE user (
    userid INT NOT NULL AUTO_INCREMENT,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    date_of_birth DATE NOT NULL,
    email VARCHAR(255) NOT NULL,
    mobile_number VARCHAR(255) NOT NULL,
    registered_date DATETIME NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (userid)
);