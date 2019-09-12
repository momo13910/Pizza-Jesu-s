



<?php



    
if  (isset($_GET['valider'])) {
    $nom = ( $_GET['nom']);
    $email = ( $_GET['email']);
    $message = ($_GET['message']);
    $selection = ($_GET['selection']) ;
   
    $connect = new mysqli("localhost", "root", "", "pizzeria")
        or die ("Connexion au serveur impossible");
        
    //On prépare la commande sql d'insertion
    $sql = $connect->prepare("INSERT INTO contact (nom, email, reclamation, message) VALUES (?, ?, ?, ?)");
    $sql->bind_param('ssss', $nom, $email, $selection, $message);
   $sql->execute();
   $sql->close();
    $connect->close();
    echo 'VOTRE MESSAGE A ETE ENVOYE';
    header("refresh:3;url=../index.html");
    exit();
    
}



?>

