<link href="<?php echo base_url("assets") ?>/css/datepicker.css" rel="stylesheet">
<script src="<?php echo base_url("assets") ?>/js/bootstrap-datepicker.js"></script>
<div style="width:1000px; margin:10px; font-size:12px;">
			<form id="frm" method="post" />
			<table width="100%" border="0"  class="listtabel">
              <tr>
                <td width="12%">PILIH PERIODE </td>
                <td width="1%">: </td>
                <td width="73%"><?php
			$arr = array(
               "X" => "- PILIH PERIODE LAPORAN ",   
               "b"=>"BULANAN ", 
              "t1"=>"TRIWULAN I",
               "t2"=>"TRIWULAN II",
                       "t3"=>"TRIWULAN III",
                   "t4"=>"TRIWULAN IV",
               "s1"=>"SEMESTER PERTAMA",
               "s2"=>"SEMESTER AKHIR",
               "y"=>"TAHUNAN"
                         
               );
				echo form_dropdown("periode",$arr,'','id="periode"  class="form-control"');
                ?></td>
                <td width="14%"></td>
              </tr>
              <tr class="tr_bulan">
                <td>BULAN </td>
                <td>:</td>
                <td><?php echo form_dropdown(null,$this->cm->arr_bulan(),'','id="bulan"  class="form-control"') ?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>TANGGAL </td>
                <td>: </td>
                <td><input name="tanggal" type="text" class="form-control" id="tanggal" placeholder="Tanggal" data-date-format="dd-mm-yyyy" style="width:120px;" /></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><a href="#" class="btn btn-lg btn-primary"  onclick="cetak()" ><i class="glyphicon glyphicon-print"></i> Cetak </a></td>
                <td>&nbsp;</td>
              </tr>
       </table>
</form>
     </div>

 
 <script>
 
 
 $(document).ready(function(){
	
$("#tanggal").datepicker().on('changeDate', function(ev){                 
   			 $('#tanggal').datepicker('hide');
		}); 				
											
							
	$(".tr_bulan").hide();						
	$("#periode").change(function(){
			vl = $(this).val();
			if(vl=="b"){
				$(".tr_bulan").show();
			}
			else {
				$(".tr_bulan").hide();
			}
	});
	});
  
 
 function cetak(){
	 v_tanggal  =  $('#tanggal').val();
 	window.open('<?php echo site_url("$controller/cetak"); ?>/'+$("#periode").val()+'/'+$("#bulan").val()+'/'+v_tanggal );
 }
 </script>