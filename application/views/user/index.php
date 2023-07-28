

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

					<div class="row">
						<div class="col md-12">
							<a class="btn btn-primary btn-sm" href="<?= base_url(); ?>user/add">Tambah User</a>
							<a class="btn btn-success btn-sm" href="<?= base_url(); ?>user/import">Import</a>
						</div>
					</div>

                    <div class="row mt-3">
						<div class="col-md-10 bg bg-success">
						<?= $this->session->flashdata('message'); ?>
						</div>
						
				      <div class="col-md-12">

				         <?= form_error('blog', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

				         

				        <table class="table table-hover" id="data-table" style="font-size: 12px; width:100%">
				        <thead>
				          <tr>
				            <th scope="col">#</th>
				            <th class="col-xs-5">Nama</th>
				            <th scope="col">NIP</th>
				            <th scope="col">Tempat Lahir</th>
				            <th scope="col">Tanggal Lahir</th>
				            <th scope="col">Kelas Jabatan</th>
				            <th scope="col">Jabatan</th>
				            <th scope="col">Pangkat / Golongan</th>
				            <th scope="col">Unit Kerja</th>
				            <th scope="col">Level User</th>
				            <th scope="col">Status</th>
				            <th scope="col">Aksi</th>
				          </tr>
				        </thead>
				        <tbody>
				        	<?php 
					          $i = 1;
							  $level_user = "";
							  $status = "";

					          foreach ($users as $key => $value) : 
								if ($value->role_id == 1) {$level_user = "Admin";} else {$level_user = "Pegawai";} 
								if ($value->is_active == 1) {$status = "Aktif";} else {$status = "Tidak Aktif";} 
							  
							  ?>
					          <tr>
					            <td><?= $key+1 ?></td>
					            <td><?= $value->nama; ?></td>
					            <td class="col-xs-5"><?= $value->nip; ?></td>
					            <td class="col-xs-5"><?= $value->tempat_lahir; ?></td>
					            <td class="col-xs-5"><?= $value->tanggal_lahir; ?></td>
					            <td class="col-xs-5"><?= $value->kelas_jabatan; ?></td>
					            <td class="col-xs-5"><?= $value->jabatan; ?></td>
					            <td class="col-xs-5"><?= $value->pangkat_golongan; ?></td>
					            <td class="col-xs-5"><?= $value->unit_kerja; ?></td>
					            <td><?= $level_user; ?></td>
					            <td><?= $status; ?></td>
								<td>
									<a class="btn btn-warning btn-sm" href="<?=base_url();?>user/edit?id=<?=$value->id;?>">edit</a>
									<a class="btn btn-danger btn-sm hapus" href="<?=base_url();?>user/do_delete_user?id=<?=$value->id;?>">hapus</a>
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