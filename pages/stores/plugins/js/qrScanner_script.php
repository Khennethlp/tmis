<script>
// alert('Why??');
    const videoElement = document.getElementById('reader');
    const resultDiv = document.getElementById('result');

    const storeinaddress = document.getElementById('address_qr');
    const storeinqr = document.getElementById('kanban_qr');
    const kanbanqrout = document.getElementById('kanban_qr_out');

    const store_in_address = document.getElementById('store_in_address');
    const store_in_qr = document.getElementById('store_in_qr');
    const store_out_qr = document.getElementById('store_out_qr');

    const label = document.getElementById('lbl_qr_modal');
    const codeReader = new ZXing.BrowserQRCodeReader();

    // function stopVideoStream() {
    //         if (stream) {
    //             stream.getTracks().forEach(track => track.stop());
    //             videoElement.srcObject = null;
    //             console.log('Camera stream stopped.');
    //         }
    //     }

    function startScanner(inputElement) {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({
                        video: { facingMode: 'environment' }
                    })
                    .then((stream) => {
                        $('#qr').modal('show');
                        videoElement.srcObject = stream;
                        videoElement.play();
                        console.log('Camera stream started.');
                        inputElement.focus();
                        codeReader.decodeFromVideoElement(videoElement)
                            .then(result => {
                                console.log('QR code detected:', result);
                              
                                inputElement.value = result.text;
                                inputElement.focus();
                                codeReader.reset();
                               
                                $('#qr').modal('hide');
                            })
                            .catch(err => {
                                console.error('Error decoding QR code:', err);
                                resultDiv.textContent = 'Error decoding QR code: ' + err.message;
                            });
                    })
                    .catch((err) => {
                        console.error('Error accessing camera:', err);
                        alert('Error accessing camera: ' + err.message);
                        
                    });
            } else {
                alert('getUserMedia is not supported by your browser');
            }
        }

        storeinaddress.addEventListener('click', () => {
            startScanner(store_in_address);
            label.textContent = storeinaddress.click ? "Scan Address Qr" : "Scan Kanban QR";
        });

        storeinqr.addEventListener('click', () => {
            startScanner(store_in_qr);
            document.getElementById('store_in_qr').addEventListener('keypress', handleEnterKeyPress);
            label.textContent = storeinqr.click ? "Scan Kanban QR":"Scan Address Qr";
        });

        kanbanqrout.addEventListener('click', () => {
            startScanner(store_out_qr);
            label.textContent = kanbanqrout.click ? "Scan Kanban QR":"Scan Qr";
        });

    // QRCode Script End ========================================
</script>