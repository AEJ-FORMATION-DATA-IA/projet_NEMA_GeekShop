<?php
    require 'database.php';

    $Error = $pseudoError = $emailError = $passwordError = $passError = $pseudo = $email = $password = $pass = "";
    
    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

   
    if(!empty($_POST))
    {
        $pseudo          = checkInput($_POST['pseudo']);
        $email           = checkInput($_POST['email']);
        $pass            = checkInput($_POST['pass']);
        $isSuccess       = true;

        if(empty($pseudo))
            {
                $pseudoError = "Ce champ ne peut pas etre vide";
                $isSuccess = false;
            }
        if(empty($email))
        {
            $emailError = "Ce champ ne peut pas etre vide";
            $isSuccess = false;
        }
        if(empty($pass))
        {
            $passError = "Ce champ ne peut pas etre vide";
            $isSuccess = false;
        }
          

        if($isSuccess)

        {

                $db = Database::connect();
                $statement = $db->prepare("INSERT INTO users (pseudo, email, pass, date) values(?, ?, ?, NOW())");
                $statement->execute(array($pseudo,$email,$pass));
                Database::disconnect();
                $Error = "Votre compte a été crée avec succes !";
                header("Location: index.php");
            
        }

     }

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Inscription</title>
</head>
<body>
    <div class="FormInscrs">
        <div class="form-text">Inscription</div>
        <div class="form-saisie">
            <form method="post" action="inscription.php">
                <span>Nom & Prenom :</span>
                <input type="text" required name="pseudo" placeholder="Votre Nom et Prenom(s)">

                <span>Adress Email :</span>
                <input type="email" required name="email" placeholder=" Votre Adresse Email">

                <span>Mot de pass :</span>
                <input type="pass" required name="pass" placeholder="Votre mot de pass">

                <input type="submit" name="envoyer" value="S'inscrire" class="btnInscris">
                Etes-vous inscris ?&nbsp;<a href="index.php">Connectez-vous</a>
            </form>
        </div>
    </div>
</body>
</html>