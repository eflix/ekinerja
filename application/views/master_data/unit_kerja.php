

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

					<div class="row">
						<div class="col md-2">
							<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newMenuModal">Tambah Unit Kerja</button>
						</div>
						<div class="col md-10 text-right">
							<!-- <a class="btn btn-success btn-sm" href="<?= base_url(); ?>master_data/export_tokoh">Export</a> -->
							<!-- <a class="btn btn-primary btn-sm" href="<?= base_url(); ?>report/print_ktp?param=all&value=">Print KTP</a> -->
						</div>
					</div>

                    <div class="row mt-3">
						
				      <div class="col-md-12">

				         <!-- <?= form_error('blog', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

				         <?= $this->session->flashdata('message'); ?> -->

				        <table class="table table-hover" id="data-table" style="font-size: 12px;">
				        <thead>
				          <tr>
				            <th scope="col">#</th>
				            <th class="col-xs-5">Unit Kerja</th>
				            <th class="col-xs-5">Tingkatan</th>
				            <th scope="col" width="12%">Aksi</th>
				          </tr>
				        </thead>
				        <tbody>
				        	<?php 
					          $i = 1;
					          foreach ($events as $key => $value) : ?>
					          <tr>
					            <td><?= $key+1 ?></td>
					            <td><?= $value->unit_kerja; ?></td>
					            <td class="col-xs-5"><?= $value->tingkatan; ?></td>
								<td style="width:12%">
									<button class="btn btn-warning btn-sm" onclick="edit(<?=$value->id;?>)">edit</button>
									<a class="btn btn-danger btn-sm hapus" href="<?=base_url();?>master_data/do_delete_unit_kerja?id=<?=$value->id;?>">hapus</a>
								</td>
					          </tr>
				        	<?php $i++; endforeach; ?>  
				          
				        </tbody>
				      </table>  
				       

				      </div>
				    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->   

	<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMenuModalLabel">Tambah Unit Kerja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('master_data/do_add_edit_unit_kerja'); ?>" method="post">
	      <div class="modal-body">
            <input type="hidden" id="id" name="id">
	        <div class="form-group">
		        <input type="text" class="form-control" id="unit_kerja" name="unit_kerja" placeholder="masukan nama unit kerja">
		    </div>
            <div class="form-group">
			<input type="text" class="form-control" id="tingkatan" name="tingkatan" placeholder="masukan tingkatan">
		    </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
	        <button type="submit" class="btn btn-primary">Simpan</button>
	      </div>
      </form>
    </div>
  </div>
</div>	   

<div class="modal fade" id="confirmModal" >
	<div class="modal-dialog">
		<div class="modal-content">
		<!--<div class="overlay">
			<i class="fas fa-2x fa-sync fa-spin"></i>
		</div>-->
		<div class="modal-header">
			<h4 class="modal-title">Konfirmasi</h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<p>Yakin hapus data ini?</p>
		</div>
		<div class="modal-footer justify-content-between">
			<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
			<button type="button" class="btn btn-danger" onclick="confirmAction()" >Ya, hapus sekarang</button>
		</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

			<!-- Bootstrap core JavaScript-->
			<script src="<?= base_url('assets'); ?>/vendor/jquery/jquery.min.js"></script>
			<script src="<?= base_url('assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

			<!-- Core plugin JavaScript-->
			<script src="<?= base_url('assets'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

			<!-- Custom scripts for all pages-->
			<script src="<?= base_url('assets'); ?>/js/sb-admin-2.min.js"></script>
			<script src="<?= base_url('assets'); ?>/datatables/jquery.dataTables.js"></script>
			<script src="<?= base_url('assets'); ?>/datatables/dataTables.bootstrap4.min.js"></script>

			<script>
				$('#data-table').DataTable({
					scrollY:        "350px",
					scrollX:        true,
					scrollCollapse: true,
				});

				function edit(id){
                    $("#newMenuModal").modal("show")
                    $("#newMenuModalLabel").html("Edit Unit Kerja")

                    var url = "<?= base_url() ?>master_data/getUnitKerjaById/"+id;
                    $.get(url, function(data, status){
						data = JSON.parse(data)
                        $("#id").val(data['id']);
                        $("#unit_kerja").val(data['unit_kerja']);
                        $("#tingkatan").val(data['tingkatan']);
                    });
                }

				$(".hapus").click(function (e) {
					e.preventDefault();
					URL = $(this).attr("href");
					$("#confirmModal").modal({
						backdrop: "static"
					});
				});

				function confirmAction() {
					$.ajax({
						type: "GET",
						url: URL,
					}).done(function (msg) {
						location.reload();
					});
				}

			</script>