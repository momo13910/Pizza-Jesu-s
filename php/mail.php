<?php
$name = $_POST['name'];
$mail = $_POST['email']; 
$message = $_POST['message'];
$selection = $_POST['selection'];

if(!$name || !$mail || !$message || !$selection) {
    echo 'Veuillez remplir tous les champs S.V.P !';
    exit();
}



?>