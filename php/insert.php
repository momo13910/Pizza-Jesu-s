<?php

if(isset($_POST["nom"]))
{
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $image = $_FILES['image'];

    $connect = new mysqli("localhost", "root", "", "pizzeria");
    $sql = $connect->prepare("INSERT INTO pizza (nom, description, prix, image) VALUES (?, ?, ?, ?)");
    $sql->bind_param('ssdi', $nom, $description, $prix, $image);
    $sql->execute();
    $sql->close();
    $connect->close();
}
?>