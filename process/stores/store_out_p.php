<?php
include '../conn.php';
include '../login.php';

$method = $_POST['method'];

if ($_POST['method'] == 'partsout_list') {
    $entries = json_decode($_POST['entries'], true);
	// $store_out_qr = $_POST['store_out_qr'];

    $updated_by = $_SESSION['name'];
    $c = 0;  // Initialize $c to avoid undefined variable error

    if (!empty($entries)) {
		ob_start(); // Start output buffering
        foreach ($entries as $entry) {
            $store_out_qr = $entry['store_out_qr'];

            // Remove white spaces
            $qr = preg_replace('/\s+/', '', $store_out_qr);

            // Get values from the $qr
            $partscode = substr($qr, 21, 5);
            $barcode_label = substr($qr, 5, 16);
            $qty = substr($qr, 33, 3);

            // Output table rows
            $c++;
            echo '<tr>';
            echo '<td>' . $c . '</td>';
            echo '<td>' . $partscode . '</td>';
            echo '<td> N/A </td>';
            echo '<td>' . $qty . '</td>';
            echo '<td>' . 'N/A' . '</td>'; // Placeholder for store_in_address
            echo '<td>' . $barcode_label . '</td>';
            echo '</tr>';

            // try {
            //     // Check if the data already exists in t_partsout
            //     $stmt_duplicate = $conn->prepare("SELECT COUNT(*) AS count FROM t_partsout WHERE qr_code = :qr");
            //     $stmt_duplicate->bindParam(':qr', $qr);
            //     $stmt_duplicate->execute();
            //     $count = $stmt_duplicate->fetchColumn();

            //     if ($count > 0) {
            //         echo 'duplicate';
            //     } else {
            //         try {
            //             // Select from t_partsin
            //             $stmt = $conn->prepare("SELECT * FROM t_partsin WHERE partcode = :partscode");
            //             $stmt->bindParam(':partscode', $partscode);
            //             $stmt->execute();

            //             $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //             if (empty($data)) {
            //                 echo 'undefined';
            //                 continue; // Skip to the next iteration
            //             }

            //             $lot_address = $data[0]['lot_address'];

            //             $conn->beginTransaction();

            //             // Delete from t_partsin
            //             $del_stmt = $conn->prepare("DELETE FROM t_partsin WHERE partcode = :partscode");
            //             $del_stmt->bindParam(':partscode', $partscode);
            //             $del_stmt->execute();

            //             // Insert into t_partsout
            //             $partsin_sql = "INSERT INTO t_partsout (qr_code, partcode, partname, packing_quantity, lot_address, barcode_label, updated_by)
            //                             VALUES (:qr, :partscode, 'N/A', :qty, :lot_address, :barcode_label, :updated_by)";
            //             $stmt3 = $conn->prepare($partsin_sql);
            //             $stmt3->bindParam(':qr', $qr);
            //             $stmt3->bindParam(':partscode', $partscode);
            //             $stmt3->bindParam(':qty', $qty);
            //             $stmt3->bindParam(':lot_address', $lot_address);
            //             $stmt3->bindParam(':barcode_label', $barcode_label);
            //             $stmt3->bindParam(':updated_by', $updated_by);
            //             $stmt3->execute();

            //             // Update quantity in t_partsin_history
            //             $update_qty = "UPDATE t_partsin_history SET quantity = quantity - 1 WHERE qr_code = :qr_code AND partcode = :partscode";
            //             $stmt_update = $conn->prepare($update_qty);
            //             $stmt_update->bindParam(':qr_code', $qr);
            //             $stmt_update->bindParam(':partscode', $partscode);
            //             $stmt_update->execute();

            //             echo 'success';
            //             $conn->commit();
            //         } catch (Exception $e) {
            //             $conn->rollBack();
            //             echo 'error: ' . $e->getMessage();
            //         }
            //     }
            // } catch (Exception $e) {
            //     echo 'error: ' . $e->getMessage();
            // }
        }
			$response = ob_get_clean(); // Get the buffered output
            echo $response; // Output the table rows
    } else {
        // No entries
        echo '<tr>';
        echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
        echo '</tr>';
    }
}

