<?php
	/*
	require '../../../include/common/core.inc.php';
	require '../../../include/common/dbhelper.inc.php';
	require '../../include/common/loggedin.php';
	
	$file_path = '../../';
	
	$db = new dbHelper;
	$db->axi_connectToDB();	
	*/
	
?>

<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en">

<![endif]--><!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en">

<![endif]--><!--[if IE 8]>
<html class="no-js lt-ie9" lang="en">

<![endif]--><!--[if gt IE 8]>
<!-->
<html class="no-js" lang="en">

<!--<![endif]-->

<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Home | Administrator - Quiz</title>
<!-- Metadata -->
<meta content="" name="description" />
<meta content="" name="keywords" />
<meta content="" name="author" />

<!-- Set the viewport width to device width for mobile -->
	<meta name="viewport" content="width=device-width" />

<!-- CSS Styles -->
<link rel="stylesheet" href="../../resources/css/foundation/foundation.css"/>
<link rel="stylesheet" href="../../resources/css/common-frontend/app.css"/>
<link rel="stylesheet" href="../../resources/css/modules/question/question.css"/>

<!-- Favicon -->
<link href="../../resources/images/favicon.png" rel="shortcut icon" type="image/png" />
<!-- Javascript -->
	<script type="text/javascript" src="../../resources/js/foundation/modernizr.foundation.js"></script>
	<!-- Included JS Files (Uncompressed) -->
	
	<script type="text/javascript" src="../../resources/js/foundation/jquery.js"></script>
	<script type="text/javascript" src="../../resources/js/foundation/jquery.foundation.mediaQueryToggle.js"></script>
	<script type="text/javascript" src="../../resources/js/foundation/jquery.foundation.forms.js"></script>
	<script type="text/javascript" src="../../resources/js/foundation/jquery.foundation.orbit.js"></script>
	<script type="text/javascript" src="../../resources/js/foundation/jquery.foundation.navigation.js"></script>
	<script type="text/javascript" src="../../resources/js/foundation/jquery.foundation.buttons.js"></script>
	<script type="text/javascript" src="../../resources/js/foundation/jquery.foundation.tabs.js"></script>
	<script type="text/javascript" src="../../resources/js/foundation/jquery.placeholder.js"></script>
	<script type="text/javascript" src="../../resources/js/foundation/js/jquery.foundation.alerts.js"></script>
	<script type="text/javascript" src="../../resources/js/foundation/jquery.foundation.topbar.js"></script>
	<script type="text/javascript" src="../../resources/js/foundation/jquery.foundation.clearing.js"></script>
	<script type="text/javascript" src="../../resources/js/foundation/jquery.foundation.magellan.js"></script>
	<script type="text/javascript" src="../../resources/js/foundation/jquery.foundation.reveal.js"></script>

	
	
		
	<!-- Initialize JS Plugins -->
	<script type="text/javascript" src="../../resources/js/foundation/app.js"></script> 

</head>

<body style="padding-bottom:20px;">
<div class="header">
	<div class="row" >
	<div class="twelve columns">
		<nav class="top-bar">
			<ul>
				<li class="name">
					<h1><a href="home"><img src="../../resources/images/utopia.png"></a></h1>
				</li>
				<li class="toggle-topbar"><a href="#"></a></li>
			</ul>
			<section>
				<ul class="left">
					<li class="divider"></li>
					<li ><a href="#">Dashboard</a></li>
					<li class="divider"></li>
					<li class="has-dropdown">
						<a href="#">Courses</a>
						<ul class="dropdown">
	              			<li><label>Reciently Viewed</label></li>
	              			<li ><a href="#">Internet and Web Programming</a></li>
	              			<li ><a href="#">Course 2</a></li>
	              			<li ><a href="#">Course 3</a></li>
	              			<li><label>Reciently Updated</label></li>
	              			<li ><a href="#">Course 1</a></li>
	              			<li ><a href="#">Course 2</a></li>
	              			<li ><a href="#">Course 3</a></li>
	              			<li class="divider"></li>
	              			<li ><a href="#">Add Course</a></li>
						<ul/>
					</li>					
				</ul>
			</section>
			<ul class="right">
				<li class="divider" style="margin-right:5px;"></li>
				<li><input type="text" id="searchBar" /></li>
				<li class="divider" style="margin-left:5px;"></li>
				<li ><a href="#">Login</a></li>
			</ul>	
		</nav>
	</div>
	</div>
</div>
<div class="row question-body">
	<div class="twelve columns">
		<h3 class="question-no">Question 1</h3>
		<span class="question-subheading">1-3 Defining Games</span>
		<p class="question-data">
			Consider the following normal form:

		    N={1, 2}
		    Ai={Movie, Theater} Each player chooses an action of either going to a movie or going to the theater.
		    Player 1 prefers to see a movie with Player 2 over going to the theater with Player 2.
		    Player 2 prefers to go to the theater with Player 1 over seeing a movie with Player 1.
		    Players get a payoff of 0 if they end up at a different place than the other player.
		
			Which restrictions should a, b, c and d satisfy? 
		</p>
		<div class="option-single-answer">
			 <label for="radio1"><input name="radio-option" type="radio" id="radio1"> Option 1</label>
		     <label for="radio2"><input name="radio-option" type="radio" id="radio2"> Option 2</label>
		     <label for="radio3"><input name="radio-option" type="radio" id="radio2"> Option 3</label>    
		</div>
	</div>
</div>

<div class="row question-body">
	<div class="twelve columns">
		<h3 class="question-no">Question 1</h3>
		<span class="question-subheading">1-3 Defining Games</span>
		<p class="question-data">
			Consider the following normal form:

		    N={1, 2}
		    Ai={Movie, Theater} Each player chooses an action of either going to a movie or going to the theater.
		    Player 1 prefers to see a movie with Player 2 over going to the theater with Player 2.
		    Player 2 prefers to go to the theater with Player 1 over seeing a movie with Player 1.
		    Players get a payoff of 0 if they end up at a different place than the other player.
		
			Which restrictions should a, b, c and d satisfy? 
		</p>
		<div class="option-multiple-answer">
			 <label for="checkbox1"><input name="checkbox-option" type="checkbox" id="checkbox1"> Option 1</label>
		     <label for="checkbox2"><input name="checkbox-option" type="checkbox" id="checkbox2"> Option 2</label>
		     <label for="checkbox3"><input name="checkbox-option" type="checkbox" id="checkbox2"> Option 3</label>    
		</div>
	</div>
</div>

<div class="row question-body">
	<div class="twelve columns">
		<h3 class="question-no">Question 1</h3>
		<span class="question-subheading">1-3 Defining Games</span>
		<p class="question-data">
			Consider the following normal form:

		    N={1, 2}
		    Ai={Movie, Theater} Each player chooses an action of either going to a movie or going to the theater.
		    Player 1 prefers to see a movie with Player 2 over going to the theater with Player 2.
		    Player 2 prefers to go to the theater with Player 1 over seeing a movie with Player 1.
		    Players get a payoff of 0 if they end up at a different place than the other player.
		
			Which restrictions should a, b, c and d satisfy? 
		</p>
		<div class="option-subjective">
			 <textarea placeholder="Enter your answer here"></textarea>    
		</div>
	</div>
</div>

<div class="row question-body">
	<div class="twelve columns">
		<h3 class="question-no">Question 1</h3>
		<span class="question-subheading">1-3 Defining Games</span>
		<p class="question-data">
			Consider the following normal form:

		    N={1, 2}
		    Ai={Movie, Theater} Each player chooses an action of either going to a movie or going to the theater.
		    Player 1 prefers to see a movie with Player 2 over going to the theater with Player 2.
		    Player 2 prefers to go to the theater with Player 1 over seeing a movie with Player 1.
		    Players get a payoff of 0 if they end up at a different place than the other player.
		
			Which restrictions should a, b, c and d satisfy? 
		</p>
		<div class="option-numerical">
			 <div class="row">
			 	<div class="two columns mobile-one" style="padding:0px;">
			 		<span class="prefix">Number Only</span>
			 	</div>
			 	<div class="ten columns mobile-three" style="padding:0px;">
			 		<input type="text" placeholder="Enter the numeric answer"> 
			 	</div>
			 </div>
		</div>
	</div>
</div>


<div class="row question-body">
	<div class="twelve columns">
		<h3 class="question-no">Question 1</h3>
		<span class="question-subheading">1-3 Defining Games</span>
		<p class="question-data">
			Consider the following normal form:

		    N={1, 2}
		    Ai={Movie, Theater} Each player chooses an action of either going to a movie or going to the theater.
		    Player 1 prefers to see a movie with Player 2 over going to the theater with Player 2.
		    Player 2 prefers to go to the theater with Player 1 over seeing a movie with Player 1.
		    Players get a payoff of 0 if they end up at a different place than the other player.
		
			Which restrictions should a, b, c and d satisfy? 
		</p>
		<div class="option-true-false">
			 <span>Select One:</span> 
			 <label style="margin-top:5px;" for="radioTrue"><input name="radio-option" type="radio" id="radioTrue">True</label>
		     <label for="radioFalse"><input name="radio-option" type="radio" id="radioFalse">False</label>
		</div>
	</div>
</div>

<div class="row question-body">
	<div class="twelve columns">
		<h3 class="question-no">Question 1</h3>
		<span class="question-subheading">1-3 Defining Games</span>
		<p class="question-data">
			Consider the following normal form:

		    N={1, 2}
		    Ai={Movie, Theater} Each player chooses an action of either going to a movie or going to the theater.
		    Player 1 prefers to see a movie with Player 2 over going to the theater with Player 2.
		    Player 2 prefers to go to the theater with Player 1 over seeing a movie with Player 1.
		    Players get a payoff of 0 if they end up at a different place than the other player.
		
			Which restrictions should a, b, c and d satisfy? 
		</p>
		<div class="option-match">
			 <span>Select The Correct Match:</span> 
			 <div class="row matrix-match">
			 	<div class="six columns mobile-two">
			 		<label class="option">A) Something</label>
			 		<label class="option">B) Something</label>
			 		<label class="option">C) Something</label>
			 	</div>
			 	<div class="one columns mobile-one">
			 		<select>	
			 			<option>A)</option>
			 			<option>B)</option>
			 			<option>C)</option>
			 		</select>
			 		<select>	
			 			<option>A)</option>
			 			<option>B)</option>
			 			<option>C)</option>
			 		</select>
					<select>	
			 			<option>A)</option>
			 			<option>B)</option>
			 			<option>C)</option>
			 		</select>
			 	</div>
				<div class="five columns mobile-one end">
					<label class="option">Something</label>
					<label class="option">Something</label>
					<label class="option">Something</label>
			 	</div>
			 </div>
		</div>
	</div>
</div>


</body>

</html>
