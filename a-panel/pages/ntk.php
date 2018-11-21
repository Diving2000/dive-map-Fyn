<?php
  $id = $objConnection->real_escape_string($_GET['id']);

	$sql = "
	SELECT * FROM drf_map_junction WHERE id = '$id'
	";
	$result = $objConnection->query($sql);

	while($row = $result->fetch_object()){
		$title = $row->ref_title;
	}
?>
<div class="page content">
	<div class="space-between">
		<h1>
			'Nice to Know'-sektioner for dive spot '<?php echo $title; ?>'
		</h1>
		<div class="button">
			<a href="?page=ntk_add&id=<?php echo $id; ?>">Tilføj 'nyttig viden'</a>
		</div>
	</div>
  
	<div id="load-NTK">
		
	</div>
	
</div>

<script>
	window.onload = function(){
		function ajax(){
			var ajaxRequest = new XMLHttpRequest();
			ajaxRequest.onreadystatechange = function(){
				if(ajaxRequest.readyState == 4){
					 var ajaxDisplay = document.getElementById('load-NTK');
					 ajaxDisplay.innerHTML = ajaxRequest.responseText;
				}
		 }
		 ajaxRequest.open("GET", "code/selectNTK.php?id=<?php echo $id; ?>", true);
		 ajaxRequest.send(null);
		}
		setInterval(ajax, 1000);
	}
</script>