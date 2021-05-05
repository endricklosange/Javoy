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



INSERT INTO category(id,name,image) VALUES(1,'Vin rouge','https://cdn.pixabay.com/photo/2020/04/13/17/54/a-bottle-of-wine-5039546_960_720.png%27'),(2,'Vin Blanc','https://cdn.pixabay.com/photo/2018/02/27/14/07/white-wine-3185546_960_720.jpg%27'),(3,'Vin Rosé','https://cdn.pixabay.com/photo/2019/08/18/16/38/champagne-4414476_960_720.jpg%27'),(4,'Spiritueux','https://cdn.pixabay.com/photo/2016/02/13/21/59/alcohol-1198643_960_720.jpg'),(5,'Jus de Fruits','https://cdn.pixabay.com/photo/2015/03/10/18/53/fruit-juices-667570_960_720.jpg');



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

