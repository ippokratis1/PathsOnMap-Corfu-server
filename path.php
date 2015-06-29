<?php
 	// εισάγει τις συναρτήσεις χειρισμού της βάσης
	require_once 'include/DB_Functions.php';
	
	 $player_id = $_GET['player_id'];
	 
	 $path = randomPath($player_id);
	 echo $path;
	
?>