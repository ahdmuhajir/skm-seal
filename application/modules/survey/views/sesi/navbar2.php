<?php
$this->db->select('*');
$profil = $this->db->get_where('profil_aplikasi',['id_profilaplikasi' => '1'])->result();
?>

 
 <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="<?php echo site_url().'survey' ?>"><span><?= $profil[0]->nama_aplikasi?></span></a></h1>
      </div>

   
    </div>
  </header><!-- End Header -->