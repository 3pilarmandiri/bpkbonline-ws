 <?php 
	$tahun=$this->session->userdata("tahun_anggaran");
	$tahun_sebelum = $tahun - 1;
	$id_desa  = $this->session->userdata("id_desa");
	$data_desa = $this->cm->data_desa();
?>
<style>
td {
	font-size:8px;
}
</style>
<table width="100%" border="0" align="right">
  <tr>
    <td width="47%" align="center">&nbsp;</td>
    <td width="53%" align="center"><?php echo "$data_desa->desa, ". tgl_indo(date("d-m-Y"));?></td>
  </tr>
  <tr>
    <td align="center">KEPALA DESA <?php echo strtoupper("$data_desa->desa") ?> </td>
    <td align="center">PELAKSANA KEGIATAN</td>
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
    <td align="center"><b><u><?php echo $data_desa->nama_kepala_desa;?></u></b></td>
    <td align="center"> <b>
    <u><?php echo $data_desa->ptpkd;?></u><br /><br />
    </b> </td>
  </tr>
</table>
 