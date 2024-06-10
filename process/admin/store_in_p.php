<?php
include '../conn.php';
include '../login.php';
include '../../functions/partsin_query.php';

$method = $_POST['method'];

function count_partsin($search_arr, $conn)
{
	$query = "SELECT COUNT(DISTINCT partcode) AS total FROM t_partsin WHERE partcode LIKE '" . $search_arr['partsin'] . "%' OR partname LIKE '" . $search_arr['partsin'] . "%'";
	$query = "SELECT COUNT(DISTINCT partcode) AS total FROM t_partsin WHERE partcode LIKE '" . $search_arr['partsin'] . "%' OR partname LIKE '" . $search_arr['partsin'] . "%'";
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

if ($method == 'count_partsin_list') {
	$partsin = $_POST['partsin'];

	$search_arr = array(
		"partsin" => $partsin,
	);
	echo count_partsin($search_arr, $conn);
}

if ($method == 'partsin_list') {
	$current_page = intval($_POST['current_page']);
	$c = 0;

	$results_per_page = 10;
	$page_first_result = ($current_page - 1) * $results_per_page;
	$c = $page_first_result;

	$query = t_partsin($page_first_result, $results_per_page);
	if ($query->rowCount() > 0) {
		foreach ($query->fetchALL() as $j) {
			$c++;
			// echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_accounts_details(&quot;'.$j['id'].'~!~'.$j['id_number'].'~!~'.$j['username'].'~!~'.$j['full_name'].'~!~'.$j['password'].'~!~'.$j['section'].'~!~'.$j['role'].'&quot;)">';
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

if ($method == 'partsin_pagination') {
	$partsin = $_POST['partsin'];

	$search_arr = array(
		"partsin" => $partsin,
	);

	$results_per_page = 10;
	$number_of_result = intval(count_partsin($search_arr, $conn));
	$number_of_page = ceil($number_of_result / $results_per_page);

	for ($page = 1; $page <= $number_of_page; $page++) {
		echo '<option value="' . $page . '">' . $page . '</option>';
	}
}

if ($method == 'search_partsin') {
	$partsin = $_POST['partsin'];
	$current_page = isset($_POST['current_page']) ? max(1, intval($_POST['current_page'])) : 1;
	$c = 0;

	$results_per_page = 10;
	$page_first_result = ($current_page - 1) * $results_per_page;
	$c = $page_first_result;

	$query = t_partsin_search($partsin, $page_first_result, $results_per_page);
	if ($query->rowCount() > 0) {
		foreach ($query->fetchALL() as $j) {
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
