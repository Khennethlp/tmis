<?php
include '../conn.php';
include '../login.php';
include '../../functions/partsin_query.php';

$method = $_POST['method'];

function count_partsin($search_arr, $conn)
{
	// $query = "SELECT COUNT(DISTINCT partcode) AS total FROM t_partsin WHERE partcode LIKE '" . $search_arr['partsin'] . "%' OR partname LIKE '" . $search_arr['partsin'] . "%'";
	$query = "SELECT COUNT(partcode) AS total FROM t_partsin WHERE partcode LIKE '" . $search_arr['partsin'] . "%' OR partname LIKE '" . $search_arr['partsin'] . "%'";
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

	$results_per_page = 50;
	$page_first_result = ($current_page - 1) * $results_per_page;
	$c = $page_first_result;

	// 	$query = "SELECT 
	// 	a.partcode,
	// 	a.partname, 
	// 	a.packing_quantity, 
	// 	b.id, 
	// 	b.partcode AS b_partcode,
	// 	b.Qty, 
	// 	b.qr_code, 
	// 	b.lot_address, 
	// 	b.barcode_label, 
	// 	b.packing_quantity AS b_packing_quantity, 
	// 	b.date_updated, 
	// 	b.updated_by 
	// FROM 
	// 	m_kanban a 
	// LEFT JOIN (
	// 	SELECT 
	// 		t.id, 
	// 		t.qr_code, 
	// 		t.partcode, 
	// 		t.partname, 
	// 		t.packing_quantity, 
	// 		t.lot_address, 
	// 		t.barcode_label, 
	// 		t.updated_by, 
	// 		t.date_updated
	// 	FROM 
	// 		t_partsin t
	// 	JOIN (
	// 		SELECT 
	// 			partcode, 
	// 			MAX(date_updated) AS latest_date 
	// 		FROM 
	// 			t_partsin 
	// 		GROUP BY 
	// 			partcode
	// 	) AS c ON t.partcode = c.partcode AND t.date_updated = c.latest_date
	// ) AS b ON a.partcode = b.partcode ORDER BY b.date_updated DESC
	// LIMIT  " . $page_first_result . ", " . $results_per_page;
	
	// $query = "SELECT a.partcode,a.partname, a.packing_quantity, b.Qty, b.qr_code, b.lot_address, b.barcode_label, b.packing_quantity, b.date_updated, b.updated_by FROM m_kanban a left join (select qr_code, partcode, partname, packing_quantity, lot_address, barcode_label, updated_by, date_updated from t_partsin GROUP by partcode ) as b ON a.partcode = b.partcode LIMIT " . $page_first_result . ", " . $results_per_page;
	$query = "SELECT * FROM t_partsin ORDER BY id DESC LIMIT " . $page_first_result . ", " . $results_per_page;
	$stmt = $conn->prepare($sql);
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
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

	$results_per_page = 50;
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

	$results_per_page = 50;
	$page_first_result = ($current_page - 1) * $results_per_page;
	$c = $page_first_result;

	// $query = "SELECT a.partcode,a.partname, a.packing_quantity, b.Qty, b.lot_address, b.barcode_label, b.packing_quantity, b.date_updated, b.updated_by FROM m_kanban a left join (select partcode, partname, packing_quantity, lot_address, barcode_label, updated_by, date_updated, count(partcode) as Qty from t_partsin GROUP by partcode ) as b ON a.partcode = b.partcode WHERE concat(a.partname LIKE '$partsin%', b.partcode LIKE '$partsin%')  LIMIT " . $page_first_result . ", " . $results_per_page;
	$query = "SELECT * FROM t_partsin WHERE partname LIKE '$partsin%' OR partcode LIKE '$partsin%' ORDER BY id DESC LIMIT " . $page_first_result . ", " . $results_per_page;
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
