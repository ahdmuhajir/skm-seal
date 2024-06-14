<section class="content">
	<div class="row">
		<div class="panel">
			 
			<div class="panel-body">
				 
			<form method="post" enctype='multipart/form-data' action="<?php echo site_url('pengaturan/update_profilaplikasi') ?>">
			
				<input  type="hidden" name="id_loket"/>
				
				<?php
				if($profilaplikasi->logo_aplikasi=="") {
					$profilaplikasi->logo_aplikasi="noimages.jpeg";
				}
				
				if($profilaplikasi->favicon_aplikasi=="") {
					$profilaplikasi->favicon_aplikasi="noimages.jpeg";
				}
				if($profilaplikasi->logo_instansi=="") {
					$profilaplikasi->logo_instansi="noimages.jpeg";
				}
				?>
			
					<div class="form-group row">
						<label for="staticEmail" class="col-lg-3 col-form-label">Nama Aplikasi</label>
						<div class="col-lg-8">
						<input type="text" id="nama_aplikasi" name="nama_aplikasi" class="form-control" value="<?= $profilaplikasi-> nama_aplikasi ?>"/>
						</div>
					</div>

				<div class="form-group row">
						<label for="staticEmail" class="col-lg-3 col-form-label">Logo Aplikasi</label>
						<div class="col-lg-8">
						<img src="<?= base_url()?>assets/img/<?php echo $profilaplikasi->logo_aplikasi ?>" width="200px" >
						<br/>
						<input type="file"  name="gambar1"  />
						
						<input type="hidden"  id="logo_aplikasi" name="logo_aplikasi"   value="<?= $profilaplikasi-> logo_aplikasi ?>"/>
						</div>
					</div>
					
					
					<div class="form-group row">
						<label for="staticEmail" class="col-lg-3 col-form-label">Favicon Aplikasi</label>
						<div class="col-lg-8">
						<img src="<?= base_url()?>assets/img/<?php echo $profilaplikasi->favicon_aplikasi ?>" width="80px" >
						<br/>
						<input type="file"  name="gambar2"  />
						<input type="hidden"  id="favicon_aplikasi" name="favicon_aplikasi" class="form-control" value="<?= $profilaplikasi-> favicon_aplikasi ?>"/>
						</div>
					</div>
					<br/><br/>
					
					<div class="form-group row">
						<label for="staticEmail" class="col-lg-3 col-form-label">Nama Instansi</label>
						<div class="col-lg-8">
						<input type="text"  id="nama_instansi" name="nama_instansi" class="form-control" value="<?= $profilaplikasi-> nama_instansi ?>"/>
						</div>
					</div>

					<div class="form-group row">
						<label for="staticEmail" class="col-lg-3 col-form-label">Alamat Instansi</label>
						<div class="col-lg-8">
						<input type="text"  id="alamat_instansi" name="alamat_instansi" class="form-control" value="<?= $profilaplikasi-> alamat_instansi ?>"/>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="staticEmail" class="col-lg-3 col-form-label">Email Instansi</label>
						<div class="col-lg-8">
						<input type="email"  id="email_instansi" name="email_instansi" class="form-control" value="<?= $profilaplikasi-> email_instansi ?>"/>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="staticEmail" class="col-lg-3 col-form-label">Notelp Instansi</label>
						<div class="col-lg-8">
						<input type="text"  id="notelp_instansi" name="notelp_instansi" class="form-control" value="<?= $profilaplikasi-> notelp_instansi ?>"/>
						</div>
					</div>


					<div class="form-group row">
						<label for="staticEmail" class="col-lg-3 col-form-label">Logo Instansi</label>
						<div class="col-lg-8">
						<img src="<?= base_url()?>assets/img/<?php echo $profilaplikasi->logo_instansi ?>" width="200px" >
						<br/>
						<input type="file"  name="gambar3"  />
						<input type="hidden"  id="logo_instansi" name="logo_instansi"  value="<?= $profilaplikasi-> logo_instansi ?>"/>
						</div>
					</div>
					
					

				</div>
				<div class="modal-footer">
				 
					<button type="submit" class="btn bg-purple"><i class="fa fa-save"></i> Simpan Perubahan</button>
				</div>
			</form>

			
			</div>
		</div>
	</div>
</section>
  

<script src="<?php echo base_url('assets/js/jsbaru/js_loket.js') ?>" type="text/javascript"></script>