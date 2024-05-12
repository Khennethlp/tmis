<script>

function trim_white_space(event) {
    document.getElementById('store_in_qr').value = document.getElementById('store_in_qr').value.trim();
}

// Function to handle Enter key press event for both input fields
// const handleEnterKeyPress = (e) => {
//     // Check if the key pressed is Enter
//     if (e.key === 'Enter') {
//         // Prevent the default action of the Enter key, which is submitting the form
//         e.preventDefault();
//         // Focus on the other input field
//         if (e.target.id === 'store_in_qr') {
//             document.getElementById('store_in_address').focus();
//         } else {
//             document.getElementById('store_in_qr').focus();
//         }
//     }
// };

// Listen for key press events on both input fields
// document.getElementById('store_in_qr').addEventListener('keypress', handleEnterKeyPress);
// document.getElementById('store_in_address').addEventListener('keypress', handleEnterKeyPress);

// document.addEventListener("DOMContentLoaded", () => {
//         // load_partsin();
//         // getMlist();
// });
$(document).ready(function() {
    search_partsin(1);
});
 
    
// const insert_partsin = () => {
// console.log('Inserting parts...');
// var store_in_qr = document.getElementById('store_in_qr').value;
// var store_in_address = document.getElementById('store_in_address').value;
// console.log(store_in_qr);
// // var m_kanban = document.getElementById('kanban_partnames').value;
// // console.log(m_kanban);

// if(store_in_qr === ''){
//     Swal.fire({
//         icon: 'info',
//         title: 'Please Scan QR !!!',
//         text: 'Information',
//         showConfirmButton: false,
//         timer : 1000
//     });
        
//         $('#store_in_qr').val('');
//         $('#store_in_qr').focus();
//         load_partsin();
// }else if(store_in_address === ''){
//     Swal.fire({
//         icon: 'info',
//         title: 'Please Scan Stock Address !!!',
//         text: 'Information',
//         showConfirmButton: false,
//         timer : 1000
//     });
//         $('#store_in_qr').val('');
//         $('#store_in_address').val('');
//         $('#store_in_address').focus();
//         load_partsin();
// }else {
//     $.ajax({
//         type: "POST",
//         url: "../../process/admin/store_in_p.php",
//         cache: false,
//         data: {
//             method: 'insert_partsin',
//             store_in_qr: store_in_qr,
//             store_in_address: store_in_address,
            
//         },
//         success: function (response) {
//             if(response == 'success'){
//                 Swal.fire({
//                     icon: 'success',
//                     title: 'Successfully Recorded !!!',
//                     text: 'Success',
//                     showConfirmButton: false,
//                     timer : 1000
//                 });
                
//                 $('#store_in_qr').val('');
//                 $('#store_in_address').val('');
//                 $('#store_in_address').focus();
//                 load_partsin();

//             } else if(response == 'duplicate'){
//                 Swal.fire({
//                     icon: 'info',
//                     title: 'Duplicate Data !!!',
//                     text: 'Information',
//                     showConfirmButton: false,
//                     timer : 1000
//                 });
                
//                 $('#store_in_qr').val('');
//                 load_partsin();

//             } else {
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Error !!!',
//                     text: 'Error',
//                     showConfirmButton: false,
//                     timer : 1000
//                 });
                
//                 load_partsin();
//             }
//         }
//     });
// }
// };

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
        search_partsin(prev_page);
    }
}

//get next page
const get_next_page = () => {
    var current_page = parseInt(sessionStorage.getItem('partsin_table_pagination'));
    let total = sessionStorage.getItem('count_rows');
    var last_page = parseInt(sessionStorage.getItem('last_page'));
    var next_page = current_page + 1;
    if (next_page <= last_page && total > 0) {
        search_partsin(next_page);
    }
}

// load partsin pagination
const load_partsin_pagination = () => {
    var partsin = sessionStorage.getItem('partsin_search');
    var current_page = sessionStorage.getItem('partsin_table_pagination');
    $.ajax({
        url: "../../process/admin/store_in_p.php",
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

//count partsin
const count_partsin = () => {
    var partsin = sessionStorage.getItem('partsin_search');
    
    $.ajax({
        url: "../../process/admin/store_in_p.php",
        type:'POST',
        cache:false,
        data:{
            method: 'count_partsin_list',
            partsin: partsin,
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

const load_partsin = current_page => {
    $.ajax({
        url: '../../process/admin/store_in_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'partsin_list',
            current_page:current_page,

        }, success: function (response) {
            document.getElementById("partsin_table").innerHTML = response;
            count_partsin();
            load_partsin_pagination();
        }
    });
}

const search_partsin = current_page => {
    var partsin = document.getElementById('partsin_search').value;
    var savedSearch  = sessionStorage.getItem('partsin_search');

    if(current_page > 1){
        switch(true){
            case partsin !== savedSearch:
            case partsin === savedSearch:
                break;
            default:
        }
    }else{
        sessionStorage.setItem('partsin_search', partsin);
    }

    $.ajax({
        url: '../../process/admin/store_in_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'search_partsin',
            partsin: partsin,
            current_page: current_page
            
        }, success: function (response) {
            document.getElementById("partsin_table").innerHTML = response;
            sessionStorage.setItem('partsin_table_pagination', current_page);
            count_partsin();
        }
    });
}
    
//     function getMlist() {
//     // AJAX call to retrieve data from server
//     $.ajax({
//         type: "POST",
//         url: "../../process/admin/admin_p.php", // Replace with your endpoint to retrieve options
//         data: {
//             method: 'get_mlist',
//         },
//         success: function(response) {
//             // Parse response and populate datalist options
//             var m_kanban = document.getElementById('m_kanban').innerHTML = response;
//         }
//     });
// }
</script>