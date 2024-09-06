<?php
include '../conn.php';
// include '../../functions/inventory_query.php';

$method = $_POST['method'];

function count_inv_list($search_arr, $conn)
{
	$query = "SELECT COUNT(DISTINCT t.partcode) AS total 
    FROM t_partsin t
    JOIN m_kanban m ON t.partcode = m.partcode
    WHERE t.partcode LIKE :search 
        OR t.partname LIKE :search 
       
        OR t.barcode_label LIKE :search 
        OR t.lot_address LIKE :search 
        OR m.packing_quantity LIKE :search
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
	$query = "SELECT count(partcode) AS total FROM t_partsin WHERE partcode = '" . $search_arr['get_partcode'] . "' ";
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
	$get_partcode = $_POST['get_partcode'];

	$search_arr = array(
		"get_partcode" => $get_partcode,
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
	$search = $_POST['search'];
	$current_page = isset($_POST['current_page']) ? max(1, intval($_POST['current_page'])) : 1;

	$c = 0;
	$results_per_page = 50;
	$page_first_result = ($current_page - 1) * $results_per_page;
	$c = $page_first_result;

	echo '<thead id="thead_inv">
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
		FROM t_partsin t JOIN (
			SELECT 
				partcode, 
				MAX(date_updated) AS latest_date,
				COUNT(*) AS Qty
			FROM t_partsin
			GROUP BY partcode) 
				AS c ON t.partcode = c.partcode AND t.date_updated = c.latest_date) 
				AS b ON a.partcode = b.partcode 
				WHERE 1=1 ";

	if(!empty($search)){
		$query .= " AND a.partcode LIKE :search";
	}
	$query .= "GROUP BY partcode ORDER BY id DESC LIMIT " . $page_first_result . ", " . $results_per_page;

	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	
	if (!empty($search)) {
		$stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
	}

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
			echo '<td>' . date('Y/m/d', strtotime($j['date_updated'])) . '</td>';
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
	$partcode = $_POST['partcode'];
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

	$query = "SELECT a.partcode,a.partname, a.packing_quantity, b.id, b.qr_code, b.lot_address, b.barcode_label, b.date_updated, b.updated_by FROM m_kanban a left join (select id, partcode, qr_code, partname, lot_address, barcode_label, updated_by, date_updated from t_partsin ) as b ON a.partcode = b.partcode WHERE b.partcode = '$partcode' ";
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
			echo '<td>' . date('Y/m/d', strtotime($j['date_updated'])) . '</td>';
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

	$results_per_page = 50;
	$number_of_result = intval(count_inv_list($search_arr, $conn));
	$number_of_page = ceil($number_of_result / $results_per_page);

	for ($page = 1; $page <= $number_of_page; $page++) {
		echo '<option value="' . $page . '">' . $page . '</option>';
	}
}

if ($method == 'inventory_search') {
	$inventory_search = $_POST['inventory_search'];
	// $date_from = $_POST['date_from'];
	// $date_to = $_POST['date_to'];
	$c = 0;

	echo '<thead id="thead_inv">
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
	
	$current_page = isset($_POST['current_page']) ? max(1, intval($_POST['current_page'])) : 1;
	$results_per_page = 50;
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
    FROM t_partsin t JOIN (
        SELECT 
            partcode, 
            MAX(date_updated) AS latest_date,
            COUNT(*) AS Qty
        FROM t_partsin 
        GROUP BY partcode)
			 AS c ON t.partcode = c.partcode AND t.date_updated = c.latest_date) 
			 AS b ON a.partcode = b.partcode 
			 WHERE (b.partcode LIKE '$inventory_search%' OR a.partname LIKE '$inventory_search%' OR b.lot_address LIKE '$inventory_search%') 
			 GROUP BY partcode ORDER BY id DESC
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
			echo '<td>' . date('Y/m/d', strtotime($j['date_updated'])) . '</td>';
			// echo '<td>' . $j['updated_by'] . '</td>';
			echo '</tr>';
		}
	} else {
		echo '<tr>';
		echo '<td colspan="10" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}

