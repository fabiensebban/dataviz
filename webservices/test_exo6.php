<?php
	//result array
	$final = array();

	if (isset($_GET['user'])) {
		//db connect
		include("../bdd/connexion_bdd.php");

		$user = $_GET['user'];

		$query1 = " SELECT sexe, count(*) AS count FROM relations
                   JOIN utilisateurs ON user2 = id WHERE user1 = " . $user . "
                   utilisateurs.age BETWEEN 18 AND 21 GROUP BY sexe";
        $query2 = " SELECT sexe, count(*) AS count FROM relations
                   JOIN utilisateurs ON user2 = id WHERE user1 = " . $user . "
                   utilisateurs.age BETWEEN 22 AND 25 GROUP BY sexe";
        $query3 = " SELECT sexe, count(*) AS count FROM relations
                   JOIN utilisateurs ON user2 = id WHERE user1 = " . $user . "
                   utilisateurs.age BETWEEN 26 AND 29 GROUP BY sexe";

		$result1 = mysqli_query($conn, $query1);
		$result2 = mysqli_query($conn, $query2);
		$result3 = mysqli_query($conn, $query3);
        
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


