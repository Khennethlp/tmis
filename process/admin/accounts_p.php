<?php
include '../conn.php';

$method = $_POST['method'];

if ($method == 'search_account_list') {
	$acc_search = $_POST['acc_search'];
	// $user_type = $_POST['user_type'];
	$c = 0;

	$query = "SELECT * FROM m_accounts WHERE emp_id LIKE '$acc_search%' OR username LIKE '$acc_search%' OR fullname LIKE '$acc_search%' OR role LIKE '$acc_search%'";
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;
			// echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_accounts_details(&quot;'.$j['id'].'~!~'.$j['id_number'].'~!~'.$j['username'].'~!~'.$j['full_name'].'~!~'.$j['password'].'~!~'.$j['section'].'~!~'.$j['role'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['emp_id'].'</td>';
				echo '<td>'.$j['fullname'].'</td>';
				echo '<td>'.$j['username'].'</td>';
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

if ($method == 'account_list') {
	$c = 0;

	$query = "SELECT * FROM m_accounts";
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;
			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_accounts_details(&quot;'.$j['id'].'~!~'.$j['emp_id'].'~!~'.$j['username'].'~!~'.$j['fullname'].'~!~'.$j['password'].'~!~'.$j['section'].'~!~'.$j['role'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['emp_id'].'</td>';
				echo '<td>'.$j['fullname'].'</td>';
				echo '<td>'.$j['username'].'</td>';
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

if($method == 'add_account'){
	$emp_id = $_POST['emp_id'];
	$fullname = $_POST['fullname'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$section = $_POST['section'];
	$role = $_POST['role'];

	$check_duplicate = "SELECT COUNT(*) FROM m_accounts WHERE emp_id = :emp_id ";
	$stmt_duplicate = $conn->prepare($check_duplicate);
	$stmt_duplicate->bindParam(':emp_id',$emp_id);
	$stmt_duplicate->execute();
	$count = $stmt_duplicate->fetchColumn();

	if($count > 0){
		echo 'duplicate';
	}else{
		try{
			$insert = "INSERT INTO m_accounts (emp_id, fullname, username, password, section,role) VALUES (:emp_id, :fullname, :username, :password, :section, :role)";
			$stmt = $conn->prepare($insert);
			$stmt->bindParam(':emp_id', $emp_id);
			$stmt->bindParam(':fullname', $fullname);
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':section', $section);
			$stmt->bindParam(':role', $role);
			$stmt->execute();

			echo 'success';
		}catch(Exception $e){
			echo 'fail';
		}
	}
}

if($method == 'edit_account'){
    $partcode = $_POST['partcode'];
    $partname = $_POST['partname'];
    $qty = $_POST['qty'];
    $id = $_POST['id'];

    $check = "SELECT * FROM m_kanban WHERE id = :id";
    $stmt = $conn->prepare($check);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if($stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $partcodes = $row['partcode'];
        $partnames = $row['partname'];
        $qtys = $row['packing_quantity'];
        $id = $row['id'];
    }

    $update_qry = "UPDATE m_kanban SET partcode = :partcode, partname = :partname, packing_quantity = :qty WHERE id = :id";
    $stmt = $conn->prepare($update_qry);
    $stmt->bindParam(':id', $id);
	$stmt->bindParam(':partcode', $partcode);
	$stmt->bindParam(':partname', $partname);
	$stmt->bindParam(':qty', $qty);
 
    if($stmt->execute()){
        echo 'success';
    }else{
        echo 'error';
		// If there's an error, print error information
		$errorInfo = $stmt->errorInfo();
		echo 'error: ' . $errorInfo[2];
    }
}
?>