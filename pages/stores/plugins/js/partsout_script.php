<script>
    // Call count_partsout function to initially populate total count
    function trim_white_space(event) {
        document.getElementById('store_out_qr').value = document.getElementById('store_out_qr').value.trim();
    }
    document.addEventListener("DOMContentLoaded", () => {
        load_partsout();
    });

    function clearSessionStorage() {
        sessionStorage.removeItem("store_out_entries");
        console.log("Session storage cleared");
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
        var store_out_entries = JSON.parse(sessionStorage.getItem("store_out_entries")) || [];
        var store_in_entries = JSON.parse(sessionStorage.getItem("store_in_entries")) || [];

        var store_out_qr = document.getElementById("store_out_qr").value;

        $.ajax({
            url: '../../process/stores/store_out_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'partsout_list',
                store_out_entries: JSON.stringify(store_out_entries),
                store_in_entries: JSON.stringify(store_in_entries),
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
        var store_out_entry = {
            store_out_qr: store_out_qr,
        };

        // Retrieve existing entries from session storage
        var store_out_entries = JSON.parse(sessionStorage.getItem("store_out_entries")) || [];

        // Check if a similar entry already exists
        var isDuplicate = store_out_entries.some(existingEntry =>
            existingEntry.store_out_qr === store_out_entry.store_out_qr
        );

        if(!isDuplicate) {
        store_out_entries.push(store_out_entry);

        sessionStorage.setItem("store_out_entries", JSON.stringify(store_out_entries));

        load_partsout();

        // Clear the input field and set focus
        document.getElementById("store_out_qr").value = '';
        document.getElementById("store_out_qr").focus();

        console.log("Data saved to session storage");
        } else {
            console.log("Entry already exists in session storage");
        }
    };
</script>