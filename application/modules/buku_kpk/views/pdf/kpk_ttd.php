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
    <td align="center" valign="top"><br>      <span class="full-border"><?php echo "$data_desa->desa, ". date("d-m-Y");?><br />
        Pelaksana Kegiatan <br />
        <br />
        <br />
        <br />
        <br>
        <br />
    <b>(_____________________________)</b></span></td>
  </tr>
</table>
