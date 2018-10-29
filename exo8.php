<!DOCTYPE html>
<html lang="fr">
	
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, user-scalable=yes">
		<title>Exercices</title>
	</head>

	<body>
    <style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 10px;
}
</style>

<?php 
try{
    $bdd = new PDO('mysql:host=localhost:3306;dbname=exercice;charset=utf8','clementinel','online@2017');
    }
    catch(Exception $e)
    {
    die('Erreur : '.$e->getMessage());
    }
?>

<table>
    <caption><h1>Moyenne d'âge générale</h1></caption>
<thead>
    <tr>
        <th>Moyenne d'âge</th>
    </tr>
</thead>

<tbody>


    <?php

$req1 = "SELECT AVG(FLOOR(DATEDIFF(CURRENT_DATE, STR_TO_DATE(utilisateurs.birth_date, '%d/%m/%Y')) / 365.25)) AS agemoyentotal FROM utilisateurs utilisateurs";
$datas = $bdd->query($req1)->fetchAll(PDO::FETCH_ASSOC);


// pour chaque ligne (chaque enregistrement) dans phpmyadmin 
    foreach ( $datas as $data ) 
    {
?>

    <tr>
        <td><?php echo $data['agemoyentotal']; ?></td>
    </tr>

<?php
    } // fin foreach
?>


</tbody>
</table>

                                    <!-- SECOND TABLEAU -->

<table>
    <caption><h1>Moyenne d'âge par sexe</h1></caption>
<thead>
    <tr>
        <th>Sexe</th>
        <th>Moyenne d'âge</th>
    </tr>
</thead>

<tbody>


    <?php

$req1 = "SELECT `gender`, AVG(FLOOR(DATEDIFF(CURRENT_DATE, STR_TO_DATE(utilisateurs.birth_date, '%d/%m/%Y')) / 365.25)) AS agemoyen FROM utilisateurs utilisateurs GROUP BY `gender`";
$datas = $bdd->query($req1)->fetchAll(PDO::FETCH_ASSOC);


// pour chaque ligne (chaque enregistrement) dans phpmyadmin 
    foreach ( $datas as $data ) 
    {
?>

    <tr>
        <td><?php echo $data['gender']; ?></td>
        <td><?php echo $data['agemoyen']; ?></td>
    </tr>

<?php
    } // fin foreach
?>


</tbody>
</table>

                            <!-- TROISIEME TABLEAU -->

<table>
    <caption><h1>Age de chaque utilisateurs</h1></caption>
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

$req1 = "SELECT *, FLOOR(DATEDIFF(CURRENT_DATE, STR_TO_DATE(utilisateurs.birth_date, '%d/%m/%Y')) / 365.25) AS AGE FROM utilisateurs utilisateurs";
$datas = $bdd->query($req1)->fetchAll(PDO::FETCH_ASSOC);


// pour chaque ligne (chaque enregistrement) dans phpmyadmin 
    foreach ( $datas as $data ) 
    {
?>

    <tr>
        <td><?php echo $data['id']; ?></td>
        <td><?php echo $data['last_name']; ?></td>
        <td><?php echo $data['first_name']; ?></td>
        <td><?php echo $data['email']; ?></td>
        <td><?php echo $data['gender']; ?></td>
        <td><?php echo $data['ip_adress']; ?></td>
        <td><?php echo $data['birth_date']; ?></td>
        <td><?php echo $data['AGE']; ?></td>
        <td><?php echo $data['zip_code']; ?></td>
        <td><?php echo $data['state_code']; ?></td>
        <td><?php echo $data['country_code']; ?></td>
    </tr>

<?php
    } // fin foreach
?>


</tbody>
</table>


</body>
</html>