 <?php
$this->db->select('*');
$profil = $this->db->get_where('profil_aplikasi',['id_profilaplikasi' => '1'])->result();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan</title>
	<style>
		table{
			width: 100%; 
			border-collapse:collapse;
			border:1px solid #ccc;
		}
		th{ 
			text-align: center; 
		}
	</style>
</head>
<body>
	<?php 
	header("Content-Type: application/vnd.msword");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=Laporan-Kepuasan.doc");
	?>
	<p>
		<h4><center><?= strtoupper($profil[0]->nama_instansi)?> <br>
			<?php echo $tgl_indo != 'setahun' ? "JANUARI s/d ".strtoupper($tgl_indo).' '.$tahun : "TAHUN ".$tahun ?>
		</center></h4>
	</p>
	<p>
		<h4>Hasil Survey <br> Karakteristik Responden</h4>
	</p>
	<p>
		Dalam Survey Kepuasan Masyarakat di <?= strtoupper($profil[0]->nama_instansi)?>   menggunakan sampel sebanyak <?php echo $pengunjung ?> orang pengunjung / pengguna layanan dan dari <?php echo $pengunjung ?> kuesioner yang disediakan semuanya kembali dengan jawaban lengkap dan layak untuk digunakan analisis.
	</p>
	<p>
		Berikut ini dipaparkan karakteristik responden secara umum menurut umur, dan jenis kelamin dan mata pencaharian di <?= strtoupper($profil[0]->nama_instansi)?>
	</p>
	<p>
		<ol type="a">
			<li>Karakteristik Responden Berdasarkan Kelompok Umur</li>
			<p>Karakteristik responden yang menjadi subyek dalam penelitian ini menurut umur dibagi berdasarkan nilai mean yaitu 3.49. Hal ini dapat ditunjukkan dalam tabel berikut : </p>
			<p>Tabel Karakteristik Responden Berdasarkan Umur</p>
			<p>
				<table border="1px">
					<thead>
						<tr>
							<th>Umur</th>
							<th>Jumlah</th>
							<th>Presentase (%)</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$umursum = 0; $presentase = 0;
						foreach ($umur as $um): ?>
							<tr>
								<td align="center"><?php echo $um['index'] ?></td>
								<td align="center"><?php echo $um['jumlah'] ?></td>
								<td align="center"><?php echo $um['presentase'] ?> </td>
							</tr>

							<?php
							$umursum 	+= $um['jumlah'];
							$presentase += $um['presentase'];
						endforeach ?>
						<tr>
							<td align="center"><strong>Total</strong></td>
							<td align="center"><strong><?php echo $umursum; ?></strong></td>
							<td align="center"><strong><?php echo $presentase; ?> % </strong></td>
						</tr>
					</tbody>
				</table>
			</p>
			<p>
				Berdasarkan tabel di atas dapat diketahui kelompok umur dibawah 40 tahun sebanyak <?php echo $umur['up40']['jumlah'] ?> orang (<?php echo $umur['up40']['presentase'] ?>%) dan di atas sama dengan 40 tahun sebanyak <?php echo $umur['min40']['jumlah'] ?> orang (<?php echo $umur['min40']['presentase'] ?>%)  
			</p>
			<li>Karakteristik Responden Berdasarkan Jenis Kelamin</li>
			<p>
				Karakteristik responden pada penelitian ini menurut jenis kelamin dapat diketahui berdasarkan tabel sebagai berikut : 
			</p>
			<p>Tabel Karakteristik Responden Berdasarkan Jenis Kelamin</p>
			<p>
				<table border="1px">
					<thead>
						<tr>
							<th>Jenis Kelamin</th>
							<th>Jumlah</th>
							<th>Presentase (%)</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$sumjk	= 0; $presentasejk = 0;
						foreach ($jk as $j): ?>
							<tr>
								<td><?php echo $j['jk'] ?></td>
								<td align="center"><?php echo $j['jumlah'] ?></td>
								<td align="center"><?php echo $j['presentase'] ?></td>
							</tr>
							<?php 
							$sumjk += $j['jumlah'];
							$presentasejk += $j['presentase'];
						endforeach ?>
						<tr>
							<td><strong>Total</strong></td>
							<td align="center"><strong><?php echo $sumjk; ?></strong></td>
							<td align="center"><strong><?php echo $presentasejk; ?> % </strong></td>
						</tr>
					</tbody>
				</table>
			</p>
			<p>
				Berdasarkan tabel diatas menunjukkan bahwa responden yang berjenis kelamin laki-laki sebanyak <?php echo $jk['laki']['jumlah'] ?>  orang (<?php echo $jk['laki']['presentase'] ?>%), dan yang berjenis kelamin perempuan sebanyak  <?php echo $jk['pr']['jumlah'] ?>  orang ( <?php echo $jk['pr']['presentase'] ?>%)
			</p>
		</ol>	
	</p>

	<p>
		<h4>Deskripsi Jawaban Responden</h4>
	</p>
	<p>Berikut ini disajikan tabel nilai rata-rata unsur pelayanan hasil pengisian kuesioner yang dilakukan oleh responden di <?= strtoupper($profil[0]->nama_instansi)?></p>
	<p>Tabel Nilai Rata-Rata Unsur Pelayanan di <?= strtoupper($profil[0]->nama_instansi)?> Tahun <?php echo $tahun ?></p>
	<p>
		<table border="1px">
			<thead>
				<tr>
					<th colspan="2">Unsur SKM</th>
					<th><?php echo $tahun ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($hasil as $h): ?>
					<tr>
						<td align="center"><?php echo $h['id_pertanyaan'] ?></td>
						<td><?php echo $h['kategori'] ?></td>
						<td align="center"><?php echo $h['kepuasan'] ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</p>
	<p>
		Dari nilai rata-rata yang ada maka dapat ditarik kesimpulan nilai SKM yang diperoleh adalah <?php echo $tingkat_kepuasan['presentase'] ?> <br>
		Sehingga dapat diperoleh hasil sebagai berikut : <br>
		Mutu pelayanan <strong><?php echo $tingkat_kepuasan['index'] ?></strong> <br>
		Kinerja unit pelayanan <strong><?php echo $tingkat_kepuasan['mutu'] ?></strong>
	</p>
	<p>
		<h4>Analisis</h4>
		Dari tabel dapat dilihat bahwa dengan nilai SKM <?php echo $tingkat_kepuasan['presentase'] ?> disimpulkan bahwa Kategorisasi Mutu Pelayanan "<?php echo $tingkat_kepuasan['mutu'] ?>" dan Kinerja Unit Pelayanan adalah Sangat Baik. Jika dilihat dari Nilai Rata-Rata (NRR) unsur pelayanan, unsur yang memiliki nilai tertinggi adalah unsur "<?php echo $max['kategori'] ?>" (NRR <?php echo $max['kepuasan'] ?>), sedangkan unsur dengan Nilai Rata-Rata terendah adalah unsur "<?php echo $min['kategori'] ?>" (NRR <?php echo $min['kepuasan'] ?>). Angka ini menunjukkan bahwa tingkat pelayanan paling tinggi diperoleh dari <strong><?php echo $max['kategori'] ?></strong>, sedangkan tingkat kepuasan paling rendah berada pada unsur <strong><?php echo $min['kategori'] ?></strong>.
	</p>
	<p>Secara umum capaian di <?= strtoupper($profil[0]->nama_instansi)?> ditingkatkan sebagai berikut:</p>
	<p>
		<table border="1px">
			<thead>
				<tr>
					<th>No</th>
					<th>Unsur SKM</th>
					<th>Nilai Rata - rata</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$x = 1;
				foreach ($hasil as $h): ?>
					<tr>
						<td align="center"><?php echo $x++ ?></td>
						<td><?php echo $h['kategori'] ?></td>
						<td align="center"><?php echo $h['kepuasan'] ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</p>
	 
</body>
</html>