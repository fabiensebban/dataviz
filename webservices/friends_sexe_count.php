<?php
	//result array
	$final = array();

	if (isset($_GET['user'])) {
		//db connect
		include("../bdd/connexion_bdd.php");

		$user = $_GET['user'];

		//if NOT all user
		if($user != 0) {
			$query = "SELECT count(*) AS count FROM relations 
					  JOIN utilisateurs ON user2 = id WHERE user1 IN (".$user.") GROUP BY sexe";		
		}
		else {
			$query = "SELECT sexe, count(*) AS count FROM utilisateurs GROUP BY sexe";		
		}

		$result = mysqli_query($conn, $query);
        
        while ($row = mysqli_fetch_array($result)) {
        	array_push($final, intval($row[0]));
		}

		mysqli_free_result($result);

		//db disconnect
		include("../bdd/deconnexion_bdd.php");
	}

	//rend result to js
	echo json_encode($final);
?>