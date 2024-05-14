<script>
// Call count_partsout function to initially populate total count
function trim_white_space(event) {
    document.getElementById('store_out_qr').value = document.getElementById('store_out_qr').value.trim();
}
document.addEventListener("DOMContentLoaded", () => {
    load_partsout();
});

function clearLocalStorage() {
    localStorage.clear();
    console.log("Local storage cleared");

    // Optionally, you can also clear the displayed table
    document.getElementById('partsin_table').innerHTML = '';
}

const insert_partsout = () => {
    console.log('Inserting parts...');
    var store_out_qr = document.getElementById('store_out_qr').value;

    console.log(store_out_qr);

    if(store_out_qr === ''){
        Swal.fire({
            icon: 'info',
            title: 'Please Scan QR !!!',
            text: 'Information',
            showConfirmButton: false,
            timer : 1000
        });
            
            $('#store_out_qr').focus();
            load_partsout();
    } else {
        $.ajax({
            type: "POST",
            url: "../../process/stores/store_out_p.php",
            cache: false,
            data: {
                method: 'insert_partsout',
                store_out_qr: store_out_qr,
               
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
                    
                    $('#store_out_qr').val('');
                   
                    load_partsout();

                } else if(response == 'duplicate'){
                    Swal.fire({
                        icon: 'info',
                        title: 'Already Stored out Data !!!',
                        text: 'Information',
                        showConfirmButton: false,
                        timer : 1000
                    });
                    
                    $('#store_out_qr').val('');
                   
                    load_partsout();
                } else if(response == 'undefined'){
                    Swal.fire({
                        icon: 'info',
                        title: 'Not in Store in !!!',
                        text: 'Information',
                        showConfirmButton: false,
                        timer : 1000
                    });
                    
                    $('#store_out_qr').val('');
                   
                    load_partsout();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error !!!',
                        text: 'Error',
                        showConfirmButton: false,
                        timer : 1000
                    });
                    load_partsout();
                }
            }
        });
    }
};

// datalist page list
// document.getElementById("partsout_table_pagination").addEventListener("keyup", e => {
//     var current_page = parseInt(document.getElementById("partsout_table_pagination").value.trim());
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
    //     var current_page = parseInt(sessionStorage.getItem('partsout_table_pagination'));
    //     let total = sessionStorage.getItem('count_rows');
    //     var prev_page = current_page - 1;
    //     if (prev_page > 0 && total > 0) {
    //     }
    // }

//get next page
// const get_next_page = () => {
//     var current_page = parseInt(sessionStorage.getItem('partsout_table_pagination'));
//     let total = sessionStorage.getItem('count_rows');
//     var last_page = parseInt(sessionStorage.getItem('last_page'));
//     var next_page = current_page + 1;
//     if (next_page <= last_page && total > 0) {
//     }
// }

// const count_partsout = () => {
//     $.ajax({
//         url: "../../process/stores/store_out_p.php",
//         type:'POST',
//         cache:false,
//         data:{
//             method: 'count_partsout_list',
           
//         },
//         success:function(response){
//             sessionStorage.setItem('count_rows', response);
//             var count = `Total: ${response}`;
//             $('#partsout_table_info').html(count);

//             if (response > 0) {
//                 load_partsout_pagination();
//                 document.getElementById("btnPrevPage").removeAttribute('disabled');
//                 document.getElementById("btnNextPage").removeAttribute('disabled');
//                 document.getElementById("partsout_table_pagination").removeAttribute('disabled');
//             } else {
//                 document.getElementById("btnPrevPage").setAttribute('disabled',true);
//                 document.getElementById("btnNextPage").setAttribute('disabled',true);
//                 document.getElementById("partsout_table_pagination").setAttribute('disabled',true);

//             }
//         }
//     });
// }

// const load_partsout_pagination = () => {
//     var partsout = sessionStorage.getItem('partsout_table');
//     var current_page = sessionStorage.getItem('partsout_table_pagination');

//     $.ajax({
//         url: "../../process/stores/store_out_p.php",
//         type:'POST',
//         cache:false,
//         data:{
//             method:'partsout_pagination',
//             partsout: partsout,
//         },
//         success:function(response){
//             $('#partsout_table_paginations').html(response);
//             $('#partsout_table_pagination').val(current_page);
//             let last_page_check = document.getElementById("partsout_table_paginations").innerHTML;
//             if (last_page_check != '') {
//                 let last_page = document.getElementById("partsout_table_paginations").lastChild.text;
//                 sessionStorage.setItem('last_page',last_page);
//             }
//         }
//     });
// }

const load_partsout = () => {
    var entries = JSON.parse(localStorage.getItem("entries")) || [];
    var store_out_qr = document.getElementById("store_out_qr").value;

    $.ajax({
        url: '../../process/stores/store_out_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'partsout_list',
            entries: JSON.stringify(entries),
            store_out_qr: store_out_qr, 
        }, 
        success: function (response) {
            document.getElementById("partsout_table").innerHTML = response;
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
};

const save_to_local_storage = () => {
    var store_out_qr = document.getElementById("store_out_qr").value;

    // Create an entry object
    var entry = {
        store_out_qr: store_out_qr,
    };

    // Retrieve existing entries from local storage
    var entries = JSON.parse(localStorage.getItem("entries")) || [];

    // Add the new entry
    entries.push(entry);

    // Save the updated array back to local storage
    localStorage.setItem("entries", JSON.stringify(entries));
    
    // Reload the parts out list
    load_partsout();
    
    // Clear the input field and set focus
    document.getElementById("store_out_qr").value = '';
    document.getElementById("store_out_qr").focus();
    
    console.log("Data saved to local storage");
};

</script>
