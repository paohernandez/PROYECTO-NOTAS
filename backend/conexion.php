<?php
    $host = 'localhost';
    $dbname = 'bd_ineb';
    $username = 'root';
    $password = '';

try {
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
