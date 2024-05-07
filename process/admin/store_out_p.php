<?php
include '../conn.php';
include '../login.php';

$method = $_POST['method'];

if($method == 'partsout_list'){
	$c = 0;

	$query = "SELECT * FROM t_partsout ORDER BY id DESC";
	$stmt = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		foreach($stmt->fetchALL() as $j){
			$c++;
			// echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_account" onclick="get_accounts_details(&quot;'.$j['id'].'~!~'.$j['id_number'].'~!~'.$j['username'].'~!~'.$j['full_name'].'~!~'.$j['password'].'~!~'.$j['section'].'~!~'.$j['role'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$j['partcode'].'</td>';
				echo '<td>'.$j['partname'].'</td>';
				echo '<td>'.$j['packing_quantity'].'</td>';
				echo '<td>'.$j['lot_address'].'</td>'; // barcode label
				echo '<td>'.$j['barcode_label'].'</td>';
				echo '<td>'.date('Y-M-d', strtotime($j['date_updated'])).'</td>';
				echo '<td>'.$j['updated_by'].'</td>';

			echo '</tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan="6" style="text-align:center; color:red;">No Result !!!</td>';
		echo '</tr>';
	}
}

if($method == 'insert_partsout'){
    
    $updated_by = $_SESSION['name'];
    $store_out_qr = $_POST['store_out_qr'];

    //remove white spaces
    $qr = preg_replace('/\s+/', '', $store_out_qr);

    //get from the $qr
    $partscode = substr($qr, 21, 5 );
    $barcode_label = substr( $qr, 5, 16 );
    $qty = substr($qr, 33, 3 );

	 // Check if the data already exists in t_partsout
	$stmt_duplicate = "SELECT COUNT(*) AS count FROM t_partsout WHERE qr_code = :qr ";
	$stmt_duplicate = $conn->prepare($stmt_duplicate);
	$stmt_duplicate->bindParam(':qr', $qr);
	$stmt_duplicate->execute();
	$count = $stmt_duplicate->fetchColumn();
	
	if($count > 0){
        echo 'duplicate';
    }else{
		try{
			
			$select = "SELECT * FROM t_partsin WHERE partcode= '$partscode'";
			$stmt = $conn->prepare($select);
			$stmt->execute();
		
			$data = [];
			while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
				$data[] = $res;
			}
			foreach ($data as $row) {
				// Access 'partcode' and 'partname' columns for each row
			//    $id = $row['id'];
			   $lot_address = $row['lot_address'];
			}
		
			$conn->beginTransaction();
		
			//delete query
			// $del_qry = "DELETE FROM t_partsin WHERE partcode='$partscode'";
			// $del = $conn->prepare($del_qry);
			// $del->execute();

			$check_in = "SELECT COUNT(*) FROM t_partsin WHERE partcode='$partscode'";
			$stmt = $conn->prepare($check_in);
			$stmt->execute();
			$count_in = $stmt->fetchColumn();

		    if ($count_in > 0) {
				// Data exists in t_partsin, perform deletion
				$del_qry = "DELETE FROM t_partsin WHERE partcode = :partscode";
				$del_stmt = $conn->prepare($del_qry);
				$del_stmt->bindParam(':partscode', $partscode);
				$del_stmt->execute();
			} else {
				// Data not found in t_partsin, echo 'undefined' and rollback transaction
				echo 'undefined';
				$conn->rollBack();
				exit(); // Exit the script as no further action is needed
			}

				 // Data doesn't exist in t_partsin, perform insertion into t_partsout
				 //$lot_address = ''; // Define lot_address
				 $partsin_sql = "INSERT INTO t_partsout (qr_code, partcode, partname, packing_quantity, lot_address, barcode_label, updated_by)
								 VALUES (:qr, :partscode, 'N/A', :qty, :lot_address, :barcode_label, :updated_by)";
				 $stmt3 = $conn->prepare($partsin_sql);
				 $stmt3->bindParam(':qr', $qr);
				 $stmt3->bindParam(':partscode', $partscode);
				 $stmt3->bindParam(':qty', $qty);
				 $stmt3->bindParam(':lot_address', $lot_address);
				 $stmt3->bindParam(':barcode_label', $barcode_label);
				 $stmt3->bindParam(':updated_by', $updated_by);
				 $stmt3->execute();
			
				echo 'success';
			
		
			$conn->commit();

		}catch(Exception $e){
			echo 'error: ' . $e->getMessage();
		}
    }
	
}
?>