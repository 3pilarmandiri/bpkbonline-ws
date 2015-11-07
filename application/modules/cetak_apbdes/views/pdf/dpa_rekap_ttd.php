<?php 
  $tahun=$this->session->userdata("tahun_anggaran");
  $tahun_sebelum = $tahun - 1;
  $id_desa  = $this->session->userdata("id_desa");
  $data_desa = $this->cm->data_desa();
?>
<style>
.cetak td, .cetak th {
	font-size:8px;
}
.tebal {
 font-weight:bold;
}

.judul {
	 font-weight:bold;
font-size:10px;
}


table.cetak th {
	border : 1px solid #000;
}

table.cetak td {
	/*border-left : 1px solid #000;
	border-right : 1px solid #000;*/
	border:0.5px solid #000;
	
}
</style>
<table width="100%" border="1" cellpadding="5" >
  <tbody>
    <tr>
      <th colspan="5" align="center" scope="col"><table width="100%" border="0" align="right">
        <tr>
          <td width="71%" align="center">&nbsp;</td>
          <td width="29%" align="center"><?php echo "$data_desa->desa, ". tgl_indo(date("d-m-Y"));?></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center">KEPALA DESA <?php echo strtoupper("$data_desa->desa") ?></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center"><b> <br />
            <br />
            <?php echo $data_desa->nama_kepala_desa;?></b></td>
        </tr>
      </table></th>
    </tr>
    
  </tbody>
</table> 
 <table width="100%" border="0" cellpadding="3" class="cetak">
   <tr>
     <th colspan="4" align="center" scope="col">TIM PENDAMPING KECAMATAN</th>
   </tr>
   <tr>
     <th width="5%" align="center" scope="col">NO.</th>
     <th width="25%" align="center" scope="col">NAMA / NIP </th>
     <th width="41%" align="center" scope="col">JABATAN / KEDUDUKAN</th>
     <th width="29%" align="center" scope="col">TANDA TANGAN</th>
   </tr>
   <?php 
 $rec = $this->cm->get_verifikatur();
 $i=0;
 foreach($rec->result() as $row) : 
 $i++;
 $align = ($i%2==0)?"right":"left";
 ?>
   <tr>
     <td scope="col"><?php echo $i; ?></td>
     <td scope="col"><?php echo $row->nama ?><br />
       NIP. <?php echo $row->nip ?> </td>
     <td scope="col"><?php echo $row->jabatan ?> / <br />
         <?php echo $row->kedudukan ?></td>
     <td scope="col" align="<?php echo $align; ?>"><br />
         <br />
       <?php echo $i ?>.................................</td>
   </tr>
   <?php endforeach; ?>
 </table>
 <p>&nbsp;</p>
