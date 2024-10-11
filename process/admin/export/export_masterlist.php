<?php
require '../../conn.php';

$mlist_search = isset($_POST['search']) ? $_POST['search'] : '';

$c = 0;
$delimiter = ",";
$datenow = date('Y-m-d');
$filename = "TMIS_Masterlist_" . $datenow . ".csv";

// Create a file pointer
$f = fopen('php://memory', 'w');

// Output the UTF-8 BOM for Excel compatibility
fputs($f, "\xEF\xBB\xBF");

// Set column headers
$fields = array('#', 'Part Code', 'Part Name', 'Packing Quantity');
fputcsv($f, $fields, $delimiter);

// Build query
$query = "SELECT * FROM m_kanban WHERE partcode LIKE '$mlist_search%' OR partname LIKE '$mlist_search%' OR packing_quantity LIKE '$mlist_search%'";

$stmt = $conn->prepare($query);
$stmt->execute();

// Fetch data and write to CSV
if ($stmt->rowCount() > 0) {
    foreach ($stmt->fetchALL(PDO::FETCH_ASSOC) as $row) {
        $c++;

        // Prepare data for CSV
        $lineData = array(
            $c,
            $row['partcode'],
            $row['partname'],
            $row['packing_quantity'],
        );
        fputcsv($f, $lineData, $delimiter);
    }
}

// Move back to the beginning of the file
fseek($f, 0);

// Set headers for download
header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="' . $filename . '";');
header('Pragma: no-cache');
header('Expires: 0');

// Output all remaining data on a file pointer
fpassthru($f);

// Close the file pointer
fclose($f);

// Close the connection
$conn = null;
exit;
