<?php
include '../conn.php';
include '../login.php';

$method = $_POST['method'];

if ($_POST['method'] == 'partsin_list') {
    $entries = json_decode($_POST['entries'], true);
    $store_in_address = $_POST['store_in_address'];
    $store_in_qr = $_POST['store_in_qr'];
    $c = 0;

    $updated_by = $_SESSION['name'];
    $m_kanban = 'N/A';

    if (!empty($entries)) {
        foreach ($entries as $entry) {
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
            echo '<td> N/A </td>';
            echo '<td>' . $p_qty . '</td>';
            echo '<td>' . $store_in_address . '</td>';
            echo '<td>' . $barcode_label . '</td>';
            echo '</tr>';

        } 
        // Database operations
        try {
            $stmt_check = $conn->prepare("SELECT COUNT(*) FROM t_partsin WHERE partcode = :partscode");
            $stmt_check->bindParam(':partscode', $partscode);
            $stmt_check->execute();
            $count = $stmt_check->fetchColumn();

            if ($count > 0) {
                $update_qty = "UPDATE t_partsin_history ph 
                               INNER JOIN t_partsin tp ON ph.partcode = tp.partcode 
                               SET ph.quantity = ph.quantity + 1
                               WHERE tp.qr_code = :qr_code and tp.partcode = :partcode";
                $stmt = $conn->prepare($update_qty);
                $stmt->bindParam(':qr_code', $qr);
                $stmt->bindParam(':partcode', $partscode);
                $stmt->execute();
            } else {
                $partsinSql = "INSERT INTO t_partsin (qr_code, partcode, partname, packing_quantity, lot_address, barcode_label, updated_by)
                               VALUES (:qr_code, :partcode, :partname, :packing_quantity, :lot_address, :barcode_label, :updated_by)";
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
                                      VALUES (:qr_code, :partcode, :partname, :packing_quantity, :quantity, :lot_address, :barcode_label, :updated_by)";
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
            }
        } catch (Exception $e) {
            echo 'error: ' . $e->getMessage();
        }
    } else {
            // No entries
            echo '<tr>';
            echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
            echo '</tr>';
        }
   
}


// function insertNewRecord($qr, $partscode, $barcode_label, $p_qty, $store_in_address) {
//     global $conn;
    

// }
