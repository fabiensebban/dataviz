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
        var sexe = "1";

        if ($("#female").prop("checked"))
        {
            sexe = "0";
        }

        if(userID != '')
        {
            exo1(userID);
            exo2(userID);
            exo3(userID);
            exo5(userID, sexe)
        }
    });

    /***************************************
		QUESTION 1 : Evolution nombre d'amis
	****************************************/

    function exo1(userID) {

        $('#nb_amis_chart').empty();

        getRequest("webservices/liste_amis_user.php?user="+ userID, function(data) {
            var plot1 = $.jqplot('nb_amis_chart', [data], {
                title:'Evolution nombre d\'amis',
                axes:{
                    xaxis:{
                        renderer:$.jqplot.DateAxisRenderer
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
                title: 'Evolution popularite',
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
     QUESTION 3 : Pourcentage message envoyé a amis et non amis
     ****************************************/

    function exo3 (userID) {
        getRequest("webservices/messages_user.php?user=" + userID + "&wschanged=1", function (data) {

            $('#msg_envoye').empty();

            var line1 = data;
            var plot1 = jQuery.jqplot ('msg_envoye', [data],
                {
                    seriesDefaults: {
                        // Make this a pie chart.
                        renderer: jQuery.jqplot.PieRenderer,
                        rendererOptions: {
                            // Turn off filling of slices.
                            fill: true,
                            showDataLabels: true,
                            // Add a margin to seperate the slices.
                            sliceMargin: 4,
                            // stroke the slices with a little thicker line.
                            lineWidth: 5
                        }
                    },
                    legend: { show:true, location: 'e' }
                });
        });
    }

    /***************************************
     QUESTION 5 :  Popularite par sexe
     ****************************************/

    function exo5 (userID, sexe) {

        getRequest("webservices/notations_user.php?user=" + userID + "&wschanged=1&sexe=" + sexe, function (data) {

            $('#popularite_sexe_chart').empty();

            var data = data;
            var plot2 = jQuery.jqplot('popularite_sexe_chart', [data],
                {
                    seriesDefaults: {
                        renderer: jQuery.jqplot.PieRenderer,
                        rendererOptions: {
                            // Turn off filling of slices.
                            fill: true,
                            showDataLabels: true,
                            // Add a margin to seperate the slices.
                            sliceMargin: 4,
                            // stroke the slices with a little thicker line.
                            lineWidth: 5
                        }
                    },
                    legend: {show: true, location: 'e'}
                });
            });

        };


});



