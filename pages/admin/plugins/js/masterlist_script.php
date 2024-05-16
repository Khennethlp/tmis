<script>

document.addEventListener("DOMContentLoaded", () => {
    get_masterlist();
});

$(document).ready(function() {
    $('#deleteBtn').attr('disabled', true);
    search_mlist(1);
    // get_masterlist();
});

document.querySelector('#mlist_search').addEventListener("keyup", function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        search_mlist(); // Call your search function
    }
});

// get datalist table
document.getElementById("mlist_table_pagination").addEventListener("keyup", e => {
    var current_page = parseInt(document.getElementById("mlist_table_pagination").value.trim());
    let total = sessionStorage.getItem('count_rows');
    var last_page = parseInt(sessionStorage.getItem('last_page'));
    if (e.which === 13) {
        e.preventDefault();
        console.log(total);
        if (current_page != 0 && current_page <= last_page && total > 0) {
            search_mlist(current_page);
        }  
    }
});

//get previous page
const get_prev_page = () => {
    var current_page = parseInt(sessionStorage.getItem('mlist_table_pagination'));
    let total = sessionStorage.getItem('count_rows');
    var prev_page = current_page - 1;
    if (prev_page > 0 && total > 0) {
        search_mlist(prev_page);
    }
}

//get next page
const get_next_page = () => {
    var current_page = parseInt(sessionStorage.getItem('mlist_table_pagination'));
    let total = sessionStorage.getItem('count_rows');
    var last_page = parseInt(sessionStorage.getItem('last_page'));
    var next_page = current_page + 1;
    if (next_page <= last_page && total > 0) {
        search_mlist(next_page);
    }
}

// load mlist pagination
const load_mlist_pagination = () => {
    var mlist_search = sessionStorage.getItem('mlist_search');
    var current_page = sessionStorage.getItem('mlist_table_pagination');
    $.ajax({
        url: '../../process/admin/masterlist_p.php',
        type:'POST',
        cache:false,
        data:{
            method:'m_list_pagination',
            mlist_search: mlist_search,
        },
        success:function(response){
            $('#mlist_table_paginations').html(response);
            $('#mlist_table_pagination').val(current_page);
            let last_page_check = document.getElementById("mlist_table_paginations").innerHTML;
            if (last_page_check != '') {
                let last_page = document.getElementById("mlist_table_paginations").lastChild.text;
                sessionStorage.setItem('last_page',last_page);
            }
        }
    });
}

//count mlist
const count_mlist = () => {
    var mlist_search = sessionStorage.getItem('mlist_search');
    
    $.ajax({
        url:'../../process/admin/masterlist_p.php',
        type:'POST',
        cache:false,
        data:{
            method:'count_mlist',
            mlist_search: mlist_search,
        },
        success:function(response){
            var count = `Total: ${response}`;
            $('#mlist_table_info').html(count);
            sessionStorage.setItem('count_rows', response);

            if (response > 0) {
                load_mlist_pagination();
                document.getElementById("btnPrevPage").removeAttribute('disabled');
                document.getElementById("btnNextPage").removeAttribute('disabled');
                document.getElementById("mlist_table_pagination").removeAttribute('disabled');
            } else {
                document.getElementById("btnPrevPage").setAttribute('disabled',true);
                document.getElementById("btnNextPage").setAttribute('disabled',true);
                document.getElementById("mlist_table_pagination").setAttribute('disabled',true);

            }
        }
    });
    
}

const load_kanban_mlist = current_page => {
    $.ajax({
        url: '../../process/admin/masterlist_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'kanban_mlist',
            current_page: current_page
          
        }, success: function (response) {
            document.getElementById("kanban_mlist").innerHTML = response;
            // count_mlist();
            load_mlist_pagination();
        }
    });
    
}

const search_mlist = current_page => {
    var mlist_search = document.getElementById('mlist_search').value;
   
    var savedSearch_mlist  = sessionStorage.getItem('mlist_search');
    
    if(current_page > 1){
            switch(true){
                case mlist_search !== savedSearch_mlist:
                case mlist_search === savedSearch_mlist:
                    break;
                default:
            }
        }else{
            sessionStorage.setItem('mlist_search', mlist_search);
        }
        $.ajax({
            url: '../../process/admin/masterlist_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'search_mlist',
                mlist_search: mlist_search,
                current_page: current_page,
            
            }, success: function (response) {
                document.getElementById("kanban_mlist").innerHTML = response;
                sessionStorage.setItem('mlist_table_pagination', current_page);
                count_mlist();
            }
        });
}

const search_by_date = () => {
    var from_date = document.getElementById("fromD_search").value;
    var to_date = document.getElementById("toD_search").value;

    if(from_date === '' && to_date === ''){
        load_kanban_mlist();
        // count_mlist();
    }else{
    $.ajax({
        url: '../../process/admin/masterlist_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'search_by_date',
            from_date: from_date,
            to_date: to_date,
        },
        success: function (response) {
            var data = JSON.parse(response);
            var rowsHTML = '';
            var count = data.count;
            data.rows.forEach(function (row, index) {
                rowsHTML += '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_mlist" onclick="get_mlist_details(&quot;' + row.id + '~!~' + row.partcode + '~!~' + row.partname + '~!~' + row.packing_quantity + '&quot;)">';
                rowsHTML += '<td>' + (index + 1) + '</td>';
                rowsHTML += '<td>' + row.partcode + '</td>';
                rowsHTML += '<td>' + row.partname + '</td>';
                rowsHTML += '<td>' + row.packing_quantity + '</td>';
                rowsHTML += '</tr>';
            });
            document.getElementById("kanban_mlist").innerHTML = rowsHTML;
            document.getElementById("count_mlist").innerHTML = count;
        }
    });
    }
}

// const count_mlist = () => {
//     $.ajax({
//         type: "POST",
//         url: '../../process/admin/masterlist_p.php',
//         data: {
//             method: 'count_mlist',
//             // count: count,
//         },
//         success: function (response) {
//             document.getElementById("count_mlist").innerHTML = response;
//         }
//     });
// }
const history_list = () => {
    
    $.ajax({
        url: '../../process/admin/masterlist_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'history_list' ,
          
        }, success: function (response) {
            document.getElementById("history_list").innerHTML = response;
           
        }
    });
}

const save_mlist = () => {
    var partcode = document.getElementById('partcode').value;
    var partname = document.getElementById('partname').value;
    var qty = document.getElementById('qty').value;

    if(partcode === ''){
        Swal.fire({
            icon: 'info',
            title: 'Please Input Part Code !!!',
            text: 'Information',
            showConfirmButton: false,
            timer : 1000
        });
    }else if(partname === ''){
        Swal.fire({
            icon: 'info',
            title: 'Please Input Part Name !!!',
            text: 'Information',
            showConfirmButton: false,
            timer : 1000
        });
    }else if(qty === ''){
        Swal.fire({
            icon: 'info',
            title: 'Please Input Packing Quantity !!!',
            text: 'Information',
            showConfirmButton: false,
            timer : 1000
        });
    }else{
        $.ajax({
            type: 'POST',
            url: '../../process/admin/masterlist_p.php',
            cache:false,
            data: {
                method: 'save_mlist',
                partcode: partcode,
                partname: partname,
                qty: qty,
            },
            success: function (response) {
                console.log(response);
                if(response == 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'Successfully Recorded !!!',
                        text: 'Success',
                        showConfirmButton: false,
                        timer : 1000
                    });
                    $('#add_mlist').modal('hide');
                    $('#partcode').val('');
                    $('#partname').val('');
                    $('#qty').val('');
                } else if(response == 'duplicate'){
                    Swal.fire({
                        icon: 'info',
                        title: 'Duplicate Data !!!',
                        text: 'Information',
                        showConfirmButton: false,
                        timer : 1000
                    });
                    $('#add_mlist').modal('hide');
                    $('#partcode').val('');
                    $('#partname').val('');
                    $('#qty').val('');
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error !!!',
                        text: 'Error',
                        showConfirmButton: false,
                        timer : 1000
                    });
                }
            }
        });
    }
}
const get_mlist_details = (param) => {
    var data = param.split('~!~');
    var id = data[0];
    var partcode = data[1];
    var partname = data[2];
    var qty = data[3];

    $('#id_mlist').val(id);
    $('#partcode_edit').val(partcode);
    $('#partname_edit').val(partname);
    $('#qty_edit').val(qty);

    console.log(param);
}

const mlist_update = () => {
    var partcode_edit = document.getElementById('partcode_edit').value;
    var partname_edit = document.getElementById('partname_edit').value;
    var qty_edit = document.getElementById('qty_edit').value;
    var id_mlist = document.getElementById('id_mlist').value;

    if (partcode_edit === '') {
        Swal.fire({
            icon: 'info',
            title: 'Please Input Part Code !!!',
            text: 'Information',
            showConfirmButton: false,
            timer : 1000
        });
    } else if(partname_edit === '') {
        Swal.fire({
            icon: 'info',
            title: 'Please Input Part Name !!!',
            text: 'Information',
            showConfirmButton: false,
            timer : 1000
        });
    } else if(qty_edit === '') {
        Swal.fire({
            icon: 'info',
            title: 'Please Input Packing Quantity !!!',
            text: 'Information',
            showConfirmButton: false,
            timer : 1000
        });
    } else {
        $.ajax({
            type: "POST",
            url: '../../process/admin/masterlist_p.php',
            cache:false,
            data: {
                method: 'edit_mlist',
                partcode: partcode_edit,
                partname: partname_edit,
                qty: qty_edit,
                id: id_mlist,
            },
            success: function (response) {
                console.log(response);
                if (response == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Successfully Updated !!!',
                        text: 'Success',
                        showConfirmButton: false,
                        timer : 1000
                    });
                    
                    $('#update_mlist').modal('hide');
                    $('#partcode_edit').val('');
                    $('#partname_edit').val('');
                    $('#searchReqBtn').click();
                    // load_kanban_mlist();
                    
                } else if(response == 'existing') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Existing Data !!!',
                        text: 'Information',
                        showConfirmButton: false,
                        timer : 1000
                    });
                    $('#update_mlist').modal('hide');
                    $('#partcode_edit').val('');
                    $('#partname_edit').val('');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error !!!',
                        text: 'Error',
                        showConfirmButton: false,
                        timer : 1000
                    });
                }
            }
            
        });
    }
}

const delete_mlist = () => {
    var id = document.getElementById('id_mlist').value;
    $.ajax({
        url: '../../process/admin/masterlist_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'del_mlist',
            id: id
        },
        success: function(response) {
            if (response == 'success') {
                Swal.fire({
                    icon: 'info',
                    title: 'Successfully Deleted !!!',
                    text: 'Information',
                    showConfirmButton: false,
                    timer: 1000
                });
                $('#update_mlist').modal('hide');
                
                load_kanban_mlist();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error !!!',
                    text: 'Error',
                    showConfirmButton: false,
                    timer: 1000
                });
            }
        },
        error: function(xhr, status, error) {
            // Handle AJAX errors if any
            console.error(xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Error !!!',
                text: 'Failed to delete item',
                showConfirmButton: false,
                timer: 1000
            });
        }
    });
};

const get_history_details = (param) => {
    var data = param.split('~!~');
    var id = data[0];
    var partcode = data[1];
    var partname = data[2];
    var qty = data[3];
    var address = data[4];
    var updated_by = data[5];

    $('#id_history').val(id);
    $('#partcode_update').val(partcode);
    $('#partname_update').val(partname);
    $('#qty_update').val(qty);
    $('#address_update').val(address);
    $('#by_update').val(updated_by);

    console.log(param);
}

const history_update = () => {
    var id_history = document.getElementById('id_history').value;
    var partcode_update = document.getElementById('partcode_update').value;
    var partname_update = document.getElementById('partname_update').value;
    var qty_update = document.getElementById('qty_update').value;
    var address_update = document.getElementById('address_update').value;
    var by_update = document.getElementById('by_update').value;

    if (partcode_update === '') {
        Swal.fire({
            icon: 'info',
            title: 'Please Input Part Code !!!',
            text: 'Information',
            showConfirmButton: false,
            timer : 1000
        });
    } else if(partname_update === '') {
        Swal.fire({
            icon: 'info',
            title: 'Please Input Part Name !!!',
            text: 'Information',
            showConfirmButton: false,
            timer : 1000
        });
        }else if(qty_update === '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Input Packing Quantity !!!',
                text: 'Information',
                showConfirmButton: false,
                timer : 1000
            });
        }else if(address_update === '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Input Lot Address !!!',
                text: 'Information',
                showConfirmButton: false,
                timer : 1000
            });
        }else {
            $.ajax({
                type: "POST",
                url: '../../process/admin/masterlist_p.php',
                cache:false,
                data: {
                    method: 'update_history',
                    id: id_history,
                    partcode: partcode_update,
                    partname: partname_update,
                    qty: qty_update,
                    address: address_update,
                    by_update: by_update,
                },
                success: function (response) {
                    if (response == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Successfully Updated !!!',
                        text: 'Success',
                        showConfirmButton: false,
                        timer : 1000
                    });
                    
                    $('#update_history').modal('hide');
                    $('#partcode_update').val('');
                    $('#partname_update').val('');
                    $('#qty_update').val('');
                    $('#address_update').val('');
                    $('#by_update').val('');
                    history_list();
                    // $('#searchReqBtn').click();
                    // load_kanban_mlist();
                    
                } else if(response == 'existing') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Existing Data !!!',
                        text: 'Information',
                        showConfirmButton: false,
                        timer : 1000
                    });

                    $('#update_history').modal('hide');
                    $('#partcode_update').val('');
                    $('#partname_update').val('');
                    $('#qty_update').val('');
                    $('#address_update').val('');
                    $('#by_update').val('');
                    history_list();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error !!!',
                        text: 'Error',
                        showConfirmButton: false,
                        timer : 1000
                    });
                }
                }
            });
        
        } 
}

const delete_history = () => {
    var id = document.getElementById('id_history').value;
    $.ajax({
        url: '../../process/admin/masterlist_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'del_history',
            id: id
        },
        success: function(response) {
            if (response == 'success') {
                Swal.fire({
                    icon: 'info',
                    title: 'Successfully Deleted !!!',
                    text: 'Information',
                    showConfirmButton: false,
                    timer: 1000
                });
                $('#update_history').modal('hide');
                history_list();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error !!!',
                    text: 'Error',
                    showConfirmButton: false,
                    timer: 1000
                });
            }
        },
        error: function(xhr, status, error) {
            // Handle AJAX errors if any
            console.error(xhr.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Error !!!',
                text: 'Failed to delete item',
                showConfirmButton: false,
                timer: 1000
            });
        }
    });
};

const export_csv = (table_id, separator = ',') => {
        // Select rows from table_id
        var rows = document.querySelectorAll('table#' + table_id + ' tr');
        // Construct csv
        var csv = [];
        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll('td, th');
            for (var j = 0; j < cols.length; j++) {
                var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
                data = data.replace(/"/g, '""');
                // Push escaped string
                row.push('"' + data + '"');
            }
            csv.push(row.join(separator));
        }
        var csv_string = csv.join('\n');
        // Download it
        var filename = 'Export-Mlist' + '_' + new Date().toLocaleDateString() + '.csv';
        var link = document.createElement('a');
        link.style.display = 'none';
        link.setAttribute('target', '_blank');
        link.setAttribute('href', 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURIComponent(csv_string));
        link.setAttribute('download', filename);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

const print = () =>{
    var from_date = document.getElementById("fromD_search").value;
    var to_date = document.getElementById("toD_search").value;
    window.open('../../process/admin/print/print.php?date_from=' + from_date + "&date_to=" + to_date, '_blank');

}
const selectAll = (checkbox) => {
      //check all data
        var select_all = document.getElementById('select_all');
        if (select_all.checked == true) {
            console.log('checked');
            $('.selected').each((i, el) => {
                el.checked = true;
            });
        }
        else {
            console.log('unchecked');
            $('.selected').each((i, el) => {
                el.checked = false;
            });
        }
        get_checked_length();
}

const get_checked_length = () => {
        var arr = [];
        $('input.selected:checkbox:checked').each((i, el) => {
            arr.push($(el).val());
        });
        console.log(arr);
        var numberOfChecked = arr.length;
        if (numberOfChecked > 0) {
            $('#deleteBtn').attr('disabled', false);
        }
        else {
            $('#deleteBtn').attr('disabled', true);
        }
    }

// delete data arr
const delete_data_arr = () => {
 var arr = [];
    $('input.selected:checkbox:checked').each((i, el) => {
        arr.push($(el).val());
    });
    console.log(arr);

    var numberOfChecked = arr.length;
    if (numberOfChecked > 0) {
        $.ajax({
            url: '../../process/admin/masterlist_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'delete_data_arr',
                id_arr: arr
            },
            beforeSend: (jqXHR, settings) => {
                Swal.fire({
                    icon: 'info',
                    title: 'Loading',
                    text: 'Please Wait',
                    showConfirmButton: false,
                    timer: 2000
                });
                jqXHR.url = settings.url;
                jqXHR.type = settings.type;
            },
            success: response => {
                setTimeout(() => {
                    swal.close();
                    if (response == 'success') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Data Deleted',
                        text: 'Successfully',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    load_inventory();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: `Error: ${response}`,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
                }, 500);
            }
        })
        .fail((jqXHR, textStatus, errorThrown) => {
        console.log(jqXHR);
        
        Swal.fire({
            icon: 'error',
            title: 'System Error',
            text: `Error: url: ${jqXHR.url}, method: ${jqXHR.type} ( HTTP ${jqXHR.status} - ${jqXHR.statusText} ) Press F12 to see Console Log for more info.`,
            showConfirmButton: false,
            timer: 2000
        });
        });
    } else {
        Swal.fire({
            icon: 'info',
            title: 'No checkbox checked',
            text: 'No checkbox checked',
            showConfirmButton: false,
            timer: 2000
        })
    }
}

const get_masterlist = () => {
        $.ajax({
        type: "POST",
        url: "../../process/admin/masterlist_p.php", // Replace with your endpoint to retrieve options
        data: {
            method: 'get_all_mlist', //get all sections from section column in m_accounts
        },
        success: function(response) {
            // Parse response and populate datalist options
            $('#mlist_list').html(response); 
        }
    });
    }

</script>