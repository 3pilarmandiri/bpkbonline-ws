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
<?php 
$tmp_kode = explode(".",$detail_kegiatan['kode']);
?>
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
            <td><?php echo $tmp_kode[0]; ?></td>
            <td><?php echo $tmp_kode[1]; ?></td>
            <td><?php echo isset($tmp_kode[2])?$tmp_kode[2]:""; ?></td>
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
    <tr>
      <td>BIDANG</td>
      <td>:</td>
      <td><?php echo $data_desa->kode_kecamatan.".".$data_desa->kode_desa.".".$detail_bidang['kode'] ?></td>
      <td><?php echo $detail_bidang['nama'] ?></td>
    </tr>
    <tr>
      <td>KEGIATAN</td>
      <td>:</td>
      <td><?php echo $data_desa->kode_kecamatan.".".$data_desa->kode_desa.".".$detail_kegiatan['kode'] ?></td>
      <td><?php echo $detail_kegiatan['kegiatan'] ?></td>
    </tr>
    <tr>
      <td>LOKASI KEGIATAN</td>
      <td>:</td>
      <td colspan="2"><?php echo $detail_kegiatan['lokasi']?></td>
    </tr>
    <tr>
      <td>SUMBER DANA</td>
      <td>:</td>
      <td colspan="2"><?php echo $detail_kegiatan['nama'];?></td>
    </tr>
    <tr>
      <td>JUMLAH ANGGARAN</td>
      <td>:</td>
      <td colspan="2"><?php 
      //$detail_kegiatan['total'] = $this->add->subtotal_tw("2_".$id_kegiatan,"v_belanja","total",$this->tahun,$this->id_desa)   ;
	  $detail_kegiatan['total'] = $this->add->get_total_by_id("belanja","total","2_".$id_kegiatan,$this->id_desa,$this->tahun);
      echo rupiah($detail_kegiatan['total'])." <i>(". ucwords( $this->cm->terbilang($detail_kegiatan['total'])." Rupiah )</i>");

      ?></td>
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
<p>&nbsp;</p>
<h3>&nbsp;</h3>
 
 