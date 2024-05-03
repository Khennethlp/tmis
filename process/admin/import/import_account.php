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
                $emp_id = $line[1];
                $fullname = $line[2];
                $username = $line[3];
                $role = $line[4];

                // Form validation
                if (empty($id) || empty($emp_id) || empty($fullname) || empty($username) || empty($role)) {
                    $error++;
                    continue;
                }

                // Prepared statement to prevent SQL injection
                $sql = "INSERT INTO m_accounts (emp_id, fullname, username, role) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                if ($stmt->execute([$emp_id, $fullname, $username, $role])) {
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
                        location.replace("../../../pages/admin/accounts.php");
                    </script>';
            } else {
                echo '<script>
                        alert("WITH ERROR! # OF ERRORS ' . $error . '");
                        location.replace("../../../pages/admin/accounts.php");
                    </script>';
            }
        } else {
            echo '<script>
                    alert("CSV FILE NOT UPLOADED!");
                    location.replace("../../../pages/admin/accounts.php");
                </script>';
        }
    } else {
        echo '<script>
                alert("INVALID FILE FORMAT!");
                location.replace("../../../pages/admin/accounts.php");
            </script>';
    }
}

// Close database connection
$conn = null;
?>
