<?php

  	$id = $objConnection->real_escape_string($_GET['id']);
    $junction = $objConnection->real_escape_string($_GET['junction']);
    
    $dText = $objConnection->real_escape_string($_GET['version']);
    
    // find de tilsvarende engelske og tyske NTK
    switch ($dText) {
      case 13:
        $gText = 2;
        $eText = 1;
        break;
      case 14:
        $gText = 4;
        $eText = 3;
        break;
      case 15:
        $gText = 6;
        $eText = 5;
        break;
      case 16:
        $gText = 8;
        $eText = 7;
        break;
      case 17:
        $gText = 10;
        $eText = 9;
        break;
      case 18:
        $gText = 12;
        $eText = 11;
        break;
      default:
        $gText = '';
        $eText = '';
    }

  if(isset($_GET['id'])){
		if(!isset($_GET['confirm'])){
			$confirm = "Vil du slette sektionen?";
		}
		else {
      $eText = $objConnection->real_escape_string($_GET['eText']);
      $gText = $objConnection->real_escape_string($_GET['gText']);
      $dText = $objConnection->real_escape_string($_GET['dText']);
      
      
      // DELETE english
      $enSql = "
        DELETE FROM drf_map_ntk WHERE text_id = $eText AND junction_id = $junction
      ";
//       echo $enSql;
      $objConnection->query($enSql);
      
      // DELETE german
      $deSql = "
        DELETE FROM drf_map_ntk WHERE text_id = $gText AND junction_id = $junction
      ";
//       echo $deSql;
      $objConnection->query($deSql);
      
      // DELETE danish
      $daSql = "
        DELETE FROM drf_map_ntk WHERE text_id = $dText AND junction_id = $junction
      ";
//       echo $daSql;
      $objConnection->query($daSql);
			
			echo '<div class="modal"><p>Sektionen blev slettet.</p></div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php?page=home" />';
		}
  }

?>
<div class="page content">
	<h1>
		Slet sektion
	</h1>
	<div class="delete">
    <div class="button">
      <a href="index.php?page=ntk_delete&id=<?php echo $id; ?>&junction=<?php echo $junction; ?>&gText=<?php echo $gText; ?>&eText=<?php echo $eText; ?>&dText=<?php echo $dText; ?>&confirm=true">Ja</a>
    </div>
    <div class="button">
      <a href="index.php?page=home">Nej</a>
    </div>
	</div>
</div>