<?php
$pdo=new PDO("mysql:host=localhost;dbname=amp12g","root","");
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sorgu = $pdo->prepare("DELETE FROM ogrenci WHERE id=?");
$sorgu->execute([$_GET["id"]]);

header("Location: index.php");
?>