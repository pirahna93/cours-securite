<?php

if(isset($_POST['username'])){
    $pdo = new PDO("mysql:host=localhost;dbname=tpinjection", 'root', '');
    
    // Utilisez mysqli_real_escape_string pour échapper les données
    $username = mysqli_real_escape_string($pdo, $_POST['username']);
    $password = mysqli_real_escape_string($pdo, $_POST['password']);
    
    // Utilisez ces valeurs échappées dans votre requête SQL
    $selectall = $pdo->query("SELECT * FROM user WHERE login='$username' AND password='$password'");
    
    $result = $selectall->fetch();
    
    $counttable = count((is_countable($result) ? $result : []));
    
    if($counttable != 0){
        echo 'connexion établie';
    } else {
        echo 'utilisateur non reconnu';
    }
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Exemple de faille SQL">
    <title>Se logger en Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        fieldset {
            width: 300px;
            margin: 20px auto;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        p {
            margin: 10px 0;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h1>Portail de connexion</h1>
    <fieldset>
        <form action="#" method="POST">
            <p>Nom d'utilisateur :</p>
            <input type="text" name="username" placeholder="Entrez votre nom d'utilisateur">
            <p>Mot de passe :</p>
            <input type="password" name="password" placeholder="Entrez votre mot de passe">
            <br><br>
            <button type="submit">Se connecter</button>
        </form>
        <p>Essayer avec le login <strong>' OR 1=1 OR 1='</strong> : la connexion fonctionne</p>
    </fieldset>
</body>

</html>


