var base = document.getElementById('base').value;
var nsoal = document.getElementById('n_soal').value;

const jawabans = [];

/*button*/
var lanjut = document.getElementById('lanjut');
var kembali = document.getElementById('kembali');


var selesai = document.getElementById('selesai');

/*deklarasi variable*/
var id_soal 	= document.getElementById('id_soal');
var idreg 		= document.getElementById('noreg');

/*label untuk checkbox*/
var a 			= document.getElementById('a');
var b 			= document.getElementById('b');
var c 			= document.getElementById('c');
var d 			= document.getElementById('d');

/*event klik save / lanjut*/


var no = 0;
lanjut.addEventListener('click', function(){
	jawaban(no);
	soalnext();
	
}, false);


kembali.addEventListener('click', function(){
	soalprev();
	
}, false);


/*menampilkan soal*/
function soalnext(){
	
	no++;
	$.ajax({
		url: base+"tes2/get_soal/"+ no,
		type: 'get',
		dataType: 'json'
	})
	.done(function(data) {
	 
		id_soal.value = data['id_pertanyaan'];
		pertanyaan.innerHTML = data['soal'];
		a.innerHTML = data['a'];
		b.innerHTML = data['b'];
		c.innerHTML = data['c'];
		d.innerHTML = data['d'];

	 
			["c1", "c2", "c3", "c4"].forEach(function(id) {
				document.getElementById(id).checked = false;
			});
		 
			if(jawabans[no]=="a") {
			document.getElementById("c1").checked = true;
			}
			if(jawabans[no]=="b") {
				document.getElementById("c2").checked = true;
			}
			if(jawabans[no]=="c") {
				document.getElementById("c3").checked = true;
			}
			if(jawabans[no]=="d") {
				document.getElementById("c4").checked = true;
			}
		 
		
	})
	
	.fail(function(data) {
		location.href = base+"survey/saran/"+idreg.value;
	});
}


function soalprev(){
 
 if(no<0){
	 no=0;
 } else {
	 no--;
 }
 
 
	$.ajax({
		url: base+"tes2/get_soal/"+ no,
		type: 'get',
		dataType: 'json'
	})
	.done(function(data) {
	 
	 
		id_soal.value = data['id_pertanyaan'];
		pertanyaan.innerHTML = data['soal'];
		a.innerHTML = data['a'];
		b.innerHTML = data['b'];
		c.innerHTML = data['c'];
		d.innerHTML = data['d'];

		/*reset checkbox*/
		["c1", "c2", "c3", "c4"].forEach(function(id) {
			document.getElementById(id).checked = false;
		});
		
		if(jawabans[no]=="a") {
			document.getElementById("c1").checked = true;
		}
		if(jawabans[no]=="b") {
			document.getElementById("c2").checked = true;
		}
		if(jawabans[no]=="c") {
			document.getElementById("c3").checked = true;
		}
		if(jawabans[no]=="d") {
			document.getElementById("c4").checked = true;
		}
	})
	
	.fail(function(data) {
		location.href = base+"survey/pertanyaan/";
	});
}



/*upload saran*/


/*post jawaban*/
function jawaban(no){
	var jawaban = document.querySelector('input[type=radio][name=pilihan]:checked').value;
	var data = {
		"id_pertanyaan"		: id_soal.value,
		"id_responden"	: idreg.value,
		"jawaban"		: jawaban
	}

	jawabans[no] = jawaban;
	$.ajax({
		url: base+'/survey/jawaban',
		type: 'post',
		dataType: 'json',
		data: data,
	})
	.done(function(data) {
		//console.log(data);
	})
	.fail(function(data) {
		//console.log(data);
	});

}