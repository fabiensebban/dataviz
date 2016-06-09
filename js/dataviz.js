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
     QUESTION 4 :  Amis par sexe
     ****************************************/
    getRequest("webservices/friends_sexe_count.php?user=1", function (data) {
        var total = data.reduce(function(a, b) {
          return a + b;
        });

          var barData = [{
            'x': 'Female',
            'y': data[0] * 100 / total
          }, {
            'x': 'Male',
            'y': data[1] * 100 / total
          }];

        var vis = d3.select('#visualisation'),
            WIDTH = 1000,
            HEIGHT = 500,
            MARGINS = {
              top: 20,
              right: 20,
              bottom: 20,
              left: 50
            },
            xRange = d3.scale.ordinal().rangeRoundBands([MARGINS.left, WIDTH - MARGINS.right], 0.1)
                             .domain(barData.map(function (d) { return d.x; })),


        yRange = d3.scale.linear().range([HEIGHT - MARGINS.top, MARGINS.bottom]).domain([0,
          d3.max(barData, function (d) {
            return d.y;
          })
        ]),

        xAxis = d3.svg.axis()
            .scale(xRange)
            .tickSize(5)
            .tickSubdivide(true),

        yAxis = d3.svg.axis()
            .scale(yRange)
            .tickSize(5)
            .orient("left")
            .tickSubdivide(true);


        vis.append('svg:g')
            .attr('class', 'x axis')
            .attr('transform', 'translate(0,' + (HEIGHT - MARGINS.bottom) + ')')
            .call(xAxis);

        vis.append('svg:g')
            .attr('class', 'y axis')
            .attr('transform', 'translate(' + (MARGINS.left) + ',0)')
            .call(yAxis);

        vis.selectAll('rect')
            .data(barData)
            .enter()
            .append('rect')
            .attr('x', function (d) {
              return xRange(d.x);
            })
            .attr('y', function (d) {
              return yRange(d.y);
            })
            .attr('width', xRange.rangeBand())
            .attr('height', function (d) {
              return ((HEIGHT - MARGINS.bottom) - yRange(d.y));
            })
            .attr('fill', '#F1F1F1')
            .on('mouseover',function(d){
              d3.select(this)
                .attr('fill','#c00000');
            })
            .on('mouseout',function(d){
              d3.select(this)
                .attr('fill','#F1F1F1');
            });

    });

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



