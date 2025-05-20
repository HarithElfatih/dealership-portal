CREATE DATABASE IF NOT EXISTS my_website;
USE my_website;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activated BOOLEAN DEFAULT FALSE
);

CREATE TABLE vehicles (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    vehicle_name VARCHAR(255) NOT NULL,
    vehicle_model VARCHAR(255) NOT NULL,
    vehicle_mileage VARCHAR(255) NOT NULL,
    owner_id INT(11) NOT NULL,
    creation_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    image_path CHAR(255) NULL,
    vehicle_price FLOAT NOT NULL
);

CREATE TABLE email_verification (
    user_id INT,
    token VARCHAR(64),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
