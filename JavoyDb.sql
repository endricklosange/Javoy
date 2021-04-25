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

CREATE TABLE `actuality` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(255),
  `article` TEXT,
  `image` VARCHAR(255),
  `created_at` DATE
);

