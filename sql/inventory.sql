DROP TABLE IF EXISTS inventories;
CREATE TABLE inventories (
    id SERIAL PRIMARY KEY,
    seller int references users(id),
    inventory_name varchar(255) NOT NULL UNIQUE
);
-- @block
INSERT INTO inventories (seller,inventory_name) VALUES (1,'2021 inventory'),(1,'2022 inventory'),(1,'2023 inventory');

-- @block
SELECT * FROM Inventories
        WHERE seller=1 ORDER BY id;