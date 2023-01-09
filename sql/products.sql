DROP TABLE IF EXISTS products;
CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price FLOAT NOT NULL,
    cost FLOAT NOT NULL,
    ready_to_sell BOOLEAN NOT NULL default '0',
    category_id INT,
    user_id INT,
    store_id INT,
    created_at timestamp default NOW(),
    updated_at timestamp default NOW(),
    -- FOREIGN KEYS 
    FOREIGN KEY(user_id) references users(id),
    FOREIGN KEY(store_id) references stores(id),
    FOREIGN KEY(category_id) references categories(id)
);

-- @block
-- INSERT INTO products (title,description,price,cost,ready_to_sell,user_id,store_id,category_id)
-- VALUES ;

-- @block
DELETE FROM products;