<?php
include '../conn.php';
include '../login.php';

$method = $_POST['method'];

if ($_POST['method'] == 'partsin_list') {
    $store_in_entries = json_decode($_POST['store_in_entries'], true);
    $store_in_address = $_POST['store_in_address'];
    $store_in_qr = $_POST['store_in_qr'];
    $c = 0;

    if (!empty($store_in_entries)) {
        foreach ($store_in_entries as $entry) {
            $store_in_address = $entry['store_in_address'];
            $store_in_qr = $entry['store_in_qr'];

            $qr = preg_replace('/\s+/', '', $store_in_qr);
            $barcode_label = substr($qr, 5, 16);
            $partscode = substr($qr, 21, 5);
            $p_qty = substr($qr, 33, 3);

            // Output table rows
            $c++;
            echo '<tr>';
            echo '<td>' . $c . '</td>';
            echo '<td>' . $partscode . '</td>';
            // echo '<td>  </td>';
            echo '<td>' . $p_qty . '</td>';
            echo '<td>' . $store_in_address . '</td>';
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

if ($method == 'insert_partsin') {
    // $entries = json_decode($_POST['entries'], true);
    $store_in_address = $_POST['store_in_address'];
    $store_in_qr = $_POST['store_in_qr'];

    $updated_by = $_SESSION['name'];
    

    $qr = preg_replace('/\s+/', '', $store_in_qr);
    $barcode_label = substr($qr, 5, 16);
    $partscode = substr($qr, 21, 5);
    $p_qty = substr($qr, 33, 3);

    // Database operations
    try {

        $stmt_check = $conn->prepare("SELECT COUNT(*) FROM t_partsin WHERE qr_code = :qr");
        $stmt_check->bindParam(':qr', $qr);
        // $stmt_check->bindParam(':lot_address', $store_in_address);
        $stmt_check->execute();
        $count = $stmt_check->fetchColumn();

        if ($count > 0) {
            echo 'duplicate';
        } else if (strlen($qr) < 59) {
            echo 'invalid';
        } else {
            $get_partname = "SELECT DISTINCT partname FROM m_kanban WHERE partcode = :partscode";
            $stmt = $conn->prepare($get_partname);
            $stmt->bindParam(':partscode', $partscode);
            $stmt->execute();
 
            $data = [];
 			while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
 				$data[] = $res;
 			}
 			foreach ($data as $row) {
				$partname = $row['partname'];
 			}

            $partsin_sql = "INSERT INTO t_partsin (qr_code, partcode, partname, packing_quantity, lot_address, barcode_label, updated_by)
                        VALUES (:qr_code, :partcode, :partname, :packing_quantity, :lot_address, :barcode_label, :updated_by)";
            $stmt1 = $conn->prepare($partsin_sql);
            $stmt1->bindParam(':qr_code', $qr);
            $stmt1->bindParam(':partcode', $partscode);
            $stmt1->bindParam(':partname', $partname);
            $stmt1->bindParam(':packing_quantity', $p_qty);
            $stmt1->bindParam(':lot_address', $store_in_address);
            $stmt1->bindParam(':barcode_label', $barcode_label);
            $stmt1->bindParam(':updated_by', $updated_by);
            $stmt1->execute();

            $partsin_history_sql = "INSERT INTO t_partsin_history (qr_code, partcode, partname, packing_quantity, lot_address, barcode_label, updated_by)
                            VALUES (:qr_code, :partcode, :partname, :packing_quantity, :lot_address, :barcode_label, :updated_by)";
            $stmt2 = $conn->prepare($partsin_history_sql);
            $stmt2->bindParam(':qr_code', $qr);
            $stmt2->bindParam(':partcode', $partscode);
            $stmt2->bindParam(':partname', $partname);
            $stmt2->bindParam(':packing_quantity', $p_qty);
            $stmt2->bindParam(':lot_address', $store_in_address);
            $stmt2->bindParam(':barcode_label', $barcode_label);
            $stmt2->bindParam(':updated_by', $updated_by);
            $stmt2->execute();

            echo 'success';
        }
    } catch (Exception $e) {
        echo 'error: ' . $e->getMessage();
    }
}
