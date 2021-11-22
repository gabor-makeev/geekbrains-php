DROP DATABASE IF EXISTS catalog;
CREATE DATABASE catalog;

USE catalog;

DROP TABLE IF EXISTS images;
CREATE TABLE images (
  id SERIAL PRIMARY KEY,
  url VARCHAR(255) UNIQUE NOT NULL
);

DROP TABLE IF EXISTS goods;
CREATE TABLE goods (
  id SERIAL PRIMARY KEY,
  name VARCHAR(150) UNIQUE NOT NULL,
  description TEXT NOT NULL,
  image_id BIGINT UNSIGNED NOT NULL,
  price INT UNSIGNED NOT NULL,
  FOREIGN KEY (image_id) REFERENCES images(id) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO images (url)
VALUES 
  ('http://localhost/gb/geekbrains-php/images/ps_5.jpg'),
  ('http://localhost/gb/geekbrains-php/images/xbox_series_x.jpg'),
  ('http://localhost/gb/geekbrains-php/images/nintendo_switch.jpg');

INSERT INTO goods (name, description, image_id, price)
VALUES 
  ('PlayStation 5', 'risus quis varius quam quisque id diam vel quam elementum', 1, 100),
  ('Xbox Series X', 'aliquam faucibus purus in massa tempor nec feugiat nisl pretium', 2, 200),
  ('Nintendo Switch', 'eget arcu dictum varius duis at consectetur lorem donec massa', 3, 300);