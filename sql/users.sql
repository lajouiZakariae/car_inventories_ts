DROP TABLE users;
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    user_role varchar(15) NOT NULL
);

-- @block
INSERT INTO users (full_name,username,email,password,user_role)
VALUES ('admin admin','admin','admin@mail.com','12345678','administrator');
-- @block
INSERT INTO users (full_name,username,email,password,user_role)
VALUES ('first creator','Omar','omar@mail.com','12345678','creator');
-- @block
DELETE FROM users;