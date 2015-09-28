<?php

session_start();

echo "<a href='/homepage'>Homepage</a>";

echo "<h1>Log in</h1>";

if (isset($_GET["login"]) && isset($_GET["password"])) {
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=testtheoevo;charset=utf8', 'root', 'root');
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
	$users = $bdd->prepare("SELECT * FROM USER WHERE username = :login AND password = :password");
	$users->bindParam(':login', $_GET["login"]);
	$users->bindParam(':password', $_GET["password"]);
	$users->execute();

	if ($users->rowCount() > 0) {
		$user = $users->fetch();
		$_SESSION["user_id"] = $user["id"];
		header("location: /notes?user_id=" . $user["id"]);
	} else {
		echo "<p>Invalid login or password</p>";
	}

}
?>

<form>
	<label for="login"><input id="login" name="login" type="text" />
	<label for="password"><input id="password" name="password" type="text"/>
	<input type="submit"/> 
</form>