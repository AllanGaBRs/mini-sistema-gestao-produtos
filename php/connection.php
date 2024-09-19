<?php

$servername = "localhost";
$username = "root";
$password = ""; 

$conn = new mysqli($servername, $username, $password);
$sql = "CREATE DATABASE IF NOT EXISTS pelegrino";
$conn->query($sql);
$conn->select_db("pelegrino");

$sql = "CREATE TABLE IF NOT EXISTS suppliers(
    cod_supp INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    cnpj_cpf VARCHAR(50) NOT NULL
)";
mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS products (
    cod_prod INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(200) NOT NULL,
    description VARCHAR(200),
    price double,
    quantity int,
    supplier_id INT not null,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(cod_supp)
)";
mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS users (
    cod_user INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(200) NOT NULL,
    adress VARCHAR(200),
    cellnumber VARCHAR(16),
    email VARCHAR(255),
    password VARCHAR(200),
    borndate DATE
)";
mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS basket (
    cod_basket INT(6) AUTO_INCREMENT PRIMARY KEY, 
    totalprice double,
    quantity int,
    user_id INT(6) UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES users(cod_user)
)";
mysqli_query($conn, $sql);
