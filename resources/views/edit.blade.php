<div id="ModalEditForm" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Edit</h1>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="">
                @csrf
                    <input type="hidden" name="id" id="id_field" value="">
                    <div class="form-group">
                        <label class="control-label">IP:-</label>
                        <div>
                            <input type="text" id="edit_ip" class="form-control input-lg" name="IP" value="" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">SAPID</label>
                        <div>
                            <input type="text" id="edit_sapid" class="form-control input-lg" name="sapid" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">HOSTNAME</label>
                        <div>
                            <input type="text" id="edit_host" class="form-control input-lg" name="hostname" value="" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">LOOPBACK</label>
                        <div>
                            <input type="text" id="edit_loop" class="form-control input-lg" name="loopback" value="" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">MAC-ADDRESS</label>
                        <div>
                            <input type="text"  id="edit_mac" class="form-control input-lg" name="mac" value="" >
                        </div>
                    </div>
                    
                    
                   
                    <div class="form-group">
                        <div>
                            <button type="submit" class="router-update btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>