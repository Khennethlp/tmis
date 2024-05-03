<script>

document.addEventListener("DOMContentLoaded", () => {
    load_kanban_mlist();
    history_list();
    count_mlist();
   
});

document.querySelector('#mlist_search').addEventListener("keyup", function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        search_mlist(); // Call your search function
    }
});

const load_kanban_mlist = () => {
    
    $.ajax({
        url: '../../process/admin/masterlist_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'kanban_mlist' ,
          
        }, success: function (response) {
            document.getElementById("kanban_mlist").innerHTML = response;
           
        }
    });
}


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

const search_mlist = () => {
    var mlist_search = document.getElementById('mlist_search').value;

    $.ajax({
        url: '../../process/admin/masterlist_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'mlist_search',
            mlist_search: mlist_search,
        }, success: function (response) {
            document.getElementById("kanban_mlist").innerHTML = response;
        }
    });
}

const search_by_date = () => {
    var from_date = document.getElementById("fromD_search").value;
    var to_date = document.getElementById("toD_search").value;

    if(from_date === '' && to_date === ''){
        load_kanban_mlist();
        count_mlist();
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

const count_mlist = () => {
    $.ajax({
        type: "POST",
        url: '../../process/admin/masterlist_p.php',
        data: {
            method: 'count_mlist',
            // count: count,
        },
        success: function (response) {
            document.getElementById("count_mlist").innerHTML = response;
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
</script>