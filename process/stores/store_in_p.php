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
