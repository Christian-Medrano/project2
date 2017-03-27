<?php

if(!empty($_GET['searchaddress'])){
	$searchaddress = $_GET['searchaddress']; 
	$searchaddress_final = str_replace(' ', '%20', $searchaddress);
}
else {
	$searchaddress = ''; 
	$searchaddress_final = 'Washington D.C.'; 
}

// function rand_color() {
//     return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
// }
// <body style="background-color: <?php echo rand_color();

?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ameche | Find Your Representatives</title>
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Reem+Kufi" rel="stylesheet">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="shortcut icon" type="image/png" href="icons/favicon.png"/>
</head>
<body>

	

	<div id="top" class="jumbotron bg-don">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<img class="main-graphic" src="images/ameche.svg" alt="ameche">
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h1>/<em>ah-mee-chee </em>/</h1>
				<h4>noun</h4>
				<ol>
					<li><p>(US slang, c. 1940's) a telephone, after Don Ameche</p></li>
					<li><p>the absolute best way to find your local, state, and federal representatives</p></li>
				</ol>
			</div>

			<div class="col-lg-12">
				<form  action="" method="GET" class="form-inline">
					<input type="text" class="form-control search-input" id="searchaddress" name="searchaddress" value="<?php echo $searchaddress; ?>" placeholder="Your City/Zipcode">
					<button class="btn btn-outline-secondary" onclick="location.href='#results';">Search</button>
				</form>
			</div>

		</div>
	</div>

	<a id="return-to-top" href="#top"><img src="icons/arrow-up.svg" class="top-return" title="return to top" alt="return to top"></a>


<?php



	$data = json_decode(file_get_contents('https://www.googleapis.com/civicinfo/v2/representatives?key=AIzaSyCnYid13AOdb2b85CuSakurHxJTcfsqarE&address='.$searchaddress_final));

	// setup blank array
	$jobs = [];
	// loop through each office 
	foreach ($data->offices as $office) {
		// loop through each officialIndices array
    if (isset($office->officialIndices)) {
  		foreach ($office->officialIndices as $officialIndices) {
  			$jobs += [ $officialIndices => $office->name];
  		}
    }
	}
	// print_r($jobs);

// setup count
$i = 0;

echo '<div class="container-fluid main bg-faded">';
echo '<div id="results" class="container card-section">';
echo '<div class="row">';




// loop through officials
foreach ($data->officials as $person) {

	// print_r($person);
	echo '<div class="col-lg-4 col-md-6 col-sm-12">';	
	echo '<div class="card align-center">';	
	echo '<div class="card-img-top" style="background-image: url('.(isset($person->photoUrl)? $person->photoUrl : 'images/placeholder.png').'); background-repeat: no-repeat; background-size: 100%; background-position: top;"></div>';
	echo '<div class="card-block">';
	echo '<h3>'.$person->name.'</h3>';
	echo '<h5>'.$jobs[$i].'</h5>';
	echo '<p>'.(isset($person->party)? $person->party :'Party Not Listed').'</p>';
	echo '<ul class="list-group list-group-flush">';
	echo '<li class="list-group-item"><img class="contact-icon" src="icons/phone.svg" alt="Phone"> '.(isset($person->phones[0])? $person->phones[0] :'Not Listed').'</li>';
	echo '<li class="list-group-item"><img class="contact-icon" src="icons/web.svg" alt="website"><a href="'.(isset($person->urls[0])? $person->urls[0] :'Not Listed').'" target="blank">website</a></li>';
	echo '<li class="list-group-item">
			'.(isset($person->address[0])? $person->address[0]->line1 :'Address not listed').'
			'.(isset($person->address[0]->line1)? '</br>' :'').'
			'.(isset($person->address[0])? $person->address[0]->line2 :'').'
			'.(isset($person->address[0]->line2)? '</br>' :'').'
			'.(isset($person->address[0])? $person->address[0]->city :'').', 
			'.(isset($person->address[0])? $person->address[0]->state :'').' 
			'.(isset($person->address[0])? $person->address[0]->zip :'').'
		  </li>';
	echo '<li class="list-group-item">
			<p>
			'.(isset($person->channels[0])? '<img class="contact-icon" src="icons/'.$person->channels[0]->type.'.svg" alt="'.$person->channels[0]->type.'">  '.$person->channels[0]->id.'' : 'No Social Media').'

			'.(isset($person->channels[1])? '</br>' : '').'

			'.(isset($person->channels[1])? '<img class="contact-icon" src="icons/'.$person->channels[1]->type.'.svg" alt="'.$person->channels[1]->type.'"> '.$person->channels[1]->id.'' : '').'

			'.(isset($person->channels[2])? '</br>' : '').'

			'.(isset($person->channels[2])? '<img class="contact-icon" src="icons/'.$person->channels[2]->type.'.svg" alt="'.$person->channels[2]->type.'"> '.$person->channels[2]->id.'' : '').'

			'.(isset($person->channels[3])? '</br>' : '').'

			'.(isset($person->channels[3])? '<img class="contact-icon" src="icons/'.$person->channels[3]->type.'.svg" alt="'.$person->channels[3]->type.'"> '.$person->channels[3]->id.'' : '').'
			</p>
		  </li>';
	echo '</ul>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
// add 1 count to $i;
$i++;
}

echo '</div>';
echo '</div>';
echo '</div>';

?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- smooth scroll -->
<script >
		$(function() {
  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top - 50
        }, 1000);
        return false;
      }
    }
  });
});
</script>

<script type="text/javascript">
	// ===== Scroll to Top ==== 
	$(window).scroll(function() {
	    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
	        $('#return-to-top').fadeIn(200);    // Fade in the arrow
	    } else {
	        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
	    }
	});
</script>


</body>
</html>