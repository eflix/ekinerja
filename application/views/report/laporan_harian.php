

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

					<div class="row">
                        <div class="col md-10">
                                <form action="" method="get">
                                    <div class="row">
                                        <div class="col md-11 text-right">
                                            <div class="form-group">
                                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d') ?>">
                                            </div>
                                        </div>
                                        <div class="col md-1">
                                            <button class="btn btn-warning btn-sm" type="submit" value="Submit">Cari</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
						<div class="col md-2 text-right">
							<a class="btn btn-success btn-sm" href="<?= base_url(); ?>report/download_laporan?tanggal=<?=$tanggal?>">Download PDF</a>
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
				            <th width="15%" class="">Tanggal</th>
				            <th class="">Laporan</th>
				          </tr>
				        </thead>
				        <tbody>
				        	<?php 
							$laporan = [];
								foreach ($laporan_harian as $key => $value) :  
									$laporan[] = [
										$value->tanggal => $value->keterangan
									];
								 endforeach; 

								$month = date("m",$tanggal);
								$year = date("Y",$tanggal);

								for ($i=1; $i <= 31; $i++) { 
									if (strlen($i) == 1){
										$tanggal = "$year-$month-0$i";
									} else {
										$tanggal = "$year-$month-$i";
									}

									?>
									<tr>
										<td width="5%"><?= $i ?></td>
										<td width="15%"><?= $tanggal; ?></td>
										<td><?php 
										if ($laporan) {
											foreach ($laporan as $key => $value) {
												if (!empty($value[$tanggal])) {
													echo $value[$tanggal];
												}
											}
										}
										?></td>
									</tr>
									<?php 
								}

							?>  
				          
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
        <h5 class="modal-title" id="newMenuModalLabel">Tambah Laporan Harian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('report/do_add_edit_laporan'); ?>" method="post">
	      <div class="modal-body">
            <input type="hidden" id="id" name="id">
	        <div class="form-group">
		        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d') ?>">
		    </div>
            <div class="form-group">
		        <textarea class="form-control" name="laporan" id="laporan" cols="30" rows="10" placeholder="keterangan"></textarea>
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
				// $('#data-table').DataTable({
				// 	scrollY:        "350px",
				// 	scrollX:        true,
				// 	scrollCollapse: true,
				// });

                // function edit(id){
                //     $("#newMenuModal").modal("show")
                //     $("#newMenuModalLabel").html("Edit Laporan Harian")

                //     var url = "<?= base_url() ?>report/getLaporanById/"+id;
                //     $.get(url, function(data, status){
                //         $("#id").val(data['id']);
                //         $("#tanggal").val(data['tanggal']);
                //         $("#laporan").val(data['keterangan']);
                //     });
                // }

			</script>