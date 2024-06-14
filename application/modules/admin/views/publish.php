<style>
	table{
		font-size: 15px;
	}
</style>
<div class="box">
	<div class="box-body">
		<input type="hidden" id="base" value="<?php echo site_url() ?>">
		<table class="table" id="responden">
			<thead>
				<tr>
					<th class="text-center">No</th>
					<th class="text-center">Tgl Buat</th>
					<th class="text-center">Nama Responden</th>
					<th class="text-center">Email </th>
					<th class="text-center">Jawaban</th> 
					<th class="text-center">Status</th>
					<th class="text-center">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach ($rekap as $data): 
				
					if($data['status']==1) {
						$status="<span class='label label-danger'>Not Publish</span>";
					} else {
						$status="<span class='label label-success'>Publish</span>";
					}
					?>
				<tr>
					<td class="text-center"><?php echo $no++; ?></td>
					<td  class="text-center">   <?php echo $data['tanggal'] ?>  </td>
					<td> <?php echo $data['nama_responden'] ?> </td>
					<td> <?php echo $data['id_responden'] ?> </td>
					<td class="">
						<?php
						 
						$this->db->where('id_responden', trim($data['id_responden']));
						$jawabans = $this->db->get('jawaban')->result();
						
						$all="";
						$bobot=0;
						$total=0;
						$n=0;
						foreach ($jawabans as $jawaban){
							$nilai = $jawaban->jawaban;
							if ($nilai == 'a') {
								$bobot = 1;
							} else if ($nilai == 'b') {
								$bobot = 2;
							} else if ($nilai == 'c') {
								$bobot = 3;
							} else {
								$bobot = 4;
							}
							$all .= $jawaban->jawaban.", ";
							$total=$total+$bobot;
							$n++;
						}
						$all=substr($all,0,-2);
						echo $all;
						echo "<br/> Rata-rata = ".number_format(($total/$n),3);
						
							
						?>
					</td>
					<td class="text-center"><?php echo $status ?></td>
					<td class="text-center"><a href="<?php echo site_url('admin/detil/').$data['id_responden'] ?>" class="btn-sm btn-success"  title="Edit"><i class="fa fa-pencil"></i></a>
					
					 <a onclick="return confirm('Anda yakin akan menghapus Jawaban <?= $data['id_responden']?>?')" href="<?php echo site_url('admin/hapusjawaban/').$data['id_responden'] ?>" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
					 
					</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
</div>