<?php
include '../conn.php';
include '../login.php';

$method = isset($_POST['method']) ? $_POST['method'] : '';

if ($method == 'partsout_list') {
    $store_out_entries = json_decode($_POST['store_out_entries'], true);
    $store_in_entries = json_decode($_POST['store_in_entries'], true);

    $store_out_qr = $_POST['store_out_qr'];

    $stock_address = 'N/A';
    if (!empty($store_in_entries) && !empty($store_out_entries)) {
        foreach ($store_out_entries as &$out_entry) {
            $store_out_qr = $out_entry['store_out_qr'];
            foreach ($store_in_entries as $in_entry) {
                if ($store_out_qr === $in_entry['store_in_qr']) {
                    $out_entry['store_in_address'] = $in_entry['store_in_address'];
                }
            }
        }
    }

    $updated_by = $_SESSION['name'];
    $c = 0;  // Initialize $c to avoid undefined variable error

    if (!empty($store_out_entries)) {
        foreach ($store_out_entries as $entry) {
            $store_out_qr = $entry['store_out_qr'];
            $stock_address = isset($entry['store_in_address']) ? $entry['store_in_address'] : ' ';

            // Remove white spaces
            $qr = preg_replace('/\s+/', '', $store_out_qr);

            // Get values from the $qr
            $partscode = substr($qr, 21, 5);
            $barcode_label = substr($qr, 5, 16);
            $qty = substr($qr, 33, 3); //packing_quantity

            // Output table rows
            $c++;
            echo '<tr>';
            echo '<td>' . $c . '</td>';
            echo '<td>' . $partscode . '</td>';
            // echo '<td> N/A </td>';
            echo '<td>' . $qty . '</td>';
            echo '<td>' . $stock_address. '</td>'; // Placeholder for store_in_address
            echo '<td>' . $barcode_label . '</td>';
            echo '</tr>';
        } 
    } else {
        // No entries
        echo '<tr>';
        echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
        echo '</tr>';
    }

}

if($method == 'insert_partsout'){
    $store_out_qr = $_POST['store_out_qr'];
    $updated_by = $_SESSION['name'];

    //remove white spaces
	$qr = preg_replace('/\s+/', '', $store_out_qr);

    //get from the $qr
	$partscode = substr($qr, 21, 5);
	$barcode_label = substr($qr, 5, 16);
	$qty = substr($qr, 33, 3);

    // Check if the data already exists in t_partsout
	$stmt_duplicate = "SELECT COUNT(*) AS count FROM t_partsout WHERE qr_code = :qr ";
	$stmt_duplicate = $conn->prepare($stmt_duplicate, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt_duplicate->bindParam(':qr', $qr);
	$stmt_duplicate->execute();
	$count = $stmt_duplicate->fetchColumn();

    if ($count > 0) {

        // $del_qry = "DELETE FROM t_partsin_history WHERE qr_code = :qr LIMIT 1";
        // $del_stmt = $conn->prepare($del_qry);
        // $del_stmt->bindParam(':qr', $qr);
        // $del_stmt->execute();

		echo 'duplicate';
	}else {
        try{
            $select = "SELECT * FROM t_partsin WHERE qr_code= :qr";
			$stmt = $conn->prepare($select, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->bindParam(':qr', $qr);
			$stmt->execute();

			$data = [];
			while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $res;
			}
			foreach ($data as $row) {
				// $partsname = $row['partname'];
				$lot_address = $row['lot_address'];
			}
            
            $conn->beginTransaction();

            $check_store_in = "SELECT COUNT(*) AS count FROM t_partsin WHERE qr_code = :qr";
            $stmt = $conn->prepare($check_store_in);
            $stmt->bindParam(':qr', $qr);
            $stmt->execute();
            $count_store_out = $stmt->fetchColumn();

            if ($count_store_out > 0) {
                // Data exists in t_partsin, perform deletion
                $del_qry = "DELETE FROM t_partsin WHERE qr_code = :qr LIMIT 1";
                $del_stmt = $conn->prepare($del_qry);
                $del_stmt->bindParam(':qr', $qr);
                $del_stmt->execute();
            }else {
                echo 'undefined';
				$conn->rollBack();
				exit();
            }

            $partnames = 'N/A';
            $partsin_sql = "INSERT INTO t_partsout (qr_code, partcode, partname, packing_quantity, lot_address, barcode_label, updated_by)
            VALUES (:qr, :partscode, :partsname, :qty, :lot_address, :barcode_label, :updated_by)";
            $stmt3 = $conn->prepare($partsin_sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt3->bindParam(':qr', $qr);
            $stmt3->bindParam(':partscode', $partscode);
            $stmt3->bindParam(':partsname', $partnames);
            $stmt3->bindParam(':qty', $qty);
            $stmt3->bindParam(':lot_address', $lot_address);
            $stmt3->bindParam(':barcode_label', $barcode_label);
            $stmt3->bindParam(':updated_by', $updated_by);
            $stmt3->execute();

            echo 'success';
            $conn->commit();
        }catch(Exception $e){
            echo 'error: ' . $e->getMessage();
        }
    }
}
