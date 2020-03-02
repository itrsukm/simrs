// rubah akses user
$('.form-check-input').on('click', function () {
	const menuId = $(this).data('menu');
	const roleId = $(this).data('role');

	$.ajax({
		url: 'http://localhost/ci/admin/changeaccess',
		type: 'post',
		data: {
			menuId: menuId,
			roleId: roleId
		},
		success: function () {
			document.location.href = 'http://localhost/ci/admin/roleaccess/' + roleId;
		}
	});
});

// ambil data value di modal edit role
$('.editrole').on('click', function () {
	const id = $(this).data('id');

	$.ajax({
		url: 'http://localhost/ci/admin/geteditrole',
		data: {
			id: id
		},
		method: 'post',
		dataType: 'json',
		success: function (data) {
			$('#roleedit').val(data.role);
			$('#idroleedit').val(data.id);
		}
	});
});


// sweet alert untuk tombol hapus
$('.tombol-hapus').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');
	Swal.fire({
		title: 'Apakah anda yakin',
		text: "Data ini akan dihapus?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya, Hapus!'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
});
