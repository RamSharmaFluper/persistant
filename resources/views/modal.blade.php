<div id="ModalLoginForm" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Add</h1>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="">
                @csrf
                    <input type="hidden" name="_token" value="">
                    <div class="form-group">
                        <label class="control-label">IP:-</label>
                        <div>
                            <input type="text" id="ip" class="form-control input-lg" name="IP" value="" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">SAPID</label>
                        <div>
                            <input type="text" id="sapid" class="form-control input-lg" name="sapid" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">HOSTNAME</label>
                        <div>
                            <input type="text" id="host" class="form-control input-lg" name="hostname" value="" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">LOOPBACK</label>
                        <div>
                            <input type="text" id="loop" class="form-control input-lg" name="loopback" value="" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">MAC-ADDRESS</label>
                        <div>
                            <input type="text"  id="mac" class="form-control input-lg" name="mac" value="" >
                        </div>
                    </div>
                    
                    
                   
                    <div class="form-group">
                        <div>
                            <button type="submit" class="router-submite btn btn-success">Submite</button>

                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>