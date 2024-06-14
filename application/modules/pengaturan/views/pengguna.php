<section class="content">
	<div class="row">
		<div class="box">
			<div class="box-body">
				<a href="#modaladd" data-toggle="modal" class="btn-sm btn-success" ><i class="fa fa-plus"></i> Tambah</a>
				<br/><br/>
				<table class="table table-hover" id="responden"  >
					<thead>
						<tr>
							<th class="text-center" >No</th>
							<th class="text-center" >Foto</th>
							<th class="text-center" >Nama Lengkap</th>
							<th class="text-center" >Username</th> 
							<th class="text-center" width="100">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($pengguna): ?>
							<?php $no = 1; foreach ($pengguna as $pengguna):
								
								if($pengguna->foto=="") {
									$pengguna->foto="noimages.jpeg";
								}
							?>
							<tr>
								<td class="text-center"><?php echo $no++ ?></td>
								<td class="text-center"><img src="<?= base_url()?>assets/img/<?php echo $pengguna->foto ?>" width="100px" ></td>
								<td><?php echo $pengguna->nama_lengkap ?></td>
								<td><?php echo $pengguna->username ?></td>
							 
								<td class="text-center">
									<a href="#exampleModalCenter" data-id="<?php echo $pengguna->id_admin ?>" data-toggle="modal" class="btn-sm btn-success modal-edit"><i class="fa fa-pencil"></i></a>
									
									<a onclick="return confirm('Anda yakin akan menghapus Pengguna :: <?= $pengguna->nama_lengkap?>?')" href="<?php echo site_url('pengaturan/hapuspengguna/').$pengguna->id_admin ?>" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php endforeach ?>
					<?php endif ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</section>



<!-- Modal edit -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<input type="hidden" id="base" value="<?php echo site_url() ?>">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Edit <strong>(Pengguna)</strong></h5>
			</div>
			<div class="modal-body">
				<form method="post"  enctype='multipart/form-data' action="<?php echo site_url('pengaturan/updatepengguna') ?>">
					<input type="hidden" name="id_pengguna" value="">
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-4 col-form-label">Ganti Foto</label>
						<div class="col-sm-8">
							<input type="file" name="image" id="image"  > 
							
						</div>
					</div>
					
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-4 col-form-label">Nama Lengkap</label>
						<div class="col-sm-8">
							<input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"> 
							
						</div>
					</div>
					<br/>
					
					
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-4 col-form-label">Username</label>
						<div class="col-sm-8">
							<input type="text" name="username" id="username" class="form-control"> 
							
						</div>
					</div>
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-4 col-form-label">Password</label>
						<div class="col-sm-8">
							<input type="text" name="password" id="password" class="form-control"> 
							<input type="hidden" name="passwordlama" id="passwordlama" > 
							* Kosongkan jika tidak ingin mengganti password.
						</div>
					</div>
					

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button>
				</div>
			</form>
		</div>
	</div>
</div>



<!-- Modal add -->
<div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<input type="hidden" id="base" value="<?php echo site_url() ?>">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Posting <strong>(Pengguna)</strong></h5>
			</div>
			<div class="modal-body">
				<form action="<?php echo site_url('pengaturan/addpengguna') ?>"  enctype='multipart/form-data' method="post">
					<input type="hidden" name="id_pengguna" value="">
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-4 col-form-label">Foto</label>
						<div class="col-sm-8">
							<input type="file" name="image" id="image"  > 
							
						</div>
					</div>
					
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-4 col-form-label">Nama Lengkap</label>
						<div class="col-sm-8">
							<input type="text" name="nama_lengkap" id="nama_lengkap"  class="form-control"> 
							
						</div>
					</div>
					<br/>
					
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-4 col-form-label">Username</label>
						<div class="col-sm-8">
							<input type="text" name="username" id="username" class="form-control"> 
							
						</div>
					</div>
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-4 col-form-label">Password</label>
						<div class="col-sm-8">
							<input type="text" name="password" id="password" class="form-control"> 
							
						</div>
					</div>
					 

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).on('click', '.modal-edit', function(event) {
		var id 	= $(this).data('id')
		var base = $('#base').val()

		$('input[name="id_pengguna"]').val(id)


		$.ajax({
			url:base+'pengaturan/detilpengguna/'+id,
			type: 'get',
			dataType: 'json',
		})
		
		.done(function(data) {
			 
			$('#nama_lengkap').val(data.nama_lengkap); 
			$('#username').val(data.username);
			$('#passwordlama').val(data.password); 
		})
		
		.fail(function(data) {
			console.log("error");
		});
		

	});
</script>

