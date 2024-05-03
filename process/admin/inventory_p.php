<?php
include '../conn.php';

$method = $_POST['method'];

if($method == 'inventory_list'){
    $c = 0;

    //joined table of store_out & store_in history 
    // $get_history = "SELECT * FROM t_partsin_history ";
    $get_history = "SELECT * FROM t_partsin_history";
    $stmt = $conn->prepare($get_history);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;
			// echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_accounts_details(&quot;'.$j['id'].'~!~'.$j['id_number'].'~!~'.$j['username'].'~!~'.$j['full_name'].'~!~'.$j['password'].'~!~'.$j['section'].'~!~'.$j['role'].'&quot;)">';
				echo '<td><input type="checkbox" name="selected[]" class="selected" id="selected[]" value="'.$j['id'].'" onclick="get_checked_length()"  style="cursor:pointer;"></td>';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['partcode'].'</td>';
				echo '<td>'.$j['partname'].'</td>';
				echo '<td>'.$j['packing_quantity'].'</td>';
				echo '<td>'.$j['lot_address'].'</td>';
				echo '<td>'.$j['barcode_label'].'</td>';
				echo '<td>'.$j['quantity'].'</td>';
				// echo '<td>'.$j['updated_by'].'</td>';
			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}

// counting total rows of t_partsin and t_partsin_history
if($method == 'count_list'){

    // query for joined table of t_partsin and t_partsin_history
    // $count_rows = "SELECT SUM(count) AS total_count FROM 
    // (SELECT COUNT(partcode) AS count FROM t_partsin UNION ALL SELECT COUNT(partcode) 
    // AS count FROM t_partsin_history) AS counts ";
	$count_rows = "SELECT COUNT(partcode) AS count FROM t_partsin_history";
    $total = 0;
    $stmt = $conn->prepare($count_rows);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $total= $result['count'];

    echo $total;
}

//delete arr
if ($method == 'delete_data_arr') {
    $id_arr = [];
    $id_arr = $_POST['id_arr'];

    $count = count($id_arr);
    foreach ($id_arr as $id) {
		$query = "DELETE FROM `t_partsin_history` WHERE id = ?";
		$stmt = $conn -> prepare($query);
		$params = array($id);
		$stmt -> execute($params);
		$count--;
	}

	if ($count == 0) {
		echo 'success';
	}
}

?>