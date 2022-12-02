DROP TABLE IF EXISTS cars;
DROP TABLE IF EXISTS Categories;
DROP TABLE IF EXISTS users;

-- @block
CREATE TABLE users (
	id serial PRIMARY key,
	full_name VARCHAR(255) NOT NULL ,
	email VARCHAR(255) NOT NULL,
	username VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL 
    );
CREATE TABLE IF NOT EXISTS Categories (
    id serial PRIMARY KEY,
    seller int references Users(id) NOT NULL,
    name VARCHAR(255) UNIQUE NOT NULL DEFAULT 'uncategorized',
    slug VARCHAR(255) UNIQUE NOT NULL DEFAULT 'uncategorized'
);
CREATE TABLE cars (
	id serial,
	seller int NOT NULL references Users(id),
	category int NOT NULL references Categories(id) ON DELETE SET DEFAULT,
	name VARCHAR(255) NOT NULL,
	made VARCHAR(255) NOT NULL,
	price FLOAT NOT NULL,
	year VARCHAR(4) NOT NULL,
	ready_to_sell BOOLEAN NOT NULL
);
--@block
INSERT INTO users (full_name,email,username,password) VALUES ('admin admin','admin@at.com','admin','12345678');

INSERT INTO Categories
(seller,name,slug)
VALUES
(1,'sedan','sedan'),
(1,'hatch back','hatch-back'),
(1,'SUV','suv');

INSERT INTO Categories (seller)
VALUES (1) ;

INSERT INTO cars
(seller,category,name,made,year,price,ready_to_sell)
VALUES
(1,1,'g 65','Mercedes-benz',2022,54000,true),
(1,2,'7 series','Bmw',2020,80000,true),
(1,3,'Clio','Renault',2019,100000,false),
(1,1,'Camaro','Chevrolet',2005,90000,false);