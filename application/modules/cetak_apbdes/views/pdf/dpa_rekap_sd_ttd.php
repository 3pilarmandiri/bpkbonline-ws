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
<table width="100%" border="1" cellpadding="5" class="cetak">
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
 