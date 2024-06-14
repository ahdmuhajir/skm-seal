<style>
  .boxc{
    height: 180px;
  }
</style>
<section id="counts" class="counts" style="background-color: #192965; color: white; ">
  <div class="container">
    <div class="section-title" data-aos="fade-up">
	<br/>
      <h2>Statistik Hasil Survey</h2>
      
    </div>
	<br/><br/>
	
    <div class="row" data-aos="fade-up">

      <div class="col-lg-4 col-md-6">
        <div class="count-box boxc">
          <i class="icofont-simple-smile"></i>
          <span data-toggle="counter-up"><?php echo $kepuasan ?></span>
          <p style="color:#010483;">Index Kepuasan (%)</span></p>
         
          <h4 style="color:#010483;"><strong><?php echo $tingkat_kepuasan; ?></strong></h4>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mt-5 mt-lg-0">
        <div class="count-box boxc">
          <i class="icofont-users-alt-5"></i>
          <span data-toggle="counter-up"><?php echo $pengunjung ?></span>
          <p style="color:#010483;">Total Responden</p>
        </div>
      </div>

<!--       <div class="col-lg-4 col-md-6 mt-5 mt-md-0">
        <div class="count-box boxc">
          <i class="icofont-document-folder"></i>
          <span data-toggle="counter-up">521</span>
          <p>Jumlah Pengajuan</p>
        </div>
      </div>
 -->
      <div class="col-lg-4 col-md-6 mt-5 mt-lg-0">
        <div class="count-box boxc">
          <i class="icofont-live-support"></i>
          <span data-toggle="counter-up"><?php echo $loket ?></span>
          <p style="color:#010483;">Total Unit</p>
        </div>
      </div>
    </div>

  </div>
</section>
