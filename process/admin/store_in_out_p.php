<?php
// session_start();
include '../conn.php';
include '../login.php';

// echo $name = $_SESSION['name'];
// $method = $_POST['method'];

if(isset($_POST['submit_qr'])){
	$updated_by = $_SESSION['name'];
	$store_in_qr = $_POST['store_in_qr'];
	$kanban_partnames = $_POST['kanban_partnames'];

	$qr = preg_replace('/\s+/', '', $store_in_qr);

	$loc_add = substr( $qr, 5, 16 );
    $partscode = substr($qr, 21, 5 );
    $qty = substr($qr, 33, 3 );

	   // Check if the data already exists in t_partsin
	   $selectSql = "SELECT COUNT(*) AS count FROM t_partsin WHERE qr_code = '$qr'";
	   $selectStmt = $conn->prepare($selectSql);
	   $selectStmt->execute();
	   $row = $selectStmt->fetch(PDO::FETCH_ASSOC);
	   $count = $row['count'];
   
   if ($count == 0) {
	   // Data does not exist in t_partsin, insert into both t_partsin and t_partsin_history
	   $partsinSql = "INSERT INTO t_partsin (qr_code, partcode, partname, packing_quantity, lot_address, updated_by)
		   VALUES (:qr_code, :partcode, :partname, :packing_quantity, :lot_address, :updated_by) ";
	   $stmt1 = $conn->prepare($partsinSql);
	   $stmt1->bindParam(':qr_code', $qr);
	   $stmt1->bindParam(':partcode', $partscode);
	   $stmt1->bindParam(':partname', $kanban_partnames);
	   $stmt1->bindParam(':packing_quantity', $qty);
	   $stmt1->bindParam(':lot_address', $loc_add);
	   $stmt1->bindParam(':updated_by', $updated_by);
	   $stmt1->execute();
   
	   $partsinHistorySql = "INSERT INTO t_partsin_history (qr_code, partcode, partname, packing_quantity, lot_address, updated_by)
		   VALUES (:qr_code, :partcode, :partname, :packing_quantity, :lot_address, :updated_by) ";
	   $stmt2 = $conn->prepare($partsinHistorySql);
	   $stmt2->bindParam(':qr_code', $qr);
	   $stmt2->bindParam(':partcode', $partscode);
	   $stmt2->bindParam(':partname', $kanban_partnames);
	   $stmt2->bindParam(':packing_quantity', $qty);
	   $stmt2->bindParam(':lot_address', $loc_add);
	   $stmt2->bindParam(':updated_by', $updated_by);
	   $stmt2->execute();
   
	   if ($stmt1 && $stmt2) {
		   header('location: ../../index.php');
	   }
   } else {
	   // Data already exists in t_partsin, do not insert
	//    echo "Data already exists";
		$_SESSION['status'] = 'error';
		$_SESSION['msg'] = 'Data already exists.';
		header('location: ../../pages/admin/index.php');
   }
}

if(isset($_POST['del_qr'])){
	$updated_by = $_SESSION['name'];
    $store_out_qr = $_POST['store_out_qr'];

    //remove white spaces
    $qr = preg_replace('/\s+/', '', $store_out_qr);

    //get from the $qr
    $partscode = substr($qr, 21, 5 );
    // $loc_add = substr( $qr, 5, 16 );
    $qty = substr($qr, 33, 3 );

	 // Check if the data already exists in t_partsout
	$stmt_duplicate = "SELECT COUNT(*) AS count FROM t_partsout WHERE qr_code = :qr";
	$stmt_duplicate = $conn->prepare($stmt_duplicate);
	$stmt_duplicate->bindParam(':qr', $qr);
	$stmt_duplicate->execute();
	$count = $stmt_duplicate->fetchColumn();
	
	if($count > 0){
		try{
			
			$select = "SELECT * FROM t_partsin WHERE qr_code= '$qr'";
			$stmt = $conn->prepare($select);
			$stmt->execute();
		
			$data = [];
			while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
				$data[] = $res;
			}
			foreach ($data as $row) {
				// Access 'partcode' and 'partname' columns for each row
			   $partname = $row['partname'];
			}
		
			$conn->beginTransaction();
		
			//delete query
			$del_qry = "DELETE FROM t_partsin WHERE qr_code='$qr'";
			$del = $conn->prepare($del_qry);
			$del->execute();
		
			//insert query
			$partsin_sql = "INSERT INTO t_partsout (qr_code, partcode, partname, packing_quantity, updated_by)
			VALUES ('$qr', '$partscode', '$partname', '$qty', '$updated_by') ";
			$stmt3 = $conn->prepare($partsin_sql);
			$stmt3->execute();
		
			echo 'success';
			$conn->commit();

		}catch(Exception $e){
			echo 'error';
		}
	}

   
}

?>