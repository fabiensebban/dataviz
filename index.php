<!DOCTYPE html>
<html>
  <head>
    <title>Statistiques de l'utilisateur</title>
    <!-- Inclusion CSS (librairie + perso) -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.jqplot.min.css">
    <link rel="stylesheet" type="text/css" href="css/dataviz.css">
  </head>
  <body>
    <?php include ('structure/header.php'); ?>

    <div class="container">
      <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
                      <input id="user_id" placeholder="User ID"/>
          <button class="btn" id="btn_user_id">GO !</button>
            </div>
      </div>

    	<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-3 bhoechie-tab-menu">
                  <div class="list-group">
                    <a id="main-tab" href="#" class="list-group-item active text-center" data-id="1">
                      <h4 class="fa fa-users"></h4><br/>Amis
                    </a>
                    <a href="#" class="list-group-item text-center" data-id="2">
                      <h4 class="fa fa-fire"></h4><br/>Popularité
                    </a>
                    <a href="#" class="list-group-item text-center" data-id="3">
                      <h4 class="fa fa-envelope-o"></h4><br/>messages envoyés
                    </a>
                    <a href="#" class="list-group-item text-center" data-id="4">
                      <h4 class="fa fa-transgender"></h4><br/>Sexe amis
                    </a>
                    <a href="#" class="list-group-item text-center" data-id="5">
                      <h4 class="fa fa-thumbs-o-up"></h4><br/>Popularite par sexe
                    </a>
                    <a href="#" class="list-group-item text-center" data-id="6">
                      <h4 class="fa fa-venus-mars"></h4><br/>Popularite par sexe
                    </a>
                  </div>
                </div>
                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 bhoechie-tab">
                    <!-- flight section -->
                    <div class="bhoechie-tab-content active">
                        <center>
                          <div id="nb_amis_chart">
                            <h1 class="fa fa-frown-o" style="font-size:12em;color:#55518a"></h1>
                            <h2 style="margin-top: 0;color:#55518a">Pas de donnés</h2>
                            <h3 style="margin-top: 0;color:#55518a">Merci de choisir un utilisateur</h3>                            
                          </div>
                        </center>
                    </div>
                    <!-- train section -->
                    <div class="bhoechie-tab-content">
                        <center>
                          <div id="popularite_chart">
                            <h1 class="fa fa-frown-o" style="font-size:12em;color:#55518a"></h1>
                            <h2 style="margin-top: 0;color:#55518a">Pas de donnés</h2>
                            <h3 style="margin-top: 0;color:#55518a">Merci de choisir un utilisateur</h3>                            
                          </div>
                        </center>
                    </div>
        
                    <!-- hotel search -->
                    <div class="bhoechie-tab-content">
                        <center>
                          <div id="msg_envoye">
                            <h1 class="fa fa-frown-o" style="font-size:12em;color:#55518a"></h1>
                            <h2 style="margin-top: 0;color:#55518a">Pas de donnés</h2>
                            <h3 style="margin-top: 0;color:#55518a">Merci de choisir un utilisateur</h3>                            
                          </div>
                        </center>
                    </div>
                    <div class="bhoechie-tab-content">
                        <center>
                          <svg id="visualisation" width="1000" height="500"></svg>
                        </center>
                    </div>
                    <div class="bhoechie-tab-content">
                        <center>
                          <div id="popularite_sexe_chart">
                            <h1 class="fa fa-frown-o" style="font-size:12em;color:#55518a"></h1>
                            <h2 style="margin-top: 0;color:#55518a">Pas de donnés</h2>
                            <h3 style="margin-top: 0;color:#55518a">Merci de choisir un utilisateur</h3>                            
                          </div>
                        </center>
                        <div class="col-md-12">
                            <input type="radio" name="sexe" id="female" value="0" checked>Female</button>
                            <input type="radio" name="sexe" id="male" value="1" >Male</button>
                        </div>
                    </div>
                    <div class="bhoechie-tab-content">
                        <center>
                          <div id="repartition_amis">
                            <h1 class="fa fa-frown-o" style="font-size:12em;color:#55518a"></h1>
                            <h2 style="margin-top: 0;color:#55518a">Pas de donnés</h2>
                            <h3 style="margin-top: 0;color:#55518a">Merci de choisir un utilisateur</h3>                            
                          </div>
                        </center>
                    </div>
                </div>
            </div>
      </div>
    </div>

    <?php include ('structure/footer.php'); ?>
  </body>
</html>