--@block
DROP TABLE IF EXISTS cars;
--@block
CREATE TABLE cars (
	id serial,
	seller int NOT NULL references Users(id),
	category int NOT NULL references Categories(id),
	name VARCHAR(255) NOT NULL,
	made VARCHAR(255) NOT NULL,
	price FLOAT NOT NULL,
	year VARCHAR(4) NOT NULL,
	ready_to_sell BOOLEAN NOT NULL
);

-- @block
INSERT INTO cars
(seller,category,name,made,year,price,ready_to_sell)
VALUES
(1,1,'g 65','Mercedes-benz',2022,54000,true),
(1,2,'7 series','Bmw',2020,80000,true),
(1,3,'Clio','Renault',2019,100000,false),
(1,1,'Camaro','Chevrolet',2005,90000,false);

-- @block
SELECT
	Categories.id AS category_id,
	Categories.name AS category_name,
	Cars.id AS car_id,
	Cars.name AS car_name,
	Cars.seller,
	made,
	price,
	year,
	ready_to_sell
	from Cars
	INNER JOIN Categories
	ON Cars.category = Categories.id
	WHERE Cars.seller=1;