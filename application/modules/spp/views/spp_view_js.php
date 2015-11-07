<script>

$(document).ready(function() {

 
	
	$("#id_kegiatan").change(function(){
		$.ajax({
			url : '<?php echo site_url("$controller/get_tanggal"); ?>',
			data : { id_kegiatan : $(this).val() },
			type : 'post',
			success: function(html){
				$("#tanggal").html(html);
			}
		});	
	});
	
	
	
});


function get_child(vid,tbname, berikut){
 
  $.ajax({
    url:'<?php echo site_url("depan_baru/get_account_by_pid") ?>',
    type : 'post',
    data : {pid:$(vid).val(), tbname : tbname  },
    success : function(isi){
      $(berikut).html(isi);
      console.log(isi);
    }
  });
}




function  formatPrice(val,row) {

   // return 'Rp '+val;
   console.log(row);
     var parts = val.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    if(row.has_child == "1")
      return "<b>"+parts.join(",")+",00</b>";
    else 
    return parts.join(",")+",00";

}


function cetak() {
	data = $("#frm").serialize();
	window.open('<?php echo site_url("$controller/pdf"); ?>/?'+data);
}
</script>
 