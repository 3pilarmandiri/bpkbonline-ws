 <?php 
  $tahun=$this->session->userdata("tahun_anggaran");
  $tahun_sebelum = $tahun - 1;
  $id_desa  = $this->session->userdata("id_desa");
  $data_desa = $this->cm->data_desa();
?>
<style>

.kop td, .kop th {
  font-size:8px;
   
  
}
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
 

 <table width="100%" border="1" class="kop">
  <tr>
    <td width="61%" rowspan="2" align="center"  ><table width="100%" border="0">
      <tr>
        <td width="6%">&nbsp;</td>
        <td width="16%"><br />
          <br />
          <img src="<?php echo base_url(); ?>/assets/images/ksb-header.png" width="40" height="50" align="middle" /></td>
        <td width="78%" align="center"><br />
          <strong><br />
            DOKUMEN PELAKSANAAN ANGGARAN<br />
            DESA <?php echo $data_desa->desa; ?> KECAMATAN  <?php echo $data_desa->kecamatan;?> <br />
          KABUPATEN  <?php echo  str_replace("KABUPATEN","", $data_desa->kota); ?> <br />
          TAHUN ANGGARAN  <?php echo $this->tahun; ?> </strong></td>
      </tr>
    </table></td>
    <td height="40" colspan="5" align="center" width="25%"><br />
      <strong><br />
        <br />
        NOMOR DPA DESA</strong></td>
    <td width="14%" rowspan="2" align="center"><strong><br />
      <br />
      FORMULIR<br />
      DPA DESA<br />
      1</strong></td>
  </tr>
  <tr>
    <td style="padding-top:5px;" width="5%" align="center" valign="middle"><strong><?php echo $data_desa->kode_kecamatan; ?></strong></td>
    <td style="padding-top:5px;"  width="5%" align="center" valign="middle"><strong><?php echo $data_desa->kode_desa; ?></strong></td>
    <td style="padding-top:5px;"  width="5%" align="center" valign="middle"><strong>1</strong></td>
    <td style="padding-top:5px;"  width="5%" align="center" valign="middle">&nbsp;</td>
    <td style="padding-top:5px;"  width="5%" align="center" valign="middle">&nbsp;</td>
  </tr>
</table>
<br />
<!-- <table width="100%" border="1" cellpadding="3" class="kop">
  <tr>
    <td colspan="3" align="center"><strong>PEMERINTAH <?php echo $data_desa->kota; ?><br />
      <font size="8pt"> TAHUN ANGGARAN <?php echo $this->session->userdata("tahun_anggaran"); ?> </font> </strong></td>
  </tr>
 
  <tr>
    <td colspan="3" class="judul">
    <TABLE width="100%">
     <tr>
    <th width="18%" align="left"><strong>KECAMATAN</strong></th>
    <td width="12%">: <?php echo $data_desa->kode_kecamatan;?></td>
    <td width="70%"><?php echo $data_desa->kecamatan;?></td>
  </tr>
  <tr>
    <th align="left"><strong>DESA</strong></th>
    <td>: <?php echo $data_desa->kode_kecamatan;?>.<?php echo $data_desa->kode_desa;?></td>
    <td><?php echo $data_desa->desa;?></td>
  </tr>
    </TABLE>
    </td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="judul"><strong>RINCIAN DOKUMEN PELAKSANAAN ANGGARAN PENDAPATAN DESA</strong></td>
  </tr>
</table>   -->


<table width="100%" border="1" cellpadding="3" class="kop">
  <!--<tr>
    <td width="76%" class="judul"><TABLE width="100%">
      <tr>
        <th width="17%" align="left"><span class="kode">KABUPATEN</span></th>
        <td width="15%"><span class="kode">: <?php echo $data_desa->kode_kota; ?></span></td>
        <td width="61%"><span class="kode"><?php echo  str_replace("KABUPATEN","", $data_desa->kota); ?></span></td>
        <td width="7%">&nbsp;</td>
      </tr>
      <tr>
        <th align="left"><span class="kode"><strong>KECAMATAN</strong></span></th>
        <td><span class="kode">: <?php echo $data_desa->kode_kota; ?>.<?php echo $data_desa->kode_kecamatan;?></span></td>
        <td><span class="kode"><?php echo $data_desa->kecamatan;?></span></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <th align="left"><span class="kode"><strong>DESA</strong></span></th>
        <td><span class="kode">: <?php echo $data_desa->kode_kota; ?>.<?php echo $data_desa->kode_kecamatan;?>.<?php echo $data_desa->kode_desa;?></span></td>
        <td><span class="kode"><?php echo $data_desa->desa;?></span></td>
        <td>&nbsp;</td>
      </tr>
    </TABLE></td>
    <td width="24%" colspan="3" align="center" class="judul"><br>
      <br>
    TAHUN ANGGARAN <?php echo $this->tahun; ?></td>
  </tr>-->
  <tr>
    <td colspan="4" align="center" class="judul">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center" class="judul"><strong>RINCIAN DOKUMEN PELAKSANAAN ANGGARAN  
    </strong></td>
  </tr>
  <tr>
    <td colspan="4" align="center" class="judul">PENDAPATAN DESA </td>
  </tr>
</table>


<table width="100%" border="0" cellpadding="3" class="cetak">
  <thead>
    <tr>
      <th width="9%" rowspan="2" align="center" scope="col"><strong>KODE <br>
      REKENING</strong></th>
      <th width="45%" rowspan="2" align="center" scope="col"><strong>URAIAN</strong></th>
      <th width="29%" colspan="3" align="center" scope="col"><strong>RINCINAN PERHITUNGAN</strong></th>
      <th width="17%" rowspan="2" align="center" scope="col"><strong>JUMLAH<br />
        (RP)</strong></th>
    </tr>
    <tr>
      <th width="8%" align="center"><strong>VOLUME</strong></th>
      <th width="8%" align="center"><strong>SATUAN</strong></th>
      <th width="13%" align="center"><strong>TARIF/HARGA</strong></th>
    </tr>
    <tr>
      <th align="center"><strong>1</strong></th>
      <th align="center"><strong>2</strong></th>
      <th align="center"><strong>3</strong></th>
      <th align="center"><strong>4</strong></th>
      <th align="center"><strong>5</strong></th>
      <th align="center"><strong>6</strong></th>
    </tr>
  </thead>
   <?php 
   $class = "";
  foreach($rec_penjabaran_pendapatan->result() as $pendapatan) : 
   $jumlah = $pendapatan->total;
  if($pendapatan->has_child == 1) {
    $class  = "tebal";
  
  }
  else {
    $class = "";
 
  }
  ?>
  <tr>
    <td width="9%" class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo $pendapatan->kode; ?></td>
    <td width="45%"  class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo spasi($pendapatan->kode).$pendapatan->nama; ?></td>
    <td width="8%" align="center"  class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo ($pendapatan->has_child==0)?"1":""; ?></td>
    <td width="8%" align="center"  class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo ($pendapatan->has_child==0)?"thn":""; ?></td>
    <td width="13%" align="right"  class="kiri-kanan kanan <?php echo $class ?>" scope="col"><?php echo rupiah($jumlah); ?></td>
    <td width="17%" align="right"  class="kiri-kanan kanan <?php echo $class ?>" scope="col"><?php echo rupiah($jumlah); ?></td>
  </tr>
  <?php endforeach; ?>
</table>
<p>&nbsp;</p>
