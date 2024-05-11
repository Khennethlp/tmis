<?php

// PHP part (store_in_p.php)

// Function to fetch parts with pagination
function fetchPartsWithPagination($page, $conn) {
    $resultsPerPage = 10;
    $offset = ($page - 1) * $resultsPerPage;
    $query = "SELECT * FROM t_partsin LIMIT ?, ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $offset, PDO::PARAM_INT);
    $stmt->bindParam(2, $resultsPerPage, PDO::PARAM_INT);
    $stmt->execute();
    $parts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $parts;
}
?>
