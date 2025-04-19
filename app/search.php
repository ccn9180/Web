<?php
require 'base.php';

$name = $_GET['name'] ?? '';
$books = [];

if ($name) {
    $stm = $_db->prepare('SELECT * FROM products WHERE name LIKE ?');
    $stm->execute(["%$name%"]);
    $books = $stm->fetchAll(PDO::FETCH_ASSOC);
}

header('Content-Type: application/json');
echo json_encode($books);
