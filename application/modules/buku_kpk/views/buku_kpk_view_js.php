<script>


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


function query(){

v_id_kegiatan = $("#id_kegiatan").val();
console.log('id kegia'+v_id_kegiatan);
if(  v_id_kegiatan == null || v_id_kegiatan=="x") { 
        $.messager.alert('Error','Data tidak boleh kosong','error');
}
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
 