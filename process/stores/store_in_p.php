<?php
include '../conn.php';
include '../login.php';

$method = $_POST['method'];

function count_partsin($conn)
{
    $query = "SELECT COUNT(id) AS total FROM t_partsin";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $total = $stmt->fetchColumn();
    return $total;
}

if ($method == 'count_partsin_list') {
    echo count_partsin($conn);
}

if ($method == 'partsin_list') {
    $current_page = isset($_POST['current_page']) ? max(1, intval($_POST['current_page'])) : 1;
    $c = 0;

    $results_per_page = 10;
    $page_first_result = ($current_page - 1) * $results_per_page;
    $c = $page_first_result;

    $query = "SELECT * FROM t_partsin ORDER BY id DESC LIMIT " . $page_first_result . ", " . $results_per_page;
    $stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        foreach ($stmt->fetchAll() as $j) {
            $c++;
            echo '<tr>';
            echo '<td>' . $c . '</td>';
            echo '<td>' . $j['partcode'] . '</td>';
            echo '<td>' . $j['partname'] . '</td>';
            echo '<td>' . $j['packing_quantity'] . '</td>';
            echo '<td>' . $j['lot_address'] . '</td>';
            echo '<td>' . $j['barcode_label'] . '</td>';
            echo '<td>' . date('Y-M-d', strtotime($j['date_updated'])) . '</td>';
            echo '<td>' . $j['updated_by'] . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr>';
        echo '<td colspan="8" style="text-align:center; color:red;">No Result !!!</td>';
        echo '</tr>';
    }
}

if ($method == 'insert_partsin') {

    $updated_by = $_SESSION['name'];
    $store_in_qr = $_POST['store_in_qr'];
    $store_in_address = isset($_POST['store_in_address']) ? $_POST['store_in_address'] : 'N/A';
    $m_kanban = 'N/A';

    $qr = preg_replace('/\s+/', '', $store_in_qr);

    $barcode_label = substr($qr, 5, 16);
    $partscode = substr($qr, 21, 5);
    $p_qty = substr($qr, 33, 3);

    $stmt_check = "SELECT COUNT(*) FROM t_partsin WHERE partcode = :partcode";
    $stmt_check = $conn->prepare($stmt_check, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
    $stmt_check->bindParam(':partcode', $partscode);
    $stmt_check->execute();
    $count = $stmt_check->fetchColumn();

    if ($count > 0) {
        // Check if a record with the same partcode and date today exists in t_partsin_history
        $stmt_date_check = $conn->prepare("SELECT COUNT(*) FROM t_partsin_history WHERE partcode = :partcode AND date_updated = CURDATE()", array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
        $stmt_date_check->bindParam(':partcode', $partscode);
        $stmt_date_check->execute();
        $date_count = $stmt_date_check->fetchColumn();

        if ($date_count > 0) {
            //if partcode and date today exists, quantity + 1
            $update_qty = "UPDATE t_partsin_history ph INNER JOIN t_partsin tp ON ph.partcode = tp.partcode SET ph.quantity = ph.quantity + 1 WHERE tp.qr_code = :qr_code";
            $stmt = $conn->prepare($update_qty, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->bindParam(':qr_code', $qr);
            $stmt->execute();
        } else {
            // If no record with the same partcode and date exists, insert a new record with quantity = 1
            $quantity = 1;
            $partsinHistorySql = "INSERT INTO t_partsin_history (qr_code, partcode, partname, packing_quantity, quantity, lot_address, barcode_label, updated_by)
            VALUES (:qr_code, :partcode, :partname, :packing_quantity, :quantity, :lot_address, :barcode_label, :updated_by) ";
            $stmt2 = $conn->prepare($partsinHistorySql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
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
        echo 'success';
    } else {
        try {
            // Data does not exist in t_partsin, insert into both t_partsin and t_partsin_history
            $partsinSql = "INSERT INTO t_partsin (qr_code, partcode, partname, packing_quantity, lot_address, barcode_label, updated_by)
            VALUES (:qr_code, :partcode, :partname, :packing_quantity, :lot_address, :barcode_label, :updated_by) ";
            $stmt1 = $conn->prepare($partsinSql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
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
            $stmt2 = $conn->prepare($partsinHistorySql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
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
        } catch (Exception $e) {
            echo 'error';
        }
    }
}
