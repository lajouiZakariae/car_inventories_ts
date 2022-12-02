--@block
DROP TABLE IF EXISTS Users;
--@block
CREATE TABLE IF NOT EXISTS Users (
    id serial PRIMARY KEY,
    full_name varchar(255) NOT NULL,
    username varchar(255) UNIQUE NOT NULL,
    email varchar(255) UNIQUE NOT NULL,
    password varchar(255) NOT NULL
);

-- @block
INSERT INTO Users
(full_name, username, email, password)
VALUES
('admin user','admin','admin@g.com','admin');
-- @block
SELECT *
from Users;