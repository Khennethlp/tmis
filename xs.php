<?php
 $line = "F1001LPC0124042404046    01PFP               0000000500B         COT       0000000079202404240 ";

$line_count = strlen($line);
//////Start: Get the position of 'COT' in the line////////////////
// $cot_position = strpos($line, 'COT');
// // Extract 'COT' along with surrounding whitespace
// $cot_with_whitespace = substr($line, $cot_position, 7); // 'COT' plus 4 spaces before and 2 spaces after
// // Remove leading and trailing whitespace
// $get_cot = trim($cot_with_whitespace);
// //////End: Get the position of 'COT' in the line////////////////

// ////Start: Get the position of the first white space after the first 5 characters/////
// $first_space_position = strpos($line, ' ', 5);
// // Extract characters from the 6th position up to the first white space
// $lot_number = substr($line, 5, $first_space_position - 5);
// ////End: Get the position of the first white space after the first 5 characters/////

// //Start: Extract "01PFP" from the line based on its position//////////
// $parts_code = substr($line, 25, 5);
// //End: Extract "01PFP" from the line based on its position
// //Start: get the F1001
// $get_location = substr($line, 0, 5);
// //End: get the F1001/////////////////////////////////

// //start: get the position of 500 or 300
// $getB = strpos($line, 'COT');
// // Extract "20240424" from the line based on the position of "COT"
// $extracted_b = substr($line, $getB + 27, 8);
// //End: get the position of 500 or 300

// //Start: get the position of Date//////////////////////////////////
// // echo $extracted_date; // Output: '20240424'
// $start_positions = strpos($line, 'COT');
// // Extract "20240424" from the line based on the position of "COT"
// $extracted_date = substr($line, $start_positions + 20, 8);
// $date_object = date_create_from_format('Ymd', $extracted_date);
// // Format the DateTime object as desired
// $dates = date_format($date_object, 'Y-M-d');
// /////end of date position///////////////////////////////////////////////////

// /////get the length and Color///////////////////////////
// // $len = "500";
// // $start_position = strpos($line, $len);
// // // Extract "500B" from the line
// // $getQty = substr($line, $start_position, 3);
// // Find the position of "B" in the line
// $b_position = strpos($line, 'B');

// // Extract the substring before "B"
// $sub_line = substr($line, 0, $b_position);

// // Find the position of the last occurrence of digits in the substring
// $last_digit_position = strrpos($sub_line, ' ');

// // Extract the last three digits from the substring
// $getQty = substr($sub_line, $last_digit_position + 1);
// /////end of length and Color position///////////////////////////

// "<br>".'QTY / Color: '. $getQty . "<br>";
// 'OPT No: '. $get_cot . "<br>";
// 'Location: '. $get_location . "<br>"; 
// 'Parts Code: '. $parts_code . "<br>";
// 'lot No.: '. $lot_number. "<br>"; 
// 'Date: '. $dates;

// $data = [
//     "Qty_color" => $extracted_b,
//     "Opt_no" => $cot,
//     "Location" => $first_five,
//     "Parts_code" => $extracted_string,
//     "lot_no" => $next_characters,
//     "Date" => $formatted_date,
// ];
// Remove white spaces
echo $line = preg_replace('/\s+/', '', $line)."<br>";

// Extract and store each part in variables
$location = substr($line, 0, 5);
$product_code = substr($line, 5, 16);
$part_code = substr($line, 21, 5);
$quant = substr($line, 33, 3);
$color = substr($line, 36, 1);
$cot = substr($line, 37, 3);
$date = substr($line, 50, 8);

$new_date = date_format(date_create_from_format('Ymd', $date), 'Y-m-d');
// Continue extracting other parts as needed

// Output the extracted values
// echo "Rack Location: " . $location . "<br>";
// echo "Lot No: " . $product_code . "<br>";
// echo "Parts Code: " . $part_code . "<br>";
// echo "Quantity: " . $quant . "<br>";
// echo "Color: " . $color . "<br>";
// echo "Operator No: " . $cot . "<br>";
// echo "Date: " . $new_date . "<br>";

//JSON

$data = array();
// Store the extracted values in the array
$data['Rack Location'] = $location;
$data['Lot No'] = $product_code;
$data['Parts Code'] = $part_code;
$data['Quantity'] = $quant;
$data['Color'] = $color;
$data['Operator No'] = $cot;
$data['Date'] = $new_date;

// Convert the array to JSON format
$json_data = json_encode($data);

// Output the JSON data
$json_data;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Extracted QR Line</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 8px;
      border: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
<hr>
<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Parts Code</th>
      <th>Lot No.</th>
      <th>Rack Location</th>
      <th>QTY</th>
      <th>Color</th>
      <th>Operator No.</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    <?php $c=0; ?>
    <tr>
      <td><?= ++$c; ?></td>
      <td><?= $part_code; ?></td>
      <td><?= $product_code; ?></td>
      <td><?= $location; ?></td>
      <td><?= $quant; ?></td>
      <td><?= $color; ?></td>
      <td><?= $cot; ?></td>
      <td><?= $new_date; ?></td>
     
    </tr>
    
  </tbody>
</table>

</body>
</html>
