	 <!-- Begin Page Content -->
	<div class="container-fluid">

	    <!-- Page Heading -->
	    <h1 class="h3 mb-4 text-gray-800"><?= $title . ' Surat'; ?></h1>
	    <input type="hidden" name="id" id="id" value="<?php echo $is['is_id']; ?>">

	    <div class="row">
                    	<div class="col-sm-6">
                    		<?= $this->session->flashdata('message'); ?>
                    	</div>
                    </div>

	    <?php echo @$error; ?> 
		<?php echo form_open_multipart('admin/ubahIdentitas');?>
			<div class="row">
				<div class="form-group col-sm-6">
	            	<label for="kepalaDesa">Nama Kepala Desa</label>
	              	<input type="text" class="form-control form-control-sm" id="kepalaDesa" name="kepalaDesa" value="<?= $is['is_kepala_desa']; ?>">
	            </div>

	            <div class="form-group col-sm-6">
	            	<label for="desa">Nama Desa</label>
	              	<input type="text" class="form-control form-control-sm" id="desa" name="desa" value="<?= $is['is_desa']; ?>">
	            </div>

	            <div class="form-group col-sm-6">
	            	<label for="kelurahan">Kelurahan</label>
	              	<input type="text" class="form-control form-control-sm" id="kelurahan" name="kelurahan" value="<?= $is['is_kelurahan']; ?>">
	            </div>

	            <div class="form-group col-sm-6">
	            	<label for="kecamatan">Kecamatan</label>
	              	<input type="text" class="form-control form-control-sm" id="kecamatan" name="kecamatan" value="<?= $is['is_kecamatan']; ?>">
	            </div>

	            <div class="form-group col-sm-6">
	            	<label for="kabupaten">Kabupaten</label>
	              	<input type="text" class="form-control form-control-sm" id="kabupaten" name="kabupaten" value="<?= $is['is_kabupaten']; ?>">
	            </div>

	            <div class="form-group col-sm-6">
	            	<label for="provinsi">Provinsi</label>
	              	<input type="text" class="form-control form-control-sm" id="provinsi" name="provinsi" value="<?= $is['is_provinsi']; ?>">
	            </div>

	            <div class="form-group col-sm-6">
	            	<label for="alamat">Alamat</label>
	              	<textarea type="text" class="form-control form-control-sm" id="alamat" name="alamat"><?= $is['is_alamat']; ?></textarea>
	            </div>

				<div class="form-group col-sm-6">
					<label for="profile_pic">Pilih Logo</label>
					<input class="form-control" type='file' name="profile_pic" id="profile_pic" size='20'>
				</div>

				<div class="form-group col-sm-6">
				    <input class="btn btn-primary btn-sm" type='submit' name='submit' value='Ubah Identitas'>
				</div>
				              
			</div>
		</form>           

	 </div>
	<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->