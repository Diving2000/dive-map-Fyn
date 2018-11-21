<?php

  require_once('../includes/config.php');
  require_once('../includes/dbConn.php');

  $id = $objConnection->real_escape_string($_GET['id']);

	$ntkSql = "
		SELECT *, drf_map_ntk.id AS ntk_id FROM drf_map_ntk
		INNER JOIN drf_map_ntk_text ON (drf_map_ntk_text.id = drf_map_ntk.text_id)
		WHERE junction_id = {$id} AND drf_map_ntk.lang_id = 3
	";
	$ntkResult = $objConnection->query($ntkSql);
	
	if($ntkResult->num_rows != 0){
		while($row = $ntkResult->fetch_object()){
			echo '<ul class="details-list">';
			if($row->type_id == 1){
				echo '<li class="space-between"><div>';
				echo '<img width="20" height="16" src="../Resources/ui/icon-check.png">';
				echo $row->explanation . '</div>';
				echo '<div class="button"><a href="?page=ntk_delete&id=' . $row->ntk_id . '&junction=' . $id . '&version=' . $row->text_id . '">Slet</a></div>';
				echo '</li>';
			}elseif($row->type_id == 2){
				echo '<li class="space-between"><div>';
				echo '<img width="20" height="16" src="../Resources/ui/icon-notice.png">';
				echo $row->explanation . '</div>';
				echo '<div class="button"><a href="?page=ntk_delete&id=' . $row->ntk_id . '&junction=' . $id . '&version=' . $row->text_id . '">Slet</a></div>';
				echo '</li>';
			}else {
				echo '<li class="space-between"><div>';
				echo '<img width="20" height="16" src="../Resources/ui/icon-warning.png">';
				echo $row->explanation . '</div>';
				echo '<div class="button"><a href="?page=ntk_delete&id=' . $row->ntk_id . '&junction=' . $id . '&version=' . $row->text_id . '">Slet</a></div>';
				echo '</li>';
			}
			echo '</ul>';
		}
	}else {
		echo '<p class="warning">Der er endnu ikke tilføjet nogen sektioner til dette dive spot.</p>';
	}
