<section class="content">
	<div class="row">
		<div class="box">
			<div class="box-body">
				<a href="#modaladd" data-toggle="modal" class="btn-sm btn-success" ><i class="fa fa-plus"></i> Tambah</a>
				<br/><br/>
				<table class="table table-hover" id="responden"  >
					<thead>
						<tr>
							<th class="text-center" width="80">No</th> 
							<th class="text-center" >Nama Unit</th> 
							<th class="text-center" width="100">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($unit): ?>
							<?php $no = 1; foreach ($unit as $unit):
								
								 
							?>
							<tr>
								<td class="text-center"><?php echo $no++ ?></td>
							 
								<td><?php echo $unit->nama_unit ?></td>
							 
							 
								<td class="text-center">
									<a href="#exampleModalCenter" data-id="<?php echo $unit->id_unit ?>" data-toggle="modal" class="btn-sm btn-success modal-edit"><i class="fa fa-pencil"></i></a>
									
									<a onclick="return confirm('Anda yakin akan menghapus Unit :: <?= $unit->nama_unit?>?')" href="<?php echo site_url('pengaturan/hapusunit/').$unit->id_unit ?>" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
				<h5 class="modal-title" id="exampleModalLongTitle">Edit <strong>(Unit)</strong></h5>
			</div>
			<div class="modal-body">
				<form method="post"  enctype='multipart/form-data' action="<?php echo site_url('pengaturan/updateunit') ?>">
					<input type="hidden" name="id_unit" value="">
					 
					
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-3 col-form-label">Nama Unit</label>
						<div class="col-sm-8">
							<input type="text" name="nama_unit" id="nama_unit" class="form-control"> 
							
						</div>
					</div>
					<br/>
					 

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
				<h5 class="modal-title" id="exampleModalLongTitle">Posting <strong>(Unit)</strong></h5>
			</div>
			<div class="modal-body">
				<form action="<?php echo site_url('pengaturan/addunit') ?>"  enctype='multipart/form-data' method="post">
					<input type="hidden" name="id_unit" value="">
				 
					
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-3 col-form-label">Nama Unit</label>
						<div class="col-sm-8">
							<input type="text" name="nama_unit" id="nama_unit"  class="form-control"> 
							
						</div>
					</div>
					<br/>
					
					 

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

		 
		$('input[name="id_unit"]').val(id)


		$.ajax({
			url:base+'pengaturan/detilunit/'+id,
			type: 'get',
			dataType: 'json',
		})
		
		.done(function(data) {
			 
			$('#nama_unit').val(data.nama_unit); 
			 
		})
		
		.fail(function(data) {
			console.log("error");
		});
		

	});
</script>

