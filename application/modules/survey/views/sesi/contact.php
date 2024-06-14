 <?php
$this->db->select('*');
$profil = $this->db->get_where('profil_aplikasi',['id_profilaplikasi' => '1'])->result();
?>

<section id="contact" class="contact">
  <div class="container">

   <div class="section-title" data-aos="fade-up">
    <h2>KONTAK </h2>
    <p style="font-size:1.5rem;"><?= $profil[0]->nama_instansi?></p><br/>
  </div>

  <div class="row" style="margin-top: -60px;">
    <div class="col-lg-4" data-aos="fade-right" data-aos-delay="100" >
      <div class="info" >
        <div class="address" style="margin-top: 30px;">
          <i class="icofont-google-map"></i>
          <h4>Alamat</h4>
          <p><?= $profil[0]->alamat_instansi?></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4" data-aos="fade-right" data-aos-delay="100">
      <div class="info">
        <div class="email">
          <i class="icofont-envelope"></i>
          <h4>Email</h4>
          <p><?= $profil[0]->email_instansi?></p>
        </div>
      </div>
    </div>
    <div class="col-lg-4" data-aos="fade-right" data-aos-delay="100">
      <div class="info">
        <div class="phone">
          <i class="icofont-phone"></i>
          <h4>Telp.</h4>
          <p><?= $profil[0]->notelp_instansi?></p>
        </div>

      </div>

    </div>

  </div>

</div>
</section>