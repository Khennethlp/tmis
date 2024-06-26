<?php
include '../conn.php';
include '../login.php';

$method = $_POST['method'];

function count_partsout($search_arr, $conn)
{
	$query = "SELECT COUNT(partcode) AS total FROM t_partsout WHERE partcode LIKE '" . $search_arr['partsout'] . "%' OR partname LIKE '" . $search_arr['partsout'] . "%'";
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

if ($method == 'count_partsout_list') {
	$partsout = $_POST['partsout'];
	$search_arr = array(
		"partsout" => $partsout,
	);
	echo count_partsout($search_arr, $conn);
}

if ($method == 'partsout_list') {
	$current_page = intval($_POST['current_page']);
	$c = 0;

	$results_per_page = 10;
	$page_first_result = ($current_page - 1) * $results_per_page;
	$c = $page_first_result;

	// $query = "SELECT a.partcode,a.partname, a.packing_quantity, b.lot_address, b.barcode_label, b.packing_quantity, b.date_updated, b.updated_by FROM m_kanban a left join (select partcode, partname, packing_quantity, lot_address, barcode_label, updated_by, date_updated from t_partsout GROUP by partcode ORDER BY id DESC ) as b ON a.partcode = b.partcode LIMIT " . $page_first_result . ", " . $results_per_page;
	$query = "SELECT * FROM t_partsout ORDER BY id DESC LIMIT " . $page_first_result . ", " . $results_per_page;
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			// echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_accounts_details(&quot;'.$j['id'].'~!~'.$j['id_number'].'~!~'.$j['username'].'~!~'.$j['full_name'].'~!~'.$j['password'].'~!~'.$j['section'].'~!~'.$j['role'].'&quot;)">';
			echo '<td>' . $c . '</td>';
			echo '<td>' . $j['partcode'] . '</td>';
			echo '<td>' . $j['partname'] . '</td>';
			echo '<td>' . $j['packing_quantity'] . '</td>';
			echo '<td>' . $j['lot_address'] . '</td>'; // barcode label
			echo '<td>' . $j['barcode_label'] . '</td>';
			echo '<td>' . date('Y/M/d', strtotime($j['date_updated'])) . '</td>';
			// echo '<td>' . $j['updated_by'] . '</td>';

			echo '</tr>';
		}
	} else {
		echo '<tr>';
		echo '<td colspan="8" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}

if ($method == 'partsout_pagination') {
	$partsout = $_POST['partsout'];

	$search_arr = array(
		"partsout" => $partsout,
	);

	$results_per_page = 10;
	$number_of_result = intval(count_partsout($search_arr, $conn));
	$number_of_page = ceil($number_of_result / $results_per_page);

	for ($page = 1; $page <= $number_of_page; $page++) {
		echo '<option value="' . $page . '">' . $page . '</option>';
	}
}

if ($method == 'search_partsout') {
	$partsout = $_POST['partsout'];
	$current_page = isset($_POST['current_page']) ? max(1, intval($_POST['current_page'])) : 1;
	$c = 0;

	$results_per_page = 10;
	$page_first_result = ($current_page - 1) * $results_per_page;
	$c = $page_first_result;

	// $query = "SELECT * FROM t_partsout WHERE partcode LIKE '$partsout%' OR partname LIKE '$partsout%' LIMIT " . $page_first_result . ", " . $results_per_page;

$query = "SELECT * FROM t_partsout WHERE partname LIKE '$partsout%' OR partcode LIKE '$partsout%' ORDER BY id desc LIMIT " . $page_first_result . ", " . $results_per_page;	
$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			// echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_accounts_details(&quot;'.$j['id'].'~!~'.$j['partcode'].'~!~'.$j['username'].'~!~'.$j['fullname'].'~!~'.$j['password'].'~!~'.$j['section'].'~!~'.$j['role'].'&quot;)">';
			echo '<td>' . $c . '</td>';
			echo '<td>' . $j['partcode'] . '</td>';
			echo '<td>' . $j['partname'] . '</td>';
			echo '<td>' . $j['packing_quantity'] . '</td>';
			echo '<td>' . $j['lot_address'] . '</td>';
			echo '<td>' . $j['barcode_label'] . '</td>';
			echo '<td>' . date('Y/M/d', strtotime($j['date_updated'])) . '</td>';
			// echo '<td>' . $j['updated_by'] . '</td>';
			echo '</tr>';
		}
	} else {
		echo '<tr>';
		echo '<td colspan="8" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}
