CREATE DATABASE InventoryDB;
USE InventoryDB;

CREATE TABLE users(
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(50) NOT NULL,
    Email VARCHAR(100) UNIQUE NOT NULL,
    Password VARCHAR(255),
    Role ENUM("admin","user","manager") NOT NULL

);

CREATE TABLE stock_item(
    ItemID INT PRIMARY KEY,
    Name VARCHAR(50),
    Price DECIMAL(10, 2),
    Manufacturer VARCHAR(50),
    Quantity INT,
    Date_Added DATE
);