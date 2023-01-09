DROP TABLE IF EXISTS stores;
CREATE TABLE IF NOT EXISTS stores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL UNIQUE,
    slug varchar(255) NOT NULL UNIQUE,
    user_id INT,
    FOREIGN KEY(user_id) references users(id)
);

-- @block
INSERT INTO stores (name, slug, user_id)
VALUES ('Main Store','main-store', 1), ('Second Store','second-store',1);

-- @block
DELETE FROM stores;