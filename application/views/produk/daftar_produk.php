<style>
	/* .daftar-produk {
		height: 80%;
	} */
	.isi {
		height: 15rem;
	}
</style>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800 alert"></h1>
	<!-- <div class="mb-0 col-sm-7  alert alert-success">Sukses asdasdasd</div> -->
	<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="./">Data Master</a></li>
	<li class="breadcrumb-item active" aria-current="page">Daftar Produk</li>
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
	<div class="col-xl-12 col-lg-7 mb-4">
		<div class="card">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Produk</h6>
				<a class="m-0 float-right"></a>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-sm-3">
						<div class="card daftar-produk">
							<img class="card-img-top" src="<?= base_url('assets/template/img/test/standard_repo.png')?>" alt="Card image cap">
							<div class="card-body">
								<div class="text-center" style="margin-bottom: 8%;">
									<h5 class="card-title">majoo Pro</h5>
									<h5 class="card-title"><small>Rp. </small><b>2.750.000</b></h5>
								</div>
								<p class="card-text isi">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab quia earum hic deleniti dolorem harum alias vero inventore assumenda. Distinctio accusantium aspernatur architecto non suscipit labore culpa possimus aliquid alias.</p>
								<hr>
								<div class="text-center">
									<a href="#" class="btn btn-primary">Beli</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="card daftar-produk">
							<img class="card-img-top" src="<?= base_url('assets/template/img/test/paket-advance.png')?>" alt="Card image cap">
							<div class="card-body">
								<div class="text-center" style="margin-bottom: 8%;">
									<h5 class="card-title">majoo Advance</h5>
									<h5 class="card-title"><small>Rp. </small><b>2.750.000</b></h5>
								</div>
								<p class="card-text isi">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius tempore porro, cumque quisquam quos in asperiores, perspiciatis quae deserunt consectetur dicta. Laborum eum consequatur dolores, odit labore deserunt ipsa minus!</p>
								<hr>
								<div class="text-center">
									<a href="#" class="btn btn-primary">Beli</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="card daftar-produk">
							<img class="card-img-top" src="<?= base_url('assets/template/img/test/paket-lifestyle.png')?>" alt="Card image cap">
							<div class="card-body">
								<div class="text-center" style="margin-bottom: 8%;">
									<h5 class="card-title">majoo Lifestyle</h5>
									<h5 class="card-title"><small>Rp. </small><b>2.750.000</b></h5>
								</div>
								<p class="card-text isi">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis suscipit in laudantium commodi nobis aspernatur nemo deleniti provident odio minima accusantium, quas fuga nesciunt pariatur magnam! Fuga magnam quibusdam quam.</p>
								<hr>
								<div class="text-center">
									<a href="#" class="btn btn-primary">Beli</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="card daftar-produk">
							<img class="card-img-top" src="<?= base_url('assets/template/img/test/paket-desktop.png')?>" alt="Card image cap">
							<div class="card-body">
								<div class="text-center" style="margin-bottom: 8%;">
									<h5 class="card-title">majoo Desktop</h5>
									<h5 class="card-title"><small>Rp. </small><b>2.750.000</b></h5>
								</div>
								<p class="card-text isi">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate ea recusandae eius iusto soluta sit. Molestiae blanditiis aliquid ab ut, vitae libero eligendi cumque corrupti tenetur rerum minima ad nisi.</p>
								<hr>
								<div class="text-center">
									<a href="#" class="btn btn-primary">Beli</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
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
