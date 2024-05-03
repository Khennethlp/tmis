<script>
function trim_white_space(event) {
    document.getElementById('store_out_qr').value = document.getElementById('store_out_qr').value.trim();

}

document.addEventListener("DOMContentLoaded", () => {
    load_partsout();
});

    const load_partsout = () => {
    $.ajax({
        url: '../../process/admin/store_out_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'partsout_list'
        }, success: function (response) {
            document.getElementById("partsout_table").innerHTML = response;
        }
    });
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