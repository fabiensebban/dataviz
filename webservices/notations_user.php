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
	    $wsChanged = 0;

        if(isset($_GET['wschanged'])) {
            $wsChanged = $_GET['wschanged'];
        }

        if(isset($_GET['sexe'])) {
            $sexe = $_GET['sexe'];
        }
        $query = "SELECT noteur, photo, note, date
                    FROM notations";

        //************
        // Pour ex 5
        //************
        if (isset($sexe) && $wsChanged == 1)
        {
            $cnt_0 = 0;
            $cnt_1 = 0;
            $cnt_2 = 0;
            $cnt_3 = 0;
            $cnt_4 = 0;
            $cnt_5 = 0;

            $query = "SELECT notations.note FROM notations
                        JOIN utilisateurs ON  utilisateurs.id = notations.noteur";

            $query = $query . " WHERE notations.photo = " . $user .
                                " AND utilisateurs.sexe = " . $sexe . "
                                ORDER BY note ASC";


            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_array($result)) {

                switch (intval($row[0])){
                    case 0:
                        $cnt_0 ++;
                        break;
                    case 1:
                        $cnt_1 ++;
                        break;
                    case 2:
                        $cnt_2 ++;
                        break;
                    case 3:
                        $cnt_3 ++;
                        break;
                    case 4:
                        $cnt_4 ++;
                        break;
                    case 5:
                        $cnt_5 ++;
                        break;
                }

            }
            $result_request[] = array(
                                    array("0", $cnt_0),
                                    array("1", $cnt_1),
                                    array("2", $cnt_2),
                                    array("3", $cnt_3),
                                    array("4", $cnt_4),
                                    array("5", $cnt_5)
                                );
            $result_request = $result_request[0];
            mysqli_free_result($result);
        }

        //************
        // Pour ex 2
        //************
        elseif($wsChanged == 1)
        {

            if ($user != 0) {
                $query = $query . " WHERE photo IN (" . $user
                    . ") ORDER BY date ASC";
            }

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_array($result)) {
                $result_request[] = array($row[3], intval($row[2]));
            }

            mysqli_free_result($result);
        }

        //********************
        // Webservice de base
        //********************
        else
        {

            $query
                = "SELECT noteur, photo, note
                    FROM notations";
            if ($user != 0) {
                $query = $query . " WHERE photo IN (" . $user
                    . ") ";
            }

            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_array($result)) {
                $result_request[] = array(intval($row[0]), $row[1], $row[2]);
            }

            mysqli_free_result($result);
        }
	
		// Déconnexion de la BDD
		include("../bdd/deconnexion_bdd.php");
	}
	
	// Renvoyer le résultat au javascript
	echo json_encode($result_request);

?>