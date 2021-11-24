DROP DATABASE IF EXISTS shop;
CREATE DATABASE shop;

USE shop;

CREATE TABLE goods (
  id SERIAL PRIMARY KEY,
  name VARCHAR(150) UNIQUE NOT NULL
);

INSERT INTO goods (name) 
VALUES
  ('Computer'),
  ('Monitor'),
  ('Keyboard'),
  ('Mouse');