<script>

function trim_white_space(event) {
    document.getElementById('store_in_qr').value = document.getElementById('store_in_qr').value.trim();
}

window.addEventListener('beforeunload', function () {
    // localStorage.clear();
    console.log("Local storage cleared.");
});

document.addEventListener("DOMContentLoaded", () => {
    load_partsin();
});

const insert_partsin = () => {
console.log('Inserting parts...');
var store_in_qr = document.getElementById('store_in_qr').value;
var store_in_address = document.getElementById('store_in_address').value;
console.log(store_in_qr);
// var m_kanban = document.getElementById('kanban_partnames').value;
// console.log(m_kanban);

if(store_in_qr === ''){
    Swal.fire({
        icon: 'info',
        title: 'Please Scan QR !!!',
        text: 'Information',
        showConfirmButton: false,
        timer : 1000
    });
        
        $('#store_in_qr').val('');
        $('#store_in_qr').focus();
        load_partsin();
}else if(store_in_address === ''){
    Swal.fire({
        icon: 'info',
        title: 'Please Scan Stock Address !!!',
        text: 'Information',
        showConfirmButton: false,
        timer : 1000
    });
        $('#store_in_qr').val('');
        $('#store_in_address').val('');
        $('#store_in_address').focus();
        load_partsin();
}else {
    $.ajax({
        type: "POST",
        url: "../../process/stores/store_in_p.php",
        cache: false,
        data: {
            method: 'insert_partsin',
            store_in_qr: store_in_qr,
            store_in_address: store_in_address,
            
        },
        success: function (response) {
            if(response == 'success'){
                Swal.fire({
                    icon: 'success',
                    title: 'Successfully Recorded !!!',
                    text: 'Success',
                    showConfirmButton: false,
                    timer : 1000
                });
                
                $('#store_in_qr').val('');
                $('#store_in_address').val('');
                $('#store_in_address').focus();
                load_partsin();

            } else if(response == 'duplicate'){
                Swal.fire({
                    icon: 'info',
                    title: 'Duplicate Data !!!',
                    text: 'Information',
                    showConfirmButton: false,
                    timer : 1000
                });
                
                $('#store_in_qr').val('');
                load_partsin();

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error !!!',
                    text: 'Error',
                    showConfirmButton: false,
                    timer : 1000
                });
                
                load_partsin();
            }
        }
    });
}
};

const handleEnterKeyPress = (e) => {
    // Check if the key pressed is Enter
    if (e.key === 'Enter') {
        // Prevent the default action of the Enter key, which is submitting the form
        e.preventDefault();
        // Focus on the other input field
        if (e.target.id === 'store_in_qr') {
            document.getElementById('store_in_address').focus();
        } else {
            document.getElementById('store_in_qr').focus();
        }
    }
};
document.getElementById('store_in_qr').addEventListener('keypress', handleEnterKeyPress);
document.getElementById('store_in_address').addEventListener('keypress', handleEnterKeyPress);

// Call count_partsin function to initially populate total count
$(document).ready(function () {
    // count_partsin();
    load_partsin();
});
function clearLocalStorage() {
    localStorage.clear();
    console.log("Local storage cleared");

    // Optionally, you can also clear the displayed table
    document.getElementById('partsin_table').innerHTML = '';
}
// JavaScript part
// document.getElementById("partsin_table_pagination").addEventListener("keyup", e => {
//     var current_page = parseInt(document.getElementById("partsin_table_pagination").value.trim());
//     let total = sessionStorage.getItem('count_rows');
//     var last_page = parseInt(sessionStorage.getItem('last_page'));
//     if (e.which === 13) {
//         e.preventDefault();
//         console.log(total);
//         if (current_page != 0 && current_page <= last_page && total > 0) {
//         }  
//     }
// });

//get previous page
// const get_prev_page = () => {
//     var current_page = parseInt(sessionStorage.getItem('partsin_table_pagination'));
//     let total = sessionStorage.getItem('count_rows');
//     var prev_page = current_page - 1;
//     if (prev_page > 0 && total > 0) {
//     }
// }

// //get next page
// const get_next_page = () => {
//     var current_page = parseInt(sessionStorage.getItem('partsin_table_pagination'));
//     let total = sessionStorage.getItem('count_rows');
//     var last_page = parseInt(sessionStorage.getItem('last_page'));
//     var next_page = current_page + 1;
//     if (next_page <= last_page && total > 0) {
//     }
// }

// const count_partsin = () => {
//     $.ajax({
//         url: "../../process/stores/store_in_p.php",
//         type:'POST',
//         cache:false,
//         data:{
//             method: 'count_partsin_list',
           
//         },
//         success:function(response){
//             sessionStorage.setItem('count_rows', response);
//             var count = `Total: ${response}`;
//             $('#partsin_table_info').html(count);

//             if (response > 0) {
//                 load_partsin_pagination();
//                 document.getElementById("btnPrevPage").removeAttribute('disabled');
//                 document.getElementById("btnNextPage").removeAttribute('disabled');
//                 document.getElementById("partsin_table_pagination").removeAttribute('disabled');
//             } else {
//                 document.getElementById("btnPrevPage").setAttribute('disabled',true);
//                 document.getElementById("btnNextPage").setAttribute('disabled',true);
//                 document.getElementById("partsin_table_pagination").setAttribute('disabled',true);

//             }
//         }
//     });
// }

// const load_partsin_pagination = () => {
//     var partsin = sessionStorage.getItem('partsin_table');
//     var current_page = sessionStorage.getItem('partsin_table_pagination');

//     $.ajax({
//         url: "../../process/stores/store_in_p.php",
//         type:'POST',
//         cache:false,
//         data:{
//             method:'partsin_pagination',
//             partsin: partsin,
//         },
//         success:function(response){
//             $('#partsin_table_paginations').html(response);
//             $('#partsin_table_pagination').val(current_page);
//             let last_page_check = document.getElementById("partsin_table_paginations").innerHTML;
//             if (last_page_check != '') {
//                 let last_page = document.getElementById("partsin_table_paginations").lastChild.text;
//                 sessionStorage.setItem('last_page',last_page);
//             }
//         }
//     });
// }

// const load_partsin = current_page => {
//     $.ajax({
//         url: '../../process/stores/store_in_p.php',
//         type: 'POST',
//         cache: false,
//         data: {
//             method: 'partsin_list',
//             current_page: current_page,
//         }, 
//         success: function (response) {
//             document.getElementById("partsin_table").innerHTML = response;
//         }
//     });
// };
const load_partsin = () => {
    // Retrieve the entries from local storage
    var entries = JSON.parse(localStorage.getItem("entries")) || [];
    var store_in_address = document.getElementById("store_in_address").value;
    var store_in_qr = document.getElementById("store_in_qr").value;
    $.ajax({
        url: '../../process/stores/store_in_p.php',
        type: 'POST',
        data: { 
            method: 'partsin_list',
            entries: JSON.stringify(entries),
            store_in_address: store_in_address,
            // store_in_qr: store_in_qr 
        },
        success: function(response) {
            // Insert the response into the table
            document.getElementById('partsin_table').innerHTML = response;
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

//ssave to local storage
const save_to_local_storage = () => {
    var store_in_address = document.getElementById("store_in_address").value;
    var store_in_qr = document.getElementById("store_in_qr").value;

    // Create an entry object
    var entry = {
        store_in_address: store_in_address,
        store_in_qr: store_in_qr
    };

    // Retrieve existing entries from local storage
    var entries = JSON.parse(localStorage.getItem("entries")) || [];

    // Add the new entry
    entries.push(entry);

    // Save the updated array back to local storage
    localStorage.setItem("entries", JSON.stringify(entries));
    load_partsin();
    document.getElementById("store_in_address").value = '';
    document.getElementById("store_in_qr").value = '';
    document.getElementById("store_in_address").focus;
    console.log("Data saved to local storage");
}

</script>
