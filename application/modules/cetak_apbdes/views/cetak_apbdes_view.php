<style>
.listtabel td {
	padding:5px;
	font-family:Verdana, Geneva, sans-serif;
	font-size:12px;
}
</style> 
     
     <div style="width:1000px; margin:10px; font-size:12px;">
			<form id="frm" method="post" />
			<table class="listtabel" width="100%" border="0">
              <tr>
                <td width="12%">Pilih Dokumen </td>
                <td width="1%">: </td>
                <td width="73%"><?php
 
        $arr = array("pdf_ringkasan"=>"ANGGARAN PENDAPATAN BELANJA DESA (RAPBDesa)",
               "pdf_penjabaran"=>"PENJABARAN RENCANA ANGGARAN PENDAPATAN BELANJA DESA",
               "pdf_anggarankas"=>"ANGGARAN  KAS ",
			   
			   "dpa_desa"=>"DPA - DESA. Ringkasan Dokumen Pelaksanaan Anggaran Pendapatan Desa ",
			   "pdf_dpa"=>"DPA - DESA 1. Rincian Dokumen Pelaksanaan Anggaran Pendapatan Desa ",
			   "pdf_dpa_rekap"=>"DPA - DESA 2.1 Rekapitulasi Belanja menurut Bidang dan Kegiatan Desa ",
			   "pdf_dpa_belanja"=>"DPA - DESA 2.1.1 Rincian Dokumen Pelaksanaan Anggaran Belanja menurut Bidang dan Per kegiatan Desa",
			    "pdf_dpa_pembiayaan/3_1"=>"DPA - DESA 3.1 Rincian Dokumen Pelaksanaan Anggaran Pembiayaan Penerimaan "
				
				/*,
				
			    "xxxxx"=>"---------------------------------------------------------------------------------",
			   "pdf_dpa_rekap"=>"DOKUMEN PELAKSANAAN ANGGARAN (DPA) - REKAP KELOMPOK BELANJA ",
			   "pdf_dpa_sd"=>"DOKUMEN PELAKSANAAN ANGGARAN (DPA) - REKAP SUMBER DANA ",
         "pdf_dpa_rekap_belanja"=>"DOKUMEN PELAKSANAAN ANGGARAN (DPA) - REKAP REKENING BELANJA ",
               "pdf_dpa"=>"DOKUMEN PELAKSANAAN ANGGARAN (DPA) - PENDAPATAN ",
               "pdf_dpa_belanja"=>"DOKUMEN PELAKSANAAN ANGGARAN (DPA) - BELANJA",
               "pdf_dpa_pembiayaan"=>"DOKUMEN PELAKSANAAN ANGGARAN (DPA) PEMBIAYAAN",
               "rincian_program"=>"RENCANA ANGGARAN BIAYA"*/
               
               );
				echo form_dropdown("jenis_cetak",$arr,'','id="jenis_cetak" class="form-control"');
                ?></td>
                <td width="14%"></td>
              </tr>

        <tr class="tr_program">
                <td>Program &amp; Kegiatan</td>
                <td>:</td>
                <td><?php echo form_dropdown(null,$this->dm->arr_id_program(),'','id="program" class="form-control" onchange="get_child(this,\'akun_program\',\'#id_kegiatan\')"') ?></td>
                <td>&nbsp;</td>
              </tr>
            <!--   <tr  class="tr_program">
                <td>&nbsp;</td>
                <td>:</td>
                <td><select    id="id_kegiatan2" onchange="get_child(this,'akun_program','#id_kegiatan')">
                </select></td>
                <td>&nbsp;</td>
              </tr> -->
              <tr  class="tr_program">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><select name="id_kegiatan"   id="id_kegiatan" class="form-control">
                </select></td>
                <td>&nbsp;</td>
              </tr>





              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><a href="#" class="btn btn-lg btn-primary"  onclick="cetak()" ><i class="glyphicon glyphicon-print"></i> Cetak </a>	</td>
                <td>&nbsp;</td>
              </tr>
       </table>
</form>
     </div>
 
 
 <script>
 $(document).ready(function(){
  $(".tr_program").hide();    
   
  
  $("#jenis_cetak").change(function(){
      vl = $(this).val();
      if(vl=="pdf_dpa_belanja" || vl=="rincian_program"){
        $(".tr_program").show();
      }
      else {
        $(".tr_program").hide();
      }
      });


  });


 function cetak(){
  
            window.open('<?php echo site_url("$controller"); ?>/'+$("#jenis_cetak").val()+'/'+$("#id_kegiatan").val());
        
       
 	//window.open('<?php echo site_url("$controller"); ?>/'+$("#jenis_cetak").val());
 }

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
 </script>