

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

					<?php 
						$disBulan = $this->input->get('tanggal');
					?>

					<div class="row">
                        <div class="col-md-10">
                                <form action="" method="get">
                                    <div class="row">
                                        <div class="col-md-4 text-right">
                                            <div class="form-group">
                                                <input type="month" class="form-control" id="tanggal" name="tanggal" value="<?= $disBulan ?>">
                                            </div>
                                        </div>
										<?php if ($user['role_id'] == 1) { ?>
										<div class="col-md-6">
										<!-- <label for="id_pegawai">Pegawai</label> -->
											<select name="id_pegawai" id="id_pegawai" class="form-control" required>
												<option value=""></option>
												<?php
													foreach ($users as $key => $value) { ?>
														<option value="<?= $value->id; ?>" <?= ($id_pegawai==$value->id)?"selected":""; ?>><?= $value->nama; ?></option>
												<?php  }
												?>
											</select>
										</div>
										<?php } ?>
                                        <div class="col md-1">
                                            <button class="btn btn-warning btn-sm" type="submit" value="Submit">Cari</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
						<div class="col-md-2 text-right">
							<a class="btn btn-success btn-sm" href="<?= base_url(); ?>report/download_laporan?tanggal=<?=$tanggal?>&id_pegawai=<?=$id_pegawai;?>">Download PDF</a>
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
				            <th width="15%" class="">Hari</th>
				            <th width="15%" class="">Tanggal</th>
				            <th class="">Laporan</th>
				          </tr>
				        </thead>
				        <tbody>
				        	<?php 
							$month_end = strtotime('last day of this month', $tanggal);
							$month_start = strtotime('first day of this month', $tanggal);
							$end_month = date('d', $month_end);

							$haricuti = array();
							$sabtuminggu = array();
							
							for ($i=$month_start; $i <= $month_end; $i += (60 * 60 * 24)) {
								if (date('w', $i) !== '0' && date('w', $i) !== '6') {
									$haricuti[] = $i;
								} else {
									$sabtuminggu[] = $i;
								}
							
							}
							$jumlah_cuti = count($haricuti);

							$laporan = [];
								foreach ($laporan_harian as $key => $value) :  
									$laporan[] = [
										$value->tanggal => $value->keterangan
									];
								 endforeach; 

								 foreach ($haricuti as $key => $value1) {
									$tgl = date('Y-m-d', $value1);
									$hari = strftime("%A", date($value1));
									?>
									<tr>
										<td width="5%"><?= $key+1 ?></td>
										<td width="15%"><?= $hari; ?></td>
										<td width="15%"><?= $tgl; ?></td>
										<td><?php 
										if ($laporan) {
											foreach ($laporan as $key => $value) {
												if (!empty($value[$tgl])) {
													echo $value[$tgl];
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