<?php
  if(isset($_POST['submit'])){
		$val = new Validator($objConnection);
		
		$errors = array();
		
		$required_fields = array('ref_title', 'coords', 'depth', 'difficulty');
		if($val->checkRequired($required_fields)){
			$errors['required'] = '<p class="error">Udfyld venligst felterne: Vejl. titel, Koordinater, Dybde og Sværhedsgrad!</p>';
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
      
			
      // Opret junction
      // - ref_title, depth, difficulty
			$junctionSql = "
				INSERT INTO drf_map_junction (id, ref_title, difficulty, depth) VALUES ('', '{$ref_title}', '{$difficulty}', '{$depth}')
			";
			$objConnection->query($junctionSql);
      
      // GET junction id
			$getJunctionSql = "SELECT id FROM drf_map_junction ORDER BY id DESC LIMIT 1";
			$getJunctionResult = $objConnection->query($getJunctionSql);
			while($jRow = $getJunctionResult->fetch_object()){ $id = $jRow->id; }
      
      // Opret coords
      // - coords, junction_id
			$coordsSql = "
				INSERT INTO drf_map_coords (id, coords, junction_id) VALUES ('', '{$coords}', '{$id}')
			";
			$objConnection->query($coordsSql);
      
      // Opret locations (engelsk - lang_id == 1, tysk - lang_id == 2)
      // junction_id, title, longDesc, lang_id (hardcoded) * 3
      $germanLocSql = "
				INSERT INTO drf_map_location (id, title, longDesc, lang_id, junction_id) VALUES ('', '{$germanTitle}', '{$germanText}', '2', '{$id}')
			";
			$objConnection->query($germanLocSql);
			
			$englishLocSql = "
				INSERT INTO drf_map_location (id, title, longDesc, lang_id, junction_id) VALUES ('', '{$englishTitle}', '{$englishText}', '1', '{$id}')
			";
			$objConnection->query($englishLocSql);
			
			$danishLocSql = "
				INSERT INTO drf_map_location (id, title, longDesc, lang_id, junction_id) VALUES ('', '{$danishTitle}', '{$danishText}', '3', '{$id}')
			";
			$objConnection->query($danishLocSql);

			echo '<div class="modal"><p>Destinationen blev tilføjet.</p></div>';
			echo '<meta http-equiv="refresh" content="3;url=index.php?page=home" />';
		}else {
			echo '<div class="modal modal-error"><p>Der opstod en fejl. <br> Prøv igen.</p></div>';
		}
  }
?>
<div class="page content">
	<h1>
		Tilføj dive spot
	</h1>
  <main>
    <?php 
			echo $errors['required'];
		?>
    <form action="" method="post">
      <div class="form-row">
				<label for="ref_title">Overskrift *</label>
				<input type="text" name="ref_title" required value="<?php echo $_POST['ref_title']; ?>">
			</div>
			<div class="form-row">
				<label for="coords">Koordinater *</label>
				<input type="text" name="coords" required value="<?php echo $_POST['coords']; ?>">
			</div>
			<div class="form-row">
				<label for="depth">Dybde *</label>
				<input type="text" name="depth" required value="<?php echo $_POST['depth']; ?>">
			</div>
			<div class="form-row">
				<label for="difficulty">Sværhedsgrad *</label>
				<input type="text" name="difficulty" required value="<?php echo $_POST['difficulty']; ?>">
			</div>
			
			<fieldset class="languageFields">
				
				<legend>
					Engelsk Indhold
				</legend>
				<div class="form-row">
					<label for="englishTitle">Engelsk navn *</label>
					<input type="text" name="englishTitle" required value="<?php echo $_POST['englishTitle']; ?>">
				</div>
				<div class="form-row">
					<label for="englishText">Engelsk beskrivelse</label>
					<textarea id="englishText" name="englishText"><?php echo $_POST['englishText']; ?></textarea>
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
					<input type="text" name="germanTitle" required value="<?php echo $_POST['germanTitle']; ?>">
				</div>
				<div class="form-row">
					<label for="germanText">Tysk beskrivelse</label>
					<textarea id="germanText" name="germanText"><?php echo $_POST['germanText']; ?></textarea>
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
					<input type="text" name="danishTitle" required value="<?php echo $_POST['danishTitle']; ?>">
				</div>
				<div class="form-row">
					<label for="danishText">Dansk beskrivelse</label>
					<textarea id="danishText" name="danishText"><?php echo $_POST['danishText']; ?></textarea>
					<script>
          	CKEDITOR.replace( 'danishText' );
        	</script>
				</div>
			</fieldset>
			
			<div class="form-row">
				<input type="submit" name="submit" value="Tilføj">
			</div>
    </form>
    
  </main>
  
</div>