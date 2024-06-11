<?php

#http://kanonskyltar.kidkietech.se/wp-content/themes/nb/assets/img/dynamicicon/danger.svg?c=ff0000
#http://kanonskyltar.kidkietech.se/wp-content/themes/nb/assets/img/dynamicicon/danger.svg?c=ffff00

# Om man hamnar här har man angett "något.svg" som filnamn i urlen, och förhoppningsvis skickat med en färg. Egentligen skulle man kunna tillåta UTAN färg också för att bara visa en svart bild:

$color = $_GET["c"]; // kommer från querystring
$image = $_GET['image']; // kommer från htaccess-forward

if( strlen( $color ) > 6 ) {
	echo 'Something went wrong!';
	exit;
}

$fillcolor = '#'.$color; // fyll på färg...

$path = dirname(__FILE__); // denna mapp
$path .= '/../vueeditor-icons/'; // traversa ner till ../vueeditor-icons/
$path .= $image; // appenda bildnamnet 

if (!file_exists($path)) {
	// om filen inte finns så är det en 404!
	exit;
}

# här nere vet vi att filen finns, så då sätter vi headers osv:

header('Content-type: image/svg+xml');

# din egna hämta, sök&ersätt kod, osv:

$filedata = file_get_contents($path, FILE_USE_INCLUDE_PATH);
$filedata = str_replace("#000000", $fillcolor, $filedata);
echo $filedata;

exit;

