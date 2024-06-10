<?php
include '../conn.php';
// echo 'Connected';

function t_partsin($page_first_result, $results_per_page) {
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
                    t.date_updated
                FROM 
                    t_partsin t
                JOIN (
                    SELECT 
                        partcode, 
                        MAX(date_updated) AS latest_date 
                    FROM 
                        t_partsin 
                    GROUP BY 
                        partcode
                ) AS c ON t.partcode = c.partcode AND t.date_updated = c.latest_date
            ) AS b ON a.partcode = b.partcode
            LIMIT  " . $page_first_result . ", " . $results_per_page;
    
    // Prepare and execute the query with parameters
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Return the prepared statement object
    return $stmt;
}

function t_partsin_search($partsin, $page_first_result, $results_per_page){
    global $conn;
    $query = "SELECT 
    a.partcode,
    a.partname, 
    a.packing_quantity,  
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
INNER  JOIN (
    SELECT 
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
        t_partsin t
    JOIN (
        SELECT 
            partcode, 
            MAX(date_updated) AS latest_date 
        FROM 
            t_partsin 
        GROUP BY 
            partcode
    ) AS c ON t.partcode = c.partcode AND t.date_updated = c.latest_date
    GROUP BY 
        t.qr_code, 
        t.partcode, 
        t.partname, 
        t.packing_quantity, 
        t.lot_address, 
        t.barcode_label, 
        t.updated_by, 
        t.date_updated
) AS b ON a.partcode = b.partcode WHERE a.partname LIKE '$partsin%' OR b.partcode LIKE '$partsin%'; LIMIT " . $page_first_result . ", " . $results_per_page;
$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
$stmt->execute();
return $stmt;
}
?>