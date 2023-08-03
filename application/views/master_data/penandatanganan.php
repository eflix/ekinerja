

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

					<div class="row">
						<div class="col md-2">
							<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newMenuModal">Tambah Tanda Tangan</button>
						</div>
						<div class="col md-10 text-right">
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
				            <th class="col-xs-5">Nama</th>
				            <th class="col-xs-5">NIP</th>
				            <th class="col-xs-5">Jabatan</th>
				            <th scope="col" width="12%">Aksi</th>
				          </tr>
				        </thead>
				        <tbody>
				        	<?php 
					          $i = 1;
					          foreach ($penandatanganan as $key => $value) : ?>
					          <tr>
					            <td><?= $key+1 ?></td>
					            <td><?= $value->unit_kerja; ?></td>
					            <td class="col-xs-5"><?= $value->nama; ?></td>
					            <td class="col-xs-5"><?= $value->nip; ?></td>
					            <td class="col-xs-5"><?= $value->jabatan; ?></td>
								<td style="width:12%">
									<a class="btn btn-danger btn-sm hapus" href="<?=base_url();?>master_data/do_delete_penandatanganan?id=<?=$value->id;?>">hapus</a>
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
        <h5 class="modal-title" id="newMenuModalLabel">Tambah Kelas Jabatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('master_data/do_add_edit_penandatanganan'); ?>" method="post">
	      <div class="modal-body">
            <input type="hidden" id="id" name="id">
            <div class="form-group">
                <select name="id_unit_kerja" id="id_unit_kerja" class="form-control" required>
                    <option value=""></option>
                    <?php
                        foreach ($unit_kerja as $key => $value) { ?>
                            <option value="<?= $value->id; ?>"><?= $value->unit_kerja; ?></option>
                    <?php  }
                    ?>
                </select>
            </div>
	        <div class="form-group">
		        <input type="text" class="form-control" id="nama" name="nama" placeholder="masukan nama">
		    </div>
            <div class="form-group">
			    <input type="text" class="form-control" id="nip" name="nip" placeholder="masukan nip">
		    </div>
            <div class="form-group">
			    <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="masukan jabatan">
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