DROP TABLE IF EXISTS categories;
CREATE TABLE IF NOT EXISTS categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL UNIQUE,
    slug varchar(255) NOT NULL UNIQUE,
    user_id INT,
    FOREIGN KEY(user_id) references users(id)
);

-- @block
INSERT INTO categories (name, slug, user_id)
VALUES ('health','health', 1), ('sport','sport',1),('books','books',1),('tech','tech',1);

-- @block
DELETE FROM categories;