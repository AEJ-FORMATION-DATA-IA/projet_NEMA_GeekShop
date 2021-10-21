<?php
    require 'database.php';

    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(!empty($_GET['id']))
    {
        $id = checkInput($_GET['id']);
    }
    
    $referenceError = $libelleError = $quantite_minimaleError = $quantite_en_stockError = $reference = $libelle = $quantite_minimale = $quantite_en_stock = "";
   
    if(!empty($_POST))
    {
        $reference            = checkInput($_POST['reference']);
        $libelle     = checkInput($_POST['libelle']);
        $quantite_minimale           = checkInput($_POST['quantite_minimale']);
        $quantite_en_stock        = checkInput($_POST['quantite_en_stock']);
        $isSuccess       = true;

        if(empty($reference))
            {
                $referenceError = "Ce champ ne peut pas etre vide";
                $isSuccess = false;
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
            
                $statement = $db->prepare("UPDATE produit SET reference = ?, libelle = ?, quantite_minimale = ?, quantite_en_stock = ? WHERE id = ?");
                $statement->execute(array($reference,$libelle,$quantite_minimale,$quantite_en_stock,$id));              

            Database::disconnect();
            header("Location: liste.php");
        }

    }
    else
    {
    $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM produit WHERE id = ?");
        $statement->execute(array($id));
        $item = $statement->fetch();
        $reference         = $item['reference'];
        $libelle           = $item['libelle'];
        $quantite_minimale = $item['quantite_minimale'];
        $quantite_en_stock = $item['quantite_en_stock'];
        Database::disconnect();
    }
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <title>Geek Stock</title>
</head>
    <body>

    <h1 class="text-logo"> <span class="glyphicon glyphicon-cutlery"></span> Geek Stock <span class="glyphicon glyphicon-cutlery"></span> </h1>
    <div class="container admin">
            <div class="row">
                    <h1><strong>Modifier l'enregistrement du produit</strong></h1>
                        <br>
                        <form action="<?php echo 'update.php?id=' .$id; ?>" role="form" method="post" class="form">
                                    <div class="form-group">
                                        <label for="reference">Reference : </label>
                                        <input type="text" class="form-control" name="reference" id="reference" placeholder="Reference du produit" value="<?php echo $reference; ?>"> 
                                        <span class="help-inline"><?php echo $referenceError; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="libelle">Libelle : </label>
                                        <input type="text" class="form-control" name="libelle" id="libelle" placeholder="Libelle du produit" value="<?php echo $libelle; ?>"> 
                                        <span class="help-inline"><?php echo $libelleError; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Quantite minimale : </label>
                                        <input type="number" class="form-control" name="quantite_minimale" id="quantite_minimale" placeholder="Quantite minimale" value="<?php echo $quantite_minimale; ?>"> 
                                        <span class="help-inline"><?php echo $quantite_minimaleError; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantite_en_stock">Quantite en stock : </label>
                                        <input type="number" class="form-control" name="quantite_en_stock" id="quantite_en_stock" placeholder="Quantite en stock" value="<?php echo $quantite_en_stock; ?>"> 
                                        <span class="help-inline"><?php echo $quantite_en_stockError; ?></span>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"> Modifier</span></button>
                                        <a class="btn btn-primary" href="liste.php"><span class="glyphicon glyphicon-arrow-left"> Retour</span></a>
                                    </div>
                        </form>  
            </div>
    </div>

    </body>
</html>