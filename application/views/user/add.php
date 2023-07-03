<!-- Begin Page Content --> 
<div class="container-fluid">

<!-- Page Heading -->
   <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

   <form action="<?= base_url('user/do_add_user'); ?>" method="post">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" id="nip" name="nip" class="form-control" placeholder="masukan NIP" required>
                <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?> 
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" placeholder="masukan nama" required>
                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?> 
            </div>
            <div class="form-group">
                <label for="tempat_lahir">Tempat Lahir</label>
                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="masukan tempat_lahir" required>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" id="jabatan" name="jabatan" class="form-control" placeholder="masukan jabatan" required>
                <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?> 
            </div>

        </div>

    <div class="col-sm-6">

        <div class="form-group">
                <label for="golongan">Pangkat / Golongan</label>
                <select name="golongan" id="golongan" class="form-control" required>
                    <?php
                        foreach ($golongan as $key => $value) { ?>
                            <option value="<?= $value->id; ?>"><?= $value->golongan; ?></option>
                     <?php  }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="unit_kerja">Unit Kerja</label>
                <select name="unit_kerja" id="unit_kerja" class="form-control" required>
                <?php
                        foreach ($unit_kerja as $key => $value) { ?>
                            <option value="<?= $value->id; ?>"><?= $value->unit_kerja; ?></option>
                     <?php  }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="role_id">Level User</label>
                <select name="role_id" id="role_id" class="form-control" required>
                    <option value="1">Admin</option>
                    <option value="2">Pewawai</option>
                </select>
            </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="is_active" id="is_active" class="form-control"> required
                <option value="0">Tidak Aktif</option>
                <option value="1">Aktif</option>
            </select>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="masukan password" required>
        </div>
    </div>

    <!-- <div class="row"> -->
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('user'); ?>" class="btn btn-danger">Kembali</a>    
    </div>
        </form>
    </div>
    <!-- /.container-fluid -->

</div>
    <!-- End of Main Content -->

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets'); ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets'); ?>/js/sb-admin-2.min.js"></script>