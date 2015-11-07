 <?php 
	$tahun=$this->session->userdata("tahun_anggaran");
	$tahun_sebelum = $tahun - 1;
	$id_desa  = $this->session->userdata("id_desa");
	$data_desa = $this->cm->data_desa();
  	$perdes = $this->cm->perdes();

?>
<style>
td {
	font-size:8px;
}
</style>
<table width="100%" border="0" align="right">
  <tr>
    <td width="71%" align="center">&nbsp;</td>
    <td width="29%" align="center"><?php echo "$data_desa->desa, ". tgl_indo(flipdate($perdes->tgl_peraturan));?></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">KEPALA DESA <?php echo strtoupper("$data_desa->desa") ?> </td>
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
    <td align="center"> <b>
    <br /><br />
    <?php echo $data_desa->nama_kepala_desa;?></b> </td>
  </tr>
</table>
 