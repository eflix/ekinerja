<!-- Begin Page Content -->
	<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal">Add New Role</a>

    <div class="row">
    	<div class="col-lg-6">

    		 <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

    		 <?= $this->session->flashdata('message'); ?>

    		<table class="table table-hover">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Role</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php 
			  	$i = 1;
			  	foreach ($role as $r) : ?>
			    <tr>
			      <th scope="row"><?= $i++ ?></th>
			      <td><?= $r['role']; ?></td>
			      <td>
			      	<a class="badge badge-warning" href="<?= base_url('admin/roleaccess/') . $r['id']; ?>">acess</a>
			      	<a class="badge badge-success" href="">edit</a>
			      	<a class="badge badge-danger" href="">hapus</a>
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

<!-- Modal -->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/role'); ?>" method="post">
	      <div class="modal-body">
	        <div class="form-group">
		    <input type="text" class="form-control" id="role" name="role" placeholder="Role Name">
		  </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Add</button>
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