

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

					<div class="row">
                        <div class="col-md-10">
                                <form action="" method="get">
                                    <div class="row">
                                        <div class="col-md-2 text-right">
                                            <div class="form-group">
                                                <select name="year" id="year" class="form-control">
                                                    <?php
                                                    $thisYear = date('Y');
                                                    for ($i=$thisYear; $i >= 2020 ; $i--) { ?>
                                                        <option value="<?= $i; ?>" <?= ($year == $i)?"selected":"";?> ><?= $i; ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
											
                                        </div>
										<div class="col-md-2">
											
										<div class="form-group">
                                                <select name="month" id="month" class="form-control">
                                                    <option value="1" <?= ($month == 1)?"selected":"";?>>Januari</option>
                                                    <option value="2" <?= ($month == 2)?"selected":"";?>>Februari</option>
                                                    <option value="3" <?= ($month == 3)?"selected":"";?>>Maret</option>
                                                    <option value="4" <?= ($month == 4)?"selected":"";?>>April</option>
                                                    <option value="5" <?= ($month == 5)?"selected":"";?>>Mei</option>
                                                    <option value="6" <?= ($month == 6)?"selected":"";?>>Jui</option>
                                                    <option value="7" <?= ($month == 7)?"selected":"";?>>Juli</option>
                                                    <option value="8" <?= ($month == 8)?"selected":"";?>>Agustus</option>
                                                    <option value="9" <?= ($month == 9)?"selected":"";?>>September</option>
                                                    <option value="10" <?= ($month == 10)?"selected":"";?>>Oktober</option>
                                                    <option value="11" <?= ($month == 11)?"selected":"";?>>November</option>
                                                    <option value="12" <?= ($month == 12)?"selected":"";?>>Desember</option>
                                                </select>
                                            </div>
										</div>
                                        <div class="col-md-1">
                                            <button class="btn btn-warning btn-sm" type="submit" value="Submit">Cari</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
						<div class="col-md-2 text-right">
							<a class="btn btn-success btn-sm" href="<?= base_url(); ?>report/download_tukin_admin?year=<?=$year?>&month=<?=$month;?>">Download PDF</a>
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
				            <th class="">Nama</th>
				            <th class="">Bulan</th>
				            <th class="">Tunjangan</th>
				            <th class="">Potongan</th>
				            <th class="">Tunjangan Bersih</th>
				          </tr>
				        </thead>
				        <tbody>
				        	<?php 
					          $i = 1;
					          foreach ($tukin as $key => $value) : ?>
					          <tr>
					            <td><?= $key+1 ?></td>
					            <td><?= $value->nama; ?></td>
					            <td><?= $value->bulan; ?></td>
					            <td class=""><?= number_format($value->tunjangan_jabatan,2); ?></td>
					            <td class=""><?= number_format($value->potongan,2); ?></td>
					            <td class=""><?= number_format($value->jml_bersih,2); ?></td>
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