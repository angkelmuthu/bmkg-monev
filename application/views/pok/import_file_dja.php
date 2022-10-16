
<main id="js-page-content" role="main" class="page-content">
    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2>Import DJA </h2>
                    <div class="panel-toolbar">
                        <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                        <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
					<form  method="post" enctype="multipart/form-data"  class="form-horizontal" role="form" onsubmit="return confSubmit();">
                        <table class="table table-clean">
							<tr>
                                <td>File DJA</td>
                                <td><input type="file" id="impor"  class="btn btn-warning" name="impor"></td>
                            </tr>
							<tr>
							<td> </td>
							<td><button type="submit" class="btn btn-block btn-success" name='submit' value='import'>Import</button></td>
							</tr>

                        </table>
					</form>
					 <div class="ajax-loader text-center">
                            <img id="loading-pok" style="display:none;" src="<?php echo base_url() ?>assets/smartadmin/img/loading.gif" class="img-responsive" />
						</div>
						
                       

                    </div>
					
                </div>
            </div>
        </div>
    </div>
</main>