<link rel="stylesheet" href="<?php echo base_url().'assets/' ?>font-awesome/css/font-awesome.min.css">
<script src="<?php echo base_url().'assets/js/' ?>sweetalert2@10.js"></script>
<?= $this->load->view('sesi/header') ?>

<body style="background-color: #f1f6f9;">
  <?= $this->load->view('sesi/navbar2')  ?>
  <main id="main">
    <section id="details" class="details" >
      <div class="container"  style="margin-top:1%; ">
        <div class="row content">
	
	 
  
	
       <div class="col-md-8 pt-4" data-aos="fade-up"> 
		  
	 <div class="container mt-2 mb-4"  >

        <div class="row" data-aos="fade-up"> 
            <div class="col-lg-3 col-md-6  ">
            <div class="count-box"> 
             <center> <p style="background-color:#1acc8d; color:#fff; padding:3px;">Data Responden</p></center>
            </div>
          </div> 

		  <div class="col-lg-3 col-md-6">
            <div class="count-box"> 
               <center> <p style="background-color:#ccc; color:#fff; padding:3px;">Unit Pelayanan</p></center>
            </div>
          </div> 
       
          <div class="col-lg-3 col-md-6 ">
            <div class="count-box"> 
                <center> <p style="background-color:#ccc; color:#fff; padding:3px;">Kualitas Pelayanan</p></center>
				 
            </div>
          </div> 
          <div class="col-lg-3 col-md-6  ">
            <div class="count-box"> 
               <center> <p style="background-color:#ccc; color:#fff; padding:3px;">Kritik dan Saran</p></center>
            </div>
          </div>

        </div>

      </div>
	  
	  
            <div class="card">
              <div class="card-header" style="background-color: white;">
                <h5 style="font-weight: bold;">Data Responden<h5>
                </div>
                <div class="card-body">
                  <form method="post" action="<?php echo site_url('survey/post_detil_responden') ?>">
                  
                    <div class="form-group"> 
                      <label for="formGroupExampleInput">Nama Lengkap</label>
                      <input type="text" class="form-control" name="nama" required  value="<?= $this->session->userdata('ses_nama')?>">
                    </div>
					
			<div class="form-group"> 
                      <label for="formGroupExampleInput">Email</label>
                      <input type="text" class="form-control" name="email" required   value="<?= $this->session->userdata('ses_email')?>">
                    </div>
					
                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="formGroupExampleInput2">Umur (th)</label>
                        <input type="number" required class="form-control" name="umur"   value="<?= $this->session->userdata('ses_umur')?>">
                      </div>
                      <div class="col-md-6">
                        <label for="formGroupExampleInput2">Jenis Kelamin</label>
                        <select name="jk" required class="form-control">
                         <option value=""> </option>
                         <option value="Laki-laki" <?php if($this->session->userdata('ses_jk')=="Laki-laki") { echo "selected=selected";} ?> >Laki-laki</option>
                         <option value="Perempuan" <?php if($this->session->userdata('ses_jk')=="Perempuan") { echo "selected=selected";} ?> >Perempuan</option>
                       </select>
                     </div>
                   </div>
                   <div class="form-group">
                    <label for="formGroupExampleInput2">Pekerjaan</label>
                    <select required name="pekerjaan" class="form-control">
                      <option value=""> </option>
                      <?php foreach ($pekerjaan as $pekerjaan): 
				if($this->session->userdata('ses_pekerjaan')==$pekerjaan->pekerjaan) { $ok = "selected=selected";} else { $ok=""; } ?>
                        <option value="<?php echo $pekerjaan->pekerjaan ?>" <?= $ok ?>><?php echo $pekerjaan->pekerjaan ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="formGroupExampleInput2">Pendidikan</label>
                    <select required name="pendidikan" class="form-control">
                      <option value=""> </option>
                      <?php foreach ($pendidikan as $pendidikan): 
				if($this->session->userdata('ses_pendidikan')==$pendidikan->pendidikan) { $ok2 = "selected=selected";} else { $ok2="";} ?>
                        <option value="<?php echo $pendidikan->pendidikan ?>" <?= $ok2 ?>><?php echo $pendidikan->pendidikan ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <p>
                  
			<button type="submit" class="btn btn-success float-right ">Selanjutnya <i class="fa fa-arrow-circle-right"></i></button>
                  </p>
                </form>
              </div>
            </div>
		 

          </div>
          <div class="col-md-4 pt-4" data-aos="fade-right">
            <img src="<?php echo base_url().'assets/bot/'?>img/details-1.png" class="img-fluid" alt="">
          </div>
        </div>

      </div>
    </section>
    <input type="hidden" id="base" value="<?php echo site_url() ?>">
  </main>
    <?php $this->load->view('sesi/footer') ?>
	
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  <div id="preloader"></div>

  <?= $this->load->view('sesi/script') ?>
</body>

</html>