CREATE TABLE product (
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  category VARCHAR(80) NOT NULL,
  name VARCHAR(255) NOT NULL,
  price INT NOT NULL,
  description VARCHAR(255) NOT NULL,
  year INT NOT NULL,
  image VARCHAR(255) NOT NULL,
  created_at DATE NOT NULL
);

/* CREATION table pour commande */

CREATE TABLE customer (
  id INT PRIMARY KEY AUTO_INCREMENT,
  firstname VARCHAR(255),
  lastname VARCHAR(255),
  email VARCHAR(255),
  adress VARCHAR(255),
  zipcode INT,
  city VARCHAR(255),
  country VARCHAR(255)
);

CREATE TABLE order (
  id INT PRIMARY KEY AUTO_INCREMENT,
  status VARCHAR(255),
  created_at DATE,
  customer_id INT UNIQUE NOT NULL,
  detail_id INT UNIQUE NOT NULL,
  status_id INT UNIQUE NOT NULL
);

CREATE TABLE detail_order (
  id INT PRIMARY KEY AUTO_INCREMENT,
  quantity INT,
  order_id INT UNIQUE NOT NULL,
  product_id INT UNIQUE NOT NULL
);

CREATE TABLE status_order (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255),
  created_at DATE
);

CREATE TABLE product (
  id int PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255),
  price INT,
  description VARCHAR(255),
  year INT,
  image VARCHAR(255),
  created_at DATE,
  category_id INT UNIQUE NOT NULL
);