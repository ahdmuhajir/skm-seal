 

/*FILTER LOKET*/
$('#btn_filter_unit').click(function(event) {
	var base = $('#base').val()
	var bulan = $('#bulan_unit').val()
	var tahun = $('#tahun_unit').val()

	if (bulan == '' || tahun == '') {
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Parameter Belum Diisi!',
			footer: 'silahkan isi kolom bulan dan tahun',
		})
	}
	else
	{
		location.href = base+'monitoring/index/'+bulan+'/'+tahun
	}
});


$('#btnCetakLaporanMonitoring').click(function(event) {
	var base = $('#base').val()
	var bulan = $('#bulan_unit').val()
	var tahun = $('#tahun_unit').val()

	if (bulan == '' || tahun == '') {
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Parameter Belum Diisi!',
			footer: 'silahkan isi kolom bulan dan tahun',
		})
	}
	else
	{
		location.href = base+'monitoring/index/'+bulan+'/'+tahun+'/cetak'
	}
});