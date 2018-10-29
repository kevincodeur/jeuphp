<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=yes">
    <title>Exercice n°9</title>
</head>

<body>
    <h1>Membres ACS</h1>
    <a href="index.php"><button type="button">Accueil</button></a>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
        }
    </style>

    <?php 
try{
    $bdd = new PDO('mysql:host=localhost:3306;dbname=users;charset=utf8','tmarechal','c28a64d484f088');
    }
    catch(Exception $e)
    {
    die('Erreur : '.$e->getMessage());
    }
?>
    <table>
        <caption></caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>ID_DPT</th>
                <th>ID_DPT</th>
                <th>NUMERO_DPT</th>
                <th>NOM_DPT</th>
            </tr>
        </thead>

        <tbody>


            <?php

$req1 = "SELECT * 
FROM `MembreACS`
INNER JOIN `DépartementACS`
ON `MembreACS`.`idDPT` = `DépartementACS`.`idDPT`";
$datas = $bdd->query($req1)->fetchAll(PDO::FETCH_ASSOC);


// pour chaque ligne (chaque enregistrement) dans phpmyadmin 
    foreach ( $datas as $data ) 
    {
?>

            <tr>
                <td>
                    <?php echo $data['id']; ?>
                </td>
                <td>
                    <?php echo $data['prénom']; ?>
                </td>
                <td>
                    <?php echo $data['nom']; ?>
                </td>
                <td>
                    <?php echo $data['idDPT']; ?>
                </td>
                <td>
                    <?php echo $data['idDPT']; ?>
                </td>
                <td>
                    <?php echo $data['numéroDPT']; ?>
                </td>
                <td>
                    <?php echo $data['nomDPT']; ?>
                </td>
                <td>
                    <?php echo $data['agemoyentotal']; ?>
                </td>
            </tr>

            <?php
    } // fin foreach
?>


        </tbody>
    </table>

</body>

</html>