CREATE DATABASE pirmais_darbs;

USE pirmais_darbs;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    phone_number VARCHAR(15),
    personal_code VARCHAR(20) UNIQUE
);
