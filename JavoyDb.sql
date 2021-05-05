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

CREATE TABLE actuality (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(80) NOT NULL,
  description varchar(500) NOT NULL,
  article text NOT NULL,
  image varchar(255) NOT NULL,
  created_at date NOT NULL,
  PRIMARY KEY (id)
)

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
  detail VARCHAR(2000) NOT NULL
);

CREATE TABLE status (
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  name VARCHAR(80) NOT NULL,
  color VARCHAR(80) NOT NULL,
  icon VARCHAR(500)
);

ALTER TABLE `order` ADD FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);

INSERT INTO status (name) VALUES ('En cours');
INSERT INTO status (name) VALUES ('Livrée');
INSERT INTO status (name) VALUES ('Annulée');