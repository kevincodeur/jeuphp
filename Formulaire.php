
<?php
    error_reporting(E_ALL ^ E_NOTICE | E_WARNING);
    ini_set('display_errors', 'ON');


    $message1 = ''; $erreur1 = '';$erreur2 = '';$erreur3 = '';$erreur4 = '';$erreur5 = ''; $type = 'error';
    if(isset($_POST['sendForm'])){
        if ($_POST['name'] == '' || $_POST['mail'] == '' || $_POST['numero'] == '' || $_POST['gender'] == '' || $_POST['Textarea'] == ''){
            $message1 = '<ul class="error">';

            if($_POST['name'] == ''){
            $message1 .= '<li>Veuillez saisir le nom</li>';
            $erreur1 = '*';}

            if($_POST['mail'] == ''){
            $message1 .= '<li>Veuillez saisir le mail</li>';
            $erreur2 = '*';}

            if($_POST['numero'] == ''){
            $message1 .= '<li>Veuillez saisir le numéro</li>';
            $erreur3 = '*';}

            if($_POST['gender'] == ''){
            $message1 .= '<li>Veuillez saisir le genre</li>';
            $erreur4 = '*';}

            if($_POST['Textarea'] == ''){
            $message1 .= '<li>Veuillez saisir du texte</li>';
            $erreur5 = '*';}

            $message1 .= '</ul>';

        }   else {
            
            $type = 'success';

            $mail_html = '';
            $file = fopen('mail.html', 'r');
            while ($ligne = fgets($file)) {
                $mail_html .= $ligne;
            }
            fclose($file);
            
            $date = date("d/m/Y");
            $heure = date("H:i");

            $mail_html = str_replace('{nom}', $_POST['name'], $mail_html);
            $mail_html = str_replace('{mail}', $_POST['mail'], $mail_html);
            $mail_html = str_replace('{numero}', $_POST['numero'], $mail_html);
            $mail_html = str_replace('{gender}', $_POST['gender'], $mail_html);
            $mail_html = str_replace('{Textarea}', $_POST['Textarea'], $mail_html);
            $mail_html = str_replace('{date}', $date, $mail_html);
            $mail_html = str_replace('{heure}', $heure, $mail_html);
            
            $destinataire = 'kevin.c@codeur.online';
            $objet = 'Formulaire de Contact';
            $headers .= 'Content-Type: text/html; charset=utf-8'. "\n";
            $headers .= 'From :' .$_POST['mail'];
            
            

            if (mail($destinataire, $objet, $mail_html, $headers))
            {
                
                $messagemail = 'Votre message a bien été envoyé' ."<br>" .'Le' ."\n" .$date ."\n" .'à' ."\n" .$heure;
            }
            else
            {
                $messagemail = "Votre message n'a pas pu être envoyé";
            }

            $name = $_POST['name'];
            $mail = $_POST['mail'];
            $numero = $_POST['numero'];
            $gender = $_POST['gender'];
            $Textarea = $_POST['Textarea'];

            try { $db = new PDO('mysql:dbname=formulairecontactphp;host=localhost;charset=utf8', 'stagiaire', 'online@2017');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $db->prepare("INSERT INTO utilisateurs (
                                        name,
                                        mail,
                                        tel,
                                        gender,
                                        textarea) VALUES (
                                        :name,
                                        :mail,
                                        :numero,
                                        :gender,
                                        :textarea)"
                                    );

            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
            $stmt->bindValue(':numero', $numero, PDO::PARAM_STR);
            $stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
            $stmt->bindValue(':textarea', $Textarea, PDO::PARAM_STR);
            $stmt->execute();

            $message1 = "Informations envoyés vers la base de données";
            
            } catch(PDOException $e) {
                die("ERROR Informations non envoyés" . $e->getMessage());
            }

            $sql = "select * from utilisateurs
                where mail like " . $db->quote('%'.$_POST['mail'].'%');
                $mailExist = $db->query($sql)->fetch(PDO::FETCH_ASSOC);

                if ($mailExist)
                {
                $messagemail = 'Email déjà utilisé';
                
                
                }
            
            unset($db);

            
    }
}

            
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title> head type</title>
    <meta name="exemple" content="contient un head type">
    <link rel="stylesheet" href="main.css">
    <script>
        
        function validateForm() {
            
            var name = document.getElementById('name').value;
            var mail = document.getElementById('mail').value;
            var tel = document.getElementById('tel').value;
            var radio = document.forms["Form"]["gender"].value;
            var textarea = document.getElementById('message').value;
            
            var total = " ";
            
                if (name == " ") 
                {total="\n Nom et prénom";}

                if (mail == " ") 
                {total=total + "\n E-mail";}
            
                if (tel == " ")
                {total=total + "\n Numéro de téléphone";}
            
                if (radio == " ")
                {total=total + "\n Genre";}
            
                if (textarea == " ")
                    {total=total + "\n Votre message";}
            
                if (total != " ")
                {alert("Veuillez remplir les champs suivant : "+total);
                return false;}
        }    
    </script>
    
    <title>Formulaire de contact</title>
</head>
<body>
   
        <div class="formulaire1">
        <h2> Formulaire de contact </h2> <br>


<?php   if($mail_html != ''){ ?>
            <div class=messagemail ><?php echo $messagemail;?></div>
<?php   } ?>

            <div class=error ><?php echo $message1;?></div>


        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" name="Form" onsubmit="return validateForm()"><br>
        <label for="name">Nom et Prénom :</label><br>
        <input type="text" id="name" class="border" name="name" ><span class="error"><?php echo $erreur1; ?></span> <br><br>
        
        <label for="mail">E-mail :</label><br>
        <input type="email" id="mail" class="border" name="mail" ><span class="error"><?php echo $erreur2; ?></span> <br><br> 
        
        <label for="tel">Numéro de téléphone :</label><br>
        <input type="tel" id="tel" class="border" name="numero"
        pattern ="[0-9]{10}"
        maxlength="10"><span class="error"><?php echo $erreur3; ?></span> <br><br>
        
        <input id="gender" type="radio" name="gender" value="Homme"> Homme 
        <input id="gender" type="radio" name="gender" value="Femme">Femme<span class="error"><?php echo $erreur4; ?></span><br><br>
        
        <textarea placeholder="Tapez votre message ici..." name="Textarea" id="message"></textarea><span class="error"><?php echo $erreur5; ?></span><br>
        <button type="submit" value="Submit" name="sendForm" id="Envoi">Envoyer le message</button>
        <button type="reset" value="Reset" id="Reset">Effacer les champs</button>
        <a href ="tableaudonnees.php"><button type="button" value="" name="données" id="données">Tableau données</button></a>
    </form>
        </div>
        
    </body>
</html>