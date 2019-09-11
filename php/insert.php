




<?php
if (isset($_POST)) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $image = $_FILES['file']['name'];

    $test = explode('.', $_FILES['file']['name']);
    $extension = end($test);    
    $name = bin2hex(random_bytes(10)).'.'.$extension;

    $location = '../img/'.$name;
    move_uploaded_file($_FILES['file']['tmp_name'], $location);
    
    $connect = new mysqli("localhost", "root", "", "pizzeria");
    $sql = $connect->prepare("INSERT INTO pizza (nom, description, prix, image) VALUES (?, ?, ?, ?)");
    $sql->bind_param('ssds', $nom, $description, $prix, $name);
    $sql->execute();
    $sql->close();
    $connect->close();
}
?>