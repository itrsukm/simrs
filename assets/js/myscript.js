// rubah akses user
$('.form-check-input').on('click', function () {
	const menuId = $(this).data('menu');
	const roleId = $(this).data('role');

	$.ajax({
		url: base_url + "admin/changeaccess",
		type: 'post',
		data: {
			menuId: menuId,
			roleId: roleId
		},
		success: function () {
			document.location.href = base_url + "admin/roleaccess/" + roleId;
		}
	});
});

// ambil data value di modal edit role
$('.editrole').on('click', function () {
	const id = $(this).data('id');

	$.ajax({
		url: base_url + "admin/geteditrole",
		data: {
			id: id
		},
		method: 'post',
		dataType: 'json',
		success: function (data) {
			// console.log(data);
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

// ambil data value di modal edit menu
$('.editmenu').on('click', function () {
	const id = $(this).data('id');

	$.ajax({
		url: base_url + "menu/geteditmenu",
		data: {
			id: id
		},
		method: 'post',
		dataType: 'json',
		success: function (data) {
			$('#menuedit').val(data.menu);
			$('#menueditid').val(data.id);
		}
	});
});

// ambil data value di modal edit submenu
$('.editsubmenu').on('click', function () {
	const id = $(this).data('id');

	$.ajax({
		url: base_url + "menu/geteditsubmenu",
		data: {
			id: id
		},
		method: 'post',
		dataType: 'json',
		success: function (data) {
			// console.log(data);
			$('#editsm_id').val(data.id);
			$('#editsm_title').val(data.title);
			$('#editsm_menu_id').val(data.menu_id);
			$('#editsm_url').val(data.url);
			$('#editsm_icon').val(data.icon);
			$('#editsm_is_active').val(data.is_active);
		}
	});
});

// ambil data value di modal edit user
$('.edituser').on('click', function () {
	const id = $(this).data('id');

	$.ajax({
		url: base_url + "user/getedituser",
		data: {
			id: id
		},
		method: 'post',
		dataType: 'json',
		success: function (data) {
			// console.log(data);
			$('#editid').val(data.id);
			$('#edituser').val(data.email);
			$('#editname').val(data.name);
			$('#editrole').val(data.role_id);
		}
	});
});
