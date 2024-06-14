<link rel="stylesheet" href="<?php echo base_url().'assets/' ?>font-awesome/css/font-awesome.min.css">
<script src="<?php echo base_url().'assets/js/' ?>sweetalert2@10.js"></script>
<style type="text/css">
  .row{
    margin-bottom: 20px;
  }
 

  #lanjut{
    margin-right: 50px;
    width: 150px;
    margin-top: 3%;
  } 

  #reset{
    margin-right: 10px;
    width: 150px;
    color: white;
    margin-top: 3%;
  }

</style>
<?= $this->load->view('sesi/header') ?>

<body>
  <?= $this->load->view('sesi/navbar2')  ?>
  <main id="main">
    <section id="details" class="details" >
      <div class="container"  style="margin-top:3%; ">
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
               <center> <p style="background-color:#1acc8d; color:#fff; padding:3px;">Kritik dan Saran</p></center>
            </div>
          </div>

        </div>

      </div>
	  
	  
		  <div class="card">
              <div class="card-header" style="background-color: white;">
                <h5 style="font-weight: bold;">Kritik dan Saran<h5>
                </div>
                <div class="card-body">

				
				<div class="row">
				  <input type="hidden" id="id_responden" value="<?php echo $responden ?>">
				  <textarea name="saran" id="tx_saran" class="form-control" rows="5"></textarea>
				</div>
				
				
		<a href="<?php echo site_url().'survey/pertanyaan' ?>" class="btn btn-primary float-left"> <i class="fa fa-arrow-circle-left"></i> Sebelumnya </a>
					
					
					
					
				<p>
				  <button id="saran" class="btn btn-success float-right"> Selesai <i class="fa fa-arrow-circle-right"></i></button>
				</p>
			  </div>
			  
		</div>
		</div>
		
			   <div class="col-md-4 pt-4" data-aos="fade-right">
            <img src="<?php echo base_url().'assets/bot/'?>img/details-1.png" class="img-fluid" alt="">
          </div>
        </div>
		  
        

      </div>
    </section>
    <input type="hidden" id="base" value="<?php echo base_url() ?>">
  </main>
  
  <?php $this->load->view('sesi/footer') ?>
  
  
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  <div id="preloader"></div>

  <?= $this->load->view('sesi/script') ?>
  <script src="<?php echo base_url().'assets/js' ?>/js_saran.js"></script>

</body>

</html>