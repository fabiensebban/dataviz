$(document).ready(function(){
	// Pas de cache sur les requête IMPORTANT !
	$.ajaxSetup({ cache: false });
	
	/*** 
		On définit ici les fonctions de base qui vont nous servir à la récupération des données
		Je ne définis que le GET ici, mais il est possible d'utiliser POST pour récupérer ses données (on le verra dans un prochain TP)
	****/
	function getRequest(url, callback) {
		$.get(url, function(data) {
			data = $.parseJSON(data);
			callback(data);
		});
	}

    $('#btn_user_id').click(function(){
        var userID = $('#user_id').val();

        if(userID != '')
        {
            exo1(userID);
            exo2(userID);
        }
    });

    /***************************************
		QUESTION 1 : PIE CHART : Visite par marque
	****************************************/

    function exo1(userID) {

        $('#nb_amis_chart').empty();

        getRequest("webservices/liste_amis_user.php?user="+ userID, function(data) {
            var plot1 = $.jqplot('nb_amis_chart', [data], {
                title:'Default Date Axis',
                axes:{
                    xaxis:{
                        renderer:$.jqplot.DateAxisRenderer,
                        //tickOptions:{formatString:'%#d %b'},
                        //tickInterval:'1 day'
                    }
                },
                series:[{lineWidth:4, markerOptions:{style:'square'}}]
            });
        });
    }

    /***************************************
     QUESTION 2 : Evolution popularite
     ****************************************/


    function exo2 (userID) {
        getRequest("webservices/notations_user.php?user=" + userID + "&wschanged=1", function (data) {

            $('#popularite_chart').empty();

            var line1 = data;
            var plot1 = $.jqplot('popularite_chart', [line1], {
                title: 'Popularite',
                axes: {
                    xaxis: {
                        renderer:$.jqplot.DateAxisRenderer,
                        tickOptions:{formatString:'%b %#d, %#I %p'}
                    }
                },
                series: [{lineWidth: 4, markerOptions: {style: 'square'}}]
            });
        });
    }


    /***************************************
     QUESTION 5 :  Popularite par sexe
     ****************************************/
});



