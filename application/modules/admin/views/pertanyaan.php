<style>
	.head{
		height: 40px;
		vertical-align: middle;
		background-color: #f6f6f6;
		text-align: center;
	}
	table{
		font-size: 15px;
	}
	
	td, th, table{
		padding: 8px;
		border-color:#ccc;
	}

	td{
		padding: 8px; 
	}
	a{
		color: black;
	}
</style>
<div class="col-12">
	<div class="box" >
		<div class="box-header"  style="cursor: pointer;">
			 

			<a href="#modal_add" data-toggle="modal" style="margin-left: 15px;" class="btn-sm btn-success" ><i class="fa fa-plus"></i> Tambah Pertanyaan</a>
			 
		</div>
		<div class="box-body" style="padding: 20px;">
			<table border="1px"  >
				<thead>
					<tr class="head">
						<th class="text-center">No</th>
						<th class="text-center">Kode</th>
						<th class="text-center">Kategori</th>
						<th class="text-center">Pertanyaan</th>
						<th class="text-center">Pilihan Jawaban</th>
						<th class="text-center">Point</th>
						<th class="text-center" width="100">Aksi</th>
					</tr>
				</thead>
				<?php 
				$no=1;
				foreach ($soal as $soal): ?>
					<tr>
						<td rowspan="4" class="text-center"><?php echo $no ?></td>
						<td rowspan="4" class="text-center"><?php echo $soal->id_pertanyaan ?></td>
						<td rowspan="4"> <?php echo $soal->kategori ?>   </td>
						<td rowspan="4"> <?php echo $soal->soal ?>   </td>
						<td><?php echo $soal->a ?></td>
						<td class="text-center">1</td>
						<td rowspan="4" class="text-center"> 
						<a href="#modal_edit" data-id="<?php echo $soal->id_pertanyaan ?>" data-toggle="modal" class="modal-edit btn-sm btn-success"><i class="fa fa-pencil"></i></a>
						
						 <a onclick="return confirm('Anda yakin akan menghapus Pertanyaan ini?')" href="<?php echo site_url('admin/hapuspertanyaan/').$soal->id_pertanyaan ?>" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
									
									
						</td>
						
					</tr>
					<tr>
						<td><?php echo $soal->b ?></td>
						<td class="text-center">2</td>
					</tr>
					<tr>
						<td><?php echo $soal->c ?></td>
						<td class="text-center">3</td>
					</tr>
					<tr>
						<td><?php echo $soal->d ?></td>
						<td class="text-center">4</td>
					</tr>
					
					
				<?php 
				$no++;
				endforeach ?>
				
			</table>
		</div>
		<div class="box-footer"></div>
	</div>
	<!-- end box -->
</div>

<!-- Modal edit -->
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<input type="hidden" id="base" value="<?php echo site_url() ?>">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-blue">
				<h5 class="modal-title" id="exampleModalLongTitle">Edit <strong>(Pertanyaan)</strong></h5>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo site_url('admin/updatepertanyaan') ?>">
					<input type="hidden" name="id_pertanyaan" value="">
					<div class="form-group">
						<label for="staticEmail" class="col-form-label">Kategori</label>
						<input  id="kategori" name="kategori" rows="3" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="staticEmail" class="col-form-label">Pertanyaan</label>
						<textarea name="pertanyaan" rows="3" class="form-control"></textarea>
					</div>
					<center><h4>---opsi jawaban---</h4></center><br>
					<div class="row">
						<div class="form-group col-md-3">
							<label for="staticEmail" class="col-form-label">Opsi A point 1</label>
							<input type="text" class="form-control" name="a" placeholder="Opsi A point 1">
						</div>
						<div class="form-group col-md-3">
							<label for="staticEmail" class="col-form-label">Opsi B point 2</label>
							<input type="text" class="form-control" name="b" placeholder="Opsi B point 2">
						</div>
						<div class="form-group col-md-3">
							<label for="staticEmail" class="col-form-label">Opsi C point 3</label>
							<input type="text" class="form-control" name="c" placeholder="Opsi C Point 3">
						</div>
						<div class="form-group col-md-3">
							<label for="staticEmail" class="col-form-label">Opsi D point 4</label>
							<input type="text" class="form-control" name="d" placeholder="Opsi D point 4">
						</div>
					</div>

				</div>
				<div class="modal-footer">
					
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Perubahan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal add -->
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-blue">
				<h5 class="modal-title" id="exampleModalLongTitle">Tambah <strong>(Pertanyaan)</strong></h5>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo site_url('admin/addpertanyaan') ?>">
					<div class="form-group">
						<label class="col-form-label">Nomor Pertanyaan</label>
						<input name="id_pertanyaan" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="staticEmail" class="col-form-label">Kategori</label>
						<input  id="kategori" name="kategori" rows="3" class="form-control"/>
					</div>
					<div class="form-group">
						<label for="staticEmail" class="col-form-label">Pertanyaan</label>
						<textarea name="pertanyaan" rows="3" class="form-control"></textarea>
					</div>
					<center><h4>---opsi jawaban---</h4></center><br>
					<div class="row">
						<div class="form-group col-md-3">
							<label for="staticEmail" class="col-form-label">Opsi A point 1</label>
							<input type="text" class="form-control" name="a" placeholder="Opsi A point 1">
						</div>
						<div class="form-group col-md-3">
							<label for="staticEmail" class="col-form-label">Opsi B point 2</label>
							<input type="text" class="form-control" name="b" placeholder="Opsi B point 2">
						</div>
						<div class="form-group col-md-3">
							<label for="staticEmail" class="col-form-label">Opsi C point 3</label>
							<input type="text" class="form-control" name="c" placeholder="Opsi C Point 3">
						</div>
						<div class="form-group col-md-3">
							<label for="staticEmail" class="col-form-label">Opsi D point 4</label>
							<input type="text" class="form-control" name="d" placeholder="Opsi D point 4">
						</div>
					</div>

				</div>
				<div class="modal-footer">
					
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan </button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
				</div>
			</form>
		</div>
	</div>
</div>


<script src="<?php echo base_url('assets/js/jsbaru/js_pertanyaan.js') ?>" type="text/javascript"></script>