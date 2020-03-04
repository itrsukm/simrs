<!-- Main Content -->
<div id="content">

	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

		<div class="row">
			<div class="col-lg-6">
				<?= form_error('user', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
				<?= form_error('name', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
				<?= form_error('role', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
				<?= form_error('password1', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

				<?= $this->session->flashdata('message'); ?>


				<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newUserModal">Tambah User Baru</a>

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
						<?php foreach ($datauserrole as $du) : ?>
						<tr>
							<th scope="row"><?= $i; ?></th>
							<td><?= $du['email']; ?></td>
							<td><?= $du['name']; ?></td>
							<td><?= $du['role']; ?></td>
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
<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="newUserModalLabel">Tambah User Baru</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('user/adduser'); ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="user">Username</label>
						<input type="text" class="form-control" id="user" name="user" placeholder="Username@rsukm.com">
					</div>
					<div class="form-group">
						<label for="name">Nama Pengguna</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Nama">
					</div>
					<div class="form-group">
						<label for="password1">Password</label>
						<input type="password" class="form-control" id="password1" name="password1">
					</div>
					<div class="form-group">
						<label for="password2">Ulangi Password</label>
						<input type="password" class="form-control" id="password2" name="password2">
					</div>
					<div class="form-group">
						<label for="role_id">Pilih Role</label>
						<select name="role_id" id="role_id" class="form-control">
							<option value="">Select Menu</option>
							<?php foreach ($role as $r) : ?>
							<option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
							<label class="form-check-label" for="is_active">
								Active
							</label>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Tambah</button>
				</div>
		</div>

		</form>
	</div>
</div>
