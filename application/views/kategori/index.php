<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800"></h1>
	<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="./">Data Master</a></li>
	<li class="breadcrumb-item active" aria-current="page">Kategori Produk</li>
	</ol>
</div>

<div class="row mb-3">
	<!-- Invoice Example -->
	<div class="col-xl-7 col-lg-7 mb-4">
		<div class="card">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">List Kategori Produk</h6>
				<a class="m-0 float-right"></a>
			</div>
			<div class="table-responsive p-3">
			<table class="table align-items-center table-flush" id="table">
				<thead class="thead-light">
				<tr>
					<th>#</th>
					<th>Nama Kategori</th>
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
			<h6 class="m-0 font-weight-bold text-primary">Form Kategori Produk</h6>
		</div>
		<div class="card-body">
			<form action="<?= base_url('kategori/post')?>" method="POST">
				<input type="hidden" id="id_kategori" name="id_kategori">
				<div class="form-group row">
					<label for="kat_produk" class="col-sm-4 col-form-label">Nama Kategori Produk</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="kat_produk" id="kat_produk" placeholder="Nama Produk" required>
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
	<!-- Message From Kamera-->
</div>
<script>
	var table;
	$(document).ready(function() {
		table = $("#table").DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"order": [],
			"ajax": {
				"url" : "<?php echo base_url('kategori/kategori_list')?>",
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
		$("#id_kategori").val(id)
		
		$.ajax({
			url : "<?= base_url('kategori/fetchdatabyid/')?>"+id, 
			method : "post", 
			data : {
				id : id,
			}, 
			success : function(e) {
				var obj = JSON.parse(e)
				$("#kat_produk").val(obj.nama_kategori)
			}
		})
	}
</script>
