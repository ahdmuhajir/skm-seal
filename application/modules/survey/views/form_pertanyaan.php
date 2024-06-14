<link rel="stylesheet" href="<?php echo base_url().'assets/' ?>font-awesome/css/font-awesome.min.css">
<script src="<?php echo base_url().'assets/js/' ?>sweetalert2@10.js"></script>
<style type="text/css">


 .radio-toolbar input[type="radio"] +label {
     opacity:0.5 !important;
	    border:1px solid #ccc;
}
 
 .radio-toolbar input[type="radio"]:checked + label {
    background-color:#28A745;
    color:#fff;
    border-color: #28A745;
    border:1px solid #28A745;
    opacity:1  !important;
}

  .form-check-label{
    font-size: 0.8rem;
    margin-left: 10px;
	  
  }

  #lanjut{
   
  } 

  #reset{
    margin-right: 10px;
    width: 150px;
    color: white;
    margin-top: 3%;
  }

  /* For mobile phones: */
  [class*="col-"] {
    width: 100%;
  }
}
</style>
<?= $this->load->view('sesi/header') ?>

<body>
  <?= $this->load->view('sesi/navbar2')  ?>
  <main id="main">
    <section id="details" class="details" >
      <div class="container"  style="margin-top:3%; ">

        <div class="row content">
          <div class="col-md-8" data-aos="fade-up">
		  
		  
		  
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
                <center> <p style="background-color:#1acc8d; color:#fff; padding:3px;">Kualitas Pelayanan</p></center>
				 
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
             <div class="card-header bg-white" >
               <h3 id="pertanyaan"><?php echo $soal[0]->soal ?></h3>
             </div>
             <div class="card-body">
             
      <div class="row mt-3 mb-3 radio-toolbar">
			   
               <div class="col-lg-3"> 
                <div class="col">
                  <div class="form-check form-check-inline"> 
			 
                    <input required class="form-check-input" type="radio" name="pilihan" id="c1" value="a" style="display:none;"> 
                    <label style="cursor: pointer;" class="form-check-label text-center" for="c1" >
					<img src="<?= base_url()?>assets/img/icon/1.jpg" width="100%" >
					<span id="a"><?php echo $soal[0]->a ?></span>
			</label>
                  </div>
                </div>
              </div>
			  
              <div class="col-lg-3">
                <div class="col">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pilihan" id="c2" value="b" style="display:none;">
					
                    <label style="cursor: pointer;" class="form-check-label  text-center" for="c2" >
					<img src="<?= base_url()?>assets/img/icon/2.jpg" width="100%">
					<span id="b"><?php echo $soal[0]->b ?></span>
			</label>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="col">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pilihan" id="c3" value="c" style="display:none;">
                    <label style="cursor: pointer;" class="form-check-label text-center" for="c3" >
					<img src="<?= base_url()?>assets/img/icon/3.jpg" width="100%">
					<span id="c"><?php echo $soal[0]->c ?></span>
			</label>
                  </div>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="col">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="pilihan" id="c4" value="d" style="display:none;">
                    <label style="cursor: pointer;" class="form-check-label text-center" for="c4" >
					<img src="<?= base_url()?>assets/img/icon/4.jpg" width="100%">
					<span id="d"><?php echo $soal[0]->d ?></span>
			</label>
                  </div>
                </div>
              </div>
          
		  </div>
			<br/>
			 
			
		    <p>	
			<a href="<?php echo site_url().'survey/dataunitlayanan' ?>" class="btn btn-primary float-left "> <i class="fa fa-arrow-circle-left"></i> Sebelumnya </a>  
		    </p>	
            <p>
               
			
			 
			<button id="lanjut" class="btn btn-success float-right" style="margin-left:10px;" >Selanjutnya  <i class="fa fa-arrow-circle-right"></i></button>  
				<button id="kembali" class="btn btn-success float-right "  >  <i class="fa fa-arrow-circle-left"></i> Sebelumnya </button> 
            </p>
          </div>
        </div>
		 
		  
      </div>


      <div class="col-md-4" data-aos="fade-right">
        <img src="<?php echo base_url().'assets/bot/'?>img/details-1.png" class="img-fluid" alt="">
      </div>
    </div>

  </div>
</section>
 

  <input type="hidden" id="base" value="<?php echo site_url() ?>">
  <input type="hidden" id="noreg" value="<?php echo $noreg ?>">
  <input type="hidden" id="n_soal" value="<?php echo $nsoal ?>">
  <input type="hidden" id="id_soal" value="<?php echo $soal[0]->id_pertanyaan ?>">
</main>
<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
<div id="preloader"></div>

<?= $this->load->view('sesi/script') ?>
<script src="<?php echo base_url().'assets/js' ?>/jsku.js"></script>

</body>

</html>