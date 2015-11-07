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
    <td width="50%" align="center">&nbsp;</td>
    <td width="50%" align="center"><?php 
	
	$this->cm->tanggal_periode($periode,$bulan);
	echo "$data_desa->desa, ". $this->cm->tanggal_periode($periode,$bulan); ;?></td>
  </tr>
  <tr>
    <td align="center">KEPALA DESA <?php echo strtoupper("$data_desa->desa") ?></td>
    <td align="center">BENDAHARA DESA</td>
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
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><b><?php echo $data_desa->nama_kepala_desa;?></b></td>
    <td align="center"><b><?php echo $data_desa->bendahara;?></b></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
</table>
 