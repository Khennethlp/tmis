<script>
function trim_white_space(event) {
    document.getElementById('store_out_qr').value = document.getElementById('store_out_qr').value.trim();

}

document.querySelector('#partsout_search').addEventListener("keyup", function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        search_partsout(); // Call your search function
    }
});
$(document).ready(function() {
    search_partsout(1);
});

document.getElementById("partsout_table_pagination").addEventListener("keyup", e => {
    var current_page = parseInt(document.getElementById("partsout_table_pagination").value.trim());
    let total = sessionStorage.getItem('count_rows');
    var last_page = parseInt(sessionStorage.getItem('last_page'));
    if (e.which === 13) {
        e.preventDefault();
        console.log(total);
        if (current_page != 0 && current_page <= last_page && total > 0) {
            search_partsout(current_page);
        }  
    }
});

//get previous page
const get_prev_page = () => {
    var current_page = parseInt(sessionStorage.getItem('partsout_table_pagination'));
    let total = sessionStorage.getItem('count_rows');
    var prev_page = current_page - 1;
    if (prev_page > 0 && total > 0) {
        search_partsout(prev_page);
    }
}

//get next page
const get_next_page = () => {
    var current_page = parseInt(sessionStorage.getItem('partsout_table_pagination'));
    let total = sessionStorage.getItem('count_rows');
    var last_page = parseInt(sessionStorage.getItem('last_page'));
    var next_page = current_page + 1;
    if (next_page <= last_page && total > 0) {
        search_partsout(next_page);
    }
}

// load account pagination
const load_partsout_pagination = () => {
    var partsout = sessionStorage.getItem('partsout_search');
    var current_page = sessionStorage.getItem('partsout_table_pagination');
    $.ajax({
        url: "../../process/admin/store_out_p.php",
        type:'POST',
        cache:false,
        data:{
            method:'partsout_pagination',
            partsout: partsout,
        },
        success:function(response){
            $('#partsout_table_paginations').html(response);
            $('#partsout_table_pagination').val(current_page);
            let last_page_check = document.getElementById("partsout_table_paginations").innerHTML;
            if (last_page_check != '') {
                let last_page = document.getElementById("partsout_table_paginations").lastChild.text;
                sessionStorage.setItem('last_page',last_page);
            }
        }
    });
}

//count partsout
const count_partsout = () => {
    var partsout = sessionStorage.getItem('partsout_search');
    
    $.ajax({
        url: "../../process/admin/store_out_p.php",
        type:'POST',
        cache:false,
        data:{
            method: 'count_partsout_list',
            partsout: partsout,
        },
        success:function(response){
            sessionStorage.setItem('count_rows', response);
            var count = `Total: ${response}`;
            $('#partsout_table_info').html(count);

            if (response > 0) {
                load_partsout_pagination();
                document.getElementById("btnPrevPage").removeAttribute('disabled');
                document.getElementById("btnNextPage").removeAttribute('disabled');
                document.getElementById("partsout_table_pagination").removeAttribute('disabled');
            } else {
                document.getElementById("btnPrevPage").setAttribute('disabled',true);
                document.getElementById("btnNextPage").setAttribute('disabled',true);
                document.getElementById("partsout_table_pagination").setAttribute('disabled',true);

            }
        }
    });
}

    const load_partsout = current_page => {
    $.ajax({
        url: '../../process/admin/store_out_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'partsout_list'
        }, success: function (response) {
            document.getElementById("partsout_table").innerHTML = response;
            count_partsout();
            load_partsout_pagination();
        }
    });
    }

    const search_partsout = current_page => {
    var partsout = document.getElementById('partsout_search').value;
    var savedSearch  = sessionStorage.getItem('partsout_search');

    if(current_page > 1){
        switch(true){
            case partsout !== savedSearch:
            case partsout === savedSearch:
                break;
            default:
        }
    }else{
        sessionStorage.setItem('partsout_search', partsout);
    }

    $.ajax({
        url: '../../process/admin/store_out_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'search_partsout',
            partsout: partsout,
            current_page: current_page
            
        }, success: function (response) {
            document.getElementById("partsout_table").innerHTML = response;
            sessionStorage.setItem('partsout_table_pagination', current_page);
            count_partsout();
        }
    });
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
        var filename = 'Export-Partsout' + '_' + new Date().toLocaleDateString() + '.csv';
        var link = document.createElement('a');
        link.style.display = 'none';
        link.setAttribute('target', '_blank');
        link.setAttribute('href', 'data:text/csv;charset=utf-8,%EF%BB%BF' + encodeURIComponent(csv_string));
        link.setAttribute('download', filename);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
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
            url: "../../process/admin/store_out_p.php",
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
</script>