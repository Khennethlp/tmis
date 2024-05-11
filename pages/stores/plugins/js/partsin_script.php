<script>

// JavaScript part
document.getElementById("partsin_table_pagination").addEventListener("keyup", e => {
    var current_page = parseInt(document.getElementById("partsin_table_pagination").value.trim());
    let total = sessionStorage.getItem('count_rows');
    var last_page = parseInt(sessionStorage.getItem('last_page'));
    if (e.which === 13) {
        e.preventDefault();
        console.log(total);
        if (current_page != 0 && current_page <= last_page && total > 0) {
            search_partsin(current_page);
        }  
    }
});

//get previous page
const get_prev_page = () => {
    var current_page = parseInt(sessionStorage.getItem('partsin_table_pagination'));
    let total = sessionStorage.getItem('count_rows');
    var prev_page = current_page - 1;
    if (prev_page > 0 && total > 0) {
        // search_partsin(prev_page);
    }
}

//get next page
const get_next_page = () => {
    var current_page = parseInt(sessionStorage.getItem('partsin_table_pagination'));
    let total = sessionStorage.getItem('count_rows');
    var last_page = parseInt(sessionStorage.getItem('last_page'));
    var next_page = current_page + 1;
    if (next_page <= last_page && total > 0) {
        // search_partsin(next_page);
    }
}

// Function to fetch parts and populate table
function fetchPartsAndPopulateTable(page) {
    $.ajax({
        url: '../../process/admin/store_in_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'partsin_list',
            current_page: page
        },
        success: function (response) {
            document.getElementById("partsin_table").innerHTML = response;
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
}

// Function to handle pagination button clicks
function goToPage(page) {
    fetchPartsAndPopulateTable(page);
}

// Function to initialize the page
$(document).ready(function() {
    fetchPartsAndPopulateTable(1);
});
</script>
