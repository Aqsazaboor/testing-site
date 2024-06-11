<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // don't access directly
};

// Function that returns our fonts

if( !function_exists('editor_fonts') ):
function editor_fonts() {
	
	$fonts = array(
		'arial' => array(
			"name" => "Arial",
			"slug" => "arial",
			"bold" => 1,
			"italic" => 1,
			"offsettop" => 0,
			'simple' => 1,
			"laser" => 0,
			"files" => array(
				"arial1" => "arial/arial-webfont.woff2",
				"arial2" => "arial/arial_bold_italic-webfont.woff2",
				"arial3" => "arial/arial_bold_italic-webfont.woff",
				"arial4" => "arial/arial_italic-webfont.woff2",
				"arial5" => "arial/arial_italic-webfont.woff",
				"arial6" => "arial/arial_bold-webfont.woff2",
				"arial7" => "arial/arial_bold-webfont.woff",
			)
		),
		'altedin' => array(
			"name" => "Alte DIN Mittelschrift",
			"slug" => "altedin",
			"bold" => 0,
			"italic" => 0,
			"offsettop" => 0,
			'simple' => 1,
			"laser" => 0,
			"files" => array(
				"altedin1" => "altedin/AlteDIN1451Mittelschrift.woff2",
				"altedin2" => "altedin/AlteDIN1451Mittelschrift.woff",
			)
		),
		'avantgarde' => array(
			"name" => "AvantGarde",
			"slug" => "avantgarde",
			"bold" => 0,
			"italic" => 0,
			"offsettop" => 0,
			'simple' => 1,
			"laser" => 0,
			"files" => array(
				"avantgarde1" => "avantgarde/Avantgarde.woff2",
				"avantgarde2" => "avantgarde/Avantgarde.woff",
				"avantgarde3" => "avantgarde/AvantGarde-BoldItalic.woff2",
				"avantgarde4" => "avantgarde/AvantGarde-BoldItalic.woff",
				"avantgarde5" => "avantgarde/AvantGarde-BookOblique.woff2",
				"avantgarde6" => "avantgarde/AvantGarde-BookOblique.woff",
				"avantgarde7" => "avantgarde/AvantgardeBold.woff2",
				"avantgarde8" => "avantgarde/AvantgardeBold.woff",
			)
		),
		'barlow' => array(
			"name" => "Barlow",
			"slug" => "barlow",
			"bold" => 1,
			"italic" => 1,
			"offsettop" => 0,
			'simple' => 1,
			"laser" => 0,
			"files" => array(
				"barlow1" => "barlow/Barlow-Regular.woff2",
				"barlow2" => "barlow/Barlow-Regular.woff",
				"barlow3" => "barlow/Barlow-BoldItalic.woff2",
				"barlow4" => "barlow/Barlow-BoldItalic.woff",
				"barlow5" => "barlow/Barlow-Italic.woff2",
				"barlow6" => "barlow/Barlow-Italic.woff",
				"barlow7" => "barlow/Barlow-Bold.woff2",
				"barlow8" => "barlow/Barlow-Bold.woff",
			)
		),
		'bernhardtango' => array(
			"name" => "Bernhard Tango",
			"slug" => "bernhardtango",
			"bold" => 0,
			"italic" => 0,
			"offsettop" => 0,
			'simple' => 1,
			"laser" => 0,
			"files" => array(
				"bernhard1" => "bernhard/bernhard-tango-regular.woff2",
				"bernhard2" => "bernhard/bernhard-tango-regular.woff",
			)
		),
		// 'canterburyregular' => array(
		// 	"name" => "Canterbury Regular",
		// 	"slug" => "canterburyregular",
		// 	"bold" => 0,
		// 	"italic" => 0,
		// 	"offsettop" => 0,
		// 	'simple' => 1,
		// 	"laser" => 0,
		// 	"files" => array(
		// 		"canterbury1" => "courier/canterbury-webfont.woff2",
		// 		"canterbury2" => "courier/canterbury-webfont.woff",
		// 	)
		// ),
		'couriernew' => array(
			"name" => "Courier New",
			"slug" => "couriernew",
			"bold" => 1,
			"italic" => 1,
			"offsettop" => 0,
			'simple' => 1,
			"laser" => 0,
			"files" => array(
				"courier1" => "courier/CourierNewPSMT.woff2",
				"courier2" => "courier/CourierNewPSMT.woff",
				"courier3" => "courier/CourierNewPS-ItalicMT.woff2",
				"courier4" => "courier/CourierNewPS-ItalicMT.woff",
				"courier5" => "courier/CourierNewPS-BoldMT.woff2",
				"courier6" => "courier/CourierNewPS-BoldMT.woff",
				"courier7" => "courier/CourierNewPS-BoldItalicMT.woff2",
				"courier8" => "courier/CourierNewPS-BoldItalicMT.woff",
			)
		),
		'centuryschoolbook' => array(
			"name" => "Century Schoolbook",
			"slug" => "centuryschoolbook",
			"bold" => 1,
			"italic" => 1,
			"offsettop" => 0,
			'simple' => 1,
			"laser" => 0,
			"files" => array(
				"centuryschoolbook1" => "centuryschoolbook/centuryschoolbook.woff2",
				"centuryschoolbook2" => "centuryschoolbook/centuryschoolbook.woff",
				"centuryschoolbook3" => "centuryschoolbook/centuryschoolbookbold.woff2",
				"centuryschoolbook4" => "centuryschoolbook/centuryschoolbookbold.woff",
				"centuryschoolbook5" => "centuryschoolbook/centuryschoolbookitalic.woff2",
				"centuryschoolbook6" => "centuryschoolbook/centuryschoolbookitalic.woff",
				"centuryschoolbook7" => "centuryschoolbook/centuryschoolbookbolditalic.woff2",
				"centuryschoolbook8" => "centuryschoolbook/centuryschoolbookbolditalic.woff",
			)
		),
		'domine' => array(
			"name" => "Domine",
			"slug" => "domine",
			"bold" => 1,
			"italic" => 0,
			"offsettop" => 0,
			'simple' => 1,
			"laser" => 0,
			"files" => array(
				"domine1" => "domine/Domine-Regular.woff2",
				"domine2" => "domine/Domine-Regular.woff",
				"domine3" => "domine/Domine-Bold.woff2",
				"domine4" => "domine/Domine-Bold.woff",
			)
		),
		'felipa' => array(
			"name" => "Felipa",
			"slug" => "felipa",
			"bold" => 0,
			"italic" => 0,
			"offsettop" => 0,
			'simple' => 1,
			"laser" => 0,
			"files" => array(
				"felipa1" => "felipa/Felipa-Regular.woff2",
				"felipa2" => "felipa/Felipa-Regular.woff",
			)
		),
		'futura' => array(
			"name" => "Futura",
			"slug" => "futura",
			"bold" => 1,
			"italic" => 1,
			"offsettop" => 0,
			'simple' => 1,
			"laser" => 0,
			"files" => array(
				"futura1" => "futura/Futura-Medium.woff2",
				"futura2" => "futura/Futura-Medium.woff",
				"futura3" => "futura/Futura-Bold.woff2",
				"futura4" => "futura/Futura-Bold.woff",
				"futura5" => "futura/Futura-BookItalic.woff2",
				"futura6" => "futura/Futura-BookItalic.woff",
				"futura7" => "futura/Futura-BoldItalic.woff2",
				"futura8" => "futura/Futura-BoldItalic.woff",
			)
		),
		'garamond' => array(
			"name" => "Garamond",
			"slug" => "garamond",
			"bold" => 1,
			"italic" => 1,
			"offsettop" => 0,
			'simple' => 1,
			"files" => array(
				"garamond1" => "garamond/EBGaramond-Regular.woff2",
				"garamond2" => "garamond/EBGaramond-Regular.woff",
				"garamond3" => "garamond/EBGaramond-SemiBold.woff2",
				"garamond4" => "garamond/EBGaramond-SemiBold.woff",
				"garamond5" => "garamond/EBGaramond-Italic.woff2",
				"garamond6" => "garamond/EBGaramond-Italic.woff",
				"garamond7" => "garamond/EBGaramond-BoldItalic.woff2",
				"garamond8" => "garamond/EBGaramond-BoldItalic.woff",
			)
		),
		'gillsans' => array(
			"name" => "Gill Sans",
			"slug" => "gillsans",
			"bold" => 1,
			"italic" => 1,
			"offsettop" => 0,
			'simple' => 1,
			"laser" => 0,
			"files" => array(
				"gillsans1" => "gillsans/GillSans-Medium.woff2",
				"gillsans2" => "gillsans/GillSans-Medium.woff",
				"gillsans3" => "gillsans/GillSans-Bold.woff2",
				"gillsans4" => "gillsans/GillSans-Bold.woff",
				"gillsans5" => "gillsans/GillSans-BoldItalic.woff2",
				"gillsans6" => "gillsans/GillSans-BoldItalic.woff",
				"gillsans7" => "gillsans/GillSans-BoldItalic.woff2",
				"gillsans8" => "gillsans/GillSans-BoldItalic.woff",
			)
		),
		'helvetica' => array(
			"name" => "Helvetica",
			"slug" => "helvetica",
			"bold" => 1,
			"italic" => 1,
			"offsettop" => 0,
			'simple' => 1,
			"laser" => 0,
			"files" => array(
				"helvetica1" => "helvetica/Helvetica-Regular.woff2",
				"helvetica2" => "helvetica/Helvetica-Regular.woff",
				"helvetica3" => "helvetica/Helvetica-Bold.woff2",
				"helvetica4" => "helvetica/Helvetica-Bold.woff",
				"helvetica5" => "helvetica/Helvetica-Italic.woff2",
				"helvetica6" => "helvetica/Helvetica-Italic.woff",
				"helvetica7" => "helvetica/Helvetica-BoldItalic.woff2",
				"helvetica8" => "helvetica/Helvetica-BoldItalic.woff",
			)
		),
		'marcellus' => array(
			"name" => "Marcellus",
			"slug" => "marcellus",
			"bold" => 0,
			"italic" => 0,
			"offsettop" => 0,
			'simple' => 1,
			"laser" => 0,
			"files" => array(
				"marcellus1" => "marcellus/marcellusscregular.woff2",
				"marcellus2" => "marcellus/marcellusscregular.woff",
			)
		),
		'niconne' => array(
			"name" => "Niconne Regular",
			"slug" => "niconne",
			"bold" => 0,
			"italic" => 0,
			"offsettop" => 0,
			'simple' => 1,
			"laser" => 0,
			"files" => array(
				"niconne1" => "niconne/Niconne-regular.woff",
				"niconne2" => "niconne/Niconne-regular.woff2",
			)
		),
		'oswald' => array(
			"name" => "Oswald",
			"slug" => "oswald",
			"bold" => 0,
			"italic" => 0,
			"offsettop" => 0,
			'simple' => 1,
			"laser" => 0,
			"files" => array(
				"oswald1" => "oswald/Oswald-Regular.woff2",
				"oswald2" => "oswald/Oswald-Regular.woff",
			)
		),
		'parisienne' => array(
			"name" => "Parisienne Regular",
			"slug" => "parisienneregular",
			"bold" => 0,
			"italic" => 0,
			"offsettop" => 0,
			'simple' => 0,
			"laser" => 1,
			"files" => array(
				"parisienne1" => "parisienne/parisienne-regular-webfont.woff2",
				"parisienne2" => "parisienne/parisienne-regular-webfont.woff",
			)
		),
		'playfairdisplay' => array(
			"name" => "Playfair Display",
			"slug" => "playfairdisplay",
			"bold" => 1,
			"italic" => 1,
			"offsettop" => 0,
			'simple' => 1,
			"laser" => 0,
			"files" => array(
				"playfairdisplay1" => "playfairdisplay/PlayfairDisplay-Regular.woff2",
				"playfairdisplay2" => "playfairdisplay/PlayfairDisplay-Regular.woff",
				"playfairdisplay3" => "playfairdisplay/PlayfairDisplay-BoldItalic.woff2",
				"playfairdisplay4" => "playfairdisplay/PlayfairDisplay-BoldItalic.woff",
				"playfairdisplay5" => "playfairdisplay/PlayfairDisplay-Italic.woff2",
				"playfairdisplay6" => "playfairdisplay/PlayfairDisplay-Italic.woff",
				"playfairdisplay7" => "playfairdisplay/PlayfairDisplay-Bold.woff2",
				"playfairdisplay8" => "playfairdisplay/PlayfairDisplay-Bold.woff",
			)
		),
		'roboto' => array(
			'name' => "Roboto",
			'slug' => "roboto",
			'bold' => 1,
			'italic' => 1,
			'offsettop' => 5,
			'simple' => 1,
			"laser" => 0,
			"files" => array(
				"roboto1" => "roboto/Roboto-Regular.woff2",
				"roboto2" => "roboto/Roboto-Regular.woff",
				"roboto3" => "roboto/Roboto-Italic.woff2",
				"roboto4" => "roboto/Roboto-Italic.woff",
				"roboto5" => "roboto/Roboto-Bold.woff2",
				"roboto6" => "roboto/Roboto-Bold.woff",
				"roboto7" => "roboto/Roboto-BoldItalic.woff2",
				"roboto8" => "roboto/Roboto-BoldItalic.woff",
			)
		),
		'stardosstencil' => array(
			"name" => "Stardos Stencil",
			"slug" => "stardosstencil",
			"bold" => 0,
			"italic" => 0,
			"offsettop" => 0,
			'simple' => 0,
			"laser" => 1,
			"files" => array(
				"stardosstencil1" => "stardosstencil/stardosstencilregular.woff2",
				"stardosstencil2" => "stardosstencil/stardosstencilregular.woff"
			)
		),
		'times' => array(
			"name" => "Times",
			"slug" => "times",
			"bold" => 1,
			"italic" => 1,
			"offsettop" => 0,
			'simple' => 1,
			"laser" => 0,
			"files" => array(
				"times1" => "times/Times-Regular.woff2",
				"times2" => "times/Times-Regular.woff",
				"times3" => "times/Times-Bold.woff2",
				"times4" => "times/Times-Bold.woff",
				"times5" => "times/Times-Italic.woff2",
				"times6" => "times/Times-Italic.woff",
				"times7" => "times/Times-BoldItalic.woff2",
				"times8" => "times/Times-BoldItalic.woff",
			)
		),
		'unifrakturmaguntia' => array(
			"name" => "Unifraktur",
			"slug" => "unifrakturmaguntia",
			"bold" => 0,
			"italic" => 0,
			"offsettop" => 0,
			'simple' => 1,
			"laser" => 1,
			"files" => array(
				"unifraktur1" => "unifraktur/UnifrakturMaguntia.woff2",
				"unifraktur2" => "unifraktur/UnifrakturMaguntia.woff",
			)
		),
	);
	return $fonts;
}
endif;