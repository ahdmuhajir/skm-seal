 <?php
$this->db->select('*');
$profil = $this->db->get_where('profil_aplikasi',['id_profilaplikasi' => '1'])->result();
?>

<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>SKM</b>
  </div>
  <strong>Copyright &copy; <?php echo date("Y");?> <?= $profil[0]->nama_instansi ?>.</strong> All rights
  reserved.
</footer>
