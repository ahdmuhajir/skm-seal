<div class="box">
	<div class="box-header">
		<i class="ion ion-clipboard"></i>
		<h3 class="box-title">Detil Jawaban</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="box-body">
		<div class="table-responsive">
			<table class="table" style="font-size: 15px;">
				<thead>
					<tr>
						<th>Kode</th>
						<th>Pertanyaan</th>
						<th class="text-center">Jawaban</th>
						<th class="text-center">Bobot Jawaban</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$n = 0;
					$t=0;
					$status="";
					foreach ($rekap as $v): 
					$id_responden = $v->id_responden;
					$status = $v->published;
					?>
						
						<tr>
							<td class="text-center"><?php echo $v->id_pertanyaan ?></td>
							<td><?php echo $v->soal ?></td>
							<td class="text-center"><?php echo $v->jawaban ?></td>
							<?php $nilai = $v->jawaban;
							if ($nilai == 'a') {
								$bobot = 1;
							} else if ($nilai == 'b') {
								$bobot = 2;
							} else if ($nilai == 'c') {
								$bobot = 3;
							} else {
								$bobot = 4;
							}
							?>
							<td class="text-center"><?php echo $bobot ?></td>
						</tr>

						<?php 
						$n += $bobot;
						$t++;
					endforeach ?>
					<tr>
						<td colspan="3" class="text-center"><strong>Rata - Rata</strong></td>
						<td class="text-center" ><strong><?php echo number_format(($n/$t),3)?></strong></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="box-footer">
		<div style="float: right; margin-right: 15px;">
			<?php if($status=="1") { ?>
			<a href="<?php echo site_url('admin/aksipublish/').$id_responden ?>" class="btn btn-success"><i class="fa fa-send"></i> Publish</a> 
			<?php } else { ?>
			<a href="<?php echo site_url('admin/aksiunpublish/').$id_responden ?>" class="btn btn-danger"><i class="fa fa-send"></i> Un Publish</a> 
			<?php } ?>
		</div>
	</div>
</div>