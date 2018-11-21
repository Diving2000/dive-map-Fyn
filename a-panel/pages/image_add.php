<?php

  $id = $objConnection->real_escape_string($_GET['id']);

	if(isset($_POST['submit'])){
		$alt_text = $objConnection->real_escape_string($_POST['alt_text']);
			
		$time = time();
      
    $image_src = $time . "_" . $_FILES['image']['name'];
    $tempfile = $_FILES['image']['tmp_name'];
			
		$allowed_size = 1.5;
			
		$allowed_mime_types = array(
			"image/jpeg",	
			"image/gif",
			"image/png"
		);
			
		$size = $_FILES['image']['size'];
		$type = $_FILES['image']['type'];
			
		if($allowed_size < ($size / 1000000)){
			$errors['size'] = "<p class=\"error\">Filen må ikke være større end 1 MB.</p>";
		}
		if(!in_array($type, $allowed_mime_types)){
			$errors['type'] = "<p class=\"error\">Kun filtyperne JPG, GIF og PNG er tilladt.</p>";
		}
			
		if(empty($errors)){
		
			if(move_uploaded_file($tempfile, "../Resources/img/$image_src")){
				$image = "Resources/img/" . $image_src;

				$sql = "INSERT INTO drf_map_images (id, image, alt_text, junction_id) VALUES ('', '{$image}', '{$alt_text}', {$id})";
				$objConnection->query($sql);

         echo '<div class="modal"><p>Billedet blev uploadet.</p></div>';
		     echo '<meta http-equiv="refresh" content="3;url=index.php?page=home" />';

				}else {
					echo '<div class="modal modal-error"><p>Der skete en fejl ved upload. Prøv igen.</p></div>';
				}
			}
		}
?>
<div class="page content">
	<h1>
		Upload billede
	</h1>
	
	<main>
		<form action="" method="post" enctype="multipart/form-data">
			<?php 
				echo $notice; 
				echo $errors['size'];
				echo $errors['type'];
			?>
			<div class="form-row">
				<label for="image">Billede *</label>
				<input type="file" name="image" required>
			</div>
			<div class="form-row">
				<label for="alt_text">Beskrivelse *</label>
				<textarea name="alt_text" required></textarea>
			</div>
			<div class="form-row">
				<input type="submit" name="submit" value="Upload">
			</div>
		</form>
	</main>
</div>