<!-- Begin Page Content -->
	<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
    	<div class="col-lg-6">

    		 <?= $this->session->flashdata('message'); ?>

    		 <h5>Role : <?= $role['role']; ?></h5>

    		<table class="table table-hover">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Menu</th>
			      <th scope="col">Access</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php 
			  	$i = 1;
			  	foreach ($menu as $m) : ?>
			    <tr>
			      <th scope="row"><?= $i++ ?></th>
			      <td><?= $m['menu']; ?></td>
			      <td>
			      	<div class="form-check">
			      		<input class="form-check-input" type="checkbox" <?= check_access($role['id'],$m['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $m['id']; ?>">
			      	</div>
			      </td>
			    </tr>
				<?php endforeach; ?>
			    
			  </tbody>
			</table>	
    	</div>
    </div>

                 

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