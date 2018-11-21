<?php

  $id = $objConnection->real_escape_string($_GET['id']);

	$refSql = "
	SELECT * FROM drf_map_junction WHERE id = $id
	";
	$refResult = $objConnection->query($refSql);

	while($row = $refResult->fetch_object()){
		$BFtitle = $row->ref_title;
		$BFdepth = $row->depth;
		$BFdifficulty = $row->difficulty;
	}

	$coordsSql = "
		SELECT * FROM drf_map_coords WHERE junction_id = $id 
	";
	$coordsResult = $objConnection->query($coordsSql);
	while($coordsRow = $coordsResult->fetch_object()){
		$BFcoords = $coordsRow->coords;
	}


	$germanSql = "
		SELECT * FROM drf_map_location WHERE junction_id = $id AND lang_id = 2
	";
	$germanResult = $objConnection->query($germanSql);
	while($germanRow = $germanResult->fetch_object()){
		$BFgTitle = $germanRow->title;
		$BFgText = $germanRow->longDesc;
	}


	$englishSql = "
		SELECT * FROM drf_map_location WHERE junction_id = $id AND lang_id = 1
	";
	$englishResult = $objConnection->query($englishSql);
	while($englishRow = $englishResult->fetch_object()){
		$BFeTitle = $englishRow->title;
		$BFeText = $englishRow->longDesc;
	}

	$danishSql = "
		SELECT * FROM drf_map_location WHERE junction_id = $id AND lang_id = 3
	";
	$danishResult = $objConnection->query($danishSql);
	while($danishRow = $danishResult->fetch_object()){
		$BFdTitle = $danishRow->title;
		$BFdText = $danishRow->longDesc;
	}


	if(isset($_POST['submit'])){
		$val = new Validator($objConnection);
		
		$errors = array();
		
		$required_fields = array('ref_title', 'depth', 'difficulty');
		if($val->checkRequired($required_fields)){
			$errors['required'] = '<p class="error">Udfyld venligst felterne: Vejl. titel, Dybde og Sværhedsgrad!</p>';
		}
		
		if(empty($errors)){
			
			$ref_title = $objConnection->real_escape_string($_POST['ref_title']);
			$depth = $objConnection->real_escape_string($_POST['depth']);
      $difficulty = $objConnection->real_escape_string($_POST['difficulty']);

			$coords = $objConnection->real_escape_string($_POST['coords']);
      
      $germanTitle = $objConnection->real_escape_string($_POST['germanTitle']);
      $germanText = $objConnection->real_escape_string($_POST['germanText']);
      
      $englishTitle = $objConnection->real_escape_string($_POST['englishTitle']);
      $englishText = $objConnection->real_escape_string($_POST['englishText']);
			
			$danishTitle = $objConnection->real_escape_string($_POST['danishTitle']);
      $danishText = $objConnection->real_escape_string($_POST['danishText']);
      
      
      // Rediger junction
      // - depth, difficulty WHERE junction_id = $id
			$ejSql = "
				UPDATE drf_map_junction SET ref_title = '{$ref_title}', depth = '{$depth}', difficulty = '{$difficulty}'
				WHERE id = $id
			";
			$objConnection->query($ejSql);
      
      // Rediger coords
			// - coords WHERE junction_id = $id
			if($id != 2){
				$ecSql = "
					UPDATE drf_map_coords SET coords = '{$coords}'
					WHERE junction_id = $id 
				";
				$objConnection->query($ecSql);
			}
      
      // Rediger localizations (engelsk - lang_id == 1, tysk - lang_id == 2) WHERE junction_id = $id AND lang_id == 1/2
      // title, longDesc * 3
			if($englishResult->num_rows != 0){
				$eeSql = "
					UPDATE drf_map_location SET title = '{$englishTitle}', longDesc = '{$englishText}'
					WHERE junction_id = $id AND lang_id = 1
				";
				$objConnection->query($eeSql);
			}else {
				$eeSql = "
					INSERT INTO drf_map_location (id, title, longDesc, lang_id, junction_id) VALUES ('', '{$englishTitle}', '{$englishText}', 1, $id)
				";
			}
			
			if($germanResult->num_rows != 0){
				$egSql = "
					UPDATE drf_map_location SET title = '{$germanTitle}', longDesc = '{$germanText}'
					WHERE junction_id = $id AND lang_id = 2
				";
				$objConnection->query($egSql);
			}else {
				$egSql = "
					INSERT INTO drf_map_location (id, title, longDesc, lang_id, junction_id) VALUES ('', '{$germanTitle}', '{$germanText}', 2, $id)
				";
				$objConnection->query($egSql);
			}
			
			if($danishResult->num_rows != 0){
				$edSql = "
					UPDATE drf_map_location SET title = '{$danishTitle}', longDesc = '{$danishText}'
					WHERE junction_id = $id AND lang_id = 3
				";
				$objConnection->query($edSql);
			}else {
				$edSql = "
					INSERT INTO drf_map_location (id, title, longDesc, lang_id, junction_id) VALUES ('', '{$danishTitle}', '{$danishText}', 3, $id)
				";
				$objConnection->query($edSql);
			}

			
			echo '<div class="modal"><p>Destinationen blev opdateret.</p></div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php?page=home" />';
		}else {
			echo '<div class="modal modal-error"><p>Der opstod en fejl. <br> Prøv igen.</p></div>';
		}
   }

?>
<div class="page content">
	<h1>
		Rediger dive spot '<?php echo $BFtitle; ?>'
	</h1>
	<main>
    <?php 
			echo $errors['required'];
		?>
    <form action="" method="post">
      <div class="form-row">
				<label for="ref_title">Overskrift *</label>
				<input type="text" name="ref_title" required value="<?php echo $BFtitle; ?>">
			</div>
			<?php if($id != 2){ ?>
			<div class="form-row">
				<label for="coords">Koordinater *</label>
				<input type="text" name="coords" required value="<?php echo $BFcoords; ?>">
			</div>
			<?php } ?>
			<div class="form-row">
				<label for="depth">Dybde *</label>
				<input type="text" name="depth" required value="<?php echo $BFdepth; ?>">
			</div>
			<div class="form-row">
				<label for="difficulty">Sværhedsgrad *</label>
				<input type="text" name="difficulty" required value="<?php echo $BFdifficulty; ?>">
			</div>
			
			<fieldset class="languageFields">
				
				<legend>
					Engelsk Indhold
				</legend>
				<div class="form-row">
					<label for="englishTitle">Engelsk navn *</label>
					<input type="text" name="englishTitle" required value="<?php echo $BFeTitle; ?>">
				</div>
				<div class="form-row">
					<label for="englishText">Engelsk beskrivelse</label>
					<textarea id="englishText" name="englishText"><?php echo $BFeText; ?></textarea>
					<script>
          	CKEDITOR.replace( 'englishText' );
          </script>
				</div>
			</fieldset>
			<fieldset class="languageFields">
				
				<legend>
					Tysk Indhold
				</legend>
				<div class="form-row">
					<label for="germanTitle">Tysk navn *</label>
					<input type="text" name="germanTitle" required value="<?php echo $BFgTitle; ?>">
				</div>
				<div class="form-row">
					<label for="germanText">Tysk beskrivelse</label>
					<textarea id="germanText" name="germanText"><?php echo $BFgText; ?></textarea>
					<script>
          	CKEDITOR.replace( 'germanText' );
        	</script>
				</div>
			</fieldset>
			
			<fieldset class="languageFields">
				
				<legend>
					Dansk Indhold
				</legend>
				<div class="form-row">
					<label for="danishTitle">Dansk navn *</label>
					<input type="text" name="danishTitle" required value="<?php echo $BFdTitle; ?>">
				</div>
				<div class="form-row">
					<label for="danishText">Dansk beskrivelse</label>
					<textarea id="danishText" name="danishText"><?php echo $BFdText; ?></textarea>
					<script>
          	CKEDITOR.replace( 'danishText' );
        	</script>
				</div>
			</fieldset>
			
			<div class="form-row">
				<input type="submit" name="submit" value="Opdater">
			</div>
    </form>
    
  </main>
  
</div>