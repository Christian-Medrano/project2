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
	<script src="js/float-panel.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body>

	<div id="top" class="jumbotron bg-don">
		<div class="row">

			<!-- wordmark -->
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<img class="main-graphic" src="images/ameche.svg" alt="ameche">
			</div>

			<!-- search form -->
			<div class="col-lg-12 search">
				<form  action="" method="GET" class="form-inline">
					<input style="margin-right: 5px;" type="text" class="form-control search-input" id="searchaddress" name="searchaddress" value="<?php echo $searchaddress; ?>" placeholder="Your City/Zipcode">
					<button id="myBtn" class="btn btn-outline-secondary" onclick="location.href='#results'">Search</button>
				</form>
			</div>
			
			<!-- definition -->
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 def">
				<h1>/<em>ah-mee-chee </em>/</h1>
				<h4>noun</h4>
				<ol>
					<li><p>(US slang, c. 1940's) a telephone, after Don Ameche</p></li>
					<li><p>the absolute best way to find your local, state, and federal representatives</p></li>
				</ol>
			</div>
		</div>
	</div>

	<!-- return to top button -->
	<div id="backtop" data-v-w="300, 1200"><a href=""><span style="font-size: 90px">➪</span><br></a></div>


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

if (isset($data)) {

echo '<div class="container-fluid main bg-faded">';
echo '<div id="results" class="container card-section">';
echo '<div class="row">';
echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
			<h3>Here are the officemembers we found for '.$searchaddress.':</h3>
			</br>
	  	  </div>';

$b = 0;

echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 quick-links">';
echo '<ul>';

foreach ($data->officials as $person) {

	$trimmedJob = str_replace(' ', '', $jobs[$b]);

	echo '<li><a class=".jump-link" href="#'.$trimmedJob.'">'.$jobs[$b].'</a></li>';
	echo '<li>|</li>';

	$b++;

	

}

echo '</ul>';
echo '</div>';


}

$c = 0;

// loop through officials
foreach ($data->officials as $person) {

	$trimmedJob = str_replace(' ', '', $jobs[$c]);

	$trimmedUrl = str_replace(['http://', 'https://', 'www.', 'www1.'], '', $person->urls[0]);

	$accountOne = $person->channels[0]->type;

	if ($accountOne == "GooglePlus") {
		$accountOneUrl = "http://plus.google.com";
	} else if ($accountOne == "Facebook") {
		$accountOneUrl = "http://www.facebook.com";
	} else if ($accountOne == "Twitter") {
		$accountOneUrl = "http://www.twitter.com";
	} else if ($accountOne == "Youtube") {
		$accountOneUrl = "http://www.youtube.com";
	}

	$accountTwo = $person->channels[1]->type;

	if ($accountTwo == "GooglePlus") {
		$accountTwoUrl = "http://plus.google.com";
	} else if ($accountTwo == "Facebook") {
		$accountTwoUrl = "http://www.facebook.com";
	} else if ($accountTwo == "Twitter") {
		$accountTwoUrl = "http://www.twitter.com";
	} else if ($accountTwo == "Youtube") {
		$accountTwoUrl = "http://www.youtube.com";
	}

	$accountThree = $person->channels[2]->type;

	if ($accountThree == "GooglePlus") {
		$accountThreeUrl = "http://plus.google.com";
	} else if ($accountThree == "Facebook") {
		$accountThreeUrl = "http://www.facebook.com";
	} else if ($accountThree == "Twitter") {
		$accountThreeUrl = "http://www.twitter.com";
	} else if ($accountThree == "YouTube") {
		$accountThreeUrl = "http://www.youtube.com";
	}

	$accountFour = $person->channels[3]->type;

	if ($accountFour == "GooglePlus") {
		$accountFourUrl = "http://plus.google.com";
	} else if ($accountFour == "Facebook") {
		$accountFourUrl = "http://www.facebook.com";
	} else if ($accountFour == "Twitter") {
		$accountFourUrl = "http://www.twitter.com";
	} else if ($accountFour == "YouTube") {
		$accountFourUrl = "http://www.youtube.com";
	}

	$accountFive = $person->channels[4]->type;

	if ($accountFive == "GooglePlus") {
		$accountFiveUrl = "http://plus.google.com";
	} else if ($accountFive == "Facebook") {
		$accountFiveUrl = "http://www.facebook.com";
	} else if ($accountFive == "Twitter") {
		$accountFiveUrl = "http://www.twitter.com";
	} else if ($accountFive == "YouTube") {
		$accountFiveUrl = "http://www.youtube.com";
	}


	// print_r($person);
	echo '<div class="col-lg-4 col-md-6 col-sm-12">';	
	echo '<div id="'.$trimmedJob.'" class="card align-center">';	

	// photo
	echo '<div class="card-img-top" style="background-image: url('.(isset($person->photoUrl)? $person->photoUrl : 'images/placeholder.png').'); background-repeat: no-repeat; background-size: 100%; background-position: top;"></div>';
	echo '<div class="card-block">';

	// name
	echo '<h3>'.$person->name.'</h3>';

	// office
	echo '<h5>'.$jobs[$i].'</h5>';

	// party
	echo '<p>'.(isset($person->party)? $person->party :'Party Not Listed').'</p>';

	echo '<ul class="list-group list-group-flush">';

	// phone
	echo '<li class="list-group-item"><img class="contact-icon" src="icons/phone.svg" alt="Phone">'.(isset($person->phones[0])? '<a href="tel:'.$person->phones[0].'">'.$person->phones[0].'</a>' :'Not Listed').'</li>';

	// website
	echo '<li class="list-group-item"><img class="contact-icon" src="icons/web.svg" alt="website">'.(isset($person->urls[0])? '<a href="'.$person->urls[0].'" target="_blank">'.$trimmedUrl.'</a>' : 'Not Listed').'</li>';

	// address
	echo '<li class="list-group-item">
			'.(isset($person->address[0])? $person->address[0]->line1 :'Address not listed').'
			'.(isset($person->address[0]->line1)? '</br>' :'').'
			'.(isset($person->address[0])? $person->address[0]->line2 :'').'
			'.(isset($person->address[0]->line2)? '</br>' :'').'
			'.(isset($person->address[0])? $person->address[0]->city :'').', 
			'.(isset($person->address[0])? $person->address[0]->state :'').' 
			'.(isset($person->address[0])? $person->address[0]->zip :'').'
		  </li>';

	// social media
	echo '<li class="list-group-item">
			'.(isset($person->channels[0])? '<a href="'.$accountOneUrl.'/'.$person->channels[0]->id.'" target="_blank"><img class="sm-icon" src="icons/'.$person->channels[0]->type.'.svg" alt="'.$person->channels[0]->type.'"/></a>' : 'No Social Media').'

			'.(isset($person->channels[1])? '<a href="'.$accountTwoUrl.'/'.$person->channels[1]->id.'" target="_blank"><img class="sm-icon" src="icons/'.$person->channels[1]->type.'.svg" alt="'.$person->channels[1]->type.'"/></a>' : '').'

			'.(isset($person->channels[2])? '<a href="'.$accountThreeUrl.'/'.$person->channels[2]->id.'" target="_blank"><img class="sm-icon" src="icons/'.$person->channels[2]->type.'.svg" alt="'.$person->channels[2]->type.'"/></a>' : '').'

			'.(isset($person->channels[3])? '<a href="'.$accountFourUrl.'/'.$person->channels[3]->id.'" target="_blank"><img class="sm-icon" src="icons/'.$person->channels[3]->type.'.svg" alt="'.$person->channels[3]->type.'"/></a>' : '').'

			'.(isset($person->channels[4])? '<a href="'.$accountFiveUrl.'/'.$person->channels[4]->id.'" target="_blank"><img class="sm-icon" src="icons/'.$person->channels[4]->type.'.svg" alt="'.$person->channels[4]->type.'"/></a>' : '').'
		  </li>';
	echo '</ul>';
	echo '</div>';
	echo '</div>';
	echo '</div>';

// add 1 count to $i;
$i++;
$c++;

}

echo '</div>';
echo '</div>';
echo '</div>';

?>

<!-- smooth scroll -->
<script>
	$(function() {
	  $('a[href*="#"]:not([href="#"])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html, body').animate({
	          scrollTop: target.offset().top
	        }, 1000);
	        return false;
	      }
	    }
	  });
	});
</script>







</body>
</html>