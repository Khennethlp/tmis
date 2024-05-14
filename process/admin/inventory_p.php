<?php
include '../conn.php';

$method = $_POST['method'];

function count_inv_list($search_arr, $conn)
{
	$query = "SELECT COUNT(id) AS total FROM t_partsin_history WHERE partcode LIKE :search OR partname LIKE :search OR packing_quantity LIKE :search OR barcode_label LIKE :search OR lot_address LIKE :search OR quantity LIKE :search";
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

if ($method == 'count_list') {
	$inv_search = $_POST['inv_search'];

	$search_arr = array(
		"search" => $inv_search,
	);
	echo count_inv_list($search_arr, $conn);
}

if ($method == 'inventory_list') {
	$current_page = isset($_POST['current_page']) ? max(1, intval($_POST['current_page'])) : 1;
	$c = 0;

	$results_per_page = 10;
	$page_first_result = ($current_page - 1) * $results_per_page;
	$c = $page_first_result;

	//joined table of store_out & store_in history 
	// $get_history = "SELECT * FROM t_partsin_history ";
	$get_history = "SELECT * FROM t_partsin_history ORDER BY id DESC LIMIT " . $page_first_result . ", " . $results_per_page;
	$stmt = $conn->prepare($get_history, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			// echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_accounts_details(&quot;'.$j['id'].'~!~'.$j['id_number'].'~!~'.$j['username'].'~!~'.$j['full_name'].'~!~'.$j['password'].'~!~'.$j['section'].'~!~'.$j['role'].'&quot;)">';
			echo '<tr>';
			// echo '<td><input type="checkbox" name="selected[]" class="selected" id="selected[]" value="' . $j['id'] . '" onclick="get_checked_length()"  style="cursor:pointer;"></td>';
			echo '<td>' . $c . '</td>';
			echo '<td>' . $j['partcode'] . '</td>';
			echo '<td>' . $j['partname'] . '</td>';
			echo '<td>' . $j['packing_quantity'] . '</td>';
			echo '<td>' . $j['lot_address'] . '</td>';
			echo '<td>' . $j['barcode_label'] . '</td>';
			echo '<td>' . $j['quantity'] . '</td>';
			echo '<td>' . date('Y-M-d', strtotime($j['date_updated'])) . '</td>';
			echo '<td>' . $j['updated_by'] . '</td>';
			echo '</tr>';
		}
	} else {
		echo '<tr>';
		echo '<td colspan="10" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}

if ($method == 'inv_pagination') {
	$inv_search = isset($_POST['inv_search']) ? $_POST['inv_search'] : ''; // Check if mlist_search is set

	$search_arr = array(
		"search" => $inv_search,
	);

	$results_per_page = 10;
	$number_of_result = intval(count_inv_list($search_arr, $conn));
	$number_of_page = ceil($number_of_result / $results_per_page);

	for ($page = 1; $page <= $number_of_page; $page++) {
		echo '<option value="' . $page . '">' . $page . '</option>';
	}
}


if ($method == 'inventory_search') {
	$inventory_search = $_POST['inventory_search'];
	$c = 0;

	$current_page = isset($_POST['current_page']) ? max(1, intval($_POST['current_page'])) : 1;
	$results_per_page = 10;
	$page_first_result = ($current_page - 1) * $results_per_page;
	$c = $page_first_result;

	$query = "SELECT * FROM t_partsin_history WHERE partcode LIKE '$inventory_search%' OR partname LIKE '$inventory_search%' OR packing_quantity LIKE '$inventory_search%' OR lot_address LIKE '$inventory_search%' OR barcode_label LIKE '$inventory_search%' OR quantity LIKE '$inventory_search% ' LIMIT " . $page_first_result . ", " . $results_per_page;
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			// echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_inventory" onclick="get_inventory_details(&quot;'.$j['id'].'~!~'.$j['partcode'].'~!~'.$j['partname'].'~!~'.$j['packing_quantity'].'~!~'.$j['lot_address'].'~!~'.$j['barcode_label'].'~!~'.$j['quantity'].'~!~'.'&quot;)">';
			echo '<td><input type="checkbox" name="selected[]" class="selected" id="selected[]" value="' . $j['id'] . '" onclick="get_checked_length()"  style="cursor:pointer;"></td>';
			echo '<td>' . $c . '</td>';
			echo '<td>' . $j['partcode'] . '</td>';
			echo '<td>' . $j['partname'] . '</td>';
			echo '<td>' . $j['packing_quantity'] . '</td>';
			echo '<td>' . $j['lot_address'] . '</td>';
			echo '<td>' . $j['barcode_label'] . '</td>';
			echo '<td>' . $j['quantity'] . '</td>';
			echo '<td>' . date('Y-M-d', strtotime($j['date_updated'])) . '</td>';
			echo '<td>' . $j['updated_by'] . '</td>';
			echo '</tr>';
		}
	} else {
		echo '<tr>';
		echo '<td colspan="10" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}

if ($method == 'search_by_date') {
	$from_date = $_POST['from_date'];
	$to_date = $_POST['to_date'];
	$c = 0;

	$query = "SELECT * FROM t_partsin_history WHERE DATE(date_updated) BETWEEN '$from_date' AND '$to_date'";
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
				'packing_quantity' => $j['packing_quantity'],
				'lot_address' => $j['lot_address'],
				'barcode_label' => $j['barcode_label'],
				'quantity' => $j['quantity'],
				'date_updated' => $j['date_updated'],
				'updated_by' => $j['updated_by'],
			];
		}
	}

	// Output the total count of rows within the date range
	$count_rows = "SELECT COUNT(*) AS total_count FROM t_partsin_history WHERE DATE(date_updated) BETWEEN '$from_date' AND '$to_date'";
	$stmt = $conn->prepare($count_rows, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	$count_result = $stmt->fetch(PDO::FETCH_ASSOC);
	$result['count'] = $count_result['total_count'];

	echo json_encode($result); // Return data as JSON
}

// counting total rows of t_partsin and t_partsin_history
// if ($method == 'count_list') {

	// query for joined table of t_partsin and t_partsin_history
	// $count_rows = "SELECT SUM(count) AS total_count FROM 
	// (SELECT COUNT(partcode) AS count FROM t_partsin UNION ALL SELECT COUNT(partcode) 
	// AS count FROM t_partsin_history) AS counts ";
// 	$count_rows = "SELECT COUNT(partcode) AS count FROM t_partsin_history";
// 	$total = 0;
// 	$stmt = $conn->prepare($count_rows, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
// 	$stmt->execute();
// 	$result = $stmt->fetch(PDO::FETCH_ASSOC);
// 	$total = $result['count'];

// 	echo $total;
// }

//delete arr
if ($method == 'delete_data_arr') {
	$id_arr = [];
	$id_arr = $_POST['id_arr'];

	$count = count($id_arr);
	foreach ($id_arr as $id) {
		$query = "DELETE FROM `t_partsin_history` WHERE id = ?";
		$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
		$params = array($id);
		$stmt->execute($params);
		$count--;
	}

	if ($count == 0) {
		echo 'success';
	}
}
