<?php
session_start();
if (!isset($_SESSION['id'])) {
    die(json_encode(['success' => false, 'message' => 'Utilizador não está logado.']));
}

$user_id = $_SESSION['id'];
$titulo = $_POST['titulo'];

$conn = new mysqli('localhost', 'root', '', 'scope');
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' =>
