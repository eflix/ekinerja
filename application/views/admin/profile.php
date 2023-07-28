	 <!-- Begin Page Content -->
     <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

            <div class="row">
                <div class="col-sm-6">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>

            <div class="row">
                <div class="row col-md-6">
                    <div class="col-md-5 text-right">
                        <div class="form-group">
                            <span>Nama</span>
                        </div>
                    </div>
                    <div class="col-md-7 text-left">
                        <div class="form-group">
                            <?= "  :     " . $pegawai->nama; ?>
                        </div>
                    </div>
                    <div class="col-md-5 text-right">
                        <div class="form-group">
                            <span>NIP</span>
                        </div>
                    </div>
                    <div class="col-md-7 text-left">
                        <?= "  :     " . $pegawai->nip; ?>
                    </div>
                    <div class="col-md-5 text-right">
                        <div class="form-group">
                            <span>Tempat Lahir</span>
                        </div>
                    </div>
                    <div class="col-md-7 text-left">
                        <?= "  :     " . $pegawai->tempat_lahir; ?>
                    </div>
                    <div class="col-md-5 text-right">
                        <div class="form-group">
                            <span>Tanggal Lahir</span>
                        </div>
                    </div>
                    <div class="col-md-7 text-left">
                        <?= "  :     " . $pegawai->tanggal_lahir; ?>
                    </div>
                    <div class="col-md-5 text-right">
                        <div class="form-group">
                            <span>Jabatan</span>
                        </div>
                    </div>
                    <div class="col-md-7 text-left">
                        <?= "  :     " . $pegawai->jabatan; ?>
                    </div>
                    <div class="col-md-5 text-right">
                        <div class="form-group">
                            <span>Pangkat / Golongan</span>
                        </div>
                    </div>
                    <div class="col-md-7 text-left">
                        <?= "  :     " . $pegawai->pangkat_golongan; ?>
                    </div>
                    <div class="col-md-5 text-right">
                        <div class="form-group">
                            <span>Unit Kerja</span>
                        </div>
                    </div>
                    <div class="col-md-7 text-left">
                        <?= "  :     " . $pegawai->unit_kerja; ?>
                    </div>
                    <div class="col-md-5 text-right">
                        <div class="form-group">
                            <span>Kelas Jabatan</span>
                        </div>
                    </div>
                    <div class="col-md-7 text-left">
                        <?= "  :     " . $pegawai->kelas_jabatan; ?>
                    </div>
                </div>
                <div class="row col-md-6">
                    <form action="" method="post">
                        <input type="hidden" name="id" id="id" value="<?= $user['id']; ?>">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" id="password" name="password" placeholder="masukan password" required>
                                </div>        
                            </div>
                            <div class="col-md-2" style="margin-top:30px;">
                                <div class="form-group">
                                    <input class="btn btn-primary btn-sm" type='submit' name='submit' value="Ubah Password">
                                </div>
                            </div>
                        </div>
                    </form>   
                </div>
            </div>
                

        

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->