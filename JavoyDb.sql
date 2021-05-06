CREATE TABLE product (
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  name VARCHAR(255) NOT NULL,
  price INT NOT NULL,
  description TEXT NULL,
  year INT NOT NULL,
  image VARCHAR(255) NOT NULL,
  created_at DATE NOT NULL,
  category_id INT NOT NULL
);

CREATE TABLE category (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  image varchar(255) NOT NULL,
  PRIMARY KEY (id)
);



INSERT INTO category(id,name,image) VALUES(1,'Vin rouge','vin_rouge.jpg'),(2,'Vin Blanc','vin_blanc.jpg'),(3,'Vin Rosé','rose.jpg'),(4,'Spiritueux','prune_alcool.jpg'),(5,'Jus de Fruits','jus-de-fruit.jpg');



ALTER TABLE product ADD FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

CREATE TABLE actuality (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(80) NOT NULL,
  description varchar(500) NOT NULL,
  article text NOT NULL,
  image varchar(255) NOT NULL,
  created_at date NOT NULL,
  PRIMARY KEY (id)
);

/* CREATION table order et detail_order pour commande */

CREATE TABLE `order` (
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  title VARCHAR(20) NOT NULL,
  firstname VARCHAR(255) NOT NULL,
  lastname VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  address VARCHAR(255) NOT NULL,
  zipcode INT NOT NULL,
  city VARCHAR(255) NOT NULL,
  country VARCHAR(255) NOT NULL,
  detail VARCHAR(2000) NOT NULL,
  status_id INT NOT NULL
);

CREATE TABLE status (
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  name VARCHAR(80) NOT NULL
);

INSERT INTO status (name) VALUES ('En cours');
INSERT INTO status (name) VALUES ('Livrée');
INSERT INTO status (name) VALUES ('Annulée');

ALTER TABLE `order` ADD FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);

