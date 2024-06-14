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
							<th class="text-center" >Unit</th> 
							<th class="text-center" >Nama Pelayanan</th> 
							<th class="text-center" width="100">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($pelayanan): ?>
							<?php $no = 1; foreach ($pelayanan as $pelayanan):
								
								 
							?>
							<tr>
								<td class="text-center"><?php echo $no++ ?></td>
								<td><?php 
								
								$this->db->where('id_unit', $pelayanan->id_unit ); 
								$unit = $this->db->get('unit')->result();
		
								echo $unit[0]->nama_unit;
								
								?></td>
								<td><?php echo $pelayanan->nama_pelayanan ?></td>
							 
							 
								<td class="text-center">
									<a href="#exampleModalCenter" data-id="<?php echo $pelayanan->id_pelayanan ?>" data-toggle="modal" class="btn-sm btn-success modal-edit"><i class="fa fa-pencil"></i></a>
									
									<a onclick="return confirm('Anda yakin akan menghapus Pelayanan :: <?= $pelayanan->nama_pelayanan?>?')" href="<?php echo site_url('pengaturan/hapuspelayanan/').$pelayanan->id_pelayanan ?>" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
				<h5 class="modal-title" id="exampleModalLongTitle">Edit <strong>(Pelayanan)</strong></h5>
			</div>
			<div class="modal-body">
				<form method="post"  enctype='multipart/form-data' action="<?php echo site_url('pengaturan/updatepelayanan') ?>">
					<input type="hidden" name="id_pelayanan" value="">
					 
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-3 col-form-label">Unit</label>
						<div class="col-sm-8">
							<select name="id_unit" id="id_unit"  class="form-control" required> 
							<option value="">-- Pilih Unit --</option>
							<?php
							foreach($units as $u) {
								echo "<option value='".$u->id_unit."'>".$u->nama_unit."</option>";
							}
							?>
							</select>
							
						</div>
					</div>
					
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-3 col-form-label">Nama Pelayanan</label>
						<div class="col-sm-8">
							<input type="text" name="nama_pelayanan" id="nama_pelayanan" class="form-control"> 
							
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
				<h5 class="modal-title" id="exampleModalLongTitle">Posting <strong>(Pelayanan)</strong></h5>
			</div>
			<div class="modal-body">
				<form action="<?php echo site_url('pengaturan/addpelayanan') ?>"  enctype='multipart/form-data' method="post">
					<input type="hidden" name="id_pelayanan" value="">
				 
					 
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-3 col-form-label">Unit</label>
						<div class="col-sm-8">
							<select name="id_unit" id="id_unit"  class="form-control" required> 
							<option value="">-- Pilih Unit --</option>
							<?php
							foreach($units as $u) {
								echo "<option value='".$u->id_unit."'>".$u->nama_unit."</option>";
							}
							?>
							</select>
							
						</div>
					</div>
					
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-3 col-form-label">Nama Pelayanan</label>
						<div class="col-sm-8">
							<input type="text" name="nama_pelayanan" id="nama_pelayanan"  class="form-control"> 
							
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

		 
		$('input[name="id_pelayanan"]').val(id)


		$.ajax({
			url:base+'pengaturan/detilpelayanan/'+id,
			type: 'get',
			dataType: 'json',
		})
		
		.done(function(data) {
			 
			$('#nama_pelayanan').val(data.nama_pelayanan); 
			   
			$("#id_unit").val(data.id_unit).change();
		})
		
		.fail(function(data) {
			console.log("error");
		});
		

	});
</script>

