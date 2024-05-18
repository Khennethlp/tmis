<?php
require_once '../../conn.php'; 

if(isset($_GET['q'])){
    $search = $_GET['q'];
    // $to_d = $_GET['date_to'];

    if (!empty($search)) {
        // If $search is not empty, filter by partcode
        $get_search = "SELECT * FROM t_partsin WHERE partcode = '$search%'";
        $stmt = $conn->prepare($get_search);
    } else {
        // If $search is empty, fetch all records
        $get_search = "SELECT * FROM t_partsin";
        $stmt = $conn->prepare($get_search);
    }
    
    $stmt->execute();
    $c = 0;
    if ($stmt->rowCount() > 0) {

        echo '<div class="table-responsive">';
        echo '<table class="table table-striped table-bordered">';
        echo '<thead class="thead-dark">';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Part Code</th>';
        echo '<th>Part Name</th>';
        echo '<th>Packing Quantity</th>';
        echo '<th>Lot Address</th>';
        echo '<th>Barcode Label</th>';
        echo '<th>Quantity</th>';
        echo '<th>Date Updated</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        
        foreach($stmt->fetchAll() as $j){
            $c++;
            echo '<tr>';
            echo '<td>'.$c.'</td>';
            echo '<td>'.$j['partcode'].'</td>';
            echo '<td>'.$j['partname'].'</td>';
            echo '<td>'.$j['packing_quantity'].'</td>';
            echo '<td>'.$j['lot_address'].'</td>';
            echo '<td>'.$j['barcode_label'].'</td>';
            echo '<td>'.$j['quantity'].'</td>';
            echo '<td>'.date('Y-M-d', strtotime($j['date_updated'])).'</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p style="text-align:center; color:red;">No Result !!!</p>';
    }
}
?>
<script>
    window.print();
</script>
