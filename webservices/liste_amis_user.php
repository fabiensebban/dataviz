﻿<?php
	// Le tableau de résultat
	$result_request = array();
	
	/*
		On teste si le paramètre GET existe
		0 -> tous les utilisateurs
		id_unique -> un seul utilisateur
		plusieurs id séparés par des virgules -> plusieurs utilisateurs
	*/
	if(isset($_GET['user'])) {
		// Connexion à la BDD
		include("../bdd/connexion_bdd.php");
		
		$user = $_GET['user'];

        $query = "SELECT COUNT(*), date
				FROM relations";
        if($user != 0) {
            $query = $query." WHERE user1 IN (".$user.")";
        }

        $query = $query." GROUP BY date ORDER BY date";

        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_array($result)) {
            $result_request[] = array($row[1], intval($row[0]));
		}

		mysqli_free_result($result);
	
		// Déconnexion de la BDD
		include("../bdd/deconnexion_bdd.php");
	}
	
	// Renvoyer le résultat au javascript
	echo json_encode($result_request);

?>