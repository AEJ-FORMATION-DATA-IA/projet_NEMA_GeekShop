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
    <title>Geek Stock</title>
</head>
    <body>
    <h1 class="text-logo"> <span class="glyphicon glyphicon-"></span> Geek Stock <span class="glyphicon glyphicon"></span> </h1>
    <div class="container admin">
        <div class="row">
        <h1><strong class="ms-auto">Liste des produits</strong><a href="insert.php" class="btn btn-succcess btn-lg"> <span class="glyphicon glyphicon-plus ms-auto"></span> Ajouter</a>
         <form action="" method="post"><table width="108" border="0">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Reference</th>
                    <th>Libelle</th>
                    <th>Quantite minimale</th>
                    <th>Quantite en stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require 'database.php';
                    $db = Database::connect();
                    $statement = $db->query('SELECT * 
                    FROM produit ORDER BY id DESC');
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