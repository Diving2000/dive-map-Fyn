<?php

  $id = $objConnection->real_escape_string($_GET['id']);

  $sql = "SELECT * FROM drf_map_junction WHERE id = $id";
  $result = $objConnection->query($sql);
  while($row = $result->fetch_object()){
    $title = $row->ref_title;
  }

  if(isset($_POST['submit'])){
    
    // opret variabler baseret på POST-data
    $junction_id = $id;
    
    $type_id = $_POST['type_id'];
    
    $text_id = $_POST['text_id'];
    $dText = $_POST['text_id'];
    
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
    
    // Opret NTK på engelsk
    $enSql = "
      INSERT INTO drf_map_ntk (id, text_id, lang_id, junction_id, type_id) VALUES ('', $eText, 1, $junction_id, $type_id)
    ";
    $objConnection->query($enSql);
    
    // Opret NTK på tysk
    $deSql = "
     INSERT INTO drf_map_ntk (id, text_id, lang_id, junction_id, type_id) VALUES ('', $gText, 2, $junction_id, $type_id)
    ";
    $objConnection->query($deSql);
    
    // Opret NTK på dansk
    $daSql = "
       INSERT INTO drf_map_ntk (id, text_id, lang_id, junction_id, type_id) VALUES ('', $text_id, 3, $junction_id, $type_id)
    ";
    $objConnection->query($daSql);
      
    // feedback
		echo '<div class="modal"><p>Sektionen blev tilføjet.</p></div>';
    echo '<meta http-equiv="refresh" content="3;url=index.php?page=ntk&id=' . $id . '" />';
	}
?>
<div class="page content">
	<h1>
		Tilføj 'nyttig viden'-sektion til dive spot '<?php echo $title; ?>'
	</h1>
  <main>
    <form action="" method="post">
      <div class="form-row">
        <label for="text_id">Beskrivelse</label>
        <select name="text_id">
          <?php
            $sql = "SELECT * FROM drf_map_ntk_text WHERE lang_id = 3";
            $result = $objConnection->query($sql);
            while($row = $result->fetch_object()){
              echo '<option value="' . $row->id . '">' . $row->explanation . '</option>';
            }
          ?>
        </select>
      </div>
      <div class="form-row">
        <label for="type_id">Type</label>
        <select name="type_id">
          <option value="1">Anbefaling</option>
          <option value="2">Bemærkning</option>
          <option value="3">Advarsel</option>
        </select>
      </div>
			
			<div class="form-row">
				<input type="submit" name="submit" value="Tilføj">
			</div>
    </form>
    
  </main>
  
</div>