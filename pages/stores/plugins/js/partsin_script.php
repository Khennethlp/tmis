<script>
    //  $(document).ready(function() {
    //     load_partsin();
    // });

    function trim_white_space(event) {
        document.getElementById('store_in_qr').value = document.getElementById('store_in_qr').value.trim();
    }

    document.addEventListener("DOMContentLoaded", () => {
        load_partsin();
    });

    const handleEnterKeyPress = (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            if (e.target.id === 'store_in_qr') {
                document.getElementById('store_in_address').focus();
            } else {
                document.getElementById('store_in_qr').focus();
            }
        }
    };

    document.getElementById('store_in_qr').addEventListener('keypress', handleEnterKeyPress);
    document.getElementById('store_in_address').addEventListener('keypress', handleEnterKeyPress);

    // QRCode Script Start ========================================
    // const reader = document.getElementById('reader');
    // const address = document.getElementById('store_in_address');
    // const qr = document.getElementById('store_in_qr');
    // let html5QrCode;
    // let inputCount = 0;
    
    const startButton = document.getElementById('startButton');
    const qrScanner = document.getElementById('reader');
    const resultDiv = document.getElementById('result');
    const codeReader = new ZXing.BrowserQRCodeReader();

    startButton.addEventListener('click', () => {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then((stream) => {
                        videoElement.srcObject = stream;
                    })
                    .catch((err) => {
                        console.error('Error accessing camera: ', err);
                        alert('Error accessing camera: ' + err.message);
                    });
            }else if (navigator.getUserMedia) {
                // Polyfill for older browsers
                navigator.getUserMedia({ video: true },
                    (stream) => {
                        videoElement.srcObject = stream;
                    },
                    (err) => {
                        console.error('Error accessing camera: ', err);
                        alert('Error accessing camera: ' + err.message);
                    });
            } else {
                alert('getUserMedia is not supported by your browser');
            }
        });
    // startButton.addEventListener('click', () => {
    //         codeReader.getVideoInputDevices()
    //             .then((videoInputDevices) => {
    //                 if (videoInputDevices && videoInputDevices.length) {
    //                     codeReader.decodeFromInputVideoDevice(videoInputDevices[0].deviceId, qrScanner, (result, err) => {
    //                         if (result) {
    //                             console.log('QR Code detected:', result.getText());
    //                             resultDiv.innerText = result.getText();
    //                             resultDiv.style.display = 'block';
    //                         }
    //                         if (err && !(err instanceof ZXing.NotFoundException)) {
    //                             console.error('Error decoding QR code:', err);
    //                             alert('Error decoding QR code:', err);
    //                         }
    //                     });
    //                 } else {
    //                     console.error('No video input devices found');
    //                     alert('No video input devices found');
    //                 }
    //             })
    //             .catch((err) => {
    //                 console.error('Error getting video input devices:', err);
    //                 alert('Error getting video input devices:', err.message);
    //             });
    //     });

    // function onScanSuccess(scannedQrCode) {
    //     if (inputCount === 0) {
    //         address.value = scannedQrCode; // Insert the scanned QR code into the first input field
    //         inputCount++;
    //     } else if (inputCount === 1) {
    //         qr.value = scannedQrCode; // Insert the scanned QR code into the second input field
    //         html5QrCode.stop().then(ignore => {
    //             console.log("QR Code scanning stopped.");
    //             reader.style.display = 'none'; // Hide the reader element after scanning
    //         }).catch(err => {
    //             console.error("Failed to stop QR Code scanning.", err);
    //             alert("Failed to stop QR Code scanning.", err);
    //         });
    //         inputCount = 0; // Reset the count after both inputs are filled
    //     }
    // }

    // function onScanError(errorMessage) {
    //     // handle scan error (optional)
    //     console.log(`QR Code scan error: ${errorMessage}`);
    //     alert(`QR Code scan error: ${errorMessage}`);
    // }

    // // Create instance of the Html5Qrcode class
    // startButton.addEventListener('click', () => {
    //     reader.style.display = 'block';
    //     html5QrCode = new Html5Qrcode("reader");
    //     html5QrCode.start({
    //             facingMode: "environment"
    //         }, {
    //             fps: 10,
    //             qrbox: 250
    //         },
    //         onScanSuccess,
    //         onScanError
    //     ).catch(err => {
    //         console.error(`Unable to start scanning: ${err}`);
    //         alert(`Unable to start scanning: ${err}`); 
    //     });
    // });
    // QRCode Script End ========================================

    // Call count_partsin function to initially populate total count
   
    function clearSessionStorage() {
        sessionStorage.removeItem("store_in_entries");
        console.log("Local storage cleared");
    }

    const insert_partsin = () => {
        console.log('Inserting parts...');
        // var entries = JSON.parse(sessionStorage.getItem("entries")) || [];
        var store_in_qr = document.getElementById('store_in_qr').value;
        var store_in_address = document.getElementById('store_in_address').value;
        console.log(store_in_qr);

        if (store_in_qr === '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Scan QR !!!',
                text: 'Information',
                showConfirmButton: false,
                timer: 1000
            });

            $('#store_in_qr').val('');
            $('#store_in_qr').focus();
            load_partsin();
        } else if (store_in_address === '') {
            Swal.fire({
                icon: 'info',
                title: 'Please Scan Stock Address !!!',
                text: 'Information',
                showConfirmButton: false,
                timer: 1000
            });
            $('#store_in_qr').val('');
            $('#store_in_address').val('');
            $('#store_in_address').focus();
            // $('#store_in_qr').disabled('true');
            load_partsin();
        } else {
            $.ajax({
                type: "POST",
                url: "../../process/stores/store_in_p.php",
                cache: false,
                data: {
                    method: 'insert_partsin',
                    store_in_qr: store_in_qr,
                    store_in_address: store_in_address,

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

                        $('#store_in_qr').val('');
                        $('#store_in_address').val('');
                        $('#store_in_address').focus();
                        load_partsin();

                    } else if (response == 'duplicate') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Duplicate Data !!!',
                            text: 'Information',
                            showConfirmButton: false,
                            timer: 1000
                        });

                        $('#store_in_qr').val('');
                        $('#store_in_address').val('');
                        $('#store_in_address').focus();
                        load_partsin();

                    } else if (response == 'invalid') {
                        Swal.fire({
                            icon: 'info',
                            title: 'Invalid QR !!!',
                            text: 'Information',
                            showConfirmButton: false,
                            timer: 1000
                        });

                        $('#store_in_qr').val('');
                        $('#store_in_address').focus();
                        load_partsin();

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error !!!',
                            text: 'Error',
                            showConfirmButton: false,
                            timer: 1000
                        });

                        load_partsin();
                    }
                }
            });
        }
    };

    const load_partsin = () => {
        // Retrieve the entries from local storage
        var store_in_entries = JSON.parse(sessionStorage.getItem("store_in_entries")) || [];

        var store_in_address = document.getElementById("store_in_address").value;
        var store_in_qr = document.getElementById("store_in_qr").value;
        $.ajax({
            url: '../../process/stores/store_in_p.php',
            type: 'POST',
            data: {
                method: 'partsin_list',
                store_in_entries: JSON.stringify(store_in_entries),
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
        var store_in_entry = {
            store_in_address: store_in_address,
            store_in_qr: store_in_qr
        };

        // Retrieve existing entries from local storage
        var store_in_entries = JSON.parse(sessionStorage.getItem("store_in_entries")) || [];

        // Check if a similar entry already exists
        var isDuplicate = store_in_entries.some(existingEntry =>
            existingEntry.store_in_address === store_in_entry.store_in_address &&
            existingEntry.store_in_qr === store_in_entry.store_in_qr
        );

        if (store_in_qr.length < 59) {
            console.log('Invalid QR!');
        } else if (!isDuplicate) {
            // Add the new entry
            store_in_entries.push(store_in_entry);

            // Save the updated array back to local storage
            sessionStorage.setItem("store_in_entries", JSON.stringify(store_in_entries));
            load_partsin();
            document.getElementById("store_in_address").value = '';
            document.getElementById("store_in_qr").value = '';
            document.getElementById("store_in_address").focus();
            console.log("Data saved to session storage");
        } else {
            console.log("Entry already exists in session storage");
        }

    }
</script>