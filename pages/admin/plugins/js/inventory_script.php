<script>

document.addEventListener("DOMContentLoaded", () => {
    load_inventory();
    count_inventory();
 
});

$(document).ready(function(){
    $('#deleteBtn').css('display', 'none');
   
});


const load_inventory = () => {
    $.ajax({
        url: '../../process/admin/inventory_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'inventory_list'
        }, success: function (response) {
            document.getElementById("inventory_table").innerHTML = response;
        }
    });
}

const count_inventory = () => {
    $.ajax({
        type: "POST",
        url: '../../process/admin/inventory_p.php',
        data: {
            method: 'count_list',
            // count: count,
        },
        success: function (response) {
            document.getElementById("count").innerHTML = response;
        }
    });
}

const search_inv = () => {
    var inventory_search = document.getElementById('inv_search').value;

    if(inventory_search === ''){
        load_inventory();
    }else{
        $.ajax({
            url: '../../process/admin/inventory_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'inventory_search',
                inventory_search: inventory_search,
            }, success: function (response) {
                document.getElementById("inventory_table").innerHTML = response;
            }
        });
    }
}

const search_by_date = () => {
    var from_date = document.getElementById("from_search").value;
    var to_date = document.getElementById("to_search").value;

    if(from_date === '' && to_date === ''){
        load_inventory();
        count_inventory();
    }else{
    $.ajax({
        url: '../../process/admin/inventory_p.php',
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
                // rowsHTML += '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_mlist" onclick="get_mlist_details(&quot;' + row.id + '~!~' + row.partcode + '~!~' + row.partname + '~!~' + row.packing_quantity + '&quot;)">';
                rowsHTML += '<td><input type="checkbox" name="selected[]" class="selected" id="selected_' + row.id + '" value="' + row.id + '" onclick="get_checked_length()"  style="cursor:pointer;"></td>';                
                rowsHTML += '<td>' + (index + 1) + '</td>';
                rowsHTML += '<td>' + row.partcode + '</td>';
                rowsHTML += '<td>' + row.partname + '</td>';
                rowsHTML += '<td>' + row.packing_quantity + '</td>';
                rowsHTML += '<td>' + row.lot_address + '</td>';
                rowsHTML += '<td>' + row.barcode_label + '</td>';
                rowsHTML += '<td>' + row.quantity + '</td>';
                rowsHTML += '<td>' + row.date_updated + '</td>';
                rowsHTML += '</tr>';
            });
            document.getElementById("inventory_table").innerHTML = rowsHTML;
            document.getElementById("count").innerHTML = count;
        }
    });
    }
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
            $('#deleteBtn').css('display', 'block');
        }
        else {
            $('#deleteBtn').css('display', 'none');
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
            url: '../../process/admin/inventory_p.php',
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
        var filename = 'Export-Inventory' + '_' + new Date().toLocaleDateString() + '.csv';
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
        var from_date = document.getElementById("from_search").value;
        var to_date = document.getElementById("to_search").value;

        if(from_date === ''){
            Swal.fire({
                icon: 'info',
                title: 'No selected date',
                text: 'Please select date from',
                showConfirmButton: false,
                timer: 2000
            });
        }else if(to_date === ''){
            Swal.fire({
                icon: 'info',
                title: 'No selected date',
                text: 'Please select date to',
                showConfirmButton: false,
                timer: 2000
            });
        }else if(from_date === '' && to_date === ''){
            Swal.fire({
                icon: 'info',
                title: 'No selected date',
                text: 'Please select date from and to',
                showConfirmButton: false,
                timer: 2000
            });
            return false;
        }else{
            window.open('../../process/admin/print/print.php?date_from=' + from_date + "&date_to=" + to_date, '_blank');
            
        }

    }
</script>