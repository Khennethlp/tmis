<?php
include '../conn.php';
// include '../../functions/inventory_query.php';

$method = $_POST['method'];

function count_inv_list($search_arr, $conn)
{
	$query = "SELECT COUNT(DISTINCT t.partcode) AS total 
    FROM t_partsin_history t
    JOIN m_kanban m ON t.partcode = m.partcode
    WHERE t.partcode LIKE :search 
        OR t.partname LIKE :search 
        OR t.packing_quantity LIKE :search 
        OR t.barcode_label LIKE :search 
        OR t.lot_address LIKE :search 
        OR m.partname LIKE :search";

	$stmt = $conn->prepare($query);
	$searchTerm = '%' . $search_arr['search'] . '%';
	$stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	return $result ? $result['total'] : 0;
}

function count_t2($search_arr, $conn)
{
	$query = "SELECT count(qr_code) AS total FROM t_partsin_history WHERE qr_code = '" . $search_arr['get_qr'] . "' ";
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

if ($method == 'count_t2') {
	$get_qr = $_POST['get_qr'];

	$search_arr = array(
		"get_qr" => $get_qr,
	);

	echo count_t2($search_arr, $conn);
}

if ($method == 'count_list') {
	$inv_search = $_POST['inv_search'];

	$search_arr = array(
		"search" => $inv_search,
	);
	echo count_inv_list($search_arr, $conn);
}

if ($method == 'inventory_list') {
	// $inventory_search = $_POST['inventory_search'];
	$current_page = isset($_POST['current_page']) ? max(1, intval($_POST['current_page'])) : 1;
	$c = 0;

	$results_per_page = 10;
	$page_first_result = ($current_page - 1) * $results_per_page;
	$c = $page_first_result;

	echo '<thead>
			<tr>
			<th>#</th>
			<th>Part Code</th>
			<th>Part Name</th>
			<th>Packing Qty</th>
			<th>Stock Address</th>
			<th>Barcode Label</th>
			<th>Quantity</th>
			<th>Date</th>
			</tr>
		</thead>';

	//joined table of m_kanban tbl & partsin tbl
	$query = "SELECT 
    a.partcode,
    a.partname, 
    a.packing_quantity, 
    b.id, 
    b.partcode AS b_partcode,
    b.Qty, 
    b.qr_code, 
    b.lot_address, 
    b.barcode_label, 
    b.packing_quantity AS b_packing_quantity, 
    b.date_updated, 
    b.updated_by 
	FROM m_kanban a INNER JOIN (
		SELECT 
			t.id, 
			t.qr_code, 
			t.partcode, 
			t.partname, 
			t.packing_quantity, 
			t.lot_address, 
			t.barcode_label, 
			t.updated_by, 
			t.date_updated,
			c.Qty
		FROM t_partsin_history t JOIN (
			SELECT 
				partcode, 
				MAX(date_updated) AS latest_date,
				COUNT(*) AS Qty
			FROM t_partsin_history 
			GROUP BY partcode) 
				AS c ON t.partcode = c.partcode AND t.date_updated = c.latest_date) 
				AS b ON a.partcode = b.partcode 
				WHERE b.partcode GROUP BY partcode 
				LIMIT " . $page_first_result . ", " . $results_per_page;

	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL() as $j) {
			$c++;
			echo '<tr style="cursor:pointer;" class="modal-trigger" onclick="load_t_t2(&quot;' . $j['partcode'] . '~!~' . $j['qr_code'] . '&quot;)">';
			echo '<td>' . $c . '</td>';
			echo '<td>' . $j['partcode'] . '</td>';
			echo '<td>' . $j['partname'] . '</td>';
			echo '<td>' . $j['packing_quantity'] . '</td>';
			echo '<td>' . $j['lot_address'] . '</td>';
			echo '<td>' . $j['barcode_label'] . '</td>';
			echo '<td>' . $j['Qty'] . '</td>';
			echo '<td>' . date('Y/M/d', strtotime($j['date_updated'])) . '</td>';
			// echo '<td>' . $j['updated_by'] . '</td>';
			echo '</tr>';
		}
	} else {
		echo '<tr>';
		echo '<td colspan="10" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}

if ($method == 'load_t_t2') {
	$qr_code = $_POST['qr_code'];
	$c = 0;

	echo '<thead>
			<tr>
			<th>#</th>
			<th>Part Code</th>
			<th>Part Name</th>
			<th>Packing Qty</th>
			<th>Stock Address</th>
			<th>Barcode Label</th>
			<th>Date</th>
			</tr>
		</thead>';

	$query = "SELECT a.partcode,a.partname, a.packing_quantity, b.id, b.qr_code, b.lot_address, b.barcode_label, b.date_updated, b.updated_by FROM m_kanban a left join (select id, partcode, qr_code, partname, lot_address, barcode_label, updated_by, date_updated from t_partsin_history) as b ON a.partcode = b.partcode WHERE b.qr_code = '$qr_code'";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$rows = $stmt->fetchAll();

	if (count($rows) > 0) {
		foreach ($rows as $j) {
			$c++;
			echo '<tr>';
			echo '<td>' . $c . '</td>';
			echo '<td>' . $j['partcode'] . '</td>';
			echo '<td>' . $j['partname'] . '</td>';
			echo '<td>' . $j['packing_quantity'] . '</td>';
			echo '<td>' . $j['lot_address'] . '</td>';
			echo '<td>' . $j['barcode_label'] . '</td>';
			echo '<td>' . date('Y/M/d', strtotime($j['date_updated'])) . '</td>';
			echo '</tr>';
		}
	} else {
		echo '<tr>';
		echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}

if ($method == 'inv_pagination') {
	$inv_search =  $_POST['inv_search'];
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
	$date_from = $_POST['date_from'];
	$date_to = $_POST['date_to'];
	$c = 0;

	$current_page = isset($_POST['current_page']) ? max(1, intval($_POST['current_page'])) : 1;
	$results_per_page = 10;
	$page_first_result = ($current_page - 1) * $results_per_page;
	$c = $page_first_result;

	// $query = "SELECT a.partcode,a.partname, a.packing_quantity, b.Qty, b.qr_code, b.lot_address, b.barcode_label, b.date_updated, b.updated_by FROM m_kanban a left join (select id, partcode, qr_code, partname, lot_address, barcode_label, updated_by, date_updated, count(partcode) as Qty from t_partsin_history GROUP by partcode ) as b ON a.partcode = b.partcode  GROUP by partcode ASC LIMIT " . $page_first_result . ", " . $results_per_page;

	$query = "SELECT 
    a.partcode,
    a.partname, 
    a.packing_quantity, 
    b.id, 
    b.partcode AS b_partcode,
    b.Qty, 
    b.qr_code, 
    b.lot_address, 
    b.barcode_label, 
    b.packing_quantity AS b_packing_quantity, 
    b.date_updated, 
		b.updated_by 
	FROM m_kanban a INNER JOIN (
    SELECT 
        t.id, 
        t.qr_code, 
        t.partcode, 
        t.partname, 
        t.packing_quantity, 
        t.lot_address, 
        t.barcode_label, 
        t.updated_by, 
        t.date_updated,
        c.Qty
    FROM t_partsin_history t JOIN (
        SELECT 
            partcode, 
            MAX(date_updated) AS latest_date,
            COUNT(*) AS Qty
        FROM t_partsin_history 
        GROUP BY partcode)
			 AS c ON t.partcode = c.partcode AND t.date_updated = c.latest_date) 
			 AS b ON a.partcode = b.partcode 
			 WHERE (b.partcode LIKE '$inventory_search%' OR a.partname LIKE '$inventory_search%') 
			 OR (DATE(b.date_updated) BETWEEN '$date_from' AND '$date_to') GROUP BY partcode ORDER BY id DESC
			 LIMIT " . $page_first_result . ", " . $results_per_page;

	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();

	if ($stmt->rowCount() > 0) {
		foreach ($stmt->fetchALL(PDO::FETCH_ASSOC) as $j) {
			$c++;
			// echo '<td><input type="checkbox" name="selected[]" class="selected" id="selected[]" value="' . $j['id'] . '" onclick="get_checked_length()"  style="cursor:pointer;"></td>';
			echo '<tr style="cursor:pointer;" class="modal-trigger" onclick="load_t_t2(&quot;' . $j['partcode'] . '~!~' . $j['qr_code'] . '&quot;)">';
			echo '<td>' . $c . '</td>';
			echo '<td>' . $j['partcode'] . '</td>';
			echo '<td>' . $j['partname'] . '</td>';
			echo '<td>' . $j['packing_quantity'] . '</td>';
			echo '<td>' . $j['lot_address'] . '</td>';
			echo '<td>' . $j['barcode_label'] . '</td>';
			echo '<td>' . $j['Qty'] . '</td>';
			echo '<td>' . date('Y/M/d', strtotime($j['date_updated'])) . '</td>';
			// echo '<td>' . $j['updated_by'] . '</td>';
			echo '</tr>';
		}
	} else {
		echo '<tr>';
		echo '<td colspan="10" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}

// if ($method == 'search_by_date') {
// 	$from_date = $_POST['from_date'];
// 	$to_date = $_POST['to_date'];
// 	$c = 0;

// 	$query = "SELECT * FROM t_partsin_history WHERE DATE(date_updated) BETWEEN '$from_date' AND '$to_date'";
// 	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
// 	$stmt->execute();

// 	$result['rows'] = []; // Initialize an array to store rows

// 	if ($stmt->rowCount() > 0) {
// 		foreach ($stmt->fetchAll() as $j) {
// 			$c++;
// 			$result['rows'][] = [
// 				'id' => $j['id'],
// 				'partcode' => $j['partcode'],
// 				'partname' => $j['partname'],
// 				'packing_quantity' => $j['packing_quantity'],
// 				'lot_address' => $j['lot_address'],
// 				'barcode_label' => $j['barcode_label'],
// 				'quantity' => $j['quantity'],
// 				'date_updated' => $j['date_updated'],
// 				'updated_by' => $j['updated_by'],
// 			];
// 		}
// 	}

// 	// Output the total count of rows within the date range
// 	$count_rows = "SELECT COUNT(*) AS total_count FROM t_partsin_history WHERE DATE(date_updated) BETWEEN '$from_date' AND '$to_date'";
// 	$stmt = $conn->prepare($count_rows, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
// 	$stmt->execute();
// 	$count_result = $stmt->fetch(PDO::FETCH_ASSOC);
// 	$result['count'] = $count_result['total_count'];

// 	echo json_encode($result); // Return data as JSON
// }

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
