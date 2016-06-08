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
	
	/***************************************
		QUESTION 1 : PIE CHART : Visite par marque
	****************************************/
	getRequest("webservices/infos_user.php?user=2", function(data) {
		console.log(data);
	});

    /***************************************
     QUESTION 2 : Evolution popularite
     ****************************************/

    $('#btn_popularite_user_id').click(function(){
        var userID = $('#popularite_user_id').val();

        if(userID != '')
        {
            exo(userID);
        }
    });

    function exo (userID) {
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

});



