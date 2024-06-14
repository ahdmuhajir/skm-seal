 <?php
$this->db->select('*');
$profil = $this->db->get_where('profil_aplikasi',['id_profilaplikasi' => '1'])->result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $profil[0]->nama_aplikasi ?></title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo base_url().'assets/'?>img/<?= $profil[0]->favicon_aplikasi ?>" rel="icon">
  <link href="<?php echo base_url().'assets/'?>img/<?= $profil[0]->favicon_aplikasi ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url().'assets/bot/'?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url().'assets/bot/'?>vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo base_url().'assets/bot/'?>vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url().'assets/bot/'?>vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo base_url().'assets/bot/'?>vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo base_url().'assets/bot/'?>vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url().'assets/bot/'?>vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo base_url().'assets/bot/'?>css/style.css" rel="stylesheet">
  <script src="<?php echo base_url().'assets/js/'?>jquery-3.1.1.min.js"></script>
  <script src="<?php echo base_url().'assets/'?>apexcharts.js"></script>
</head>