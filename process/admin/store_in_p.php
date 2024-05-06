<?php
include '../conn.php';
include '../login.php';

$method = $_POST['method'];

if($method == 'partsin_list'){
	$c = 0;

	$query = "SELECT * FROM t_partsin_history ORDER BY id DESC";
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;
			// echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_accounts_details(&quot;'.$j['id'].'~!~'.$j['id_number'].'~!~'.$j['username'].'~!~'.$j['full_name'].'~!~'.$j['password'].'~!~'.$j['section'].'~!~'.$j['role'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['partcode'].'</td>';
				echo '<td>'.$j['partname'].'</td>';
				echo '<td>'.$j['packing_quantity'].'</td>';
				echo '<td>'.$j['lot_address'].'</td>';
				echo '<td>'.$j['barcode_label'].'</td>';
				echo '<td>'.$j['updated_by'].'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}

if($method == 'insert_partsin'){
    
    $updated_by = $_SESSION['name'];
	$store_in_qr = $_POST['store_in_qr'];
	$store_in_address = $_POST['store_in_address'];
	$m_kanban = 'N/A';

    $qr = preg_replace('/\s+/', '', $store_in_qr);

	$barcode_label = substr( $qr, 5, 16 );
    $partscode = substr($qr, 21, 5 );
    $p_qty = substr($qr, 33, 3 );

    $stmt_check = "SELECT COUNT(*) FROM t_partsin WHERE partcode = :partcode";
    $stmt_check = $conn->prepare($stmt_check);
    $stmt_check->bindParam(':partcode', $partscode);
    $stmt_check->execute();
    $count = $stmt_check->fetchColumn();

    // $quantity = 0;
    if ($count > 0) {
        $update_qty = "UPDATE t_partsin_history ph INNER JOIN t_partsin tp ON ph.partcode = tp.partcode SET ph.quantity = ph.quantity + 1 WHERE tp.qr_code = :qr_code";
        $stmt = $conn->prepare($update_qty);
        $stmt->bindParam(':qr_code', $qr);
        $stmt->execute();

        echo 'success';
    }else{
        try{
            // Data does not exist in t_partsin, insert into both t_partsin and t_partsin_history
            $partsinSql = "INSERT INTO t_partsin (qr_code, partcode, partname, packing_quantity, lot_address, barcode_label, updated_by)
            VALUES (:qr_code, :partcode, :partname, :packing_quantity, :lot_address, :barcode_label, :updated_by) ";
            $stmt1 = $conn->prepare($partsinSql);
            $stmt1->bindParam(':qr_code', $qr);
            $stmt1->bindParam(':partcode', $partscode);
            $stmt1->bindParam(':partname', $m_kanban);
            $stmt1->bindParam(':packing_quantity', $p_qty);
            $stmt1->bindParam(':lot_address', $store_in_address);
            $stmt1->bindParam(':barcode_label', $barcode_label);
            $stmt1->bindParam(':updated_by', $updated_by);
            $stmt1->execute();

            $quantity = 1;
            $partsinHistorySql = "INSERT INTO t_partsin_history (qr_code, partcode, partname, packing_quantity, quantity, lot_address, barcode_label, updated_by)
            VALUES (:qr_code, :partcode, :partname, :packing_quantity, :quantity, :lot_address, :barcode_label, :updated_by) ";
            $stmt2 = $conn->prepare($partsinHistorySql);
            $stmt2->bindParam(':qr_code', $qr);
            $stmt2->bindParam(':partcode', $partscode);
            $stmt2->bindParam(':partname', $m_kanban);
            $stmt2->bindParam(':packing_quantity', $p_qty);
            $stmt2->bindParam(':quantity', $quantity);
            $stmt2->bindParam(':lot_address', $store_in_address);
            $stmt2->bindParam(':barcode_label', $barcode_label);
            $stmt2->bindParam(':updated_by', $updated_by);
            $stmt2->execute();
            
            echo 'success';

        }catch(Exception $e){
            echo 'error';
        }
    }
}
?>