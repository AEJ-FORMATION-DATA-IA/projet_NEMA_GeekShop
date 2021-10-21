<?php
    require 'database.php';

    $Error = $emailError = $passwordError = $email = $password = "";
    
    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

   
    if(!empty($_POST))
    {
        $email           = checkInput($_POST['email']);
        $password        = checkInput($_POST['pass']);
        $isSuccess       = true;

        if(empty($email))
        {
            $emailError = "Ce champ ne peut pas etre vide";
            $isSuccess = false;
        }
        if(empty($password))
        {
            $passwordError = "Ce champ ne peut pas etre vide";
            $isSuccess = false;
        }   

            if($isSuccess)

            {
                    $db = Database::connect();
                    $req= $db->prepare("SELECT * FROM users WHERE email=:email AND pass=:pass");
                    $req->execute(array(
                        "email"=>$email,
                        "pass"=>$password
                        ));                    
                        Database::disconnect();

                        $resultat = $req->fetch();

                if(!$resultat)
                    {
                        $msg=" Email et / ou Mot de passe incorrecte !";
                    }
                else
                    {
                        header("Location: liste.php");
                    }
            }
        

    }

  
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Connexion</title>
</head>
<body>
    <div class="FormConnexion">
        <div class="form-text">Connexion</div>
        <div class="form-saisie">
            <form method="post" action="index.php">

                <span>E-mail :</span>
                <input type="email" required name="email" placeholder="Adresse Email">

                <span>Mot de pass :</span>
                <input type="password" required name="pass" placeholder="Mot de pass">
                <input type="submit" name="connexion" value="Connexion" class="btnConn">
                Vous n'êtes pas inscris ?&nbsp;<a href="inscription.php">Inscrivez-vous</a>
            </form>
        </div>
    </div>
</body>
</html>