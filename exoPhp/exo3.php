<!DOCTYPE html>
<html lang="fr">
	
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, user-scalable=yes">
		<title>Exercice n°3</title>
	</head>

	<body>
    <h1>Liste des Etats qui ont pour première lettre N</h1>
    <a href ="index.php"><button type="button">Accueil</button></a>
    <style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 10px;
}
</style>


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
        <th>Zip Code</th>
        <th>Avatar url</th>
        <th>State code</th>
        <th>Country code</th>
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

$req1 = "SELECT * FROM jeuphp WHERE state_code LIKE'n%'";
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
        <td><?php echo $data['zip_code']; ?></td>
        <td><?php echo $data['avatar_url']; ?></td>
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