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

        $female = array(0, 0, 0);
        $male = array(0, 0, 0);

		$query1 = " SELECT sexe, count(*) AS count FROM relations
                   JOIN utilisateurs ON user2 = id WHERE user1 = " . $user . "
                   AND utilisateurs.age BETWEEN 18 AND 21 GROUP BY sexe";

        $query2 = " SELECT sexe, count(*) AS count FROM relations
                   JOIN utilisateurs ON user2 = id WHERE user1 = " . $user . "
                   AND utilisateurs.age BETWEEN 22 AND 25 GROUP BY sexe";

        $query3 = " SELECT sexe, count(*) AS count FROM relations
                   JOIN utilisateurs ON user2 = id WHERE user1 = " . $user . "
                   AND utilisateurs.age BETWEEN 26 AND 29 GROUP BY sexe";


		$result1 = mysqli_query($conn, $query1);
        $result2 = mysqli_query($conn, $query2);
        $result3 = mysqli_query($conn, $query3);


        //tranche 18-21
        while ($row = mysqli_fetch_array($result1)) {
            if ($row[0] == 0){
                $female[0] = intval($row[1]);
            }
            else {
                $male[0] = intval($row[1]);
            }
        }

        //tranche 22 - 25
        while ($row = mysqli_fetch_array($result2)) {
            if ($row[0] == 0){
                $female[1] = intval($row[1]);
            }
            else {
                $male[1] = intval($row[1]);
            }
        }

        //tranche 26 - 29
        while ($row = mysqli_fetch_array($result3)) {
            if ($row[0] == 0){
                $female[2] = intval($row[1]);

            }
            else {
                $male[2] = intval($row[1]);
            }
        }

		mysqli_free_result($result);

        $result_request = array( $female,$male );

		// Déconnexion de la BDD
		include("../bdd/deconnexion_bdd.php");
	}
	
	// Renvoyer le résultat au javascript
	echo json_encode($result_request);

?>