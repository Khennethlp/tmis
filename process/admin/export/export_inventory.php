<?php
require '../../conn.php';

$search = isset($_POST['search']) ? $_POST['search'] : '';

$c = 0;
$delimiter = ",";
$datenow = date('Y-m-d');
$filename = "TMIS_Inventory_" . $datenow . ".csv";

// Create a file pointer
$f = fopen('php://memory', 'w');

// Output the UTF-8 BOM for Excel compatibility
fputs($f, "\xEF\xBB\xBF");

// Set column headers
$fields = array('#', 'Part Code', 'Part Name', 'Packing Quantity', 'Quantity');
fputcsv($f, $fields, $delimiter);

// Build query
$query = "SELECT
a.partcode,
a.partname, 
a.packing_quantity, 
b.id, 
b.partcode AS b_partcode,
b.Qty, 
b.qr_code, 
b.lot_address, 
b.barcode_label, 
b.packing_quantity AS b_packing_quantity, 
b.date_updated, 
b.updated_by 
FROM m_kanban a INNER JOIN (
    SELECT 
        t.id, 
        t.qr_code, 
        t.partcode, 
        t.partname, 
        t.packing_quantity, 
        t.lot_address, 
        t.barcode_label, 
        t.updated_by, 
        t.date_updated,
        c.Qty
    FROM t_partsin t JOIN (
        SELECT 
            qr_code, partcode, MAX(date_updated) AS latest_date, COUNT(*) AS Qty FROM t_partsin GROUP BY partcode) AS c ON t.partcode = c.partcode AND t.date_updated = c.latest_date) AS b ON a.partcode = b.partcode ";


if (!empty($search)) {
    $query .= " WHERE a.partcode LIKE '$search%' OR a.partname LIKE  '$search%'";
}

$query .= "GROUP BY b.partcode";

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
            $row['Qty']
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
