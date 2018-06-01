<div class="pages-section">

	<section class="section-header">
		
		<div class="container-fluid">
			
			<div class="page-title">
				<h1>Import Country <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#import_guide">See Guide</button></h1>
			</div>

			<div class="breadcrumb-wrap">
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url('admin'); ?>">Admin</a></li>
					<li><a href="<?php echo base_url('admin/countries'); ?>">Tools</a></li>
					<li class="active">Import Country</li>
				</ol>
			</div>

		</div>

	</section>

	<section class="section-content">
		
		<div class="container-fluid">

			<div class="well">

				<form class="countryimport-form" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/countries/import'); ?>">

					<div class="form-group">
						<label>File Input</label>
						<input type="file" name="country" accept=".csv" required />
						<p class="help-block">Import country data csv</p>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-success btn-import">Import</button>
					</div>

				</form>

			</div>

			<div class="well logs" style="display:none;">
				
				<h2>LOGS <button class="btn btn-xs btn-warning clear-logs" title="Clear Import Logs">CLEAR LOGS</button></h2>

				<br/>

				<div class="logs-wrap" style="max-height:300px;overflow-y:scroll;">

				</div>

			</div>

			<div class="modal fade" id="import_guide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			    <div class="modal-dialog modal-lg" role="document">
			        <div class="modal-content">
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
			                </button>
			                <h4 class="modal-title" id="myModalLabel">Import Guide</h4>
			            </div>
			            <div class="modal-body">
			            	
			            </div>
			            <div class="modal-footer">
			                <button type="button" class="btn btn-success" data-dismiss="modal">Got It</button>
			            </div>
			        </div>
			    </div>
			</div>

		</div>

	</section>

</div>