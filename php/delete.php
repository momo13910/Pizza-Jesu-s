<?php
$nom = $_POST['nom'];

$connect = new mysqli("localhost", "root", "", "pizzeria");
$sql = $connect->prepare("DELETE FROM pizza WHERE nom=?");
$sql->bind_param('s', $nom);
$sql->execute();
$sql->close();
$connect->close();

?>