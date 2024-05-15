<script>
    // Call count_partsout function to initially populate total count
    function trim_white_space(event) {
        document.getElementById('store_out_qr').value = document.getElementById('store_out_qr').value.trim();
    }
    document.addEventListener("DOMContentLoaded", () => {
        load_partsout();
        // validations();
    });

    let isRefresh = false;

    window.addEventListener('beforeunload', function() {
        if(!isRefresh) {
            localStorage.clear();
        }
        console.log("Local storage cleared.");
    });
    window.addEventListener('unload', function() {
        isRefresh = true;
        // localStorage.clear();
        // console.log("Local storage cleared.");
    });

    function clearLocalStorage() {
        localStorage.clear();
        console.log("Local storage cleared");

        // Optionally, you can also clear the displayed table
        document.getElementById('partsin_table').innerHTML = '';
    }

    const insert_partsout = () => {
        var store_out_qr = document.getElementById('store_out_qr').value;

        if (store_out_qr === '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Scan QR !!!',
                text: 'Information',
                showConfirmButton: false,
                timer: 1000
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
                success: function(response) {
                    if (response == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Successfully Recorded !!!',
                            text: 'Success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        $('#store_out_qr').val('');
                        load_partsout();
                    } else if (response == 'duplicate') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Already Stored out Data !!!',
                            text: 'Information',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        $('#store_out_qr').val('');
                        load_partsout();
                    } else if (response == 'undefined') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Not in Store in !!!',
                            text: 'Information',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        $('#store_out_qr').val('');
                        load_partsout();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error !!!',
                            text: 'Error',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        load_partsout();
                    }
                }
            });
        }
    };

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
            success: function(response) {
                document.getElementById("partsout_table").innerHTML = response;
                console.log(response);
            },
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

        // Check if a similar entry already exists
        var isDuplicate = entries.some(existingEntry => 
            existingEntry.store_in_qr === entry.store_in_qr
        );
        if(!isDuplicate) {
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
        }else {
            console.log("Entry already exists in session storage");
    }
    };
</script>