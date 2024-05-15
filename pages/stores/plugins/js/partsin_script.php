<script>

function trim_white_space(event) {
    document.getElementById('store_in_qr').value = document.getElementById('store_in_qr').value.trim();
}

// document.getElementById("store_in_qr").onchange = save_to_local_storage;
document.addEventListener("DOMContentLoaded", () => {
    load_partsin();
});
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

document.getElementById('store_in_qr').addEventListener('keypress', handleEnterKeyPress);
document.getElementById('store_in_address').addEventListener('keypress', handleEnterKeyPress);

// Call count_partsin function to initially populate total count
$(document).ready(function () {
    // count_partsin();
    load_partsin();
});

function clearLocalStorage() {
    sessionStorage.clear();
    console.log("Local storage cleared");

    // Optionally, you can also clear the displayed table
    document.getElementById('partsin_table').innerHTML = '';
}

const insert_partsin = () => {
console.log('Inserting parts...');
// var entries = JSON.parse(sessionStorage.getItem("entries")) || [];
var store_in_qr = document.getElementById('store_in_qr').value;
var store_in_address = document.getElementById('store_in_address').value;
console.log(store_in_qr);

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
        url: "../../process/stores/store_in_p.php",
        cache: false,
        data: {
            method: 'insert_partsin',
            // entries: JSON.stringify(entries),
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

const load_partsin = () => {
    // Retrieve the entries from local storage
    var entries = JSON.parse(sessionStorage.getItem("entries")) || [];

    var store_in_address = document.getElementById("store_in_address").value;
    var store_in_qr = document.getElementById("store_in_qr").value;
    $.ajax({
        url: '../../process/stores/store_in_p.php',
        type: 'POST',
        data: { 
            method: 'partsin_list',
            entries: JSON.stringify(entries),
            store_in_address: store_in_address,
            store_in_qr: store_in_qr,
            
        },
        success: function(response) {
            // Insert the response into the table
            document.getElementById('partsin_table').innerHTML = response;
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}

//ssave to local storage
const save_to_local_storage = () => {
    var store_in_address = document.getElementById("store_in_address").value;
    var store_in_qr = document.getElementById("store_in_qr").value;

    // Create an entry object
    var entry = {
        store_in_address: store_in_address,
        store_in_qr: store_in_qr
    };

    // Retrieve existing entries from local storage
    var entries = JSON.parse(sessionStorage.getItem("entries")) || [];

    // Check if a similar entry already exists
    var isDuplicate = entries.some(existingEntry => 
        existingEntry.store_in_address === entry.store_in_address &&
        existingEntry.store_in_qr === entry.store_in_qr
    );

    if(!isDuplicate){
        // Add the new entry
        entries.push(entry);

        // Save the updated array back to local storage
        sessionStorage.setItem("entries", JSON.stringify(entries));
        load_partsin();
        document.getElementById("store_in_address").value = '';
        document.getElementById("store_in_qr").value = '';
        document.getElementById("store_in_address").focus;
        console.log("Data saved to session storage");
    }else {
        console.log("Entry already exists in session storage");
    }

}


// document.getElementById("store_in_address").onchange = save_to_local_storage;
</script>
