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
             <center> <p style="background-color:#ccc; color:#fff; padding:3px;">Data Responden</p></center>
            </div>
          </div> 
		  
		  <div class="col-lg-3 col-md-6">
            <div class="count-box"> 
               <center> <p style="background-color:#1acc8d; color:#fff; padding:3px;">Unit Pelayanan</p></center>
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
                <h5 style="font-weight: bold;">Unit dan Pelayanan<h5>
                </div>
                <div class="card-body">
				
                  <form method="post" action="<?php echo site_url('survey/post_datalayanan') ?>">
                   
			 <div class="form-group row">
                      <label for="unit" class="col-lg-3">Unit </label>
			 <div class="col-lg-9">
                      <select class="form-control" name="unit" id="unit" required>
                        <option value=""> </option>
                        <?php foreach($units as $unit) :  
				if($unit->id_unit==$this->session->userdata('ses_idunit')) { $ok="selected=selected";} else {$ok="";} ?>
                          <option value="<?php echo $unit->id_unit ?>" <?= $ok ?> ><?php echo $unit->nama_unit ?></option>
                        <?php endforeach ?>
                      </select>
			</div>
                    </div>
					
					
			<div class="form-group row">
                      <label for="pelayanan" class="col-lg-3">Pelayanan </label>
			 <div class="col-lg-9">
                      <select class="form-control" name="pelayanan" id="pelayanan" required>
                        <option value=""> </option> 
				<?php 
				if($this->session->userdata('ses_idunit')!="") { 
					  $this->db->where('id_unit', $this->session->userdata('ses_idunit'));
					  $this->db->order_by('id_pelayanan', 'ASC');
					  $query = $this->db->get('pelayanan');
					  
					  foreach($query->result() as $row) {
						 if($row->id_pelayanan==$this->session->userdata('ses_idpelayanan')) { $ok="selected=selected";} else {$ok="";} 
					   echo '<option value="'.$row->id_pelayanan.'"  '.$ok.'>'.$row->nama_pelayanan.'</option>';
					  }
					}  
				?>
                      </select>
			</div>
                    </div>
					
                     <a href="<?php echo site_url().'survey/dataresponden' ?>" class="btn btn-primary float-left "> <i class="fa fa-arrow-circle-left"></i> Sebelumnya </a>
					
					
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