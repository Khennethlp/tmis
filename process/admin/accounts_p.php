<?php
include '../conn.php';

$method = $_POST['method'];

function count_account_list($search_arr, $conn)
{
	$query = "SELECT COUNT(id) AS total FROM m_accounts WHERE emp_id LIKE '" . $search_arr['account'] . "%' OR fullname LIKE '" . $search_arr['account'] . "%' OR username LIKE '" . $search_arr['account'] . "%'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $row) {
			$total = $row['total'];
		}
	} else {
		$total = 0;
	}
	return $total;
}

if ($method == 'count_account_list') {
	$account = $_POST['account'];

	$search_arr = array(
		"account" => $account,
	);
	echo count_account_list($search_arr, $conn);
}

if ($method == 'account_list') {
	$current_page = intval($_POST['current_page']);
	$c = 0;

	$results_per_page = 10;

	$page_first_result = ($current_page - 1) * $results_per_page;

	$c = $page_first_result;

	$query = "SELECT * FROM m_accounts LIMIT " . $page_first_result . ", " . $results_per_page;
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			// echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_accounts_details(&quot;'.$j['id'].'~!~'.$j['emp_id'].'~!~'.$j['username'].'~!~'.$j['fullname'].'~!~'.$j['password'].'~!~'.$j['section'].'~!~'.$j['role'].'&quot;)">';
			echo '<td>' . $c . '</td>';
			echo '<td>' . $j['emp_id'] . '</td>';
			echo '<td>' . $j['fullname'] . '</td>';
			echo '<td>' . $j['username'] . '</td>';
			echo '<td>' . $j['section'] . '</td>';
			echo '<td>' . strtoupper($j['role']) . '</td>';
			echo '</tr>';
		}
	} else {
		echo '<tr>';
		echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}

if ($method == 'account_list_pagination') {
	$account = $_POST['account'];

	$search_arr = array(
		"account" => $account,
	);

	$results_per_page = 10;

	$number_of_result = intval(count_account_list($search_arr, $conn));

	$number_of_page = ceil($number_of_result / $results_per_page);

	for ($page = 1; $page <= $number_of_page; $page++) {
		echo '<option value="' . $page . '">' . $page . '</option>';
	}
}

if ($method == 'search_account_list') {
	$account = $_POST['account'];
	$current_page = isset($_POST['current_page']) ? max(1, intval($_POST['current_page'])) : 1;
	$c = 0;

	$results_per_page = 10;
	$page_first_result = ($current_page - 1) * $results_per_page;
	$c = $page_first_result;

	$query = "SELECT * FROM m_accounts WHERE emp_id LIKE '$account%' OR username LIKE '$account%' OR fullname LIKE '$account%' LIMIT " . $page_first_result . ", " . $results_per_page;
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_accounts_details(&quot;' . $j['id'] . '~!~' . $j['emp_id'] . '~!~' . $j['username'] . '~!~' . $j['fullname'] . '~!~' . $j['password'] . '~!~' . $j['section'] . '~!~' . $j['role'] . '&quot;)">';
			echo '<td>' . $c . '</td>';
			echo '<td>' . $j['emp_id'] . '</td>';
			echo '<td>' . $j['fullname'] . '</td>';
			echo '<td>' . $j['username'] . '</td>';
			echo '<td>' . $j['section'] . '</td>';
			echo '<td>' . strtoupper($j['role']) . '</td>';
			echo '</tr>';
		}
	} else {
		echo '<tr>';
		echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}

if ($method == 'add_account') {
	$emp_id = $_POST['emp_id'];
	$fullname = $_POST['fullname'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$section = $_POST['section'];
	$role = $_POST['role'];

	$check_duplicate = "SELECT COUNT(*) FROM m_accounts WHERE emp_id = :emp_id ";
	$stmt_duplicate = $conn->prepare($check_duplicate, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt_duplicate->bindParam(':emp_id', $emp_id);
	$stmt_duplicate->execute();
	$count = $stmt_duplicate->fetchColumn();

	if ($count > 0) {
		echo 'duplicate';
	} else {
		try {
			$insert = "INSERT INTO m_accounts (emp_id, fullname, username, password, section,role) VALUES (:emp_id, :fullname, :username, :password, :section, :role)";
			$stmt = $conn->prepare($insert, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->bindParam(':emp_id', $emp_id);
			$stmt->bindParam(':fullname', $fullname);
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':section', $section);
			$stmt->bindParam(':role', $role);
			$stmt->execute();

			echo 'success';
		} catch (Exception $e) {
			echo 'fail';
		}
	}
}

if ($method == 'edit_account') {
	$partcode = $_POST['partcode'];
	$partname = $_POST['partname'];
	$qty = $_POST['qty'];
	$id = $_POST['id'];

	$check = "SELECT * FROM m_kanban WHERE id = :id";
	$stmt = $conn->prepare($check, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->bindParam(':id', $id);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$partcodes = $row['partcode'];
		$partnames = $row['partname'];
		$qtys = $row['packing_quantity'];
		$id = $row['id'];
	}

	$update_qry = "UPDATE m_kanban SET partcode = :partcode, partname = :partname, packing_quantity = :qty WHERE id = :id";
	$stmt = $conn->prepare($update_qry, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->bindParam(':id', $id);
	$stmt->bindParam(':partcode', $partcode);
	$stmt->bindParam(':partname', $partname);
	$stmt->bindParam(':qty', $qty);

	if ($stmt->execute()) {
		echo 'success';
	} else {
		echo 'error';
		// If there's an error, print error information
		$errorInfo = $stmt->errorInfo();
		echo 'error: ' . $errorInfo[2];
	}
}

if ($method == 'get_all_section') {
	$query = "SELECT DISTINCT section FROM m_accounts";
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();

	// Fetch results and generate HTML options
	$optionsHTML = '';
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$section = $row['section'];
		$optionsHTML .= "<option value='$section'>$section</option>";
	}
	echo $optionsHTML;
	exit; // Terminate script execution
}
