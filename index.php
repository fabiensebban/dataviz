<!DOCTYPE html>
<html>
	<head>
		<title>Data Vizualisation - TP1</title>
		<!-- Inclusion CSS (librairie + perso) -->
		<link rel="stylesheet" type="text/css" href="css/jquery.jqplot.min.css">
		<link rel="stylesheet" type="text/css" href="css/dataviz.css">
		
		<!-- Inclusion JS (librairie + scripts de création de graph) -->
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.jqplot.min.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/dataviz.js"></script>
        <script type="text/javascript" src="js/renderer/jqplot.dateAxisRenderer.js"></script>
	</head>
	<body>
        <div class="page-header">
		    <?php include ('structure/header.php'); ?>
        </div>
		<div id="content" class="container">

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8" style="text-align: center"><h1>Evolution de la popularité</h1></div>
                <div class="col-md-2"></div>
            </div>

			<div class="row">

                <div class="col-md-2">

                        <div class="form-group">
                            <input id="popularite_user_id" placeholder="User ID"/>
                        </div>
                        <div class="form-group">
                            <button class="btn" id="btn_popularite_user_id">GO !</button>
                        </div>

                </div>

                <div class="col-md-8">
                    <div id="popularite_chart"></div>
                </div>
                <div class="col-md-2"></div>
			</div>
		</div>
		<?php include ('structure/footer.php'); ?>
	</body>
</html>