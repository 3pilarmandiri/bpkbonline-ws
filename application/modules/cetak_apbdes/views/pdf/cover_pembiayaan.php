 <?php 
  $tahun=$this->session->userdata("tahun_anggaran");
  $tahun_sebelum = $tahun - 1;
  $id_desa  = $this->session->userdata("id_desa");
  $data_desa = $this->cm->data_desa();
?>
<style type="text/css">
<!--
.judul {	font-size:24px;
	font-weight:bold;
}
.judul {	font-size:24px;
	font-weight:bold;
}
-->
</style>
 
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="100%" border="0" cellpadding="0">
  <tr>
    <td align="center"><h3><img width="100px"  height="130px"  src="<?php echo base_url(); ?>/assets/images/ksb-header.png" /></h3>
      <h3>PEMERINTAH <?php echo $data_desa->kota; ?></h3>
      <h2><?php echo $jenis_dokumen; ?></h2>
      <h3>PEMERINTAH DESA <?php echo $data_desa->desa ?> KECAMATAN <?php echo $data_desa->kecamatan ?></h3>
    <h3>TAHUN ANGGARAN <?php echo $tahun; ?></h3>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <h1><span class="judul"><?php echo $jenis; ?></span></h1></td>
  </tr>
</table>
<p align="center">
<table width="547" border="0" align="center" cellpadding="3">
  <tbody>
    <tr>
      <td width="126">&nbsp;</td>
      <td width="112">NOMOR DPA : </td>
      <td width="295"><table width="48%" border="1" cellpadding="3">
        <tbody>
          <tr>
            <td><?php echo $data_desa->kode_kecamatan; ?></td>
            <td><?php echo $data_desa->kode_desa; ?></td>
            <td>3</td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table></td>
    </tr>
  </tbody>
</table>
</p>
<table width="100%" border="0">
  <tbody>
    <tr>
      <td width="26%">KECAMATAN</td>
      <td width="1%">: </td>
      <td width="14%"><?php echo $data_desa->kode_kecamatan; ?></td>
      <td width="59%"><?php echo $data_desa->kecamatan; ?></td>
    </tr>
    <tr>
      <td>DESA</td>
      <td>:</td>
      <td><?php echo $data_desa->kode_kecamatan; ?>.<?php echo $data_desa->kode_desa; ?></td>
      <td><?php echo $data_desa->desa; ?></td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
<table width="100%" border="0" class="desa">
  <tr>
    <td colspan="3">PENGGUNA ANGGARAN / KUASA PENGGUNA ANGGARAN</td>
  </tr>
  <tr>
    <td width="26%">NAMA</td>
    <td width="1%">:</td>
    <td width="73%"><?php echo $data_desa->nama_kepala_desa;?></td>
  </tr>
  <tr>
    <td>JABATAN</td>
    <td>:</td>
    <td>KEPALA DESA</td>
  </tr>
</table>
<p></p>
 
 