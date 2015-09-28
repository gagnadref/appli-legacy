<?php

session_start();

if (!isset($_GET["user_id"]) || !isset($_SESSION["user_id"]) || $_GET["user_id"] !== $_SESSION["user_id"]) {
	header("location: /login");
}

$user_id = $_GET["user_id"];

try {
	$bdd = new PDO('mysql:host=localhost;dbname=testtheoevo;charset=utf8', 'root', 'root');
} catch (Exception $e) {
	die('Erreur : ' . $e->getMessage());
}
$notes = $bdd->prepare("SELECT * FROM NOTE WHERE user_id = :user_id");
$notes->bindParam(':user_id', $user_id);
$notes->execute();

echo "<a href='/homepage'>Homepage</a>";
echo "<h1>Notes</h1>";

echo "<ul>";

while ($note = $notes->fetch()) {
	echo "<li>" . $note["note"] . "</li>";
}

echo "</ul>";

?>