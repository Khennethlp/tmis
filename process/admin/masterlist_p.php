<?php
include '../conn.php';

$method = $_POST['method'];

function count_m_list($search_arr, $conn)
{
	$query = "SELECT COUNT(id) AS total FROM m_kanban WHERE partcode LIKE :search OR partname LIKE :search OR packing_quantity LIKE :search";
	$stmt = $conn->prepare($query);
	$searchTerm = '%' . $search_arr['search'] . '%';
	$stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
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

if ($method == 'count_mlist') {
	$mlist_search = $_POST['mlist_search'];

	$search_arr = array(
		"search" => $mlist_search,
	);
	count_m_list($search_arr, $conn);
}


if ($method == 'kanban_mlist') {
	$current_page = intval($_POST['current_page']);
	$c = 0;

	$results_per_page = 10;
	$page_first_result = ($current_page - 1) * $results_per_page;
	$c = $page_first_result;

	$query = "SELECT * FROM m_kanban LIMIT " . $page_first_result . ", " . $results_per_page;
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			// echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_mlist" onclick="get_mlist_details(&quot;'.$j['id'].'~!~'.$j['partcode'].'~!~'.$j['partname'].'~!~'.$j['packing_quantity'].'&quot;)">';
			echo '<td>' . $c . '</td>';
			echo '<td>' . $j['partcode'] . '</td>';
			echo '<td>' . $j['partname'] . '</td>';
			echo '<td>' . $j['packing_quantity'] . '</td>';
			echo '<td>' . date('Y/M/d', strtotime($j['date_updated'])) . '</td>';
			echo '</tr>';
		}
	} else {
		echo '<tr>';
		echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}

if ($method == 'm_list_pagination') {
	// $mlist_search = $_POST['mlist_search'];
	$mlist_search = isset($_POST['mlist_search']) ? $_POST['mlist_search'] : ''; // Check if mlist_search is set
	// $fromD_search = $_POST['fromD_search'];
	// $toD_search = $_POST['toD_search'];

	$search_arr = array(
		"search" => $mlist_search,
	);

	$results_per_page = 10;
	$number_of_result = intval(count_m_list($search_arr, $conn));
	$number_of_page = ceil($number_of_result / $results_per_page);

	for ($page = 1; $page <= $number_of_page; $page++) {
		echo '<option value="' . $page . '">' . $page . '</option>';
	}
}

if ($method == 'search_mlist') {
	$mlist_search = $_POST['mlist_search'];
	// $current_page = intval($_POST['current_page']);

	$current_page = isset($_POST['current_page']) ? max(1, intval($_POST['current_page'])) : 1;
	$c = 0;

	$results_per_page = 10;
	$page_first_result = ($current_page - 1) * $results_per_page;
	$c = $page_first_result;

	$query = "SELECT * FROM m_kanban WHERE partcode LIKE '$mlist_search%' OR partname LIKE '$mlist_search%' OR packing_quantity LIKE '$mlist_search%' LIMIT " . $page_first_result . ", " . $results_per_page;
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_mlist" onclick="get_mlist_details(&quot;' . $j['id'] . '~!~' . $j['partcode'] . '~!~' . $j['partname'] . '~!~' . $j['packing_quantity'] . '&quot;)">';
			echo '<td><input type="checkbox" name="selected[]" class="selected" id="selected[]" value="' . $j['id'] . '" onclick="get_checked_length()"  style="cursor:pointer;"></td>';
			echo '<td>' . $c . '</td>';
			echo '<td>' . $j['partcode'] . '</td>';
			echo '<td>' . $j['partname'] . '</td>';
			echo '<td>' . $j['packing_quantity'] . '</td>';
			echo '<td>' . date('Y/M/d', strtotime($j['date_updated'])) . '</td>';
			echo '</tr>';
		}
	} else {
		echo '<tr>';
		echo '<td colspan="5" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}

if ($method == 'search_by_date') {
	$from_date = $_POST['from_date'];
	$to_date = $_POST['to_date'];
	$c = 0;

	$query = "SELECT * FROM m_kanban WHERE DATE(date_updated) BETWEEN '$from_date' AND '$to_date'";
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();

	$result['rows'] = []; // Initialize an array to store rows

	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchAll() as $j) {
			$c++;
			$result['rows'][] = [
				'id' => $j['id'],
				'partcode' => $j['partcode'],
				'partname' => $j['partname'],
				'packing_quantity' => $j['packing_quantity']
			];
		}
	}

	// Output the total count of rows within the date range
	// $count_rows = "SELECT COUNT(*) AS total_count FROM m_kanban WHERE DATE(date_updated) BETWEEN '$from_date' AND '$to_date'";
	// $stmt = $conn->prepare($count_rows);
	// $stmt->execute();
	// $count_result = $stmt->fetch(PDO::FETCH_ASSOC);
	// $result['count'] = $count_result['total_count'];

	// echo json_encode($result); // Return data as JSON
}

if ($method == 'history_list') {

	$c = 0;

	$query = "SELECT * FROM t_partsin_history";
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_history" onclick="get_history_details(&quot;' . $j['id'] . '~!~' . $j['partcode'] . '~!~' . $j['partname'] . '~!~' . $j['packing_quantity'] . '~!~' . $j['lot_address'] . '~!~' . $j['updated_by'] . '&quot;)">';
			echo '<td>' . $c . '</td>';
			echo '<td>' . $j['partcode'] . '</td>';
			echo '<td>' . $j['partname'] . '</td>';
			echo '<td>' . $j['packing_quantity'] . '</td>';
			echo '<td>' . $j['lot_address'] . '</td>';
			// echo '<td>' . $j['updated_by'] . '</td>';
			echo '</tr>';
		}
	} else {
		echo '<tr>';
		echo '<td colspan="5" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}

if ($method == 'save_mlist') {
	$partcode = $_POST['partcode'];
	$partname = $_POST['partname'];
	$qty = $_POST['qty'];

	$check_duplicate = "SELECT COUNT(*) FROM m_kanban WHERE partcode = :partcode";
	$stmt_duplicate = $conn->prepare($check_duplicate, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt_duplicate->bindParam(':partcode', $partcode);
	$stmt_duplicate->execute();
	$count = $stmt_duplicate->fetchColumn();

	if ($count > 0) {
		echo 'duplicate';
	} else {
		try {
			$insert = "INSERT INTO m_kanban (partcode, partname, packing_quantity) VALUES (:partcode, :partname, :qty)";
			$stmt = $conn->prepare($insert, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
			$stmt->bindParam(':partcode', $partcode);
			$stmt->bindParam(':partname', $partname);
			$stmt->bindParam(':qty', $qty);
			$stmt->execute();

			echo 'success';
		} catch (Exception $e) {
			echo 'fail';
		}
	}
}

if ($method == 'edit_mlist') {
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

if ($method == 'del_mlist') {
	$id = $_POST['id'];

	$query = "DELETE FROM m_kanban WHERE id = '$id'";
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	if ($stmt->execute()) {
		echo 'success';
	} else {
		echo 'error';
	}
}

if ($method == 'update_history') {
	$id = $_POST['id'];
	$partcode = $_POST['partcode'];
	$partname = $_POST['partname'];
	$qty = $_POST['qty'];
	$s_address = $_POST['address'];
	$by_updated = $_POST['by_update'];

	$check = "SELECT * FROM t_partsin_history WHERE id = :id";
	$stmt = $conn->prepare($check, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->bindParam(':id', $id);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$id = $row['id'];
		$part_codes = $row['partcode'];
		$part_names = $row['partname'];
		$p_qty = $row['packing_quantity'];
		$address = $row['lot_address'];
		$updated_by = $row['updated_by'];
	}

	$update_qry = "UPDATE t_partsin_history SET partcode = :partcode, partname = :partname, packing_quantity = :qty, lot_address = :lot_address, updated_by = :updated_by WHERE id = :id";
	$stmt = $conn->prepare($update_qry, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->bindParam(':id', $id);
	$stmt->bindParam(':partcode', $partcode);
	$stmt->bindParam(':partname', $partname);
	$stmt->bindParam(':qty', $qty);
	$stmt->bindParam(':lot_address', $s_address);
	$stmt->bindParam(':updated_by', $by_updated);

	if ($stmt->execute()) {
		echo 'success';
	} else {
		echo 'error';
		// If there's an error, print error information
		$errorInfo = $stmt->errorInfo();
		echo 'error: ' . $errorInfo[2];
	}
}

if ($method == 'del_history') {
	$id = $_POST['id'];

	$query = "DELETE FROM t_partsin_history WHERE id = '$id'";
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	if ($stmt->execute()) {
		echo 'success';
	} else {
		echo 'error';
	}
}

if ($method == 'count_mlist') {

	$count_rows = "SELECT COUNT(*) AS total_count FROM m_kanban";
	$stmt = $conn->prepare($count_rows, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	echo $result['total_count'];
}

if ($method == 'get_all_mlist') {
	$query = "SELECT DISTINCT partname FROM m_kanban";
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();

	// Fetch results and generate HTML options
	$optionsHTML = '';
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$section = $row['partname'];
		$optionsHTML .= "<option value='$section'>$section</option>";
	}
	echo $optionsHTML;
	exit; // Terminate script execution
}
