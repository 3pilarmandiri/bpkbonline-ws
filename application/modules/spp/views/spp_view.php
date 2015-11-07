
     <div style="width:1000px; margin:10px; font-size:12px;">
			<form id="frm" method="post" />
			<table width="100%" border="0">
               

        <tr class="tr_program">
                <td width="18%">Kelompok Belanja</td>
                <td width="1%">:</td>
                <td width="76%"><?php echo form_dropdown(null,$this->dm->arr_id_program(),'','id="program" onchange="get_child(this,\'akun_program\',\'#id_kegiatan\')"') ?></td>
                <td width="5%">&nbsp;</td>
              </tr>
            <!--   <tr  class="tr_program">
                <td>&nbsp;</td>
                <td>:</td>
                <td><select    id="id_kegiatan2" onchange="get_child(this,'akun_program','#id_kegiatan')">
                </select></td>
                <td>&nbsp;</td>
              </tr> -->
              <tr  class="tr_program">
                <td>Kegiatan </td>
                <td>:</td>
                <td><select name="id_kegiatan"   id="id_kegiatan">
                </select></td>
                <td>&nbsp;</td>
              </tr>





              <tr>
                <td>Tanggal </td>
                <td>: </td>
                <td> <input   id="tanggal" name="tanggal" class="tanggal easyui-validatebox" /> </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><a href="#" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="query()" >TAMPILKAN </a>	
                
                <a href="#" class="btn btn-lg btn-primary"  onclick="cetak()" ><i class="glyphicon glyphicon-print"></i> Cetak </a>	</td>
                <td>&nbsp;</td>
              </tr>
       </table>
</form>
     </div>
     
<!-- --> 

<!-- url="<?php echo site_url("$controller/get_data")  ?>"-->
 <!-- GRID DIMULAI --> 
 <table id="tt" style="width:1180px;height:350px" 
			
			title="<?php echo $title; ?>" toolbar="#tb"  pageSize="50"
			rownumbers="false"  singleSelect="true">
		<thead>
        <thead frozen="true"  >
			<tr>
				<!--<th field="ck" checkbox="true"></th>-->
				<th field="kode" width="120" sortable="true"><strong>Kode Rekening</strong></th>
				<th field="nama" width="400" sortable="true"><strong>Uraian </strong></th>
        <th field="total" width="150" sortable="true" align="right"><strong>Jumlah Pagu (Rp) </strong></th>         
             </tr>
             </thead>
             <thead>
             <tr>                
		
        <th field="jumlah_sd" width="150" sortable="true" align="right"  formatter="formatPrice"><strong>Jumlah s.d Lalu (Rp) </strong></th>
        <th field="jumlah" width="150" sortable="true" align="right" 
        editor="{type:'numberbox',options:{precision:1}}" formatter="formatPrice"><strong>Jumlah (Rp) </strong></th>
        <th field="jumlah_semua" width="150" sortable="true" align="right"  formatter="formatPrice"><strong>Jlm. Sampai Sekarang (Rp) </strong></th>
        <th field="sisa" width="150" sortable="true" align="right"  formatter="formatPrice"><strong>Sisa (Rp) </strong></th>
        <!--<th field="edit" width="400" sortable="true"><strong>Edit </strong></th>-->
                
 				<!-- <th field="t1" width="100" sortable="true" align="right"><strong>TW I  (Rp) </strong></th>
                 <th field="t2" width="100" sortable="true" align="right"><strong>TW II  (Rp) </strong></th>
                 <th field="t3" width="100" sortable="true" align="right"><strong>TW III  (Rp) </strong></th>
                 <th field="t4" width="100" sortable="true" align="right"><strong>TW IV  (Rp) </strong></th>-->
 		 
			 <!-- FormatNumberBy3(angsuran,',','.');	 -->
			</tr>
		</thead>
	</table>
	 
<div id="tb"  style="padding:5px;height:auto">
	
	<div >		
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#tt').edatagrid('saveRow');" >Simpan </a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:hapus();" >Hapus </a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="javascript:$('#tt').edatagrid('cancelRow')" >Batal </a>	
		<a href="#" class="easyui-linkbutton" iconCls="icon-reload" plain="true" onclick="query()" >Refresh</a>	
<!--        <a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="penarikan()" >Rencana Penarikan</a>
	<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="hapus()" >Hapus</a>-->			 
		 
		<br />
		 
	</div>
	<!-- filter section -->

	
	<!-- <div>
		<fieldset style="border-radius: 5px; border:solid 1px #ccc; margin: 2px 0px;" > <legend>Pencarian </legend>
		 
		 
		 
		<input  size="30" type="text" name="search_uraian" placeholder="Cari kode rekening atau Uraian " id="search_uraian" />
		 

		<a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="cari()">Cari</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-reset" onclick="reset_cari()">Reset Pencarian</a>
		
		</fieldset>	
		
	</div>-->
	 
	 
	 
		
</div>
<!-- end of grid -->      
     

 
 <?php
$this->load->view($controller."_view_js"); 
?>
