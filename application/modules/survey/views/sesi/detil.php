    <section id="details" class="details" style="background-color: #192965; color:#fff;">
      <div class="container">
	  
	     <div class="section-title" data-aos="fade-up">
		<br/>
          <h2>News</h2>
          <p style="color:#ccc; font-size:1.2rem;"> Berita dari Kami</p>
        </div>
		
		
		<?php 
		$no=1;
		foreach($newss as $news) {
			
			if($news->img=="") {
				$news->img="noimages.jpeg";
			}
			
			if($no%2==1) {
				?>
				 <div class="row content">
				  <div class="col-md-4" data-aos="fade-right">
					<img src="<?php echo base_url().'assets/img/'.$news->img ?>" class="img-fluid" alt="" style="padding:4px; background-color:#fff;" > 
					<br>
				  </div>
				  <div class="col-md-8" data-aos="fade-up">
					<h3 style="color:#fff;"><?php echo $news->judul ?></h3>
					Tanggal Buat : <?php echo $this->indo->konversi2($news->created_date); ?> <br/><br/>
					<p><?php echo $news->konten?></p>
				  </div>
				</div>

        
				<?php
			} else {
				?>
				<div class="row content">
				  <div class="col-md-4 order-1 order-md-2" data-aos="fade-left">
					<img  src="<?php echo base_url().'assets/img/'.$news->img?>" class="img-fluid" alt="" style="padding:4px; background-color:#fff;">
					<br>
				  </div>
				  
				  <div class="col-md-8 order-2 order-md-1" data-aos="fade-up">
					<h3 style="color:#fff;"><?php echo $news->judul ?></h3>
					Tanggal Buat : <?php echo $this->indo->konversi2($news->created_date); ?> <br/><br/>
					<p>
					 <?php echo $news->konten ?>
					</p>
				  </div>
				</div>
				
				<?php 
				
			}
			$no++;
		}
		
		?>
		
       

      </div>
    </section>