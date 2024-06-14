<style>
	table{
		width: 100%;
		font-size: 15px;
	}

	td{
		padding: 8px;
	}
</style>
<div>
	<div class="box" >
		<div class="box-header">
			 
			<a href="<?php echo site_url('admin/cetaksaran') ?>" title="" class="btn-sm btn-success"><i class="fa fa-print"></i> Export</a>
			 
		</div>
		<div class="box-body" style="padding: 20px;">
			<table class="table table-hover table-bordered"  id="responden">
				<thead>
					<tr class="head">
						<th class="text-center" >No</th>
						<th class="text-center" >Tanggal</th>
						<th class="text-center" >Nama Responden</th>
						<th class="text-center" >Email</th> 
						<th class="text-center">Kritik dan Saran</th>
						<th class="text-center" >Status </th>
							<th class="text-center" width="100" >Aksi </th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$no = 1;
					 
					foreach ($rekap as $saran): ?>
						<tr>
							<td class="text-center"><?php echo  $no++ ?></td>
							<td><?php echo $this->indo->konversi2($saran->tglbuat) ?></td>
							<td><?php echo $saran->nama ?></td>
							<td><?php echo $saran->email ?></td>
							<td style="word-wrap: break-word;"><?php echo  $saran->saran ?></td>
							<td class="text-center">
								
								<?php if($saran->statusku==1) {  ?>
									<span class="label label-danger">Belum Ditanggapi</span>
								
								<?php }  if($saran->statusku==2) {  ?>
								 <span class="label label-success">Sudah Ditanggapi</span>
								<?php }   ?>
							</td>
							
							<td class="text-center">
								
								<?php if($saran->statusku==1) {  ?>
								
								<a href="<?php echo site_url('admin/tanggapisaran/').$saran->id_respondenku ?>" class="btn-sm bg-orange" onclick="return confirm('Ubah Status Tanggapan?')"><i class="fa fa-question"></i></a>
								
								<a onclick="return confirm('Anda yakin akan menghapus saran :: <?php echo $saran->nama ?>?')" href="<?php echo site_url('admin/hapussaran/').$saran->id_saran ?>" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
								
								
								<?php }  if($saran->statusku==2) {  ?>
								<a href="<?php echo site_url('admin/tanggapisaran2/').$saran->id_respondenku ?>" class="btn-sm bg-purple" onclick="return confirm('Ubah Status Tanggapan?')"><i class="fa fa-check"></i></a>
								
								<a onclick="return confirm('Anda yakin akan menghapus saran :: <?php echo $saran->nama ?>?')" href="<?php echo site_url('admin/hapussaran/').$saran->id_saran ?>" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
								
								<?php }   ?>
							</td>
						</tr>	
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
		<div class="box-footer"></div>
	</div>
	<!-- end box -->
</div>

