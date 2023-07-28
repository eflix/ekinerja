<!-- Begin Page Content --> 
<div class="container-fluid">

<!-- Page Heading -->
   <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

   <form action="<?= base_url('user/do_import_user'); ?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="exampleInputFile">File Upload</label>
                <input type="file" name="berkas_excel" class="form-control" id="exampleInputFile" required>
            </div>
            <div class="form-group">
                <a href="<?=base_url()?>assets\template\excel\template_import_pegawai.xlsx">Download Template</a>
            </div>
        </div>

    <!-- <div class="row"> -->
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Import</button>
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