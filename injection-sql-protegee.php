

<?php

if(isset($_POST['username'])){
    $pdo = new PDO("mysql:host=localhost;dbname=tpinjection", 'root', '');
    
    // Utilisez des déclarations paramétrées
    $username = $_POST['username'];
    $password = $_POST['password'];
    $selectall = $pdo->prepare("SELECT * FROM user WHERE login=:username AND password=:password");
    
    // Liez les valeurs aux paramètres
    $selectall->bindParam(':username', $username, PDO::PARAM_STR);
    $selectall->bindParam(':password', $password, PDO::PARAM_STR);

    // Exécutez la requête préparée
    $selectall->execute();
    
    // Utilisez fetch() pour récupérer les résultats
    $result = $selectall->fetch(PDO::FETCH_ASSOC);
    
    // Vérifiez le résultat
    if($result){
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


