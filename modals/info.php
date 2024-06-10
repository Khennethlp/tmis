<style>
    .inline-row {
        display: flex;
        align-items: center;
    }
</style>
<div class="modal fade bd-example-modal-xl " id="info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered " role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel">
                    PC Info
                </h5>

                <!-- <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <div class="modal-body">
                <div class="row row-cols-12">
                    <div class="col-4">PC NAME</div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-7">
                        <p class="info border border-secondary rounded text-center" id="pc_name" onclick="copy_pcname()">
                            <?= gethostbyaddr($_SERVER['REMOTE_ADDR']); ?>
                            <i class="fas fa-copy copy-icon pcn-icon" onclick="copy_pcname()"></i>
                        </p>
                    </div>

                    <div class="col-4">PC IP</div>
                    <div class="col-1">
                        <p>:</p>
                    </div>
                    <div class="col-7">
                        <p class="info border border-secondary rounded text-center" id="pc_ip" onclick="copy_pcip()">
                            <?php echo getHostByName(getHostName()); ?>
                            <i class="fas fa-copy copy-icon pcip-icon" onclick="copy_pcip()"></i>
                        </p>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn text-sm close border border-secondary px-5 py-2" data-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>