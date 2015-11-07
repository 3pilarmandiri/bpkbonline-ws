<?php 
	$tahun=$this->session->userdata("tahun_anggaran");
	$tahun_sebelum = $tahun - 1;
	$id_desa  = $this->session->userdata("id_desa");
	$data_desa = $this->cm->data_desa();
	
	$perdes = $this->cm->perdes();
?>
 
<style>
* {
  font-size: 10px;
  font-family:  verdana;
}
.full-border {
  border  : #000 solid 1px;
}
.cetak {
  border-collapse: collapse;
  border-spacing: 1px;
  border: solid 1px #000;
}
</style>

 
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td width="48%">&nbsp;</td>
    <td width="15%">LAMPIRAN I</td>
    <td width="2%">:</td>
    <td width="35%">RINGKASAN RAPBDES</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>NOMOR</td>
    <td>:</td>
    <td><?php echo $perdes->nomor_peraturan; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>TANGGAL</td>
    <td>:</td>
    <td><?php echo flipdate($perdes->tgl_peraturan); ?></td>
  </tr>
</table>
<br />
<br />

<table width="100%" border="0" cellpadding="3">
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="14%"><img src="<?php echo base_url(); ?>/assets/images/ksb-header.png" /></td>
        <td width="86%" align="center"><h3>PEMERINTAH DESA <?php echo $data_desa->desa ?> KECAMATAN <?php echo $data_desa->kecamatan ?></h3>
          <h2>
          <?php echo $data_desa->kota; ?>
          </h3>
          <h2>RINGKASAN   ANGGARAN PENDAPATAN BELANJA DESA</h2>
          <h4>TAHUN ANGGARAN <?php echo $tahun; ?></h4></td>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
