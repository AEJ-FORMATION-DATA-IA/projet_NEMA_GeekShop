<?php
    require 'database.php';
    
    $referenceError = $libelleError = $quantite_minimaleError = $quantite_en_stockError = $reference = $libelle = $quantite_minimale = $quantite_en_stock = "";
   
    if(!empty($_POST))
    {
        $reference           = checkInput($_POST['reference']);
        $libelle             = checkInput($_POST['libelle']);
        $quantite_minimale   = checkInput($_POST['quantite_minimale']);
        $quantite_en_stock   = checkInput($_POST['quantite_en_stock']);
        $isSuccess           = true;
        $isUploadSuccess     = false;

        if(empty($reference))
            {
                $referenceError = "Ce champ ne peut pas etre vide";
                $isSuccess      = false;
            }
        if(empty($libelle))
        {
            $libelleError = "Ce champ ne peut pas etre vide";
            $isSuccess = false;
        }
        if(empty($quantite_minimale))
        {
            $quantite_minimaleError = "Ce champ ne peut pas etre vide";
            $isSuccess = false;
        }
        if(empty($quantite_en_stock))
        {
            $quantite_en_stockError = "Ce champ ne peut pas etre vide";
            $isSuccess = false;
        } 

        if($isSuccess)
        {
            $db = Database::connect();
            $statement = $db->prepare("INSERT INTO produit (reference, libelle,quantite_minimale,quantite_en_stock) values(?, ?, ?, ?)");
            $statement->execute(array($reference,$libelle,$quantite_minimale,$quantite_en_stock));
            Database::disconnect();
            header("Location: liste.php");
        }

    }


    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <title>Burger Code</title>
</head>
    <body>

    <h1 class="text-logo"> <span class="glyphicon glyphicon-cutlery"></span> GESTION DE STOCK <span class="glyphicon glyphicon-cutlery"></span> </h1>
    <div class="container admin">
            <div class="row">
                <h1><strong>Ajouter un produit</strong></h1>
                <br>
                    <form action="insert.php" role="form" method="post" class="form">
                            <div class="form-group">
                                <label for="reference">Reference : </label>
                                <input type="text" class="form-control" name="reference" id="reference" placeholder="La Reference du produit" value="<?php echo $reference; ?>"> 
                                <span class="help-inline"><?php echo $referenceError; ?></span>
                            </div>
                            <div class="form-group">
                            <label for="description">Libelle : </label>
                                <input type="text" class="form-control" name="libelle" id="libelle" placeholder="Libelle du produit" value="<?php echo $libelle; ?>"> 
                                <span class="help-inline"><?php echo $libelleError; ?></span>
                            </div>
                            <div class="form-group">
                            <label for="quantite_minimale">Quantite minimale : </label>
                                <input type="number" class="form-control" name="quantite_minimale" id="quantite_minimale" placeholder="La quantite minimale du produit" value="<?php echo $quantite_minimale; ?>"> 
                                <span class="help-inline"><?php echo $quantite_minimaleError; ?></span>
                            </div>
                            <div class="form-group">
                            <label for="quantite_en_stock">Quantite en stock : </label>
                                <input type="number" class="form-control" name="quantite_en_stock" id="quantite_en_stock" placeholder="La quantite du produit a stocker" value="<?php echo $quantite_en_stock; ?>"> 
                                <span class="help-inline"><?php echo $quantite_en_stockError; ?></span>
                            </div>
                <br>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"> Ajouter</span></button>
                    <a class="btn btn-primary" href="accueil.php"><span class="glyphicon glyphicon-arrow-left"> Retour</span></a>
                </div>
            </form>
        </div>
    </div>

    </body>
</html>