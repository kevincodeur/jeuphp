<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=yes">
    <title>Exercice n°5</title>
</head>

<body>
    <h1>Répartition par Etat et par nombre d'enregistrements</h1>
    <a href ="index.php"><button type="button">Accueil</button></a>
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


    <table>
        <caption></caption>
        <thead>
            <tr>
                <th>State code</th>
                <th>Nombre</th>
            </tr>
        </thead>

        <tbody>




            <?php
try{
$bdd = new PDO('mysql:host=localhost:3306;dbname=users;charset=utf8','tmarechal','c28a64d484f088');
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}

$req1 = "SELECT state_code, COUNT(*) as nombre FROM jeuphp GROUP BY state_code ORDER BY COUNT(*), state_code ASC";
$datas = $bdd->query($req1)->fetchAll(PDO::FETCH_ASSOC);


// pour chaque ligne (chaque enregistrement) dans phpmyadmin 
    foreach ( $datas as $data ) 
    {
?>

            <tr>
                <td>
                    <?php echo $data['state_code']; ?>
                </td>
                <td>
                    <?php echo $data['nombre']; ?>
                </td>
            </tr>

            <?php
    } // fin foreach
?>


        </tbody>
    </table>

</body>

</html>