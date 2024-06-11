<?php
include '../conn.php';
// echo 'Connected';

function inventory($date_from, $date_to, $inventory_search, $page_first_result, $results_per_page) {
    global $conn;
    $sql = "SELECT 
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
FROM 
    m_kanban a 
LEFT JOIN (
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
        COUNT(t.partcode) AS Qty 
    FROM 
        t_partsin_history t
    JOIN (
        SELECT 
            partcode, 
            MAX(date_updated) AS latest_date 
        FROM 
            t_partsin_history 
        GROUP BY 
            partcode
    ) AS c ON t.partcode = c.partcode AND t.date_updated = c.latest_date
    GROUP BY 
        t.id, 
        t.qr_code, 
        t.partcode, 
        t.partname, 
        t.packing_quantity, 
        t.lot_address, 
        t.barcode_label, 
        t.updated_by, 
        t.date_updated
) AS b ON a.partcode = b.partcode 
WHERE 
    (b.partcode LIKE :inventory_search OR a.partname LIKE :inventory_search)
    AND b.date_updated BETWEEN :date_from AND :date_to
LIMIT :page_first_result, :results_per_page";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind parameters
$search_term = $inventory_search . '%';
$stmt->bindParam(':inventory_search', $search_term, PDO::PARAM_STR);
$stmt->bindParam(':date_from', $date_from, PDO::PARAM_STR);
$stmt->bindParam(':date_to', $date_to, PDO::PARAM_STR);
$stmt->bindParam(':page_first_result', $page_first_result, PDO::PARAM_INT);
$stmt->bindParam(':results_per_page', $results_per_page, PDO::PARAM_INT);

// Execute the query
$stmt->execute();
    
    // Return the prepared statement object
    return $stmt;
}

function get_inventory( $page_first_result, $results_per_page){
    global $conn;
    $sql = "SELECT 
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
FROM 
    m_kanban a 
LEFT JOIN (
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
        COUNT(t.partcode) AS Qty 
    FROM 
        t_partsin_history t
    JOIN (
        SELECT 
            partcode, 
            MAX(date_updated) AS latest_date 
        FROM 
            t_partsin_history 
        GROUP BY 
            partcode
    ) AS c ON t.partcode = c.partcode AND t.date_updated = c.latest_date
    GROUP BY 
        t.id, 
        t.qr_code, 
        t.partcode, 
        t.partname, 
        t.packing_quantity, 
        t.lot_address, 
        t.barcode_label, 
        t.updated_by, 
        t.date_updated
) AS b ON a.partcode = b.partcode 
LIMIT :page_first_result, :results_per_page";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bindParam(':page_first_result', $page_first_result, PDO::PARAM_INT);
$stmt->bindParam(':results_per_page', $results_per_page, PDO::PARAM_INT);

// Execute the query
$stmt->execute();
    
    // Return the prepared statement object
    return $stmt;
}

?>