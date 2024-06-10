<div class="modal fade bd-example-modal-sm " id="qr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered " role="document">
        <div class="modal-content bg-light">
            <!-- <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">
                    Scan QR
                </h5>
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            <div class="modal-body">
                <strong>Please,</strong> <label id="lbl_qr_modal" style="color:red;">Scan QR</label>.
                <div class="video-box">
                    <video id="reader" playsinline></video>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btnClose close" data-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>
<style>
.video-box {
    border: 2px solid #ccc;
    padding: 10px;
    width: auto;
    height: 250px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.video-box video {
    max-width: 100%;
    max-height: 100%;
}

.modal-footer, .modal-title {
    width: auto;
    display: flex;
    justify-content: center;
    align-items: center;
}

.btnClose{
    font-size: 14px;
    text-align: center;
}
</style>