<script>

function trim_white_space(event) {
    document.getElementById('store_in_qr').value = document.getElementById('store_in_qr').value.trim();
}

// Function to handle Enter key press event for both input fields
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

// Listen for key press events on both input fields
document.getElementById('store_in_qr').addEventListener('keypress', handleEnterKeyPress);
document.getElementById('store_in_address').addEventListener('keypress', handleEnterKeyPress);

document.addEventListener("DOMContentLoaded", () => {
        load_partsin();
        // getMlist();
});

    const load_partsin = () => {
        $.ajax({
            url: '../../process/admin/store_in_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'partsin_list'
            }, success: function (response) {
                document.getElementById("partsin_table").innerHTML = response;
            }
        });
    }
    
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
            url: "../../process/admin/store_in_p.php",
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
    
//     function getMlist() {
//     // AJAX call to retrieve data from server
//     $.ajax({
//         type: "POST",
//         url: "../../process/admin/admin_p.php", // Replace with your endpoint to retrieve options
//         data: {
//             method: 'get_mlist',
//         },
//         success: function(response) {
//             // Parse response and populate datalist options
//             var m_kanban = document.getElementById('m_kanban').innerHTML = response;
//         }
//     });
// }
</script>