<script>
    document.addEventListener("DOMContentLoaded", () => {
        search_inv(1);
    });

    document.querySelector('#inv_search').addEventListener("keyup", function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            search_inv(1);
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
            url: '../../process/stores/inventory_p.php',
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
            url: '../../process/stores/inventory_p.php',
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
        var search = document.getElementById('inv_search').value;
        $.ajax({
            url: '../../process/stores/inventory_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'inventory_list',
                current_page: current_page,
                search:search
            },
            success: function(response) {
                document.getElementById("inv_tbl").innerHTML = response;
                document.getElementById("inv_search").innerText = '';
                document.getElementById("lbl_c1").innerHTML = '';
                $('#t_t1_breadcrumb').hide();
                document.getElementById('funcContainer').style.display = 'block';
                count_inventory();
                load_inv_pagination();
            }
        });
    }

    const count_t2 = () => {
        var get_qr = sessionStorage.getItem('qr_code');
        var get_partcode = sessionStorage.getItem('partcode');

        $.ajax({
            url: '../../process/stores/inventory_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'count_t2',
                get_qr: get_qr,
                get_partcode: get_partcode,
            },
            success: function(response) {
                sessionStorage.setItem('count_rows', response);
                var count = `Total: ${response}`;
                $('#inv_table_info').html(count);

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

    const load_t_t2 = param => {
        var string = param.split('~!~');
        var partcode = string[0];
        var qr_code = string[1];

        var set_qr = sessionStorage.setItem('qr_code', qr_code);
        var set_partcode = sessionStorage.setItem('partcode', partcode);

        $.ajax({
            url: '../../process/stores/inventory_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'load_t_t2',
                qr_code: qr_code,
                partcode: partcode
            },
            success: function(response) {
                document.getElementById("inv_tbl").innerHTML = response;
                document.getElementById("lbl_c1").innerHTML = partcode;
                $('#t_t1_breadcrumb').show();
                // document.getElementById('thead_t').style.display = 'none';
                document.getElementById('funcContainer').style.display = 'none';
                count_t2();
            }
        });
    }

    const search_inv = current_page => {
        var inventory_search = document.getElementById('inv_search').value;
        // var date_from = document.getElementById('inv_search').value;
        // var date_to = document.getElementById('inv_search').value;

        var savedSearch_inv = sessionStorage.getItem('inv_search');

        if (current_page > 1) {
            switch (true) {
                case inventory_search !== savedSearch_inv:
                    inventory_search == savedSearch_inv;
                    break;
                default:
            }
        } else {
            sessionStorage.setItem('inv_search', inventory_search);
        }
        $.ajax({
            url: '../../process/stores/inventory_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'inventory_search',
                inventory_search: inventory_search,
               
                current_page: current_page,
            },
            success: function(response) {
                document.getElementById("inv_tbl").innerHTML = response;
                sessionStorage.setItem('inv_table_pagination', current_page);
                count_inventory();
                $('#t_t1_breadcrumb').hide();
                // document.getElementById('thead_t').style.display = 'block';
                document.getElementById('funcContainer').style.display = 'block';

            },
            error: function(xhr, status, error) {
                console.error("AJAX request failed:", status, error);
                // Handle AJAX errors (e.g., display an error message to the user).
            }
        });
    }

</script>