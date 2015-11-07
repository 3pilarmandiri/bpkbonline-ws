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
</style>
<table width="100%" border="0" cellpadding="3" class="cetak">
  <tr>
    <td width="49%" align="center" valign="top"><br>
      <br>
      Telah dilakukan verifikasi<br>
      Sekretaris Desa <br>
      <br>
      <br>
      <br>
      <br>
      <b><u><?php echo $data_desa->nama_sek_desa;?></u></b><br>
      <br></td>
    <td width="51%" align="center" valign="top"><span class="full-border"><?php echo "$data_desa->desa, ";?><?php echo $tanggal; ?><br />
        Pelaksana Kegiatan <br />
        <br />
        <br />
        <br />
        <br>
        <br />
    <b>(________________________)</b></span></td>
  </tr>
  <tr>
    <td align="center" valign="top">Setuju untuk dibayarkan <br>
    Kepala Desa<br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <b><u><?php echo $data_desa->nama_kepala_desa;?></u></b></td>
    <td width="51%" align="center" valign="top">Telah dibayar lunas <br>
      Bendahara <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <b><u><?php echo $data_desa->bendahara;?></u></b></td>
  </tr>
</table>
