<?php 
$menu_admin = ['pertanyaan', 'publish','saran'];
$menu_news  = ['news', 'faq'];
$menu_pengaturan  = ['profilaplikasi', 'user','unit','pelayanan'];
?>


<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url().'assets/'?>img/<?php echo $this->session->userdata('ses_foto'); ?>" class="img-circle" alt="User Image" style="width:40px !important; height:40px !important;">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata('ses_namalengkap') ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i>Online</a>

      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header" style="color:black">MENU UTAMA</li>
      <li>
        <a href="<?php echo site_url('admin') ?>">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="treeview" >
        <a href="#">
          <i class="fa fa-tasks fa-black"></i>
          <span>Survey</span>
		  <span class="pull-right-container">
              <i class="fa fa-chevron-right"></i>
            </span>
        </a>
        <ul class="treeview-menu" <?php if(in_array($menu, $menu_admin , true)) {echo 'style="display : block"';} ?> >
          <li <?php echo $menu=='pertanyaan' ? 'class="active"' : '' ?>><a href="<?php echo site_url('admin/pertanyaan') ?>"><i class="fa  fa-edit"></i>Pertanyaan</a></li>
          <li <?php echo $menu=='publish' ? 'class="active"' : '' ?>><a href="<?php echo site_url('admin/publish') ?>"><i class="fa fa-send"></i>Jawaban Responden</a></li>
          <li <?php echo $menu=='saran' ? 'class="active"' : '' ?>><a href="<?php echo site_url('admin/saran') ?>"><i class="fa fa-file"></i>Kritik dan Saran</a></li>
        </ul>
      </li>
	  
	  
		
		
      <li class="treeview">
        <a href="#">
          <i class="fa fa-bullhorn fa-black"></i>
          <span>News & FAQ</span>
		   <span class="pull-right-container">
              <i class="fa fa-chevron-right"></i>
            </span>
        </a>
        <ul id="menu_surat" class="treeview-menu" <?php if(in_array($menu, $menu_news , true)) {echo 'style="display : block"';} ?>>
          <li <?php echo $menu=='news' ? 'class="active"' : '' ?>><a href="<?php echo site_url('news/index') ?>"><i class="fa fa-rss-square"></i>News</a></li>
          <li <?php echo $menu=='faq' ? 'class="active"' : '' ?>><a href="<?php echo site_url('news/FAQ') ?>"><i class="fa  fa-question"></i>FAQ</a></li>
        </ul>
      </li>
	  
	  
	<li class="treeview">
        <a href="#">
          <i class="fa fa-cogs fa-black"></i>
          <span>Pengaturan</span>
		   <span class="pull-right-container">
              <i class="fa fa-chevron-right"></i>
            </span>
        </a>
        <ul id="menu_surat" class="treeview-menu" <?php if(in_array($menu, $menu_pengaturan , true)) {echo 'style="display : block"';} ?>>
          
		  <li <?php echo $menu=='profilaplikasi' ? 'class="active"' : '' ?>><a href="<?php echo site_url('pengaturan/profilaplikasi') ?>"><i class="fa fa-globe"></i>Profil Aplikasi</a></li>
         
		 <li <?php echo $menu=='user' ? 'class="active"' : '' ?>><a href="<?php echo site_url('pengaturan/user') ?>"><i class="fa  fa-users"></i>Pengguna</a></li>
		  
		  <li <?php echo $menu=='unit' ? 'class="active"' : '' ?>><a href="<?php echo site_url('pengaturan/unit') ?>"><i class="fa  fa-home"></i>Unit</a></li>
					
		 <li <?php echo $menu=='pelayanan' ? 'class="active"' : '' ?>><a href="<?php echo site_url('pengaturan/pelayanan') ?>"><i class="fa  fa-tag"></i>Layanan</a></li>
        </ul>
      </li>
	  
	  
	  
      <li <?php echo $menu=='monitoring' ? 'class="active"' : '' ?>>
        <a href="<?php echo site_url('monitoring') ?>">
          <i class="fa fa-file-o fa-black"></i>
          <span>Monitoring</span>
        </a>
      </li>
	  
	  
     
      
    </section>
    <!-- /.sidebar -->
  </aside>