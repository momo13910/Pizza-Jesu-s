<?php
    
    if  ($_POST['valider']) {
    $mysqli = new mysqli('localhost', 'root', '', 'pizzeria');
    $mysqli->set_charset("utf8");
    $requete = 'SELECT * FROM contact';
    $resultat = $mysqli->query($requete);
    
    while ($ligne = $resultat->fetch_assoc()) {
    
        echo $ligne['nom'].' '.$ligne['email'].' '.$ligne['reclamation'].' ';
        echo $ligne['message'].'<br>';
       
    }

    $mysqli->close();
    }
?>