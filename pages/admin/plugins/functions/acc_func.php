<?php
include '../../../../process/conn.php';

$method = $_POST['method'];

if ($method == 'search_account_list') {
	$employee_no = $_POST['employee_no'];
	$full_name = $_POST['full_name'];
	$user_type = $_POST['user_type'];
	$c = 0;

	$query = "SELECT * FROM user_accounts WHERE id_number LIKE '$employee_no%' AND full_name LIKE '$full_name%' AND role LIKE '$user_type%'";
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;
			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_accounts_details(&quot;'.$j['id'].'~!~'.$j['id_number'].'~!~'.$j['username'].'~!~'.$j['full_name'].'~!~'.$j['password'].'~!~'.$j['section'].'~!~'.$j['role'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['id_number'].'</td>';
				echo '<td>'.$j['username'].'</td>';
				echo '<td>'.$j['full_name'].'</td>';
				echo '<td>'.$j['section'].'</td>';
				echo '<td>'.strtoupper($j['role']).'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}
?>