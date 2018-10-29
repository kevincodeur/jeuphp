<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=yes">
    <title>Exercice n°8</title>
</head>

<body>
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
    <h1>Moyenne d'âge générale</h1>
    <table>
        <caption></caption>
        <thead>
            <tr>
                <th>Moyenne d'âge</th>
            </tr>
        </thead>

        <tbody>


            <?php

$req1 = "SELECT AVG(FLOOR(DATEDIFF(CURRENT_DATE, STR_TO_DATE(jeuphp.birth_date, '%d/%m/%Y')) / 365.25)) AS agemoyentotal FROM jeuphp jeuphp";
$datas = $bdd->query($req1)->fetchAll(PDO::FETCH_ASSOC);


// pour chaque ligne (chaque enregistrement) dans phpmyadmin 
    foreach ( $datas as $data ) 
    {
?>

            <tr>
                <td>
                    <?php echo $data['agemoyentotal']; ?>
                </td>
            </tr>

            <?php
    } // fin foreach
?>


        </tbody>
    </table>

    <!-- SECOND TABLEAU -->

    <h1>Moyenne d'âge par sexe</h1>
    <table>
        <caption></caption>
        <thead>
            <tr>
                <th>Sexe</th>
                <th>Moyenne d'âge</th>
            </tr>
        </thead>

        <tbody>


            <?php

$req1 = "SELECT gender, AVG(FLOOR(DATEDIFF(CURRENT_DATE, STR_TO_DATE(jeuphp.birth_date, '%d/%m/%Y')) / 365.25)) AS agemoyen FROM jeuphp jeuphp GROUP BY `gender`";
$datas = $bdd->query($req1)->fetchAll(PDO::FETCH_ASSOC);


// pour chaque ligne (chaque enregistrement) dans phpmyadmin 
    foreach ( $datas as $data ) 
    {
?>

            <tr>
                <td>
                    <?php echo $data['gender']; ?>
                </td>
                <td>
                    <?php echo $data['agemoyen']; ?>
                </td>
            </tr>

            <?php
    } // fin foreach
?>


        </tbody>
    </table>

    <!-- TROISIEME TABLEAU -->
    <h1>Age de chaque utilisateurs</h1>
    <table>
        <caption></caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Last name</th>
                <th>First name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>IP adress</th>
                <th>Birth date</th>
                <th>Age</th>
                <th>Zip Code</th>
                <th>State code</th>
                <th>Country code</th>
            </tr>
        </thead>

        <tbody>


            <?php

$req1 = "SELECT *, FLOOR(DATEDIFF(CURRENT_DATE, STR_TO_DATE(jeuphp.birth_date, '%d/%m/%Y')) / 365.25) AS AGE FROM jeuphp jeuphp";
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
                    <?php echo $data['last_name']; ?>
                </td>
                <td>
                    <?php echo $data['first_name']; ?>
                </td>
                <td>
                    <?php echo $data['email']; ?>
                </td>
                <td>
                    <?php echo $data['gender']; ?>
                </td>
                <td>
                    <?php echo $data['ip_adress']; ?>
                </td>
                <td>
                    <?php echo $data['birth_date']; ?>
                </td>
                <td>
                    <?php echo $data['AGE']; ?>
                </td>
                <td>
                    <?php echo $data['zip_code']; ?>
                </td>
                <td>
                    <?php echo $data['state_code']; ?>
                </td>
                <td>
                    <?php echo $data['country_code']; ?>
                </td>
            </tr>

            <?php
    } // fin foreach
?>


        </tbody>
    </table>


</body>

</html>