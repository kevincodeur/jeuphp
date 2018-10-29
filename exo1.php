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


<table>
    <caption><h1>Liste des utilisateurs ayant pour nom 'Palmer'</h1></caption>
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
$bdd = new PDO('mysql:host=localhost:3306;dbname=exercice;charset=utf8','clementinel','online@2017');
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}

$req1 = "SELECT * FROM utilisateurs WHERE last_name ='palmer'";
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