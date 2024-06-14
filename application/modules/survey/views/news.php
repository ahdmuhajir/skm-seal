<?php $this->load->view('sesi/header') ?>

<body>

<?php $this->load->view('sesi/navbar')  ?>
 
  <main id="main">
 
<?php $this->load->view('sesi/detil') ?>
 
<?php $this->load->view('sesi/contact') ?>
  </main>
<?php $this->load->view('sesi/footer') ?>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  <div id="preloader"></div>

<?php $this->load->view('sesi/script') ?>
<script src="<?php echo base_url().'assets/js' ?>/wall.js"></script>

</body>

</html>