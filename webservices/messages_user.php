<?php
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
	
		$query = "SELECT * FROM messages";

        $query2 = "SELECT destinataire, count(*) messages FROM messages m
                    JOIN relations r on m.emetteur=".$user."
                        AND m.destinataire=r.user2
                    group by m.destinataire";

        if($user != 0) {
			$query = $query." WHERE emetteur IN (".$user.")";
		}
		
		$result1 = mysqli_query($conn, $query);
		$result2 = mysqli_query($conn, $query2);

        $total_messages = mysqli_num_rows($result1);
        $messages_amis = mysqli_num_rows($result2);

        $messages_non_amis = intval($total_messages) - intval($messages_amis);

        $result_request = array(
                            array("Msg a amis",intval($messages_amis)), array("Msg a NON amis",intval($messages_non_amis))
                        );

		mysqli_free_result($result1);
		mysqli_free_result($result2);

		// Déconnexion de la BDD
		include("../bdd/deconnexion_bdd.php");
	}
	
	// Renvoyer le résultat au javascript
	echo json_encode($result_request);

?>

