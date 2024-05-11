<script>
// Call count_partsin function to initially populate total count
$(document).ready(function () {
    count_partsin();
    load_partsin();
});
// JavaScript part
document.getElementById("partsin_table_pagination").addEventListener("keyup", e => {
    var current_page = parseInt(document.getElementById("partsin_table_pagination").value.trim());
    let total = sessionStorage.getItem('count_rows');
    var last_page = parseInt(sessionStorage.getItem('last_page'));
    if (e.which === 13) {
        e.preventDefault();
        console.log(total);
        if (current_page != 0 && current_page <= last_page && total > 0) {
        }  
    }
});

//get previous page
const get_prev_page = () => {
    var current_page = parseInt(sessionStorage.getItem('partsin_table_pagination'));
    let total = sessionStorage.getItem('count_rows');
    var prev_page = current_page - 1;
    if (prev_page > 0 && total > 0) {
    }
}

//get next page
const get_next_page = () => {
    var current_page = parseInt(sessionStorage.getItem('partsin_table_pagination'));
    let total = sessionStorage.getItem('count_rows');
    var last_page = parseInt(sessionStorage.getItem('last_page'));
    var next_page = current_page + 1;
    if (next_page <= last_page && total > 0) {
    }
}

const count_partsin = () => {
    $.ajax({
        url: "../../process/stores/store_in_p.php",
        type:'POST',
        cache:false,
        data:{
            method: 'count_partsin_list',
           
        },
        success:function(response){
            sessionStorage.setItem('count_rows', response);
            var count = `Total: ${response}`;
            $('#partsin_table_info').html(count);

            if (response > 0) {
                load_partsin_pagination();
                document.getElementById("btnPrevPage").removeAttribute('disabled');
                document.getElementById("btnNextPage").removeAttribute('disabled');
                document.getElementById("partsin_table_pagination").removeAttribute('disabled');
            } else {
                document.getElementById("btnPrevPage").setAttribute('disabled',true);
                document.getElementById("btnNextPage").setAttribute('disabled',true);
                document.getElementById("partsin_table_pagination").setAttribute('disabled',true);

            }
        }
    });
}

const load_partsin_pagination = () => {
    var partsin = sessionStorage.getItem('partsin_table');
    var current_page = sessionStorage.getItem('partsin_table_pagination');

    $.ajax({
        url: "../../process/stores/store_in_p.php",
        type:'POST',
        cache:false,
        data:{
            method:'partsin_pagination',
            partsin: partsin,
        },
        success:function(response){
            $('#partsin_table_paginations').html(response);
            $('#partsin_table_pagination').val(current_page);
            let last_page_check = document.getElementById("partsin_table_paginations").innerHTML;
            if (last_page_check != '') {
                let last_page = document.getElementById("partsin_table_paginations").lastChild.text;
                sessionStorage.setItem('last_page',last_page);
            }
        }
    });
}

const load_partsin = current_page => {
    $.ajax({
        url: '../../process/stores/store_in_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'partsin_list',
            current_page: current_page,
        }, 
        success: function (response) {
            document.getElementById("partsin_table").innerHTML = response;
        }
    });
};

</script>
