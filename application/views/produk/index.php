<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800 alert"></h1>
	<!-- <div class="mb-0 col-sm-7  alert alert-success">Sukses asdasdasd</div> -->
	<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="./">Data Master</a></li>
	<li class="breadcrumb-item active" aria-current="page">Produk</li>
	</ol>
</div>

<!-- notif nya -->
<div class="row mb-3">
	<div class="col-xl-7 col-lg-7" id="notif">
	<?= $this->session->flashdata('success') ?>
	</div>
</div>

<div class="row mb-3">
	<!-- Invoice Example -->
	<div class="col-xl-7 col-lg-7 mb-4">
		<div class="card">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">List Produk</h6>
				<a class="m-0 float-right"></a>
			</div>
			
			<?php if ($this->session->flashdata('success')): ?>
			<script>
			swal.fire({
			title: "Congratulation",
			text: "Your request has been completed Successfully!",
			icon: "<?php echo site_url('assets/slim/lib/sweetalert/icon/cancel.svg'); ?>",
			button: false,
			timer: 5000,
			});
			</script>
			<?php endif; ?>

			<div class="table-responsive p-3">
			<table class="table align-items-center table-flush" id="table">
				<thead class="thead-light">
					<tr>
						<th>#</th>
						<th>Nama Produk</th>
						<th>Kategori Produk</th>
						<th>Deskripsi Produk</th>
						<th>Harga Produk</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				
				</tbody>
			</table>
			</div>
			<div class="card-footer"></div>
		</div>
	</div>
	<!-- Message From Customer-->
	<div class="card col-xl-5 col-md-5">
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Form Produk</h6>
		</div>
		<div class="card-body">
			<form action="<?= base_url('produk/post')?>" method="POST">
				<input type="hidden" name="id" id="id_produk">
				<div class="form-group row">
					<label for="" class="col-sm-3">Nama Produk</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="nama_produk" id="nama_produk" placeholder="Nama produk" required>
						<div style="font-size: 13px; color:red">
							<?php echo form_error('nama_produk'); ?>
						</div>
					</div>
				</div>
				<div class="form-group row">
					<label for="kat_produk" class="col-sm-3 col-form-label">Kategori Produk</label>
					<div class="col-sm-9">
						<select name="kat_produk" id="kat_produk" class="select2-single-placeholder form-control" required>
							<option value="">Pilih Kategori</option>
							<?php foreach ($kategori as $kat) { ?>
							<option value="<?= $kat->id?>"><?= $kat->nama_kategori?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi Produk</label>
					<div class="col-sm-9">
						<textarea name="deskripsi" id="deskripsi" cols="10" rows="5" class="form-control" placeholder="Deskripsi Produk" required></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label for="harga_produk" class="col-sm-3 col-form-label">Harga Produk</label>
					<div class="col-sm-9">
						<input type="text" name="harga_produk" class="form-control" id="harga_produk" placeholder="Harga produk" required>
					</div>
				</div>
				<hr>
				<div class="form-group row">
					<div class="col-sm-10">
						<a href="javascript:void(0)" class="btn btn-default" onclick="location.reload()">Reset</a>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('.select2-single-placeholder').select2({
			// placeholder: "Pilih kategori produk",
			allowClear: true
		});

		$("#deskripsi").summernote({
			placeholder: 'Tulis deskripsi produk',
			tabsize: 2,
			height: 120,
			toolbar: [
				// ['style', ['style']],
				['font', ['bold', 'underline', 'clear']],
				// ['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				// ['table', ['table']],
				['insert', ['link', 'picture', 'video']],
				['view', ['fullscreen', 'codeview', 'help']]
			]
		})

		$("#table").DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"order": [],
			"ajax": {
				"url" : "<?php echo base_url('produk/produk_list')?>",
				"type": "POST"
			},
			"columnDefs": [
				{ 
					"targets": [ 0 ], //first column / numbering column
					"orderable": false, //set not orderable
				},
			],
		})
	})

	function edit(id) {
	$("#id_produk").val(id)
	// alert('hi' + id)
		$.ajax({
			url : "<?= base_url('produk/fetchdatabyid/')?>"+id, 
			method : "post", 
			data : {
				id : id,
			}, 
			success : function(e) {
				var obj = JSON.parse(e)
				$("#nama_produk").val(obj.nama_produk)
				$("#kat_produk").select2("val", obj.detail_kategori)
				$("#deskripsi").summernote('code', obj.deskripsi_produk)
				$("#harga_produk").val(obj.harga_produk)
			}
		})
	}
</script>
