<?php
require '../../conn.php';

$partcode = isset($_POST['partcode']) ? $_POST['partcode'] : '';

$c = 0;
$delimiter = ",";
$datenow = date('Y-m-d');
$filename = "TMIS_Inventory_". $partcode . "_" . $datenow . ".csv";

// Create a file pointer
$f = fopen('php://memory', 'w');

// Output the UTF-8 BOM for Excel compatibility
fputs($f, "\xEF\xBB\xBF");

// Set column headers
$fields = array('#', 'Part Code', 'Part Name', 'Packing Quantity', 'Stock Address', 'Barcode Label', 'Date');
fputcsv($f, $fields, $delimiter);

// Build query
$query = "SELECT a.partcode,a.partname, a.packing_quantity, b.id, b.qr_code, b.lot_address, b.barcode_label, b.date_updated, b.updated_by FROM m_kanban a left join (select id, partcode, qr_code, partname, lot_address, barcode_label, updated_by, date_updated from t_partsin ) as b ON a.partcode = b.partcode WHERE b.partcode = '$partcode' ";

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
            $row['lot_address'],
            $row['barcode_label'],
            date('Y-m-d', strtotime($row['date_updated'])),
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
