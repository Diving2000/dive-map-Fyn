<?php

require_once('../includes/config.php');
require_once('../includes/dbConn.php');

// GET ID 
$id = $_GET['id'];
$lang = $_GET['lang'];

if($lang == 'en'){
  $lang_id = 1;
}elseif($lang == 'de'){
  $lang_id = 2;
}elseif($lang == 'da'){
	$lang_id = 3;
}else {
  $lang_id = 1;
}

echo $lang_id;

$generalSql = "
  SELECT * FROM drf_map_junction
  WHERE id = $id
";
$generalResult = $objConnection->query($generalSql);
while($gRow = $generalResult->fetch_object()){
  $ref_title = $gRow->ref_title;
  $depth = $gRow->depth;
  $difficulty = $gRow->difficulty;
}


// SELECT AND ECHO ALL RELEVANT DATA incl. HTML-STRUCTURE
echo '<div data-id="' . $id . '" class="modal c-' . $id . '">';

$langSql = "
  SELECT * FROM drf_map_location
  WHERE junction_id = $id AND lang_id = '{$lang_id}'
";
$langResult = $objConnection->query($langSql);

if($langResult->num_rows != 0){
	while($lRow = $langResult->fetch_object()){
		echo '<div class="heading">';
		echo '<h2>';
		echo $lRow->title;
		echo '</h2>';
		echo '</div>';

		echo '<div class="content">';
		echo '<div class="grid col-50-50">';
		echo '<div>';
		echo '<section>';

		if($lang == 'de'){
			echo '<h3>Der Tauchplatz</h3>';
		}elseif($lang == 'da'){
			echo '<h3>Om dette dive spot</h3>';
		}else {
			echo '<h3>The Dive Spot</h3>';
		}
		echo $lRow->longDesc;

	echo '</section>';
	echo '</div>';

	}
}else {
	echo '<div class="heading">';
  echo '<h2>';
  echo 'Overskrift';
  echo '</h2>';
  echo '</div>';

  echo '<div class="content">';
  echo '<div class="grid col-50-50">';
  echo '<div>';
  echo '<section>';

  if($lang == 'de'){
    echo '<h3>Der Tauchplatz</h3>';
  }elseif($lang == 'da'){
		echo '<h3>Om Dykkerspottet</h3>';
	}else {
    echo '<h3>The Dive Spot</h3>';
  }
								
	echo '</section>';
	echo '</div>';
}

echo '<div>';
echo '<section>';

if($lang == 'en'){
	echo "<h3>Practical Information</h3>";
}elseif($lang == 'de'){
	echo "<h3>Praktische Informationen</h3>";
}elseif($lang == 'da'){
	echo "<h3>Praktisk Information</h3>";
}else {
	echo "<h3>Practical Information</h3>";
}

echo '<ul class="details-list">';

$coordsSql = "
  SELECT * FROM drf_map_coords
  WHERE junction_id = $id
";
$coordsResult = $objConnection->query($coordsSql);
while($cRow = $coordsResult->fetch_object()){
  echo '<li>';
	echo '<img width="18" height="20" src="Resources/ui/icon-marker.png">' . $cRow->coords ;
	echo '</li>';
}
									
echo '<li>';
  echo '<img width="20" height="20" src="Resources/ui/icon-arrow.png">' . $depth;
	if($lang == 'en'){
    echo " metres";
  }elseif($lang == 'de'){
    echo " Metern";
  }elseif($lang == 'da'){
		echo " meter";
	}else {
    echo " metres";
  }
echo '</li>';
echo '<li>';
  echo '<img width="16" height="16" src="Resources/ui/icon-difficulty.png">' . $difficulty;
echo '</li>';
echo '</ul>';

$ntkSql = "
  SELECT * FROM drf_map_ntk 
  INNER JOIN drf_map_ntk_text ON (drf_map_ntk.text_id = drf_map_ntk_text.id)
  WHERE junction_id = $id AND drf_map_ntk_text.lang_id = '{$lang_id}'
";
$ntkResult = $objConnection->query($ntkSql);

if($ntkResult->num_rows != 0){
  
  if($lang == 'en'){
    echo "<h3>Nice to Know</h3>";
  }elseif($lang == 'de'){
    echo "<h3>Gut zu wissen</h3>";
  }elseif($lang == 'da'){
		echo "<h3>Nyttig viden</h3>";
	}else {
    echo "<h3>Nice to Know</h3>";
  }
  echo '<ul class="details-list">';

  while($ntkRow = $ntkResult->fetch_object()){

    echo '<li>';
    if($ntkRow->type_id == 1){
      echo '<img width="20" height="16" src="Resources/ui/icon-check.png">';
    }elseif($ntkRow->type_id == 2){
			echo '<img width="20" height="16" src="Resources/ui/icon-notice.png">';
		}else {
      echo '<img width="20" height="16" src="Resources/ui/icon-warning.png">';
    }
    echo $ntkRow->explanation;
    echo '</li>';

  }

  echo '</ul>';
}

echo '</section>';
echo '</div>';
echo '</div>';

echo '<div class="grid col-50-50">';
echo '<div>';
echo '<section>';

echo '<div class="img-gallery">';

$imageSql = "
  SELECT * FROM drf_map_images
  WHERE junction_id = $id
";
$imageResult = $objConnection->query($imageSql);

if($imageResult->num_rows != 0){
  if($lang == "en"){
		echo "<h3>Image Gallery</h3>";
	}elseif($lang == "de"){
		echo "<h3>Fotogalerie</h3>";
	}elseif($lang == 'da'){
		echo "<h3>Billedgalleri</h3>";
	}else {
		echo "<h3>Image Gallery</h3>";
	}
  
  while($imgRow = $imageResult->fetch_object()){
    echo '<div>';
    echo '<a class="fancybox" rel="' . $ref_title . '" href="' . $imgRow->image . '">';
    echo '<img src="' . $imgRow->image . '" alt="' . $imgRow->alt_text . '">';
    echo '</a>';
    echo '</div>';
  }
  
}else {
  if($lang == 'en'){
	  echo "<h3>There aren't any images of this dive spot yet.</h3>";
  }elseif($lang == 'de'){
    echo "<h3>Es gibt noch nicht Fotos von diese Tauchplatz.</h3>";
  }elseif($lang == 'da'){
		echo "<h3>Der er endnu ikke tilføjet billeder af dette dive spot.</h3>";
	}else {
    echo "<h3>There aren't any images of this dive spot yet.</h3>";
  } 
}
echo '</div>';
echo '</section>';
echo '</div>';
echo '<div>';
echo '<section>';

$videoSql = "
  SELECT * FROM drf_map_videos
  WHERE junction_id = $id
";
$videoResult = $objConnection->query($videoSql);

if($videoResult->num_rows != 0){
  echo '<h3>Videos</h3>';
  
  while($videoRow = $videoResult->fetch_object()){
    echo '<div class="video-wrapper">';
    echo html_entity_decode($videoRow->video);
    echo '</div>';
  }
  
}else {
  if($lang == 'en'){
    echo "<h3>There aren't any videos of this dive spot yet.</h3>";
  }elseif($lang == 'de'){
    echo "<h3>Es gibt noch nicht Videos von diese Tauchplatz.</h3>";
  }elseif($lang == 'da'){
		echo "<h3>Der er endnu ikke tilføjet videoer af dette dive spot.</h3>";
	}else {
    echo "<h3>There aren't any videos of this dive spot yet.</h3>";
  } 
}
echo '</section>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';

$_POST = array();