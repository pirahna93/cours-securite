<?php
 
echo('Hello World');



if(isset($_POST['signin'])){
    $pdo = new PDO("mysql:host=localhost;dbname=securite", 'root', '');
    $login = $_POST['login'];
    $pwd = $_POST['pwd'];
    $selectall = $pdo->query("select * from user where login = '$login' AND pwd='$pwd'");
    $result = $selectall->fetch();
    $counttable = count((is_countable($result)?$result:[]));
    if($counttable != 0){
        echo 'connexion réussie';
    }
    else{
        echo 'utilisateur non reconnu';
    }
}
 
?>