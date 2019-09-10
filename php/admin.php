<?php
header("Access-Control-Allow-Origin: *");
$nom = $_POST['name'];
$pass = $_POST['pass'];

if (!$nom || !$pass) {
    echo 'Veuillez saisir tous les champs';
}

$connexion = new mysqli("localhost", "root", "", "pizzeria");

$requette = $connexion -> prepare("SELECT nom, password FROM admin WHERE nom =?");
$requette -> bind_param("s", $nom);
$requette -> execute();

$bdd_nom = null;
$bdd_pass = null;

$requette -> bind_result($bdd_nom, $bdd_pass);
$requette -> fetch();

$requette->close();
$connexion->close();

if ($bdd_nom != $nom ) {
    echo "Nom d'utilisateur incorrect";   
} else if ($pass != $bdd_pass) {
    echo "Mot de passe incorrect";
} else {
    echo "http://localhost/Pizza-Jesu-s/html/InterfaceAdmin.php";
}
?>