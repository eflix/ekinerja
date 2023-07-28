<!-- Begin Page Content --> 
<div class="container-fluid">

<!-- Page Heading -->
   <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

   <form action="<?= base_url('user/do_edit_user'); ?>" method="post">
    <div class="row">
    <div class="col-sm-6">
        <input type="hidden" id="id" name="id" value="<?= $detail_user->id; ?>">
        <div class="form-group">
            <label for="nip">NIP</label>
            <input type="text" id="nip" name="nip" class="form-control" placeholder="masukan NIP" value="<?= $detail_user->nip; ?>" required>
            <?= form_error('nip', '<small class="text-danger pl-3">', '</small>'); ?> 
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" class="form-control" placeholder="masukan nama" value="<?= $detail_user->nama; ?>" required>
            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?> 
        </div>
        <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="masukan tempat_lahir" value="<?= $detail_user->tempat_lahir; ?>" required>
        </div>
        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="<?= $detail_user->tanggal_lahir; ?>" required>
        </div>
        <div class="form-group">
            <label for="jabatan">Kelas Jabatan</label>
            <select name="id_kelas_jabatan" id="id_kelas_jabatan" class="form-control" required>
                    <?php
                        foreach ($kelas_jabatan as $key => $value) { ?>
                            <option value="<?= $value->id; ?>" <?= ($detail_user->id_kelas_jabatan == $value->id)?'selected':''; ?>><?= $value->kelas_jabatan; ?></option>
                     <?php  }
                    ?>
                </select>
        </div>
        
        <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" id="jabatan" name="jabatan" class="form-control" value="<?= $detail_user->jabatan; ?>" placeholder="masukan jabatan" required>
            </div>

    </div>

    <div class="col-sm-6">

        <div class="form-group">
                <label for="pangkat_golongan">Pangkat / Golongan</label>
                <select name="pangkat_golongan" id="pangkat_golongan" class="form-control" required>
                    <option value="I.a" <?php ($detail_user->pangkat_golongan == "I.a")?"selected":""; ?>>I.a</option>
                    <option value="I.b" <?php ($detail_user->pangkat_golongan == "I.b")?"selected":""; ?>>I.b</option>
                    <option value="I.c" <?php ($detail_user->pangkat_golongan == "I.c")?"selected":""; ?>>I.c</option>
                    <option value="I.d" <?php ($detail_user->pangkat_golongan == "I.d")?"selected":""; ?>>I.d</option>
                    <option value="I.e" <?php ($detail_user->pangkat_golongan == "I.e")?"selected":""; ?>>I.e</option>
                    <option value="II.a" <?php ($detail_user->pangkat_golongan == "II.a")?"selected":""; ?>>II.a</option>
                    <option value="II.b" <?php ($detail_user->pangkat_golongan == "II.b")?"selected":""; ?>>II.b</option>
                    <option value="II.c" <?php ($detail_user->pangkat_golongan == "II.c")?"selected":""; ?>>II.c</option>
                    <option value="II.d" <?php ($detail_user->pangkat_golongan == "II.d")?"selected":""; ?>>II.d</option>
                    <option value="II.e" <?php ($detail_user->pangkat_golongan == "II.e")?"selected":""; ?>>II.e</option>
                    <option value="III.a" <?php ($detail_user->pangkat_golongan == "III.a")?"selected":""; ?>>III.a</option>
                    <option value="III.b" <?php ($detail_user->pangkat_golongan == "III.b")?"selected":""; ?>>III.b</option>
                    <option value="III.c" <?php ($detail_user->pangkat_golongan == "III.c")?"selected":""; ?>>III.c</option>
                    <option value="III.d" <?php ($detail_user->pangkat_golongan == "III.d")?"selected":""; ?>>III.d</option>
                    <option value="III.e" <?php ($detail_user->pangkat_golongan == "III.e")?"selected":""; ?>>III.e</option>
                    <option value="IV.a" <?php ($detail_user->pangkat_golongan == "IV.a")?"selected":""; ?>>IV.a</option>
                    <option value="IV.b" <?php ($detail_user->pangkat_golongan == "IV.b")?"selected":""; ?>>IV.b</option>
                    <option value="IV.c" <?php ($detail_user->pangkat_golongan == "IV.c")?"selected":""; ?>>IV.c</option>
                    <option value="IV.d" <?php ($detail_user->pangkat_golongan == "IV.d")?"selected":""; ?>>IV.d</option>
                    <option value="IV.e" <?php ($detail_user->pangkat_golongan == "IV.e")?"selected":""; ?>>IV.e</option>
                    <!-- <?php
                        foreach ($golongan as $key => $value) { ?>
                            <option value="<?= $value->id; ?>" <?= ($detail_user->id_golongan == $value->id)?'selected':''; ?>><?= $value->golongan; ?></option>
                     <?php  }
                    ?> -->
                </select>
            </div>
            
            <div class="form-group">
                <label for="unit_kerja">Unit Kerja</label>
                <select name="unit_kerja" id="unit_kerja" class="form-control" required>
                <?php
                        foreach ($unit_kerja as $key => $value) { ?>
                            <option value="<?= $value->id; ?>" <?= ($detail_user->id_unit_kerja == $value->id)?'selected':''; ?>><?= $value->unit_kerja; ?></option>
                     <?php  }
                    ?>
                </select>
            </div>

        <div class="form-group">
            <label for="tempatLahir">Level User</label>
            <select name="role_id" id="role_id" class="form-control" required>
                <option value="1" <?php echo ($detail_user->role_id==1)?'selected':''; ?>>Admin</option>
                <option value="2" <?php echo ($detail_user->role_id==2)?'selected':''; ?>>Pegawai</option>
            </select>
        </div>

        <div class="form-group">
            <label for="tempatLahir">Status</label>
            <select name="is_active" id="is_active" class="form-control"> required
                <option value="0" <?php echo ($detail_user->is_active==0)?'selected':''; ?>>Tidak Aktif</option>
                <option value="1" <?php echo ($detail_user->is_active==1)?'selected':''; ?>>Aktif</option>
            </select>
        </div>

        <div class="form-group">
            <label for="password">Password (isi password jika di rubah)</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="masukan password">
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