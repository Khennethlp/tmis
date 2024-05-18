<script>

document.addEventListener("DOMContentLoaded", () => {
    // load_accounts();
    // search_accounts();
    get_section();
});

$(document).ready(function() {
    search_accounts(1);
});

document.querySelector('#acc_search').addEventListener("keyup", function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        search_accounts(1); // Call your search function
    }
});

// get datalist table
document.getElementById("account_table_pagination").addEventListener("keyup", e => {
    var current_page = parseInt(document.getElementById("account_table_pagination").value.trim());
    let total = sessionStorage.getItem('count_rows');
    var last_page = parseInt(sessionStorage.getItem('last_page'));
    if (e.which === 13) {
        e.preventDefault();
        console.log(total);
        if (current_page != 0 && current_page <= last_page && total > 0) {
            search_accounts(current_page);
        }  
    }
});

//get previous page
const get_prev_page = () => {
    var current_page = parseInt(sessionStorage.getItem('account_table_pagination'));
    let total = sessionStorage.getItem('count_rows');
    var prev_page = current_page - 1;
    if (prev_page > 0 && total > 0) {
        search_accounts(prev_page);
    }
}

//get next page
const get_next_page = () => {
    var current_page = parseInt(sessionStorage.getItem('account_table_pagination'));
    let total = sessionStorage.getItem('count_rows');
    var last_page = parseInt(sessionStorage.getItem('last_page'));
    var next_page = current_page + 1;
    if (next_page <= last_page && total > 0) {
        search_accounts(next_page);
    }
}

// load account pagination
const load_account_pagination = () => {
    var account = sessionStorage.getItem('acc_search');
    var current_page = sessionStorage.getItem('account_table_pagination');
    $.ajax({
        url:'../../process/admin/accounts_p.php',
        type:'POST',
        cache:false,
        data:{
            method:'account_list_pagination',
            account: account,
        },
        success:function(response){
            $('#account_table_paginations').html(response);
            $('#account_table_pagination').val(current_page);
            let last_page_check = document.getElementById("account_table_paginations").innerHTML;
            if (last_page_check != '') {
                let last_page = document.getElementById("account_table_paginations").lastChild.text;
                sessionStorage.setItem('last_page',last_page);
            }
        }
    });
}

//count acc
const count_account = () => {
    var account = sessionStorage.getItem('acc_search');
    
    $.ajax({
        url:'../../process/admin/accounts_p.php',
        type:'POST',
        cache:false,
        data:{
            method:'count_account_list',
            account:account,
        },
        success:function(response){
            sessionStorage.setItem('count_rows', response);
            var count = `Total: ${response}`;
            $('#account_table_info').html(count);

            if (response > 0) {
                load_account_pagination();
                document.getElementById("btnPrevPage").removeAttribute('disabled');
                document.getElementById("btnNextPage").removeAttribute('disabled');
                document.getElementById("account_table_pagination").removeAttribute('disabled');
            } else {
                document.getElementById("btnPrevPage").setAttribute('disabled',true);
                document.getElementById("btnNextPage").setAttribute('disabled',true);
                document.getElementById("account_table_pagination").setAttribute('disabled',true);

            }
        }
    });
}

//load acc
const load_accounts = current_page => {
        $.ajax({
            url: '../../process/admin/accounts_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'account_list',
                current_page:current_page
            }, 
            success: function (response) {
                document.getElementById("list_of_accounts").innerHTML = response;
                count_account();
                load_account_pagination();
            }
        });
    }

const search_accounts = current_page => {
        var acc_search = document.getElementById('acc_search').value;
        // var user_type = document.getElementById('user_type_search').value;
        var savedSearch  = sessionStorage.getItem('acc_search');

        if(current_page > 1){
            switch(true){
                case acc_search !== savedSearch:
                case acc_search === savedSearch:
                    break;
                default:
            }
        }else{
            sessionStorage.setItem('acc_search',acc_search);
        }

        $.ajax({
            url: '../../process/admin/accounts_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'search_account_list',
                account: acc_search,
                current_page: current_page
               
            }, success: function (response) {
                document.getElementById("list_of_accounts").innerHTML = response;
                sessionStorage.setItem('account_table_pagination', current_page);
                count_account();
            }
        });
    }

    //add account
    const add_account = () => {
        var emp_id = document.getElementById('add_emp_id').value;
        var fullname = document.getElementById('add_fullname').value;
        var username = document.getElementById('add_username').value;
        var password = document.getElementById('add_password').value;
        var section = document.getElementById('add_section').value;
        var role = document.getElementById('add_user_type').value;
        
        if(emp_id === ''){
            Swal.fire({
            icon: 'info',
            title: 'Please Input Employee ID !!!',
            text: 'Information',
            showConfirmButton: false,
            timer : 1000
            });
        }else if(fullname === ''){
            Swal.fire({
            icon: 'info',
            title: 'Please Input Fullname !!!',
            text: 'Information',
            showConfirmButton: false,
            timer : 1000
            });
        }else if(username === ''){
            Swal.fire({
            icon: 'info',
            title: 'Please Input Username !!!',
            text: 'Information',
            showConfirmButton: false,
            timer : 1000
            });
        }else if(password === ''){
            Swal.fire({
            icon: 'info',
            title: 'Please Input Username !!!',
            text: 'Information',
            showConfirmButton: false,
            timer : 1000
            });
        }else if(section === ''){
            Swal.fire({
            icon: 'info',
            title: 'Please choose or input section !!!',
            text: 'Information',
            showConfirmButton: false,
            timer : 1000
            });
        }
        else if(role === ''){
            Swal.fire({
            icon: 'info',
            title: 'Please Choose Role !!!',
            text: 'Information',
            showConfirmButton: false,
            timer : 1000
            });
        }else{
            $.ajax({
                type: "POST",
                url: '../../process/admin/accounts_p.php',
                cache:false,
                data: {
                    method: 'add_account',
                    emp_id: emp_id,
                    fullname: fullname,
                    username: username,
                    password: password,
                    section: section,
                    role: role,
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
                        $('#add_acc').modal('hide');
                        $('#add_emp_id').val('');
                        $('#add_fullname').val('');
                        $('#add_username').val('');
                        $('#add_password').val('');
                        $('#add_user_type').val('');
                        load_accounts();
                    }
                    else if(response == 'duplicate'){
                    Swal.fire({
                        icon: 'info',
                        title: 'Duplicate Data !!!',
                        text: 'Information',
                        showConfirmButton: false,
                        timer : 1000
                    });
                    $('#add_acc').modal('hide');
                        $('#add_emp_id').val('');
                        $('#add_fullname').val('');
                        $('#add_username').val('');
                        $('#add_password').val('');
                        $('#add_user_type').val('');
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

    const get_accounts_details = (param) => {
        var data = param.split('~!~');
        var id = data[0];
        var emp_id = data[1];
        var fullname = data[2];
        var username = data[3];
        var password = data[4];
        var section = data[5];
        var usertype = data[6];

        $('#id_acc').val(id);
        $('#empId_edit').val(emp_id);
        $('#fullname_edit').val(fullname);
        $('#username_edit').val(username);
        $('#password_edit').val(password);
        $('#section_edit').val(section);
        $('#user_type_edit').val(usertype);

        console.log(param);
    }
    const update_account = () => {
        var id = document.getElementById('id_acc');
        var emp_id = document.getElementById('empId_edit');
        var fullname = document.getElementById('fullname_edit');
        var username = document.getElementById('username_edit');
        var password = document.getElementById('password_edit');
        var section = document.getElementById('section_edit');
        var usertype = document.getElementById('user_type_edit');

        if (emp_id === '') {
        Swal.fire({
            icon: 'info',
            title: 'Please Input Part Code !!!',
            text: 'Information',
            showConfirmButton: false,
            timer : 1000
        });
        } else if(fullname === '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Input Part Name !!!',
                text: 'Information',
                showConfirmButton: false,
                timer : 1000
            });
            }else if(username === '') {
                Swal.fire({
                    icon: 'info',
                    title: 'Please Input Packing Quantity !!!',
                    text: 'Information',
                    showConfirmButton: false,
                    timer : 1000
                });
            }else if(password === '') {
                Swal.fire({
                    icon: 'info',
                    title: 'Please Input Lot Address !!!',
                    text: 'Information',
                    showConfirmButton: false,
                    timer : 1000
                });
            }else if(usertype === '') {
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
            url: '../../process/admin/accounts_p.php',
            cache:false,
            data: {
                method: 'edit_account',
                id: id,
                emp_id: emp_id,
                fullname: fullname,
                username: username,
                password: password,
                section: section,
                user_type: usertype,
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
        var filename = 'Export-Accounts' + '_' + new Date().toLocaleDateString() + '.csv';
        var link = document.createElement('a');
        link.style.display = 'none';
        link.setAttribute('target', '_blank');
        link.setAttribute('href', 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURIComponent(csv_string));
        link.setAttribute('download', filename);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    const get_section = () => {
        $.ajax({
        type: "POST",
        url: "../../process/admin/accounts_p.php", // Replace with your endpoint to retrieve options
        data: {
            method: 'get_all_section', //get all sections from section column in m_accounts
        },
        success: function(response) {
            // Parse response and populate datalist options
            $('#section_list').html(response); 
        }
    });
    }

</script>