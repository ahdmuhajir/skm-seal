   <?php
$this->db->select('*');
$profil = $this->db->get_where('profil_aplikasi',['id_profilaplikasi' => '1'])->result();
?>
<!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <h1 class="text-light"><a href="<?php echo site_url().'survey' ?>"><span><?= $profil[0]->nama_aplikasi ?></span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="<?php echo base_url().'assets/bot/'?>img/logo.png" alt="" class="img-fluid"></a> -->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li <?php if($this->uri->segment(2)=="") {echo "class='active'";} ?> ><a href="<?php echo site_url().'survey' ?>">Home</a></li>
          <li <?php if($this->uri->segment(2)=="statistik") {echo "class='active'";} ?> ><a href="<?php echo site_url().'survey/statistik' ?>">Statistik</a></li>
          <li <?php if($this->uri->segment(2)=="faq") {echo "class='active'";} ?> ><a href="<?php echo site_url().'survey/faq' ?>">FAQ</a></li>
          <li <?php if($this->uri->segment(2)=="news") {echo "class='active'";} ?> ><a href="<?php echo site_url().'survey/news' ?>">News</a></li>
          <?php if ($this->session->userdata('ses_username') != null): ?>
          <li><a href="<?php echo site_url('admin') ?>"><strong>Admin</strong></a></li>
          <?php endif ?>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->