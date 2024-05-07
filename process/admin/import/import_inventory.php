<?php
require_once '../../conn.php'; // Adjust the path as per your file structure

if (isset($_POST['upload'])) {
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            fgetcsv($csvFile); // Skip first line

            $error = 0;
            while (($line = fgetcsv($csvFile)) !== false) {
                // Check if the row is blank or consists only of whitespace
                if (empty(implode('', $line))) {
                    continue; // Skip blank lines
                }

                $id = $line[0];
                $qr_code = $line[1];
                $partcode = $line[2];
                $partname = $line[3];
                $packing_quantity = $line[4];
                $quantity = $line[5];
                $lot_address = $line[6];
                $barcode_label = $line[7];
                $updated_by = $line[8];

                // Form validation
                if (empty($id) || empty($qr_code) || empty($partcode) || empty($partname) || empty($packing_quantity) || empty($quantity) || empty($lot_address) || empty($barcode_label) || empty($updated_by)) {
                    $error++;
                    continue;
                }

                // Prepared statement to prevent SQL injection
                $sql = "INSERT INTO t_partsin_history(qr_code, partcode, partname, packing_quantity, quantity, lot_address, barcode_label, updated_by) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                if ($stmt->execute([$qr_code, $partcode, $partname, $packing_quantity, $quantity, $lot_address, $barcode_label, $updated_by])) {
                    $error = 0;
                } else {
                    $error++;
                }
            }

            fclose($csvFile);

            // Provide feedback to the user
            if ($error == 0) {
                echo '<script>
                        alert("SUCCESS!");
                        location.replace("../../../pages/admin/inventory.php");
                    </script>';
            } else {
                echo '<script>
                        alert("WITH ERROR! # OF ERRORS ' . $error . '");
                        location.replace("../../../pages/admin/inventory.php");
                    </script>';
            }
        } else {
            echo '<script>
                    alert("CSV FILE NOT UPLOADED!");
                    location.replace("../../../pages/admin/inventory.php");
                </script>';
        }
    } else {
        echo '<script>
                alert("INVALID FILE FORMAT!");
                location.replace("../../../pages/admin/inventory.php");
            </script>';
    }
}

// Close database connection
$conn = null;
?>
