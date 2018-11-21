<?php
	session_start();

	if($_POST['langEn']){
		$lang = $_POST['langEn'];
	}elseif($_POST['langDe']){
		$lang = $_POST['langDe'];
	}elseif($_POST['langDa']){
		$lang = $_POST['langDa'];
	}else {
		$lang = 'en';
	}
?>
<!DOCTYPE html>
<html lang="<?php if($lang){echo $lang;} ?>">

	<head>
		<meta charset="UTF-8">
		<title>Dive Resort Fyn - Interactive Map</title>

		<link rel="icon" type="image/png" href="Resources/ui/favico.png">

		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<!-- SEO -->
		<meta name="description" content="Interactive map of dive spots around the Danish island of Funen">
		<meta name="keywords" content="diving, dive spots, Diving Denmark, Dive Resort Fyn, MF Ærøsund, wreck diving, Tauchen in Dänemark, Dänemark tauchplatz, Dänemark tauchstellen, Danish dive spots, Danish diving, Wracktauchen, vragdyk, dykning i Danmark, dykkerkort, dive map, diving map">
		<meta name="robots" content="index,follow,noodp">

		<!-- Mikro-formattering -->
		<meta itemprop="name" content="Dive Resort Fyn - Interactive Dive Map">
		<meta itemprop="description" content="Interactive map of dive spots around the Danish island of Funen">
		<meta itemprop="image" content="http://diving2000.dk/map/Resources/ui/map-scr.jpg">

		<!-- Twitter-deling -->
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@Fjordscene">
		<meta name="twitter:title" content="Dive Resort Fyn - Interactive Dive Map">
		<meta name="twitter:description" content="Interactive map of dive spots around the Danish island of Funen">
		<meta name="twitter:creator" content="@Fjordscene">
		<meta name="twitter:image:src" content="http://diving2000.dk/map/Resources/ui/map-scr.jpg">

		<!-- Facebook, Google+ og andre sociale medier -->
		<meta property="og:title" content="Dive Resort Fyn - Interactive Dive Map" />
		<meta property="og:url" content="http://diving2000.dk/map/" />
		<meta property="og:image" content="http://diving2000.dk/map/Resources/ui/map-scr.jpg" />
		<meta property="og:description" content="Interactive map of dive spots around the Danish island of Funen" />
		<meta property="og:site_name" content="Dive Resort Fyn - Interactive Map" />
		<meta property="article:published_time" content="2017-01-23T05:59:00+01:00" />
		<meta property="article:modified_time" content="2017-01-22T19:08:47+01:00" />

		<!-- STYLESHEETS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
		<link rel="stylesheet" href="Resources/css/style.css">

		<link rel="stylesheet" href="Resources/js/fancybox/jquery.fancybox.css" type="text/css" media="screen" /> <!-- Fancybox plugin -->

		<link rel="stylesheet" href="Resources/ui/flag-icon-css/css/flag-icon.min.css"> <!-- Flag-ikoner -->

	</head>
	<body>

		<!-- Sidebar 1 (venstre) -->
		<aside class="sidebar leftSidebar">
			<!-- Logoer -->
			<div class="logos">
				<a href="http://diving2000.com" target="_blank"><img id="dv2k" src="Resources/ui/Logo_diving_2000.png" alt=""></a>
				<a href="http://diveresortfyn.dk" target="_blank"><img id="drf" src="Resources/ui/Logo_dvf.png" alt=""></a>
			</div>

			<!-- Language toggle -->
			<div class="toggle langToggle">
				<form id="lang" method="post" action="">
					<div class="form-row">
						<label><?php if($lang == "en"){ echo "Choose Language"; }elseif($lang == "de"){ echo "Wählen Ihre Sprache"; }elseif($lang == "da"){ echo "Vælg Sprog"; }else{ echo "Choose Language"; }   ?></label>
						<label class="langButton <?php if(isset($lang) && $lang=="en"){ echo "chosen"; } ?>">
							<span class="flag-icon flag-icon-gb"></span>
							<input type="submit" name="langEn" value="en">English
						</label>
						<label class="langButton <?php if(isset($lang) && $lang=="de"){ echo "chosen"; } ?>">
							<span class="flag-icon flag-icon-de"></span>
							<input type="submit" name="langDe" value="de">Deutsch
						</label>
						<label class="langButton <?php if(isset($lang) && $lang=="da"){ echo "chosen"; } ?>">
							<span class="flag-icon flag-icon-dk"></span>
							<input type="submit" name="langDa" value="da">Dansk
						</label>

					</div>
				</form>
			</div>

			<!-- Filtrerings-knapper (injectes med JavaScript) -->
			<div id="buttons">
				<p>
					<?php
						if($lang == "en"){
							echo "Filters";
						}elseif($lang == "de"){
							echo "Filterung";
						}elseif($lang == "da"){
							echo "Filtre";
						}else{
							echo "Filters";
						}
					?>
				</p>

			</div>

			<br>

			<!-- Dokumentation - brug af kortet -->
			<div>
				<!-- Icon key -->
				<div class="fade">
					<h2>
					<?php
							if($lang == "en"){
								echo "Icon Key";
							}elseif($lang == "de"){
								echo "Ikonverklarung";
							}elseif($lang == "da"){
								echo "Ikonbeskrivelse";
							}else{
								echo "Icon Key";
							}
						?>
				</h2>
					<ul>
						<li class="icon icon-marker">
							<img src="Resources/ui/icon-marker.png" alt="">
							<?php
							if($lang == "en"){
								echo "Location";
							}elseif($lang == "de"){
								echo "Lage";
							}elseif($lang == "da"){
								echo "Placering";
							}else{
								echo "Location";
							}
						?>
						</li>
						<li class="icon icon-depth">
							<img src="Resources/ui/icon-arrow.png" alt="">
							<?php
							if($lang == "en"){
								echo "Deoth";
							}elseif($lang == "de"){
								echo "Tiefe";
							}elseif($lang == "da"){
								echo "Dybde";
							}else{
								echo "Depth";
							}
						?>
						</li>
						<li class="icon icon-difficulty">
							<img src="Resources/ui/icon-difficulty.png" alt="">
							<?php
							if($lang == "en"){
								echo "Difficulty";
							}elseif($lang == "de"){
								echo "Schwierigkeit";
							}elseif($lang == "da"){
								echo "Sværhedsgrad";
							}else{
								echo "Difficulty";
							}
						?>
						</li>
						<li class="icon icon-notice">
							<img src="Resources/ui/icon-notice.png" alt="">
							<?php
							if($lang == "en"){
								echo "Notice";
							}elseif($lang == "de"){
								echo "Bemerkung";
							}elseif($lang == "da"){
								echo "Bemærkning";
							}else{
								echo "Notice";
							}
						?>
						</li>
						<li class="icon icon-check">
							<img src="Resources/ui/icon-check.png" alt="">
							<?php
							if($lang == "en"){
								echo "Recommendation";
							}elseif($lang == "de"){
								echo "Empfehlung";
							}elseif($lang == "da"){
								echo "Anbefalet";
							}else{
								echo "Recommendation";
							}
						?>
						</li>
					</ul>
				</div>

				<!-- Kort-vejledning -->
				<div class="fade">
					<h2>
					<?php
						if($lang == "en"){
							echo "Map Usage";
						}elseif($lang == "de"){
							echo "Funktionalität";
						}elseif($lang == "da"){
								echo "Brug af kortet";
							}else{
							echo "Map Usage";
						}
					?>
				</h2>
					<ul>
						<li>
							<?php
							if($lang == "en"){
								echo "Click the circles for information about the dive spots";
							}elseif($lang == "de"){
								echo "Klick an die Circlen für Information über die Tauchstellen";
							}elseif($lang == "da"){
								echo "Klik på cirklerne for yderligere information om dykkerstederne";
							}else{
								echo "Click the circles for information about the dive spots";
							}
						?>
						</li>
						<li>
							<?php
							if($lang == "en"){
								echo "Click the squares for information about accommodation";
							}elseif($lang == "de"){
								echo "Klick an die Kvadraten für Information über Unterkunft";
							}elseif($lang == "da"){
								echo "Klik på firkanterne for information om overnatning";
							}else{
								echo "Click the squares for information about accommodation";
							}
						?>
						</li>
						<li>
							<?php
							if($lang == "en"){
								echo "Pan by touch / click-and-drag";
							}elseif($lang == "de"){
								echo "Pan bei Touch oder Klicken und Ziehen";
							}elseif($lang == "da"){
								echo "Bevæg kort ved berøring / klik og træk";
							}else{
								echo "Pan by touch / click-and-drag";
							}
						?>
						</li>
						<li>Minimum Zoom: 1</li>
						<li>Maximum Zoom: 12</li>
					</ul>
				</div>
			</div>

		</aside>

		<!-- MAP START -->
		<div class="wrapper">
			<svg version="1.1" id="Map" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="" height="1415.57px" viewBox="0 0 1930.701 1415.57" enable-background="new 0 0 1930.701 1415.57" xml:space="preserve">
				<style>
					text {
					 	font-family:'Verdana';
					 	font-size:12px;
					 	color:#666;
				 	}
				 	text.heading {
				 	 	fill:#F7931E;
					 	font-size:14px;
					 	font-weight:bold;
				 	}
				 	text.wreck {fill:#F7931E;}
				 	text.scenic {fill:#ED1C24;}

				 	tspan {font-weight:bold;}
			 	</style>

				<!-- Selve kort-delen -->
				<g id="map3">
					<image overflow="visible" width="2181" height="3125" xlink:href="Resources/snjylland-KORT.png"  transform="matrix(0.4487 0 0 0.4487 -554.752 -154.2769)"></image>
				</g>
				<g id="map2">
					<image overflow="visible" width="2181" height="3125" xlink:href="Resources/east-KORT.png"  transform="matrix(0.4529 0 0 0.4496 942.8335 -27.7139)"></image>
				</g>
				<g id="map4">
					<image overflow="visible" width="1266" height="1344" xlink:href="Resources/map-lolland.png"  transform="matrix(0.4485 0 0 0.4485 1355.333 869.6826)"></image>
				</g>
				<g id="map">
					<image overflow="visible" enable-background="new    " width="3149" height="3149" xlink:href="Resources/map-funen.png"  transform="matrix(0.4495 0 0 0.4495 -0.0283 -0.0317)"></image>
				</g>

				<!-- Overnatningssteder -->
				<g id="Accommodation">
					<rect data-name="syltemae" id="p-4" x="818.594" y="866.324" fill="#BDB8B3" width="20" height="20"/>
					<rect data-name="svendborg-sund" id="p-3" x="954.413" y="872.324" fill="#BDB8B3" width="20" height="20"/>
					<rect data-name="christiansminde" id="p-2" x="979.473" y="838.074" fill="#BDB8B3" width="20" height="20"/>
					<rect data-name="faenoe-sund" id="p-1" x="234.563" y="259.746" fill="#BDB8B3" width="20" height="20"/>
				</g>

				<!-- Sydfyn Dive Spots -->
				<g id="Svendborg_Sund">
					<g id="c-22" data-tags="Scenic">
						<path fill="#EC1F31" d="M943.247,890.349c3.914,0,7.087-3.173,7.087-7.087c0-3.913-3.173-7.086-7.087-7.086
								s-7.087,3.173-7.087,7.086C936.16,887.176,939.333,890.349,943.247,890.349"/>
					</g>
					<g id="m-22">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#ED1C24;stroke-miterlimit:10;" points="
							981,676.249 981,811.248 945.32,811.248 942.419,859.399 908.8,811.248 722,811.248 722,676.249 		"/>
						<text transform="matrix(1 0 0 1 740 706)" class="heading scenic">Svendborg <?php if($lang == "en"){ echo "Sound"; }elseif($lang == "de"){ echo "Sund"; }elseif($lang == "da"){ echo "Sund"; }else{ echo "Sound"; } ?></text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 740 721)"></image>
						<text transform="matrix(1 0 0 1 770 736)">N55°02.728' E10°36.314'</text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 740 746)"></image>
						<text transform="matrix(1 0 0 1 770 761)">1 - 12 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 742 773)"></image>
						<text transform="matrix(1 0 0 1 770 786)">3-4</text>
					</g>
				</g>

				<g id="Eichelbaum">
					<g id="c-1" data-tags="Wreck">
						<path style="fill:#F4823D;" d="M1270.299,794.441c3.914,0,7.087-3.174,7.087-7.088
							c0-3.912-3.173-7.086-7.087-7.086s-7.087,3.174-7.087,7.086C1263.212,791.267,1266.385,794.441,1270.299,794.441"/>
					</g>
					<g id="m-1">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#F7931E;stroke-miterlimit:10;" points="1303.5,576.923 1303.5,711.923
							1267.82,711.923 1264.92,760.074 1231.3,711.923 1044.5,711.923 1044.5,576.923 		"/>
						<text transform="matrix(1 0 0 1 1061 605)" class="heading wreck">M1108 / Dr Eichelbaum</text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 1061 620)"></image>
						<text transform="matrix(1 0 0 1 1091 635)"> N55°05.829' E011°02.461' </text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 1061 645)"></image>
						<text transform="matrix(1 0 0 1 1091 660)">23 - 27 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 1063 672)"></image>
						<text transform="matrix(1 0 0 1 1091 685)">3-5</text>
					</g>
				</g>

				<g id="Eboats">
					<g id="c-2" data-tags="Wreck">
						<path style="fill:#F4823D;" d="M1030.822,927.774c3.914,0,7.087-3.173,7.087-7.087
							c0-3.913-3.173-7.086-7.087-7.086s-7.087,3.173-7.087,7.086C1023.735,924.601,1026.908,927.774,1030.822,927.774"/>
					</g>
					<g id="m-2">
						<polygon vector-effect="non-scaling-stroke" opacity="0.69" fill="#FFFFFF" stroke="#F7931E" stroke-miterlimit="10" enable-background="new    " points="
		1085.055,640.952 1085.055,828.654 1035.447,828.654 1031.414,895.604 984.669,828.654 724.944,828.654 724.944,640.952 "/>
						<text transform="matrix(1 0 0 1 750 677)" class="heading wreck"><?php if($lang == "en"){ echo "The Motor Torpedo Boats"; }elseif($lang == "de"){ echo "Motortorpedoboote (MTB)"; }elseif($lang == "da"){ echo "Motortorpedobådene (MTB)"; }else{ echo "The Motor Torpedo Boats"; } ?></text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 750 695)"></image>
						<text transform="matrix(1 0 0 1 780 710)"><tspan>MTB1:</tspan> N55°00.790' E010°41.641' </text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 750 725)"></image>
						<text transform="matrix(1 0 0 1 780 740)"><tspan>MTB2:</tspan> N55°01.012' E010°42.056' </text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 750 755)"></image>
						<text transform="matrix(1 0 0 1 780 770)"><tspan>MTB3:</tspan> N55°00.956' E010°40.959' </text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 750 785)"></image>
						<text transform="matrix(1 0 0 1 780 800)"><tspan>MTB4:</tspan> N55°00.810' E010°41.133' </text>
					</g>

				</g>

				<g id="ThuroeDam">
					<g id="c-3" data-tags="Scenic">
						<path style="fill:#EC1F31;" d="M1000.123,873.334c3.914,0,7.087-3.173,7.087-7.087c0-3.913-3.173-7.086-7.087-7.086
							s-7.087,3.173-7.087,7.086C993.036,870.162,996.209,873.334,1000.123,873.334"/>
					</g>
					<g id="m-3">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#ED1C24;stroke-miterlimit:10;" points="1034.5,654.923 1034.5,789.923
							998.82,789.923 995.92,838.074 962.3,789.923 775.5,789.923 775.5,654.923 		"/>
						<text transform="matrix(1 0 0 1 793 685)" class="heading scenic"><?php if($lang == "en"){ echo "The Thur&#xF8; Dam"; }elseif($lang == "de"){ echo "Thurø-Damm"; }elseif($lang == "da"){ echo "Thurø-dæmningen"; }else{ echo "The Thur&#xF8; Dam"; } ?></text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 793 700)"></image>
						<text transform="matrix(1 0 0 1 823 715)"> N55°03.34200' E010°39.16740' </text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 793 725)"></image>
						<text transform="matrix(1 0 0 1 823 740)">6 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 795 752)"></image>
						<text transform="matrix(1 0 0 1 823 765)">1-2</text>
					</g>
				</g>

				<g id="TheSkansen">
					<g id="c-4" data-tags="Wreck">
						<path style="fill:#F4823D;" d="M1155.875,1092.236c3.914,0,7.087-3.173,7.087-7.087c0-3.913-3.173-7.086-7.087-7.086
							s-7.087,3.173-7.087,7.086C1148.788,1089.063,1151.961,1092.236,1155.875,1092.236"/>
					</g>
					<g id="m-4">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#F7931E;stroke-miterlimit:10;" points="1182.5,872.923 1182.5,1007.923
							1146.82,1007.923 1143.92,1056.074 1110.3,1007.923 923.5,1007.923 923.5,872.923 		"/>
						<text transform="matrix(1 0 0 1 940 902)" class="heading wreck">Skansen</text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 940 912)"></image>
						<text transform="matrix(1 0 0 1 970 927)"> N54°52.700' E010°50.100' </text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 940 937)"></image>
						<text transform="matrix(1 0 0 1 970 952)">14 - 18 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 942 964)"></image>
						<text transform="matrix(1 0 0 1 970 977)">3-4</text>
					</g>
				</g>

				<g id="TheIsland">
					<g id="c-6" data-tags="Wreck">
						<path style="fill:#F4823D;" d="M1134,1274.212c3.914,0,7.088-3.173,7.088-7.087c0-3.913-3.174-7.086-7.088-7.086
							s-7.087,3.173-7.087,7.086C1126.913,1271.04,1130.086,1274.212,1134,1274.212"/>
					</g>
					<g id="m-6">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#F7931E;stroke-miterlimit:10;" points="1173.5,1048.923 1173.5,1183.923
							1137.82,1183.923 1134.92,1232.074 1101.3,1183.923 914.5,1183.923 914.5,1048.923 		"/>
						<text transform="matrix(1 0 0 1 932 1078)" class="heading wreck">Island</text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 932 1093)"></image>
						<text transform="matrix(1 0 0 1 962 1108)"> N54°43.875' E010°47.791' </text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 932 1118)"></image>
						<text transform="matrix(1 0 0 1 962 1133)">16 - 23 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 934 1145)"></image>
						<text transform="matrix(1 0 0 1 962 1158)">2-4</text>
					</g>
				</g>

				<g id="M36-TheCapsized">
					<g id="c-5" data-tags="Wreck">
						<path style="fill:#F4823D;" d="M1099.625,1281.298c3.914,0,7.087-3.173,7.087-7.087c0-3.913-3.173-7.086-7.087-7.086
							s-7.087,3.173-7.087,7.086C1092.538,1278.125,1095.711,1281.298,1099.625,1281.298"/>
					</g>
					<g id="m-5">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#F7931E;stroke-miterlimit:10;" points="1129.5,1055.923 1129.5,1190.923
							1093.82,1190.923 1090.92,1239.074 1057.3,1190.923 870.5,1190.923 870.5,1055.923 		"/>
						<text transform="matrix(1 0 0 1 890 1085)" class="heading wreck">M36 / <?php if($lang == "en"){ echo "The Capsized"; }elseif($lang == "de"){ echo "Das Umgedrehte"; }elseif($lang == "da"){ echo "Den Omvendte"; }else{ echo "The Capsized"; } ?></text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 890 1100)"></image>
						<text transform="matrix(1 0 0 1 920 1115)"> N54°43.784' E01°046.451' </text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 890 1125)"></image>
						<text transform="matrix(1 0 0 1 920 1140)">22 - 28 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 892 1152)"></image>
						<text transform="matrix(1 0 0 1 922 1165)">3-5</text>
					</g>
				</g>

				<g id="TheTorpedoBoat">
					<g id="c-7" data-tags="Wreck">
						<path style="fill:#F4823D;" d="M1053.425,1355.573c3.914,0,7.087-3.173,7.087-7.087c0-3.913-3.173-7.086-7.087-7.086
							s-7.087,3.173-7.087,7.086C1046.338,1352.4,1049.511,1355.573,1053.425,1355.573"/>
					</g>
					<g id="m-7">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#F7931E;stroke-miterlimit:10;" points="1082.5,1130.923 1082.5,1265.923
							1046.82,1265.923 1043.92,1314.074 1010.3,1265.923 823.5,1265.923 823.5,1130.923 		"/>
						<text transform="matrix(1 0 0 1 838 1159)" class="heading wreck"><?php if($lang == "en"){ echo "The Torpedo Boat"; }elseif($lang == "de"){ echo "Torpedoboot"; }elseif($lang == "da"){ echo "Torpedobåden"; }else{ echo "The Torpedo Boat"; } ?></text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 838 1174)"></image>
						<text transform="matrix(1 0 0 1 868 1189)"> N54°40.131' E010°042.228' </text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 838 1199)"></image>
						<text transform="matrix(1 0 0 1 868 1214)">10 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 840 1226)"></image>
						<text transform="matrix(1 0 0 1 868 1239)">1</text>
					</g>
				</g>

				<g id="Aeroesund">
					<g id="c-8" data-tags="Wreck">
						<path style="fill:#F4823D;" d="M830.53,916.319c3.914,0,7.088-3.173,7.088-7.087
							c0-3.913-3.174-7.086-7.088-7.086s-7.087,3.173-7.087,7.086C823.443,913.146,826.616,916.319,830.53,916.319"/>
					</g>
					<g id="m-8">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#F7931E;stroke-miterlimit:10;" points="861.5,705.923 861.5,840.923
							825.82,840.923 822.92,889.074 789.3,840.923 602.5,840.923 602.5,705.923 		"/>
						<text transform="matrix(1 0 0 1 620 735)" class="heading wreck">Dive Spot M/F &#xC6;r&#xF8;sund</text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 620 750)"></image>
						<text transform="matrix(1 0 0 1 650 765)"> N54°40.131' E010°042.228' </text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 620 775)"></image>
						<text transform="matrix(1 0 0 1 650 790)">10 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 622 802)"></image>
						<text transform="matrix(1 0 0 1 650 815)">1</text>
					</g>
				</g>

				<!-- Lillebælt Dive Spots -->
				<g id="NewLillebaeltBridge">
					<g id="c-10" data-tags="Scenic,UW-Hunting">
						<path style="fill:#EC1F31;" d="M281,259.927c3.914,0,7.087-3.173,7.087-7.087c0-3.913-3.173-7.086-7.087-7.086
							s-7.087,3.173-7.087,7.086C273.913,256.754,277.086,259.927,281,259.927"/>
					</g>
					<g id="m-10">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#ED1C24;stroke-miterlimit:10;" points="245.5,454.923 245.5,319.923
							281.18,319.923 284.08,271.773 317.7,319.923 504.5,319.923 504.5,454.923 		"/>
						<text transform="matrix(1 0 0 1 260 347)" class="heading scenic"><?php if($lang == "en"){ echo "New Lilleb&#xE6;lt Bridge"; }elseif($lang == "de"){ echo "Die Neue Lillebælt Brücke"; }elseif($lang == "da"){ echo "Den Ny Lillebæltsbro"; }else{ echo "New Lilleb&#xE6;lt Bridge"; } ?></text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 260 362)"></image>
						<text transform="matrix(1 0 0 1 290 377)"> N55°31.15400' E09°44.68167' </text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 260 387)"></image>
						<text transform="matrix(1 0 0 1 290 402)">0 - 25 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 262 414)"></image>
						<text transform="matrix(1 0 0 1 290 427)">3-4</text>
					</g>
				</g>

				<g id="FerryTerminal">
					<g id="c-15" data-tags="Scenic,UW-Hunting">
						<path style="fill:#EC1F31;" d="M255.083,293.177c3.914,0,7.087-3.173,7.087-7.087c0-3.913-3.173-7.086-7.087-7.086
							s-7.087,3.173-7.087,7.086C247.997,290.004,251.169,293.177,255.083,293.177"/>
					</g>
					<g id="m-15">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#ED1C24;stroke-miterlimit:10;" points="224.5,491.923 224.5,356.923
							260.18,356.923 263.08,308.773 296.7,356.923 483.5,356.923 483.5,491.923 		"/>
						<text transform="matrix(1 0 0 1 240 383)" class="heading scenic"><?php if($lang == "en"){ echo "Ferry Terminal"; }elseif($lang == "de"){ echo "Fährehafen"; }elseif($lang == "da"){ echo "Øksnerodde"; }else{ echo "Ferry Terminal"; } ?></text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 240 398)"></image>
						<text transform="matrix(1 0 0 1 270 413)"> N55°29.64950' E09°042.20333' </text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 240 423)"></image>
						<text transform="matrix(1 0 0 1 270 438)">0 - 20 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 242 450)"></image>
						<text transform="matrix(1 0 0 1 270 463)">2-3</text>
					</g>
				</g>

				<g id="GlAalbo">
					<g id="c-16" data-tags="Scenic">
						<path style="fill:#EC1F31;" d="M228.745,322.705c3.914,0,7.087-3.173,7.087-7.087c0-3.913-3.173-7.086-7.087-7.086
							s-7.087,3.173-7.087,7.086C221.658,319.532,224.831,322.705,228.745,322.705"/>
					</g>
					<g id="m-16">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#ED1C24;stroke-miterlimit:10;" points="190.5,518.923 190.5,383.923
							226.18,383.923 229.08,335.773 262.7,383.923 449.5,383.923 449.5,518.923 		"/>
						<text transform="matrix(1 0 0 1 204 412)" class="heading scenic">Gl. &#xC5;lbo</text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 204 427)"></image>
						<text transform="matrix(1 0 0 1 234 442)"> N55°28.09167' E09°40.82217' </text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 204 452)"></image>
						<text transform="matrix(1 0 0 1 234 467)">0 - 20 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 206 479)"></image>
						<text transform="matrix(1 0 0 1 234 492)">2-3</text>
					</g>
				</g>

				<g id="Soebadet">
					<g id="c-14" data-tags="Scenic">
						<path style="fill:#EC1F31;" d="M228.745,245.754c3.914,0,7.087-3.173,7.087-7.087c0-3.913-3.173-7.086-7.087-7.086
							s-7.087,3.173-7.087,7.086C221.658,242.581,224.831,245.754,228.745,245.754"/>
					</g>
					<g id="m-14">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#ED1C24;stroke-miterlimit:10;" points="190.5,442.923 190.5,307.923
							226.18,307.923 229.08,259.773 262.7,307.923 449.5,307.923 449.5,442.923 		"/>
						<text transform="matrix(1 0 0 1 205 336)" class="heading scenic">S&#xF8;badet</text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 205 351)"></image>
						<text transform="matrix(1 0 0 1 235 366)"> N55°31.102733' E09°41.96667' </text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 205 376)"></image>
						<text transform="matrix(1 0 0 1 235 391)">0 - 30 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 207 403)"></image>
						<text transform="matrix(1 0 0 1 235 416)">2-3</text>
					</g>
				</g>

				<g id="BoulderReef-Soebadet">
					<g id="c-13" data-tags="Scenic">
						<path style="fill:#EC1F31;" d="M225.918,255.26c3.914,0,7.087-3.173,7.087-7.087c0-3.913-3.173-7.086-7.087-7.086
							s-7.087,3.173-7.087,7.086C218.832,252.087,222.004,255.26,225.918,255.26"/>
					</g>
					<g id="m-13">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#ED1C24;stroke-miterlimit:10;" points="186.5,437.923 186.5,302.923
							222.18,302.923 225.08,254.773 258.7,302.923 445.5,302.923 445.5,437.923 		"/>
						<text transform="matrix(1 0 0 1 201 329)" class="heading scenic"><?php if($lang == "en"){ echo "Boulder Reef"; }elseif($lang == "de"){ echo "Steinriff"; }elseif($lang == "da"){ echo "Stenrev"; }else{ echo "Boulder Reef"; } ?> (S&#xF8;badet)</text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 201 344)"></image>
						<text transform="matrix(1 0 0 1 231 359)"> N55°31.000' E09°42.033' </text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 201 369)"></image>
						<text transform="matrix(1 0 0 1 231 384)">0 - 20 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 203 398)"></image>
						<text transform="matrix(1 0 0 1 231 409)">2-3</text>
					</g>
				</g>

				<g id="Snoghoej">
					<g id="c-11" data-tags="Scenic,UW-Hunting">
						<path style="fill:#EC1F31;" d="M259.739,251.174c3.914,0,7.087-3.173,7.087-7.087c0-3.913-3.173-7.086-7.087-7.086
							s-7.087,3.173-7.087,7.086C252.652,248.001,255.825,251.174,259.739,251.174"/>
					</g>
					<g id="m-11">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#ED1C24;stroke-miterlimit:10;" points="224.5,444.923 224.5,309.923
							260.18,309.923 263.08,261.773 296.7,309.923 483.5,309.923 483.5,444.923 		"/>
						<text transform="matrix(1 0 0 1 239 336)" class="heading scenic">Snogh&#xF8;j</text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 239 351)"></image>
						<text transform="matrix(1 0 0 1 269 366)"> N55°31.17583' E09°42.94417' </text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 239 376)"></image>
						<text transform="matrix(1 0 0 1 269 391)">0 - 25 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 241 401)"></image>
						<text transform="matrix(1 0 0 1 269 414)">3-5</text>
					</g>
				</g>

				<g id="OldLillebaeltBridge">
					<g id="c-12" data-tags="Scenic">
						<path style="fill:#EC1F31;" d="M242.918,258.26c3.914,0,7.087-3.173,7.087-7.087c0-3.913-3.173-7.086-7.087-7.086
							s-7.087,3.173-7.087,7.086C235.832,255.087,239.004,258.26,242.918,258.26"/>
					</g>
					<g id="m-12">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#ED1C24;stroke-miterlimit:10;" points="205.5,447.923 205.5,312.923
							241.18,312.923 244.08,264.773 277.7,312.923 464.5,312.923 464.5,447.923 		"/>
						<text transform="matrix(1 0 0 1 219 340)" class="heading scenic"><?php if($lang == "en"){ echo "Old Lilleb&#xE6;lt Bridge"; }elseif($lang == "de"){ echo "Die Alte Lillebælt Brücke"; }elseif($lang == "da"){ echo "Den Gamle Lillebæltsbro"; }else{ echo "Old Lilleb&#xE6;lt Bridge"; } ?></text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 219 355)"></image>
						<text transform="matrix(1 0 0 1 249 370)"> N55°31.08483' E09°42.64967' </text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 219 380)"></image>
						<text transform="matrix(1 0 0 1 249 395)">0 - 22 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 221 407)"></image>
						<text transform="matrix(1 0 0 1 249 420)">3-4</text>
					</g>
				</g>

				<g id="Ammoniakhavnen">
					<g id="c-9" data-tags="Scenic,UW-Hunting">
						<path style="fill:#EC1F31;" d="M273.913,233.26c3.914,0,7.087-3.173,7.087-7.087c0-3.913-3.173-7.086-7.087-7.086
							s-7.087,3.173-7.087,7.086C266.826,230.087,269.999,233.26,273.913,233.26"/>
					</g>
					<g id="m-9">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#ED1C24;stroke-miterlimit:10;" points="242.5,419.923 242.5,284.923
							278.18,284.923 281.08,236.773 314.7,284.923 501.5,284.923 501.5,419.923 		"/>
						<text transform="matrix(1 0 0 1 257 310)" class="heading scenic">Ammoniakhavnen</text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 257 325)"></image>
						<text transform="matrix(1 0 0 1 287 340)"> N55°31.43383' E09°44.53800' </text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 257 350)"></image>
						<text transform="matrix(1 0 0 1 287 365)">0 - 30 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 259 377)"></image>
						<text transform="matrix(1 0 0 1 287 390)">2-4</text>
					</g>
				</g>

				<!-- Dive Spots rund um Funen -->
				<g id="Helnæs_Fyr">
					<g id="c-20" data-tags="Scenic">
						<path fill="#EC1F31" d="M463.747,775.549c3.914,0,7.087-3.173,7.087-7.087c0-3.913-3.173-7.086-7.087-7.086
							s-7.087,3.173-7.087,7.086C456.66,772.376,459.833,775.549,463.747,775.549"/>
					</g>
					<g id="m-20">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#ED1C24;stroke-miterlimit:10;" points="
							501.5,561.449 501.5,696.449 465.82,696.449 462.919,744.6 429.3,696.449 242.5,696.449 242.5,561.449 		"/>
						<text transform="matrix(1 0 0 1 260 591)" class="heading scenic"><?php if($lang == "en"){ echo "Helnæs Lighthouse"; }elseif($lang == "de"){ echo "Helnæs Leuchtturm"; }elseif($lang == "da"){ echo "Helnæs Fyr"; }else{ echo "Helnæs Lighthouse"; } ?></text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 260 606)"></image>
						<text transform="matrix(1 0 0 1 290 621)">N55°8.007' E9°58.753'</text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 260 631)"></image>
						<text transform="matrix(1 0 0 1 290 646)">4 - 6 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 262 658)"></image>
						<text transform="matrix(1 0 0 1 290 671)">1-2</text>
					</g>
				</g>

				<g id="Kerteminde_Havn">
					<g id="c-23" data-tags="Scenic">
						<path fill="#EC1F31" d="M997.497,331.304c3.914,0,7.087-3.173,7.087-7.087c0-3.913-3.173-7.086-7.087-7.086
							s-7.087,3.173-7.087,7.086C990.41,328.131,993.583,331.304,997.497,331.304"/>
					</g>
					<g id="m-23">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#ED1C24;stroke-miterlimit:10;" points="
							1035.25,117.204 1035.25,252.203 999.57,252.203 996.669,300.354 963.05,252.203 776.25,252.203 776.25,117.204 		"/>
						<text transform="matrix(1 0 0 1 794 147)" class="heading scenic"><?php if($lang == "en"){ echo "Kerteminde Harbour"; }elseif($lang == "de"){ echo "Kerteminde Hafen"; }elseif($lang == "da"){ echo "Kerteminde Havn"; }else{ echo "Kerteminde Harbour"; } ?></text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 794 162)"></image>
						<text transform="matrix(1 0 0 1 824 177)">N 55°26.897' E10°39.504'</text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 794 187)"></image>
						<text transform="matrix(1 0 0 1 824 202)">5 - 7 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 794 214)"></image>
						<text transform="matrix(1 0 0 1 824 229)">3-4</text>
					</g>
				</g>

				<g id="Måle_Strand">
					<g id="c-19" data-tags="Scenic,UW-Hunting">
						<path fill="#EC1F31" d="M1039.573,254.194c3.914,0,7.087-3.173,7.087-7.087c0-3.913-3.173-7.086-7.087-7.086
							s-7.087,3.173-7.087,7.086C1032.486,251.021,1035.659,254.194,1039.573,254.194"/>
					</g>
					<g id="m-19">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#ED1C24;stroke-miterlimit:10;" points="
				1079.834,35.936 1079.834,170.936 1044.154,170.936 1041.252,219.087 1007.633,170.936 820.833,170.936 820.833,35.936 		"/>
						<text transform="matrix(1 0 0 1 838 66)" class="heading scenic"><?php if($lang == "en"){ echo "Måle Beach"; }elseif($lang == "de"){ echo "Måle Strand"; }elseif($lang == "da"){ echo "Måle Strand"; }else{ echo "Måle Beach"; } ?></text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 838 81)"></image>
						<text transform="matrix(1 0 0 1 868 96)">N55°29.813' E10°44.096'</text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 838 106)"></image>
						<text transform="matrix(1 0 0 1 868 121)">4 - 7 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 840 133)"></image>
						<text transform="matrix(1 0 0 1 868 148)">1</text>
					</g>
				</g>

				<g id="Sibirien">
					<g id="c-18" data-tags="Scenic,UW-Hunting">
						<path fill="#EC1F31" d="M1015.247,351.138c3.914,0,7.087-3.173,7.087-7.087c0-3.913-3.173-7.086-7.087-7.086
							s-7.087,3.173-7.087,7.086C1008.16,347.965,1011.333,351.138,1015.247,351.138"/>
					</g>
					<g id="m-18">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#ED1C24;stroke-miterlimit:10;" points="
							1053,137.038 1053,272.038 1017.32,272.038 1014.419,320.189 980.8,272.038 794,272.038 794,137.038 		"/>
						<text transform="matrix(1 0 0 1 812 167)" class="heading scenic"><?php if($lang == "en"){ echo "Siberia"; }elseif($lang == "de"){ echo "Sibirien"; }elseif($lang == "da"){ echo "Sibirien"; }else{ echo "Siberia"; } ?></text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 812 182)"></image>
						<text transform="matrix(1 0 0 1 842 197)"> 55°25'50.9"N 10°41'37.5"E </text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 812 207)"></image>
						<text transform="matrix(1 0 0 1 842 222)">1 - 5 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 814 234)"></image>
						<text transform="matrix(1 0 0 1 842 247)">1</text>
					</g>
				</g>

				<g id="Amigo">
					<g id="c-21" data-tags="Wreck">
						<path fill="#F4823D" d="M1124.233,454.923c3.914,0,7.087-3.173,7.087-7.087c0-3.913-3.173-7.086-7.087-7.086
							s-7.087,3.173-7.087,7.086C1117.146,451.75,1120.319,454.923,1124.233,454.923"/>
					</g>
					<g id="m-21">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#F4823D;stroke-miterlimit:10;" points="
							1161.986,240.823 1161.986,375.823 1126.307,375.823 1123.405,423.974 1089.786,375.823 902.986,375.823 902.986,240.823 		"/>
						<text transform="matrix(1 0 0 1 920 271)" class="heading wreck">Amigo</text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 920 286)"></image>
						<text transform="matrix(1 0 0 1 950 301)">55°22.85' E10° 51.48'</text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 920 311)"></image>
						<text transform="matrix(1 0 0 1 950 326)">21 -26 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 922 338)"></image>
						<text transform="matrix(1 0 0 1 950 351)">3-5</text>
					</g>
				</g>

				<g id="Knudshoved">
					<g id="c-17" data-tags="Scenic,Wreck">
						<path fill="#EC1F31" d="M1144.091,541.565c3.914,0,7.087-3.173,7.087-7.087c0-3.913-3.173-7.086-7.087-7.086
							s-7.087,3.173-7.087,7.086C1137.004,538.393,1140.177,541.565,1144.091,541.565"/>
					</g>
					<g id="m-17">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#ED1C24;stroke-miterlimit:10;" points="
							1181.844,327.465 1181.844,462.465 1146.164,462.465 1143.263,510.617 1109.644,462.465 922.844,462.465 922.844,327.465 		"/>
						<text transform="matrix(1 0 0 1 940 357)" class="heading scenic"><?php if($lang == "en"){ echo "Knudshoved Ferry Terminal"; }elseif($lang == "de"){ echo "Knudshoved Fährehafen"; }elseif($lang == "da"){ echo "Knudshoved Færgehavn"; }else{ echo "Knudshoved Ferry Terminal"; } ?></text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 940 372)"></image>
						<text transform="matrix(1 0 0 1 970 387)">N55°17'38.747 E10°50'48.826</text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 940 397)"></image>
						<text transform="matrix(1 0 0 1 970 412)">1 - 8 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 942 424)"></image>
						<text transform="matrix(1 0 0 1 970 437)">1-2</text>
					</g>
				</g>

				<g id="Vesterkajen_Nyborg">
					<g id="c-24" data-tags="Scenic">
						<path fill="#EC1F31" d="M1091.747,534.398c3.914,0,7.088-3.173,7.088-7.087c0-3.913-3.174-7.086-7.088-7.086
							s-7.086,3.173-7.086,7.086C1084.661,531.226,1087.833,534.398,1091.747,534.398"/>
					</g>
					<g id="m-24">
						<polygon vector-effect="non-scaling-stroke" style="opacity:0.69;fill:#FFFFFF;stroke:#ED1C24;stroke-miterlimit:10;" points="
							1139.501,320.298 1139.501,455.298 1093.821,455.298 1090.919,503.449 1057.3,455.298 870.5,455.298 870.5,320.298 		"/>
						<text transform="matrix(1 0 0 1 888 350)" class="heading scenic"><?php if($lang == "en"){ echo "Western Quay"; }elseif($lang == "de"){ echo "Westlicher Liegeplatz"; }elseif($lang == "da"){ echo "Vesterkajen"; }else{ echo "Western Quay"; } ?>, Nyborg</text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-marker.png"  transform="matrix(1 0 0 1 888 365)"></image>
						<text transform="matrix(1 0 0 1 918 380)">N55°18.394' E10°47.421'</text>
						<image width="20" height="20" xlink:href="Resources/ui/icon-arrow.png"  transform="matrix(1 0 0 1 888 390)"></image>
						<text transform="matrix(1 0 0 1 918 405)">4 - 6 meters</text>
						<image width="16" height="16" xlink:href="Resources/ui/icon-difficulty.png"  transform="matrix(1 0 0 1 888 417)"></image>
						<text transform="matrix(1 0 0 1 918 430)">2-3</text>
					</g>
				</g>

			</svg>
			<!-- MAP END -->

		</div>

		<!-- Sidebar 2 (right) -->
		<aside class="sidebar rightSidebar">
			<section class="addresses">
				<h2>
				<?php
					if($lang == "en"){
						echo "Dive Centers";
					}elseif($lang == "de"){
						echo "Tauchbasen";
					}elseif($lang == "da"){
						echo "Dykkercentre";
					}else {
						echo "Dive Centers";
					}
				?>
			</h2>
				<ul>
					<li>
						<h3>
						Diving 2000
					</h3>
						<p>
							Asylgade 16
						</p>
						<p>
							5000 Odense C
						</p>
						<p>
							Tel: +45 66 13 00 49
						</p>
						<p>
							info@diving2000.dk
						</p>
					</li>
					<li>
						<h3>
						Dive Resort Fyn
					</h3>
						<p>
							Asylgade 16
						</p>
						<p>
							5000 Odense C
						</p>
						<p>
							Tel: +45 66 13 00 49
						</p>
						<p>
							info@diveresortfyn.dk
						</p>
					</li>
				</ul>
			</section>
			<section class="security">
				<h2>
				<?php
					if($lang == "en"){
						echo "Security";
					}elseif($lang == "de"){
						echo "Sicherheit";
					}elseif($lang == "da"){
						echo "Sikkerhed";
					}else {
						echo "Security";
					}
				?>
			</h2>
				<ul>
					<li>
						<h3>
						<?php
							if($lang == "en"){
								echo "Emergency tel. no.: ";
							}elseif($lang == "de"){
								echo "Notrufnummer";
							}elseif($lang == "da"){
								echo "Nødtelefonnummer";
							}else {
								echo "Emergency tel. no.: ";
							}
						?>
					</h3>
						<p>
							112
						</p>
					</li>
					<li>
						<h3>
						Coastguard (SOK):
					</h3>
						<p>
							+45 89 43 30 99
						</p>
					</li>
				</ul>
			</section>
		</aside>

		<!-- Copyright et al -->
		<footer>
			<p class="copyright">
				Indeholder <a href="http://download.kortforsyningen.dk/content/vilk%C3%A5r-og-betingelser" target="_blank">GeoDanmark data</a> fra Styrelsen for Dataforsyning og Effektivisering og Danske kommuner, december 2016
			</p>
			<p class="copyright">
				&copy; <a href="http://diveresortfyn.dk" target="_blank">Dive Resort Fyn</a>,
				<?php echo date("Y"); ?>
			</p>
		</footer>

		<!-- MODALS - content for large infoboxes gets loaded in here -->
		<div class="modals fadeOut">
			<p class="close" title="Close"></p>
		</div>

		<!-- MODALS about accommodation goes here -->
		<div class="accommodation fadeOut">
			<div class="p-1">
				<div class="heading">
					<h2>
						 <?php if($lang == "en"){ echo "Fænø-Sund Resort"; }elseif($lang == "de"){ echo "FænøSund Ferienresort"; }elseif($lang == "da"){ echo "Fænø-Sund"; }else{ echo "Fænø-Sund Resort"; } ?>
					</h2>
				</div>
				<div class="content">
					<div class="grid col-50-50">
						<div>
							<section>
								<?php
									if($lang == 'de'){
										echo '<h3>Beschreibung</h3>';
										echo '<p>Fænø-Sund Ferienresort liegt direkt am Wald und Strand und ist einfach zu erreichen. Die Unterbringung in Luxushütten für bis zu 6 Personen mit voller Ausstattung und eigener möblierter Terrasse bietet alle Komfort. Die Hütten haben eigene Küche und gratis Wi-Fi.
										</p><p>
Darüber hinaus haben Sie freien Zugang zur Sauna, Indoor- und Außen Pool und zur Minigolfanlage. Extra Aufbewahrungs-, Reinigungs- und Trockenräumlichkeiten für Ihre Taucherausrüstung stehen zur Verfügung.
</p><p>
Das Fahrwasser um Fænø-Sund – Lillebælt – liegt in einer einzigartigen Lage und einzigartiger Fauna, wie zum Beispiel direkt an einem neu erschaffenen Steinriff.
Außer Scubadiving der Extraklasse, bietet Ihnen Lillebælt bei Middelfart gute Möglichkeiten für Unterwasserjagd, Wandertouren, Mountainbiken, Angeln, Baumklettern, Bridgewalking und vieles Mehr.</p>';
									}elseif($lang == 'da'){
										echo '<h3>Beskrivelse</h3>';
										echo '<p>Fænø-Sund - beliggende nær ved både skov og strand - er let at finde, men svært at forlade. Indkvartering i 6-personers luxux-hytter med alle moderne bekvemmeligheder; en separat, møbleret terrasse, eget køkken og gratis Wifi.</p>
										<p>Der er også åben adgang til alle stedets faciliteter inklusive sauna, indendørs- og udendørs pool og en minigolfbane. Der er også mulighed for at opbevare, rengøre og tørre dykkerudstyr.</p>
										<p>De kystnære farvande omkring Fænø-Sund (Lillebælt) byder på bemærkelsesværdigt dyreliv og interessant topografi såsom det nye, menneskeskabte stenrev. Udover scuba-dykning af højeste kvalitet tilbyder Middelfart og Lillebælt glimrende muligheder for undervandsjagt, vandring, mountainbiking, lystfiskeri, træklatring og meget andet.</p>
										';
									}else {
										echo '<h3>Description</h3>';
										echo '<p>Located right next to woods and the beach, the Fænø-Sund Resort is easy to reach – but hard to leave.
Accommodations in 6-person luxury cabins with all modern conveniences, along with a separate, furnished terrace, own kitchen and free Wifi.
</p><p>
There is also free access to facilities including a sauna, indoor and outdoor pools, and a mini-golf course. There is also space to store, rinse and dry equipment.
</p><p>
The coastal waters around Fænø-Sund – i.e. the Little Belt – feature truly remarkable wildlife and astounding topography, including the completely new, man-made stone reef.
In addition to Scuba diving of the highest quality, Middelfart and the Little Belt offer excellent opportunities for underwater hunting, hiking, mountainbiking, angling, tree-climbing and much besides.</p>';
									}
								?>
							</section>
						</div>
						<div>
							<section>
								<?php
									if($lang == 'de'){
										echo '<h3>Kontakt</h3>';
									}elseif($lang == 'da'){
										echo '<h3>Kontakt</h3>';
									}else {
										echo '<h3>Contact</h3>';
									}
								?>
								<ul class="details-list">
									<li>
										<strong><?php if($lang == "en"){ echo "Name:"; }elseif($lang == "de"){ echo "Name:"; }elseif($lang == "da"){ echo "Navn:"; }else{ echo "Name:"; } ?>&nbsp;&nbsp;</strong>
										FænøSund Konference og ferie Aps
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "Address:"; }elseif($lang == "de"){ echo "Adresse:"; }elseif($lang == "da"){ echo "Adresse"; }else{ echo "Address:"; } ?>&nbsp;&nbsp;</strong>
										Oddevejen 8
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "City:"; }elseif($lang == "de"){ echo "Stadt:"; }elseif($lang == "da"){ echo "By:"; }else{ echo "City:"; } ?>&nbsp;&nbsp;</strong>
										5500 Middelfart
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "Phone:"; }elseif($lang == "de"){ echo "Telefonnummer:"; }elseif($lang == "da"){ echo "Tlf.:"; }else{ echo "Phone:"; } ?>&nbsp;&nbsp;</strong>
										+45 63 40 19 06
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "E-mail:"; }elseif($lang == "de"){ echo "E-mail-Adresse:"; }elseif($lang == "da"){ echo "E-mail:"; }else{ echo "E-mail:"; } ?>&nbsp;&nbsp;</strong>
										<a href="mailto:reception@midti.dk">reception@midti.dk</a>
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "Website:"; }elseif($lang == "de"){ echo "Link:"; }elseif($lang == "da"){ echo "Hjemmeside:"; }else{ echo "Website:"; } ?>&nbsp;&nbsp;</strong>
										<a href="http://midti.dk" target="_blank">midti.dk</a>
									</li>
								</ul>
							</section>
						</div>
					</div>
					<div class="grid col-50-50">
						<div>
							<section>
								<div class="img-gallery">
									<?php
										if($lang == "en"){
											echo "<h3>Image Gallery</h3>";
										}elseif($lang == "de"){
											echo "<h3>Fotogalerie</h3>";
										}elseif($lang == 'da'){
											echo "<h3>Billedgalleri</h3>";
										}else {
											echo "<h3>Image Gallery</h3>";
										}
									?>
									<div>
										<a class="fancybox" rel="fænøsund" href="/map/Resources/img/acc/luftfoto.jpg">
											<img src="/map/Resources/img/acc/luftfoto.jpg" alt="Luftfoto af Fænø-Sund resort">
										</a>
									</div>
									<div>
										<a class="fancybox" rel="fænøsund" href="/map/Resources/img/acc/P1030079.jpg">
											<img src="/map/Resources/img/acc/P1030079.jpg" alt="Luftfoto af Fænø-Sund resort">
										</a>
									</div>
								</div>
							</section>
						</div>
						<div>
							<section>
								<?php
									if($lang == "en"){
										echo "<h3>Facilities</h3>";
									}elseif($lang == "de"){
										echo "<h3>Fazilitäten</h3>";
									}elseif($lang == 'da'){
										echo "<h3>Faciliteter</h3>";
									}else {
										echo "<h3>Facilities</h3>";
									}
								?>
								<ul class="details-list">
									<li>
										<img width="20" height="16" src="Resources/ui/icon-check.png">&nbsp;
										<?php if($lang == "en"){ echo "Wifi"; }elseif($lang == "de"){ echo "Wifi"; }elseif($lang == "da"){ echo "Wifi"; }else{ echo "Wifi"; } ?>
									</li>
								</ul>
								<?php
									if($lang == "en"){
										echo "<h3>For Divers</h3>";
									}elseif($lang == "de"){
										echo "<h3>Für die Tauchern</h3>";
									}elseif($lang == 'da'){
										echo "<h3>For dykkere</h3>";
									}else {
										echo "<h3>For Divers</h3>";
									}
								?>
								<ul class="details-list">
									<li>
										<img width="20" height="16" src="Resources/ui/icon-check.png">&nbsp;
										<?php if($lang == "en"){ echo "Compressor"; }elseif($lang == "de"){ echo "Kompressor"; }elseif($lang == "da"){ echo "Kompressor"; }else{ echo "Compressor"; } ?>
									</li>
								</ul>
							</section>
						</div>
					</div>
				</div>

				<p class="close" title="Close"></p>
			</div>

			<div class="p-2">
				<div class="heading">
					<h2>
						Hotel Christiansminde
					</h2>
				</div>
				<div class="content">
					<div class="grid col-50-50">
						<div>
							<section>
								<?php
									if($lang == 'de'){
										echo '<h3>Beschreibung</h3>';
										echo '<p>Mit dem Hotel Christiansminde als Basis haben Sie Zugang zu Zahllose Tauchererlebnisse im Südfünischen Inselmeer. Das Hotel liegt am Svendborg Sund – und sie können direkt vom Strand aus tauchen oder vom Bootsanleger aus einen „Giant Stride“ machen. Das Hotel bietet 98 großen Zimmern, alle mit eigenes Balkon oder Terrasse – und auch eigenes Eingang.
										</p><p>
Nach den Tauchgängen können Sie ein kaltes Bier oder leckeres Mittagessen in die Panoramarestaurant genießen – und Sie können auch Billard, Tischtennis oder Darts spielen oder die Fitnessraum benutzen. Es besteht natürlich auch Möglichkeiten für Reinigung und Trocknung Ihrer Ausrüstung.
</p><p>
Die idyllischen Zentren vom Stadt Svendborg finden Sie nach einem kurzen Spaziergang an der Küste, oder Sie können einer von unseren Fahrrädern gratis benutzen.
</p>';
									}elseif($lang == 'da'){
										echo '<h3>Beskrivelse</h3>';
										echo '<p>Med Hotel Christiansminde som base får du adgang til et utal af dykkeroplevelser i det Sydfynske Øhav. Hotellet er beliggende ned til Svendborg Sund, - hvor du vil kunne dykke direkte fra stranden eller tage ”the Giant Stride from the jetty”. Hotellet tilbyder 98 rummelige værelser og lejligheder, alle med egen balkon eller terrasse - og med egen indgang.
</p><p>
Efter et godt dyk vil du kunne nyde en kold øl eller en lækker middag i panorama restauranten, - såvel som I vil kunne benytte jer af hotellets billard, bordtennis, dart eller fitness faciliteter. Der vil naturligvis også være mulighed for at få rengjort eller tørret jeres dykkerudstyr.
</p><p>
Svendborgs hyggelige midtby finder I efter en rask vandretur langs vandet, eller I kan benytte jer af vore gratis cykler.
</p>';
									}else {
										echo '<h3>Description</h3>';
										echo '<p>With Hotel Christiansminde as your base you’ll have access to diving experiences beyond count in the South Funen Archipelago. The hotel is situated by Svendborg Sound where you can dive directly from the beach or take “the Giant Stride” from the jetty. The hotel offers 98 spacious rooms and apartments – all with their own terrace or balcony – and own entrance.
</p><p>
After a dive you can enjoy a cold beer or a delicious dinner in the panorama restaurant – as well as make use of the hotel’s pool table, table tennis or fitness facilities. There will also be options for drying and storing your gear.
</p><p>
You will find the cozy city center of Svendborg after a quick stroll along the coast, or you can make use of one of our free bikes.
</p>';
									}
								?>
							</section>
						</div>
						<div>
							<section>
								<?php
									if($lang == 'de'){
										echo '<h3>Kontakt</h3>';
									}elseif($lang == 'da'){
										echo '<h3>Kontakt</h3>';
									}else {
										echo '<h3>Contact</h3>';
									}
								?>
								<ul class="details-list">
									<li>
										<strong><?php if($lang == "en"){ echo "Name:"; }elseif($lang == "de"){ echo "Name:"; }elseif($lang == "da"){ echo "Navn:"; }else{ echo "Name:"; } ?>&nbsp;&nbsp;</strong>
										Hotel Christiansminde
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "Address:"; }elseif($lang == "de"){ echo "Adresse:"; }elseif($lang == "da"){ echo "Adresse"; }else{ echo "Address:"; } ?>&nbsp;&nbsp;</strong>
										Christiansmindevej 16
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "City:"; }elseif($lang == "de"){ echo "Stadt:"; }elseif($lang == "da"){ echo "By:"; }else{ echo "City:"; } ?>&nbsp;&nbsp;</strong>
										5700 Svendborg
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "Phone:"; }elseif($lang == "de"){ echo "Telefonnummer:"; }elseif($lang == "da"){ echo "Tlf.:"; }else{ echo "Phone:"; } ?>&nbsp;&nbsp;</strong>
										+45 62 21 90 00
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "E-mail:"; }elseif($lang == "de"){ echo "E-mail-Adresse:"; }elseif($lang == "da"){ echo "E-mail:"; }else{ echo "E-mail:"; } ?>&nbsp;&nbsp;</strong>
										<a href="mailto:booking@christiansminde.dk">booking@christiansminde.dk</a>
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "Website:"; }elseif($lang == "de"){ echo "Link:"; }elseif($lang == "da"){ echo "Hjemmeside:"; }else{ echo "Website:"; } ?>&nbsp;&nbsp;</strong>
										<a href="http://christiansminde.dk" target="_blank">christiansminde.dk</a>
									</li>
								</ul>
							</section>
						</div>
					</div>
					<div class="grid col-50-50">
						<div>
							<section>
								<div class="img-gallery">
									<?php
										if($lang == "en"){
											echo "<h3>Image Gallery</h3>";
										}elseif($lang == "de"){
											echo "<h3>Fotogalerie</h3>";
										}elseif($lang == 'da'){
											echo "<h3>Billedgalleri</h3>";
										}else {
											echo "<h3>Image Gallery</h3>";
										}
									?>
									<div>
										<a class="fancybox" rel="christiansminde" href="/map/Resources/img/acc/christiansminde.jpg">
											<img src="/map/Resources/img/acc/christiansminde.jpg" alt="Luftfoto af Hotel Christiansminde">
										</a>
									</div>
									<div>
										<a class="fancybox" rel="christiansminde" href="/map/Resources/img/acc/thur.jpg">
											<img src="/map/Resources/img/acc/thur.jpg" alt="Luftfoto af Hotel Christiansminde">
										</a>
									</div>
								</div>
							</section>
						</div>
						<div>
							<section>
								<?php
									if($lang == "en"){
										echo "<h3>Facilities</h3>";
									}elseif($lang == "de"){
										echo "<h3>Fazilitäten</h3>";
									}elseif($lang == 'da'){
										echo "<h3>Faciliteter</h3>";
									}else {
										echo "<h3>Facilities</h3>";
									}
								?>
								<ul class="details-list">
									<li>
										<img width="20" height="16" src="Resources/ui/icon-check.png">&nbsp;
										<?php if($lang == "en"){ echo "Wifi"; }elseif($lang == "de"){ echo "Wifi"; }elseif($lang == "da"){ echo "Wifi"; }else{ echo "Wifi"; } ?>
									</li>
								</ul>
								<?php
									if($lang == "en"){
										echo "<h3>For Divers</h3>";
									}elseif($lang == "de"){
										echo "<h3>Für die Tauchern</h3>";
									}elseif($lang == 'da'){
										echo "<h3>For dykkere</h3>";
									}else {
										echo "<h3>For Divers</h3>";
									}
								?>
								<ul class="details-list">
									<li>
										<img width="20" height="16" src="Resources/ui/icon-check.png">&nbsp;
										<?php if($lang == "en"){ echo "Compressor"; }elseif($lang == "de"){ echo "Kompressor"; }elseif($lang == "da"){ echo "Kompressor"; }else{ echo "Compressor"; } ?>
									</li>
								</ul>
							</section>
						</div>
					</div>
				</div>

				<p class="close" title="Close"></p>
			</div>

			<div class="p-3">
				<div class="heading">
					<h2>
						Svendborg Sund Camping
					</h2>
				</div>
				<div class="content">
					<div class="grid col-50-50">
						<div>
							<section>
								<?php
									if($lang == 'de'){
										echo '<h3>Beschreibung</h3>';
										echo '<p>Umgeben von schöner Natur in der Nähe von Wald und Strand und direkt am Südfünischen Inselmeer gelegen.</p>
<p>Unterkunft in einer Luxushütte mit allen Annehmlichkeiten.</p>';
									}elseif($lang == 'da'){
										echo '<h3>Beskrivelse</h3>';
										echo '<p>Svendborg Sund Camping befinder sig i skønne omgivelser nær ved skov og strand - og lige ved det Sydfynske Øhav.</p><p>Indkvartering sker i deluxe hytter.</p>';
									}else {
										echo '<h3>Description</h3>';
										echo '<p>Set in delightful surroundings close to woods and the beach – and right next to the South Funen Archipelago.
Accommodation in deluxe cabins with a full range of conveniences.</p>';
									}
								?>
							</section>
						</div>
						<div>
							<section>
								<?php
									if($lang == 'de'){
										echo '<h3>Kontakt</h3>';
									}elseif($lang == 'da'){
										echo '<h3>Kontakt</h3>';
									}else {
										echo '<h3>Contact</h3>';
									}
								?>
								<ul class="details-list">
									<li>
										<strong><?php if($lang == "en"){ echo "Name:"; }elseif($lang == "de"){ echo "Name:"; }elseif($lang == "da"){ echo "Navn:"; }else{ echo "Name:"; } ?>&nbsp;&nbsp;</strong>
										Svendborg Sund Camping
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "Address:"; }elseif($lang == "de"){ echo "Adresse:"; }elseif($lang == "da"){ echo "Adresse"; }else{ echo "Address:"; } ?>&nbsp;&nbsp;</strong>
										Vindebyørevej 52
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "City:"; }elseif($lang == "de"){ echo "Stadt:"; }elseif($lang == "da"){ echo "By:"; }else{ echo "City:"; } ?>&nbsp;&nbsp;</strong>
										5700 Svendborg
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "Phone:"; }elseif($lang == "de"){ echo "Telefonnummer:"; }elseif($lang == "da"){ echo "Tlf.:"; }else{ echo "Phone:"; } ?>&nbsp;&nbsp;</strong>
										+45 21 72 09 13
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "E-mail:"; }elseif($lang == "de"){ echo "E-mail-Adresse:"; }elseif($lang == "da"){ echo "E-mail:"; }else{ echo "E-mail:"; } ?>&nbsp;&nbsp;</strong>
										<a href="mailto:maria@svendborgsund-camping.dk">maria@svendborgsund-camping.dk</a>
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "Website:"; }elseif($lang == "de"){ echo "Link:"; }elseif($lang == "da"){ echo "Hjemmeside:"; }else{ echo "Website:"; } ?>&nbsp;&nbsp;</strong>
										<a href="http://svendborgsund-camping.dk" target="_blank">svendborgsund-camping.dk</a>
									</li>
								</ul>
							</section>
						</div>
					</div>
					<div class="grid col-50-50">
						<div>
							<section>
								<div class="img-gallery">
									<?php
										if($lang == "en"){
											echo "<h3>Image Gallery</h3>";
										}elseif($lang == "de"){
											echo "<h3>Fotogalerie</h3>";
										}elseif($lang == 'da'){
											echo "<h3>Billedgalleri</h3>";
										}else {
											echo "<h3>Image Gallery</h3>";
										}
									?>
									<div>
										<a class="fancybox" rel="svendborg-sund" href="/map/Resources/img/acc/svendborg-sund-camping.jpg">
											<img src="/map/Resources/img/acc/svendborg-sund-camping.jpg" alt="Svendborg Sund Camping">
										</a>
									</div>
									<div>
										<a class="fancybox" rel="svendborg-sund" href="/map/Resources/img/acc/svendborg.jpg">
											<img src="/map/Resources/img/acc/svendborg.jpg" alt="Luftfoto af Svendborg Sund Camping">
										</a>
									</div>
									<div>
										<a class="fancybox" rel="svendborg-sund" href="/map/Resources/img/acc/svendborg-sund-luftfoto.jpg">
											<img src="/map/Resources/img/acc/svendborg-sund-luftfoto.jpg" alt="Luftfoto af Svendborg Sund Camping">
										</a>
									</div>
								</div>
							</section>
						</div>
						<div>
							<section>
								<?php
									if($lang == "en"){
										echo "<h3>Facilities</h3>";
									}elseif($lang == "de"){
										echo "<h3>Fazilitäten</h3>";
									}elseif($lang == 'da'){
										echo "<h3>Faciliteter</h3>";
									}else {
										echo "<h3>Facilities</h3>";
									}
								?>
								<ul class="details-list">
									<li>
										<img width="20" height="16" src="Resources/ui/icon-check.png">&nbsp;
										<?php if($lang == "en"){ echo "Wifi"; }elseif($lang == "de"){ echo "Wifi"; }elseif($lang == "da"){ echo "Wifi"; }else{ echo "Wifi"; } ?>
									</li>
								</ul>
								<?php
									if($lang == "en"){
										echo "<h3>For Divers</h3>";
									}elseif($lang == "de"){
										echo "<h3>Für die Tauchern</h3>";
									}elseif($lang == 'da'){
										echo "<h3>For dykkere</h3>";
									}else {
										echo "<h3>For Divers</h3>";
									}
								?>
								<ul class="details-list">
									<li>
										<img width="20" height="16" src="Resources/ui/icon-check.png">&nbsp;
										<?php if($lang == "en"){ echo "Compressor"; }elseif($lang == "de"){ echo "Kompressor"; }elseif($lang == "da"){ echo "Kompressor"; }else{ echo "Compressor"; } ?>
									</li>
								</ul>
							</section>
						</div>
					</div>
				</div>

				<p class="close" title="Close"></p>
			</div>

			<div class="p-4">
				<div class="heading">
					<h2>
						Syltemae Camping
					</h2>
				</div>
				<div class="content">
					<div class="grid col-50-50">
						<div>
							<section>
								<?php
									if($lang == 'de'){
										echo '<h3>Beschreibung</h3>';
										echo '<p>Mit seiner einzigartigen Lage in der Nähe von Dänemarks neuester Tauchattraktion, M/F Ærøsund, bietet Syltemae Camping den perfekten Ausgangspunkt für ein Wochenende nahe am Wasser.
</p>';
									}elseif($lang == 'da'){
										echo '<h3>Beskrivelse</h3>';
										echo '<p>Placeret lige ved siden af Danmarks nyeste dykker-attraktion, vraget af M/F Ærøsund - er Syltemae Camping det perfekte udgangspunkt for en weekend ved havet.</p>';
									}else {
										echo '<h3>Description</h3>';
										echo '<p>Situated right by Denmark’s most recent diving attraction – the wreck of the M/F Ærøsund – Syltemae Camping offers the perfect setting for a weekend spent by the coast.</p>';
									}
								?>
							</section>
						</div>
						<div>
							<section>
								<?php
									if($lang == 'de'){
										echo '<h3>Kontakt</h3>';
									}elseif($lang == 'da'){
										echo '<h3>Kontakt</h3>';
									}else {
										echo '<h3>Contact</h3>';
									}
								?>
								<ul class="details-list">
									<li>
										<strong><?php if($lang == "en"){ echo "Name:"; }elseif($lang == "de"){ echo "Name:"; }elseif($lang == "da"){ echo "Navn:"; }else{ echo "Name:"; } ?>&nbsp;&nbsp;</strong>
										Syltemae Camping
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "Address:"; }elseif($lang == "de"){ echo "Adresse:"; }elseif($lang == "da"){ echo "Adresse"; }else{ echo "Address:"; } ?>&nbsp;&nbsp;</strong>
										Strandgårdsvej 13
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "City:"; }elseif($lang == "de"){ echo "Stadt:"; }elseif($lang == "da"){ echo "By:"; }else{ echo "City:"; } ?>&nbsp;&nbsp;</strong>
										5762 Vester Skerninge
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "Phone:"; }elseif($lang == "de"){ echo "Telefonnummer:"; }elseif($lang == "da"){ echo "Tlf.:"; }else{ echo "Phone:"; } ?>&nbsp;&nbsp;</strong>
										+45 53 54 45 05
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "E-mail:"; }elseif($lang == "de"){ echo "E-mail-Adresse:"; }elseif($lang == "da"){ echo "E-mail:"; }else{ echo "E-mail:"; } ?>&nbsp;&nbsp;</strong>
										<a href="mailto:syltemaecamping@gmail.com">syltemaecamping@gmail.com</a>
									</li>
									<li>
										<strong><?php if($lang == "en"){ echo "Website:"; }elseif($lang == "de"){ echo "Link:"; }elseif($lang == "da"){ echo "Hjemmeside:"; }else{ echo "Website:"; } ?>&nbsp;&nbsp;</strong>
										<a href="http://syltemae-camping.dk" target="_blank">syltemae-camping.dk</a>
									</li>
								</ul>
							</section>
						</div>
					</div>
					<div class="grid col-50-50">
						<div>
							<section>
								<div class="img-gallery">
									<?php
										if($lang == "en"){
											echo "<h3>Image Gallery</h3>";
										}elseif($lang == "de"){
											echo "<h3>Fotogalerie</h3>";
										}elseif($lang == 'da'){
											echo "<h3>Billedgalleri</h3>";
										}else {
											echo "<h3>Image Gallery</h3>";
										}
									?>
									<div>
										<a class="fancybox" rel="syltemae" href="/map/Resources/img/acc/s1.jpg">
											<img src="/map/Resources/img/acc/s1.jpg" alt="Syltemae Camping">
										</a>
									</div>
									<div>
										<a class="fancybox" rel="syltemae" href="/map/Resources/img/acc/s2.jpg">
											<img src="/map/Resources/img/acc/s2.jpg" alt="Syltemae Camping">
										</a>
									</div>
									<div>
										<a class="fancybox" rel="syltemae" href="/map/Resources/img/acc/s3.jpg">
											<img src="/map/Resources/img/acc/s3.jpg" alt="Syltemae Camping">
										</a>
									</div>
									<div>
										<a class="fancybox" rel="syltemae" href="/map/Resources/img/acc/s4.jpg">
											<img src="/map/Resources/img/acc/s4.jpg" alt="Syltemae Camping">
										</a>
									</div>
									<div>
										<a class="fancybox" rel="syltemae" href="/map/Resources/img/acc/s5.jpg">
											<img src="/map/Resources/img/acc/s5.jpg" alt="Syltemae Camping">
										</a>
									</div>
								</div>
							</section>
						</div>
						<div>
							<section>
								<?php
									if($lang == "en"){
										echo "<h3>Facilities</h3>";
									}elseif($lang == "de"){
										echo "<h3>Fazilitäten</h3>";
									}elseif($lang == 'da'){
										echo "<h3>Faciliteter</h3>";
									}else {
										echo "<h3>Facilities</h3>";
									}
								?>
								<ul class="details-list">
									<li>
										<img width="20" height="16" src="Resources/ui/icon-check.png">&nbsp;
										<?php if($lang == "en"){ echo "Wifi"; }elseif($lang == "de"){ echo "Wifi"; }elseif($lang == "da"){ echo "Wifi"; }else{ echo "Wifi"; } ?>
									</li>
								</ul>
								<?php
									if($lang == "en"){
										echo "<h3>For Divers</h3>";
									}elseif($lang == "de"){
										echo "<h3>Für die Tauchern</h3>";
									}elseif($lang == 'da'){
										echo "<h3>For dykkere</h3>";
									}else {
										echo "<h3>For Divers</h3>";
									}
								?>
								<ul class="details-list">
									<li>
										<img width="20" height="16" src="Resources/ui/icon-check.png">&nbsp;
										<?php if($lang == "en"){ echo "Compressor"; }elseif($lang == "de"){ echo "Kompressor"; }elseif($lang == "da"){ echo "Kompressor"; }else{ echo "Compressor"; } ?>
									</li>
								</ul>
							</section>
						</div>
					</div>
				</div>

				<p class="close" title="Close"></p>
			</div>
		</div>

		<!-- Control icons -->
		<div class="controls">
			<button id="zoom-in"> Zoom</button>
			<button id="zoom-out"> Zoom</button>
			<button id="reset">Reset</button>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> <!-- jQuery -->

		<script src="Resources/js/fancybox/jquery.fancybox.pack.js"></script> <!-- Fancybox -->

		<script src="svgpan.js"></script> <!-- https://github.com/ariutta/svg-pan-zoom -->
		<script src="hammer.js"></script> <!-- Touch support -->
		
		<!-- CUSTOM JAVASCRIPT -->
		<script src="script.js"></script>
		<script src="Resources/js/filter-tags.js"></script>
		<script>

			// Get URL and hash
			var url = window.location.href;
			var hash = window.location.hash;
			var hashCleaned = window.location.hash.replace("#", "");

			if(hashCleaned.length <= 2){
				var infobox = true;
			}

			if(infobox){
				$.ajax({
					type: 'POST',
					url: 'code/getModal.php?id=' + hashCleaned + '&lang=<?php if($_POST['langDa']){ echo 'da'; }elseif($_POST['langDe']){ echo 'de'; }else{ echo 'en'; } ?>',
					success: function(data) {
						$('body').css({'height':'100vh', 'overflow-y':'hidden'});
						$('.modals').removeClass('fadeOut');
						$('.modals').addClass('fadeIn');

						$(".modals").append(data);
					}
				});
			}

			// Indsæt modal med AJAX ved klik på cirkler
			$('g[id^="c-"]').on("click", function(){
				var thisModal = this.id;
				var theModal = thisModal.substring(2);

				$.ajax({
					type: 'POST',
					url: 'code/getModal.php?id=' + theModal + '&lang=<?php if($_POST['langDa']){ echo 'da'; }elseif($_POST['langDe']){ echo 'de'; }else{ echo 'en'; } ?>',
					success: function(data) {
						$('body').css({'height':'100vh', 'overflow-y':'hidden'});
						$('.modals').removeClass('fadeOut');
						$('.modals').addClass('fadeIn');

						$(".modals").append(data);
					}
				});
			});


			// Udskift teksten på filtrerings-knapper til tysk hvis sprog-variablen angiver det
			var showAll = $('#buttons button.showAll');
			var wreck = $('#buttons button.Wreck');
			var scenic = $('#buttons button.Scenic');
			var hunt = $('#buttons button.UW-Hunting');

			var txt1 = showAll.text();
			var txt2 = wreck.text();
			var txt3 = scenic.text();
			var txt4 = hunt.text();

			<?php
			 if(isset($_POST['langDe'])){
			?>

			txt1 == showAll.text('Alle Tauchstellen');
			txt2 == wreck.text('Wrack (9)');
			txt3 == scenic.text('Natur (16)');
			txt4 == hunt.text('UW-Jagd (6)');

			<?php
			 }elseif(isset($_POST['langDa'])){
			?>

			txt1 == showAll.text('Alle dive spots');
			txt2 == wreck.text('Vrag (9)');
			txt3 == scenic.text('Natur (16)');
			txt4 == hunt.text('UV-jagt (6)');

			<?php
			 }
			?>

		</script>
	</body>
</html>
