<?php

//include the connection file
include('connection.php');

//create an instance of Connection class
$connection = new Connection();

//call the createDatabase methods to create database "chap4Db"
//$connection->createDatabase('gestion_ae');

$query = "
CREATE TABLE dossier (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    cin VARCHAR(10) NOT NULL UNIQUE,
    category VARCHAR(5) NOT NULL,
    price VARCHAR(10) NOT NULL,
    ref VARCHAR(6) NOT NULL,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    insert_user VARCHAR(50) NULL
)
";
$query1 = "
CREATE TABLE candidat (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
gender VARCHAR(20) NOT NULL,
cin VARCHAR(10) NOT NULL UNIQUE,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
date_birth date,
place_birth VARCHAR(50) NOT NULL,
address VARCHAR(50) NOT NULL,
city VARCHAR(30) NOT NULL,
phone VARCHAR(10) NOT NULL,
a_firstname VARCHAR(30) NOT NULL,
a_lastname VARCHAR(30) NOT NULL,
a_place_birth VARCHAR(50) NOT NULL,
a_address VARCHAR(50) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
insert_user VARCHAR(50) NULL
)
";


$query2 = "
CREATE TABLE reglement (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    cin VARCHAR(10) NOT NULL,
    dossier VARCHAR(5) NOT NULL,
    date_reg DATE NOT NULL,  
    price VARCHAR(6) NOT NULL,
    motif VARCHAR(25) NOT NULL,
    date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    nom_du_payeur VARCHAR(80) NULL,
    insert_user VARCHAR(50) NULL
)
";
$query3 = "
CREATE TABLE exam (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    cin VARCHAR(10) NOT NULL UNIQUE,
    dossier VARCHAR(5) NOT NULL UNIQUE,

    etat_davv_exam INT(1) NOT NULL DEFAULT '0',

    date_exam DATE NOT NULL,  
    type VARCHAR(50) NULL,
    resultat BOOLEAN NULL DEFAULT NULL,
    

    date_insertion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    insert_user VARCHAR(50) NULL
)
";

//call the selectDatabase method to select the chap4Db
$connection->selectDatabase('gestion_ae');

//call the createTable method to create table with the $query
//$connection->createTable($query0);
$connection->createTable($query3);


?>
