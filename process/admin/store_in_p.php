<?php
include '../conn.php';
include '../login.php';

$method = $_POST['method'];

function count_partsin($search_arr, $conn)
{
	$query = "SELECT COUNT(DISTINCT qr_code) AS total FROM t_partsin WHERE partcode LIKE '" . $search_arr['partsin'] . "%' OR partname LIKE '" . $search_arr['partsin'] . "%'";
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

	$query = "SELECT a.partcode,a.partname, a.packing_quantity, b.Qty, b.qr_code, b.lot_address, b.barcode_label, b.packing_quantity, b.date_updated, b.updated_by FROM m_kanban a left join (select qr_code, partcode, partname, packing_quantity, lot_address, barcode_label, updated_by, date_updated, count(partcode) as Qty from t_partsin GROUP by partcode ) as b ON a.partcode = b.partcode LIMIT " . $page_first_result . ", " . $results_per_page;
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

	$query = "SELECT a.partcode,a.partname, a.packing_quantity, b.Qty, b.lot_address, b.barcode_label, b.packing_quantity, b.date_updated, b.updated_by FROM m_kanban a left join (select partcode, partname, packing_quantity, lot_address, barcode_label, updated_by, date_updated, count(partcode) as Qty from t_partsin GROUP by partcode ) as b ON a.partcode = b.partcode WHERE concat(a.partname LIKE '$partsin%', b.partcode LIKE '$partsin%') GROUP BY partcode LIMIT " . $page_first_result . ", " . $results_per_page;
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

//insert_partsin is in process->stores->store_in_p.php
// if ($method == 'insert_partsin') {

// 	$updated_by = $_SESSION['name'];
// 	$store_in_qr = $_POST['store_in_qr'];
// 	$store_in_address = $_POST['store_in_address'];
// 	$m_kanban = 'N/A';

// 	$qr = preg_replace('/\s+/', '', $store_in_qr);

// 	$barcode_label = substr($qr, 5, 16);
// 	$partscode = substr($qr, 21, 5);
// 	$p_qty = substr($qr, 33, 3);

// 	$stmt_check = "SELECT COUNT(*) FROM t_partsin WHERE partcode = :partcode";
// 	$stmt_check = $conn->prepare($stmt_check, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
// 	$stmt_check->bindParam(':partcode', $partscode);
// 	$stmt_check->execute();
// 	$count = $stmt_check->fetchColumn();

// 	if ($count > 0) {
// 		$update_qty = "UPDATE t_partsin_history ph INNER JOIN t_partsin tp ON ph.partcode = tp.partcode SET ph.quantity = ph.quantity + 1 WHERE tp.qr_code = :qr_code";
// 		$stmt = $conn->prepare($update_qty, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
// 		$stmt->bindParam(':qr_code', $qr);
// 		$stmt->execute();

// 		echo 'success';
// 	} else {
// 		try {
// 			// Data does not exist in t_partsin, insert into both t_partsin and t_partsin_history
// 			$partsinSql = "INSERT INTO t_partsin (qr_code, partcode, partname, packing_quantity, lot_address, barcode_label, updated_by)
//             VALUES (:qr_code, :partcode, :partname, :packing_quantity, :lot_address, :barcode_label, :updated_by) ";
// 			$stmt1 = $conn->prepare($partsinSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
// 			$stmt1->bindParam(':qr_code', $qr);
// 			$stmt1->bindParam(':partcode', $partscode);
// 			$stmt1->bindParam(':partname', $m_kanban);
// 			$stmt1->bindParam(':packing_quantity', $p_qty);
// 			$stmt1->bindParam(':lot_address', $store_in_address);
// 			$stmt1->bindParam(':barcode_label', $barcode_label);
// 			$stmt1->bindParam(':updated_by', $updated_by);
// 			$stmt1->execute();

// 			$quantity = 1;
// 			$partsinHistorySql = "INSERT INTO t_partsin_history (qr_code, partcode, partname, packing_quantity, quantity, lot_address, barcode_label, updated_by)
//             VALUES (:qr_code, :partcode, :partname, :packing_quantity, :quantity, :lot_address, :barcode_label, :updated_by) ";
// 			$stmt2 = $conn->prepare($partsinHistorySql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
// 			$stmt2->bindParam(':qr_code', $qr);
// 			$stmt2->bindParam(':partcode', $partscode);
// 			$stmt2->bindParam(':partname', $m_kanban);
// 			$stmt2->bindParam(':packing_quantity', $p_qty);
// 			$stmt2->bindParam(':quantity', $quantity);
// 			$stmt2->bindParam(':lot_address', $store_in_address);
// 			$stmt2->bindParam(':barcode_label', $barcode_label);
// 			$stmt2->bindParam(':updated_by', $updated_by);
// 			$stmt2->execute();

// 			echo 'success';
// 		} catch (Exception $e) {
// 			echo 'error';
// 		}
// 	}
// }
