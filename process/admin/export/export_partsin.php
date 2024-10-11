<?php
require '../../conn.php';

$search = isset($_POST['search']) ? $_POST['search'] : '';

$c = 0;
$delimiter = ",";
$datenow = date('Y-m-d');
$filename = "TMIS_StoreIn_" . $datenow . ".csv";

// Create a file pointer
$f = fopen('php://memory', 'w');

// Output the UTF-8 BOM for Excel compatibility
fputs($f, "\xEF\xBB\xBF");

// Set column headers
$fields = array('#', 'Part Code', 'Part Name', 'Packing Quantity', 'Stock Address', 'Barcode Label', 'Date');
fputcsv($f, $fields, $delimiter);

// Build query
$query = "SELECT * FROM t_partsin";
if (!empty($search)) {
    $query .= " WHERE partcode LIKE :search OR partname LIKE :search";
}
$query .= " ORDER BY id DESC";

$stmt = $conn->prepare($query);

if (!empty($search)) {
    // Bind the search term with wildcards for LIKE
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
}

$stmt->execute();

// Fetch data and write to CSV
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $c++;

    foreach ($row as $key => $value) {
        $row[$key] = str_replace(["\r", "\n"], " ", $value);
    }

    // Prepare data for CSV
    $lineData = array(
        $c,
        $row['partcode'],
        $row['partname'],
        $row['packing_quantity'],
        $row['lot_address'],
        $row['barcode_label'],
        date('Y-m-d', strtotime($row['date_updated'])),
    );
    fputcsv($f, $lineData, $delimiter);
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
?>
