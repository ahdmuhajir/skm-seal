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
							<th class="text-center" >Judul</th>
							<th class="text-center" >Foto</th>
							<th class="text-center" >Isi</th>
							<th class="text-center" width="100">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php if ($news): ?>
							<?php $no = 1; foreach ($news as $news): 
							
							if($news->img=="") {
								$news->img="noimages.jpeg";
							}
							?>
							<tr>
								<td class="text-center"><?php echo $no++ ?></td>
								<td><?php echo $news->judul ?></td>
								<td><img src="<?= base_url()?>assets/img/<?php echo $news->img ?>" width="100px" ></td>
								<td><?php echo substr($news->konten,0,200) ?>...</td>
								<td class="text-center">
									<a href="#exampleModalCenter" data-id="<?php echo $news->id ?>" data-toggle="modal" class="btn-sm btn-success modal-edit"><i class="fa fa-pencil"></i></a>
									
									<a onclick="return confirm('Anda yakin akan menghapus News ini?')" href="<?php echo site_url('news/hapusnews/').$news->id ?>" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Edit <strong>(News)</strong></h5>
			</div>
			<div class="modal-body">
				<form method="post"  enctype='multipart/form-data' action="<?php echo site_url('news/updatenews') ?>">
					<input type="hidden" name="id_news" value="">
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-2 col-form-label">Judul</label>
						<div class="col-sm-10">
							<input type="text" name="judul" id="judul" class="form-control"> 
							
						</div>
					</div>
					
					
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Isi</label>
						<div class="col-sm-10">
							<textarea name="konten" id="konten" class="form-control" rows="3"></textarea>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-2 col-form-label">Ganti Foto</label>
						<div class="col-sm-10">
							<input type="file" name="image" id="image"  > 
							
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
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Posting <strong>(News)</strong></h5>
			</div>
			<div class="modal-body">
				<form action="<?php echo site_url('news/addnews') ?>"  enctype='multipart/form-data' method="post">
					<input type="hidden" name="id_news" value="">
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-2 col-form-label">Judul</label>
						<div class="col-sm-10">
							<input type="text" name="judul" id="judul"  class="form-control"> 
							
						</div>
					</div>
					
					
					<div class="form-group row">
						<label for="inputPassword" class="col-sm-2 col-form-label">Isi</label>
						<div class="col-sm-10">
							<textarea name="konten" id="konten" class="form-control" rows="3"></textarea>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="staticEmail" class="col-sm-2 col-form-label">Foto</label>
						<div class="col-sm-10">
							<input type="file" name="image" id="image"  > 
							
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

		$('input[name="id_news"]').val(id)


		$.ajax({
			url:base+'news/detilnews/'+id,
			type: 'get',
			dataType: 'json',
		})
		
		.done(function(data) {
			 
			$('#judul').val(data.judul);
			$('#konten').text(data.konten);
			$('#img').val(data.img);
		})
		
		.fail(function(data) {
			console.log("error");
		});
		

	});
</script>

