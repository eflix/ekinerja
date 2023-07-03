<!-- Begin Page Content -->
	<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Add New Submenu</a>

    <div class="row">
    	<div class="col-lg-10">

    		<?php if(validation_errors()) : ?>
    			<div class="alert alert-danger" role="alert">
    				<?= validation_errors(); ?>
    			</div>
    		<?php endif; ?>

    		 <?= $this->session->flashdata('message'); ?>

    		<table class="table table-hover">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Title</th>
			      <th scope="col">Menu</th>
			      <th scope="col">Url</th>
			      <th scope="col">Icon</th>
			      <th scope="col">Active</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php 
			  	$i = 1;
			  	foreach ($subMenu as $sm) : ?>
			    <tr>
			      <th scope="row"><?= $i++ ?></th>
			      <td><?= $sm['title']; ?></td>
			      <td><?= $sm['menu']; ?></td>
			      <td><?= $sm['url']; ?></td>
			      <td><?= $sm['icon']; ?></td>
			      <td><?= $sm['is_active']; ?></td>
			      <td>
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
<div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubMenuModalLabel">Add New Sub Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('menu/submenu'); ?>" method="post">
	      <div class="modal-body">
	        <div class="form-group">
		    <input type="text" class="form-control" id="title" name="title" placeholder="Sub Menu Title">
		  </div>
		  <div class="form-group">
		  	<select name="menu_id" name="menu_id" class="form-control">
		  		<option>Select Menu</option>
		  		<?php foreach ($menu as $m) : ?>
		  			<option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
		  		<?php endforeach; ?>
		  	</select>
		  </div>
	        <div class="form-group">
		    	<input type="text" class="form-control" id="url" name="url" placeholder="Sub Menu Url">
		  </div>
	        <div class="form-group">
		    	<input type="text" class="form-control" id="icon" name="icon" placeholder="Sub Menu Icon">
		  </div>
		  <div class="form-group">
		  	<div class="form-check">
		    	<input type="checkbox" class="form-check-input" value ="1" id="is_active" name="is_active" checked>
		    	<label class="form-check-label" for="is_active">Active ?</label>
		    </div>
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