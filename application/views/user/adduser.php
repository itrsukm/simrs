<!-- Main Content -->
<div id="content">

	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

		<div class="row">
			<div class="col-lg-6">
				<?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

				<?= $this->session->flashdata('message'); ?>


				<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Tambah User Baru</a>

				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">User</th>
							<th scope="col">Nama</th>
							<th scope="col">role</th>
							<th scope="col">active</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($datauser as $du) : ?>
						<tr>
							<th scope="row"><?= $i; ?></th>
							<td><?= $du['email']; ?></td>
							<td><?= $du['name']; ?></td>
							<td><?= $du['role_id']; ?></td>
							<td><?= $du['is_active']; ?></td>
							<td>
								<a href="" class="badge badge-success editmenu" data-toggle="modal" data-target="#editMenuModal" data-id="<?= $du['id']; ?>">Ubah</a>
								<a href="<?= base_url('menu/deletemenu/') . $du['id']; ?>" class="badge badge-danger tombol-hapus">Hapus</a>
							</td>
						</tr>
						<?php $i++; ?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

	</div>
	<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal tambah-->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="newMenuModalLabel">Tambah Menu Baru</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('menu'); ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" id="menu" name="menu" placeholder="Nama Menu">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal edit-->
<div class="modal fade" id="editMenuModal" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editMenuModalLabel">Ubah Nama Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('menu/updatemenu'); ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" class="form-control" id="menueditid" name="id">
						<input type="text" class="form-control" id="menuedit" name="menu">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Ubah</button>
				</div>
			</form>
		</div>
	</div>
</div>
