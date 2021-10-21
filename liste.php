<?php
 require 'database.php';
 $db = Database::connect();
 if(isset($_GET['rechercher']) && !empty($_GET['q'])){
    $statement = $db->query("SELECT * FROM produit
    WHERE libelle LIKE '%".$_GET['q']."%'");
 }else{
 $statement = $db->query('SELECT * 
 FROM produit ORDER BY id DESC');
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
    <link rel="stylesheet" href="css/style.css">
    <title>Geek Stock</title>
</head>
    <body>
    <h1 class="text-logo"> <span class="glyphicon glyphicon-"></span> Geek Stock<span class="glyphicon glyphicon"></span> </h1>
    <div class="container admin">
        <div class="row">

        <div class="row entete d-flex" id="entete">
            <div class="col-sm-8">
                <h1><strong class="ms-auto">Liste des produits</strong><a href="insert.php" class="btn btn-succcess btn-lg"> <span class="glyphicon glyphicon-plus ms-auto"></span> Ajouter</a></h1> 
            </div>
            <div class="col-sm-4">
            <form method="get" action="liste.php" id="searchForm" class="form-group">
                <div class="input-group">
                    <input type="search" name="q" placeholder="Rechercher" class="form-control">
                    <button type="submit" name="rechercher" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                          </svg>
                    </button>
                </div>
            </form>
            </div>
        </div>
        <table class="table table-striped table-bordered">
            
            <thead>
                <tr>
                    <th>Reference</th>
                    <th>Libelle</th>
                    <th>Quantite minimale</th>
                    <th>Quantite en stock</th>
                    <th>Actions</th>
                </tr>
            </head>
            <tbody>
                <?php
                   
                    while($item = $statement->fetch())
                    {
                    
                        echo '<tr>';
                        echo '<td>' . $item['reference'] . '</td>';
                        echo '<td>' . $item['libelle'] . '</td>';
                        echo '<td>' . $item['quantite_minimale'] . '</td>';
                        echo '<td>' . $item['quantite_en_stock'] . '</td>';
                        echo '<td width="330">';
                        
                        echo '<a href="update.php?id=' . $item['id'] . '" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modifier</a>';
                        echo ' ';
                        echo '<a href="delete.php?id=' . $item['id'] . '" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Supprimer</a>';
                        echo ' ';
                        echo '<a href="stock.php?id=' . $item['id'] . '" class="btn btn-default"><span class="glyphicon glyphicon-eye-open"></span> Stocker</a>';
                    
                            echo '</td>';
                        echo '</tr>';
                    }
                    Database::disconnect();
                ?>
            </tbody>
        </table>


    </div>
    </div>


    </body>
</html>