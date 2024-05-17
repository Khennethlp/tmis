<script>
    document.addEventListener("DOMContentLoaded", () => {
        //load_inventory();
        search_inv(1);
        // count_inventory();
    });
    document.querySelector('#inv_search').addEventListener("keyup", function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            search_inv(1); // Call your search function
        }
    });

    // get datalist table
    document.getElementById("inv_table_pagination").addEventListener("keyup", e => {
        var current_page = parseInt(document.getElementById("inv_table_pagination").value.trim());
        let total = sessionStorage.getItem('count_rows');
        var last_page = parseInt(sessionStorage.getItem('last_page'));
        if (e.which === 13) {
            e.preventDefault();
            console.log(total);
            if (current_page != 0 && current_page <= last_page && total > 0) {
                search_inv(current_page);
            }
        }
    });

    //get previous page
    const get_prev_page = () => {
        var current_page = parseInt(sessionStorage.getItem('inv_table_pagination'));
        let total = sessionStorage.getItem('count_rows');
        var prev_page = current_page - 1;
        if (prev_page > 0 && total > 0) {
            search_inv(prev_page);
        }
    }

    //get next page
    const get_next_page = () => {
        var current_page = parseInt(sessionStorage.getItem('inv_table_pagination'));
        let total = sessionStorage.getItem('count_rows');
        var last_page = parseInt(sessionStorage.getItem('last_page'));
        var next_page = current_page + 1;
        if (next_page <= last_page && total > 0) {
            search_inv(next_page);
        }
    }

    // load mlist pagination
    const load_inv_pagination = () => {
        var inv_search = sessionStorage.getItem('inv_search');
        var current_page = sessionStorage.getItem('inv_table_pagination');
        $.ajax({
            url: '../../process/admin/inventory_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'inv_pagination',
                inv_search: inv_search,
            },
            success: function(response) {
                $('#inv_table_paginations').html(response);
                $('#inv_table_pagination').val(current_page);
                let last_page_check = document.getElementById("inv_table_paginations").innerHTML;
                if (last_page_check != '') {
                    let last_page = document.getElementById("inv_table_paginations").lastChild.text;
                    sessionStorage.setItem('last_page', last_page);
                }
            }
        });
    }

    //count inventory
    const count_inventory = () => {
        var inv_search = sessionStorage.getItem('inv_search');

        $.ajax({
            url: '../../process/admin/inventory_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'count_list',
                inv_search: inv_search,
            },
            success: function(response) {
                var count = `Total: ${response}`;
                $('#inv_table_info').html(count);
                sessionStorage.setItem('count_rows', response);

                if (response > 0) {
                    load_inv_pagination();
                    document.getElementById("btnPrevPage").removeAttribute('disabled');
                    document.getElementById("btnNextPage").removeAttribute('disabled');
                    document.getElementById("inv_table_pagination").removeAttribute('disabled');
                } else {
                    document.getElementById("btnPrevPage").setAttribute('disabled', true);
                    document.getElementById("btnNextPage").setAttribute('disabled', true);
                    document.getElementById("inv_table_pagination").setAttribute('disabled', true);

                }
            }
        });

    }

    const load_inventory = current_page => {
        $.ajax({
            url: '../../process/admin/inventory_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'inventory_list',
                current_page: current_page,
                // inventory_search:inventory_search
            },
            success: function(response) {
                document.getElementById("inv_tbl").innerHTML = response;
                document.getElementById("lbl_c1").innerHTML = '';
                $('#t_t1_breadcrumb').hide();
                count_inventory();
                load_inv_pagination();
            }
        });
    }

    const load_t_t2 = param => {
        var string = param.split('~!~');
        var partcode = string[0];
        var qr_code = string[1];

        $.ajax({
            url: '../../process/admin/inventory_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'load_t_t2',
                qr_code: qr_code
            },
            success: function(response) {
                document.getElementById("inv_tbl").innerHTML = response;
                document.getElementById("lbl_c1").innerHTML = partcode;
                $('#t_t1_breadcrumb').show();

            }
        });
    }
    // const count_inventory = () => {
    //     $.ajax({
    //         type: "POST",
    //         url: '../../process/admin/inventory_p.php',
    //         data: {
    //             method: 'count_list',
    //             // count: count,
    //         },
    //         success: function (response) {
    //             document.getElementById("count").innerHTML = response;
    //         }
    //     });
    // }

    const search_inv = current_page => {
        var inventory_search = document.getElementById('inv_search').value;
        var savedSearch_inv = sessionStorage.getItem('inv_search');

        if (current_page > 1) {
            switch (true) {
                case inventory_search !== savedSearch_inv:
                    inventory_search = savedSearch_inv;
                    break;
                default:
            }
        } else {
            sessionStorage.setItem('inv_search', inventory_search);
        }
        $.ajax({
            url: '../../process/admin/inventory_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'inventory_search',
                inventory_search: inventory_search,
                current_page: current_page,
            },
            success: function(response) {

                document.getElementById("inventory_table").innerHTML = response;
                sessionStorage.setItem('inv_table_pagination', current_page);
                count_inventory();
                $('#t_t1_breadcrumb').hide();

            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
                // Handle AJAX errors (e.g., display an error message to the user).
            }
        });
    }

    // const search_by_date = () => {
    //     var from_date = document.getElementById("from_search").value;
    //     var to_date = document.getElementById("to_search").value;

    //     if(from_date === '' && to_date === ''){
    //         load_inventory();
    //         count_inventory();
    //     }else{
    //     $.ajax({
    //         url: '../../process/admin/inventory_p.php',
    //         type: 'POST',
    //         cache: false,
    //         data: {
    //             method: 'search_by_date',
    //             from_date: from_date,
    //             to_date: to_date,
    //         },
    //         success: function (response) {
    //             var data = JSON.parse(response);
    //             var rowsHTML = '';
    //             var count = data.count;
    //             data.rows.forEach(function (row, index) {
    //                 // rowsHTML += '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#update_mlist" onclick="get_mlist_details(&quot;' + row.id + '~!~' + row.partcode + '~!~' + row.partname + '~!~' + row.packing_quantity + '&quot;)">';
    //                 rowsHTML += '<td><input type="checkbox" name="selected[]" class="selected" id="selected_' + row.id + '" value="' + row.id + '" onclick="get_checked_length()"  style="cursor:pointer;"></td>';                
    //                 rowsHTML += '<td>' + (index + 1) + '</td>';
    //                 rowsHTML += '<td>' + row.partcode + '</td>';
    //                 rowsHTML += '<td>' + row.partname + '</td>';
    //                 rowsHTML += '<td>' + row.packing_quantity + '</td>';
    //                 rowsHTML += '<td>' + row.lot_address + '</td>';
    //                 rowsHTML += '<td>' + row.barcode_label + '</td>';
    //                 rowsHTML += '<td>' + row.quantity + '</td>';
    //                 rowsHTML += '<td>' + row.date_updated + '</td>';
    //                 rowsHTML += '<td>' + row.updated_by + '</td>';
    //                 rowsHTML += '</tr>';
    //             });
    //             document.getElementById("inventory_table").innerHTML = rowsHTML;
    //             document.getElementById("count").innerHTML = count;
    //         }
    //     });
    //     }
    // }



    const export_csv = (table_id, separator = ',') => {
        // Select rows from table_id
        var rows = document.querySelectorAll('table#' + table_id + ' tr');
        // Construct csv
        var csv = [];
        for (var i = 0; i < rows.length; i++) {
            var row = [],
                cols = rows[i].querySelectorAll('td, th');
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

    const print = () => {
        var from_date = document.getElementById("from_search").value;
        var to_date = document.getElementById("to_search").value;

        if (from_date === '') {
            Swal.fire({
                icon: 'info',
                title: 'No selected date',
                text: 'Please select date from',
                showConfirmButton: false,
                timer: 2000
            });
        } else if (to_date === '') {
            Swal.fire({
                icon: 'info',
                title: 'No selected date',
                text: 'Please select date to',
                showConfirmButton: false,
                timer: 2000
            });
        } else if (from_date === '' && to_date === '') {
            Swal.fire({
                icon: 'info',
                title: 'No selected date',
                text: 'Please select date from and to',
                showConfirmButton: false,
                timer: 2000
            });
            return false;
        } else {
            window.open('../../process/admin/print/print.php?date_from=' + from_date + "&date_to=" + to_date, '_blank');

        }

    }
</script>