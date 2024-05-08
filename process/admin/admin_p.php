<?php
session_start();
include '../conn.php';

$method = $_POST['method'];

if($method == 'get_mlist'){
	$query = "SELECT DISTINCT partname FROM m_kanban";
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();

	  // Fetch results and generate HTML options
	  $optionsHTML = '';
	  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		  $partname = $row['partname'];
		  $optionsHTML .= "<option value='$partname'></option>";
	  }
	  echo $optionsHTML;
	  exit; // Terminate script execution
}


?>