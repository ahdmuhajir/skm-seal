  <script src="<?php echo base_url().'assets/bot/'?>vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url().'assets/bot/'?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url().'assets/bot/'?>vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url().'assets/bot/'?>vendor/php-email-form/validate.js"></script>
  <script src="<?php echo base_url().'assets/bot/'?>vendor/venobox/venobox.min.js"></script>
  <script src="<?php echo base_url().'assets/bot/'?>vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="<?php echo base_url().'assets/bot/'?>vendor/counterup/counterup.min.js"></script>
  <script src="<?php echo base_url().'assets/bot/'?>vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url().'assets/bot/'?>vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo base_url().'assets/bot/'?>js/main.js"></script>
  
  <script>
  
  $('#unit').change(function(){
	  var unit_id = $('#unit').val();
	 
	  if(unit_id != '')
	  {
	 
	   $.ajax({
		url:"<?php echo base_url(); ?>survey/fetch_pelayanan",
		method:"POST",
		data:{unit_id:unit_id},
		success:function(data)
		{
		 
		 $('#pelayanan').html(data);
		  
		}  
	   });
	  }
	  else
	  {
	   
	   $('#pelayanan').html('<option value="">-- Pilih Pelayanan --</option>');
	  }
 });

 
 </script>