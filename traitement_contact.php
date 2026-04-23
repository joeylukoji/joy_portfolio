<?php

$prenom_nom = isset($_POST["prenom_nom"]) ? trim($_POST["prenom_nom"]) : "";
$email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
$sujet = isset($_POST["sujet"]) ? trim($_POST["sujet"]) : "";
$message = isset($_POST["message"]) ? trim($_POST["message"]) : "";


if (empty($prenom_nom)){
echo "Veuillez entrer votre prénom et nom s'il vous plaît ";
}
elseif (empty($email)){
    echo "Veuillez entrer votre email s'il vous plaît ";
}
elseif (empty($sujet)){
    echo "Veuillez entrer votre sujet s'il vous plaît, il est obligatoire ";
}
elseif (empty($message)){
    echo "Veuillez entrer votre message s'il vous plaît, il est obligatoire pour continuer ";
}
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "L'email n'est pas valide ";
}
else {
    $prenom_nom_safe = htmlspecialchars($prenom_nom);
    $sujet_safe = htmlspecialchars($sujet);
    $message_safe = htmlspecialchars($message);
    $email_safe = htmlspecialchars($email);

    echo "Merci $prenom_nom_safe, votre message a été reçu avec succès, qui a pour sujet <br> sujet: $sujet_safe et pour message : $message_safe, email de contact : $email_safe ";
}

?>
