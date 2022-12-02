--@block
DROP TABLE IF EXISTS Categories CASCADE;
--@block
CREATE TABLE IF NOT EXISTS Categories (
    id serial PRIMARY KEY,
    seller int references Users(id),
    name VARCHAR(255) UNIQUE NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL
);
-- @block
INSERT INTO Categories
(seller,name,slug)
VALUES
(1,'sedan','sedan'),
(1,'hatch back','hatch-back'),
(1,'SUV','suv');
--@block
SELECT *
from Categories;
--@block