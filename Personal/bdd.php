<?php
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=consejodb;charset=utf8', 'user1', 'bcIhwWWCC9IEX7s8');
	}
	catch(Exception $e)
	{
	        die('Erreur : '.$e->getMessage());
	}
?>