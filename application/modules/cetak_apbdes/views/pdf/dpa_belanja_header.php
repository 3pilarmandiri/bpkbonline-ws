 <?php 
  $tahun=$this->session->userdata("tahun_anggaran");
  $tahun_sebelum = $tahun - 1;
  $id_desa  = $this->session->userdata("id_desa");
  $data_desa = $this->cm->data_desa();
  $perdes = $this->cm->perdes();
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
<?php 
$tmp_kode = explode(".",$detail_kegiatan['kode']);
//show_array($tmp_kode); exit;
?>
<table width="100%" border="1" class="kop">
  <tr>
     
    <td width="61%" rowspan="2" align="center"  ><table width="100%" border="0">
      <tr>
        <td width="6%">&nbsp;</td>
        <td width="16%"><br />          <br />          <img src="<?php echo base_url(); ?>/assets/images/ksb-header.png" width="40" height="50" align="middle" /></td>
        <td width="78%" align="center"><br />
          <strong><br />
          <br />
          <br />
          DOKUMEN PELAKSANAAN ANGGARAN<br />
DESA <?php echo $data_desa->desa; ?></strong></td>
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
      2.1</strong></td>
  </tr>
  <tr>
    <td width="5%" height="22" align="center"><?php echo $data_desa->kode_kecamatan; ?></td>
    <td width="5%" align="center"><?php echo $data_desa->kode_desa; ?></td>
    <td width="5%" align="center">2</td>
    <td width="5%" align="center"><?php echo $tmp_kode[0]; ?></td>
    <td width="5%" align="center"><?php echo $tmp_kode[1]; ?></td>
  </tr>
   
</table>
<br />
<table width="100%" border="1" cellpadding="3" class="kop">
  <tr>
    <td colspan="3" align="center"><strong>PEMERINTAH <?php echo $data_desa->kota; ?><br />
      <font size="8pt">  TAHUN ANGGARAN <?php echo $this->session->userdata("tahun_anggaran"); ?>
      </font>
    </strong><br />
      
 </td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0" class="kop">
      <tr>
        <td width="23%">  <strong>KECAMATAN</strong></td>
        <td width="1%">:</td>
        <td width="14%"><?php echo $data_desa->kode_kecamatan;?></td>
        <td width="62%"><?php echo $data_desa->kecamatan;?></td>
      </tr>
      <tr>
        <td>  <strong>DESA</strong></td>
        <td>:</td>
        <td><?php echo $data_desa->kode_kecamatan;?>.<?php echo $data_desa->kode_desa;?></td>
        <td><?php echo $data_desa->desa;?></td>
      </tr>
      <tr>
        <td>  <strong>BIDANG</strong></td>
        <td>:</td>
        <td><?php echo $data_desa->kode_kecamatan.".".$data_desa->kode_desa.".".$detail_bidang['kode'] ?></td>
        <td><?php echo $detail_bidang['nama'] ?></td>
      </tr>
      <tr>
        <td>  <strong>KEGIATAN</strong></td>
        <td>:</td>
        <td><?php echo $data_desa->kode_kecamatan.".".$data_desa->kode_desa.".".$detail_kegiatan['kode'] ?></td>
        <td><?php echo $detail_kegiatan['kegiatan'] ?></td>
      </tr>
  </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0" class="kop">
      <tr>
        <td width="23%"><strong>&nbsp;&nbsp;Lokasi Kegiatan</strong></td>
        <td width="1%">:</td>
        <td><?php echo $detail_kegiatan['lokasi']?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0" class="kop">
      <tr>
        <td width="23%"><strong>  Sumber Dana</strong></td>
        <td width="1%">:</td>
        <td width="76%"><?php echo $detail_kegiatan['nama']?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <th colspan="3" align="center"><strong>INDIKATOR &amp; TOLOK UKUR KINERJA BELANJA </strong></th>
  </tr>
  <tr>
    <th width="27%" align="center"><strong>INDIKATOR</strong></th>
    <th width="58%" align="center"><strong>TOLOK UKUR KINERJA</strong></th>
    <th width="15%" align="center"><strong>TARGET KINERJA</strong></th>
  </tr>
  <tr>
    <th align="left"><strong>  CAPAIAN KELOMPOK BELANJA</strong></th>
    <td><?php echo $detail_kegiatan['capaian']?></td>
    <td><?php echo $detail_kegiatan['capaian_target']?></td>
  </tr>
  <tr>
    <th align="left"><strong>  MASUKAN</strong></th>
    <td>Jumlah Dana</td>
    <td><?php 
	//$detail_total = $this->add->subtotal2("2_".$id_kegiatan,"v_belanja","total",$this->tahun,$this->id_desa);
	$detail_total = $this->add->get_total_by_id("belanja","total","2_".$id_kegiatan,$this->id_desa,$this->tahun);
	echo rupiah($detail_total); ?> </td>
  </tr>
  <tr>
    <th align="left"><strong>  KELUARAN KEGIATAN</strong></th>
    <td><?php echo $detail_kegiatan['keluaran']?></td>
    <td><?php echo $detail_kegiatan['keluaran_target']?></td>
  </tr>
  <tr>
    <th align="left"><strong>  HASIL KEGIATAN</strong></th>
    <td><?php echo $detail_kegiatan['hasil']?></td>
    <td><?php echo $detail_kegiatan['hasil_target']?></td>
  </tr>
  <tr>
    <td colspan="3" align="left" class="judul">  Kelompok Sasaran Kegiatan : <?php echo $detail_kegiatan['sasaran']?></td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="judul"><strong>RINCIAN DOKUMEN PELAKSANAAN ANGGARAN BELANJA DESA</strong></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" class="cetak">
  <thead>
    <tr>
      <th width="12%" rowspan="2" align="center" scope="col"><strong>KODE <br />
      REKENING</strong></th>
      <th width="42%" rowspan="2" align="center" scope="col"><strong>URAIAN</strong></th>
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
  foreach($rec_penjabaran_belanja->result() as $belanja) : 
  $jumlah = $belanja->total;
  if($belanja->has_child == 1) {
    $class  = "tebal";
  //$jumlah = $this->add->subtotal2($belanja->id,"v_belanja","total",$tahun,$id_desa);
  }
  else {
    $class = "";
  
  }
  ?>
  <tr>
    <td width="12%" class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo $belanja->kode; ?></td>
    <td width="42%" class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo spasi($belanja->kode).$belanja->nama; ?></td>
    <td width="8%" align="center" class="kiri-kanan <?php echo $class ?>" scope="col"><?php //echo ($belanja->has_child==0)?"1":""; ?></td>
    <td width="8%" align="center" class="kiri-kanan <?php echo $class ?>" scope="col"><?php //echo ($belanja->has_child==0)?"thn":""; ?></td>
    <td width="13%" align="right" class="kiri-kanan kanan <?php echo $class ?>" scope="col"><?php //echo rupiah($jumlah); ?></td>
    <td  width="17%" align="right" class="kiri-kanan kanan <?php echo $class ?>" scope="col"><?php echo rupiah($jumlah); ?></td>
  </tr>
  
  <?php 
    $rec_rincian  = $this->add->get_belanja_rincian($belanja->id);
    foreach($rec_rincian->result() as $row_rincian) : 
  $total_rincian = $this->add->get_total_rincian($row_rincian->id_belanja_rincian);
  ?>
 
  <tr>
    <td width="12%" class="kiri-kanan <?php echo $class ?>" scope="col"> </td>
    <td width="42%" class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo spasi($belanja->kode."00").$row_rincian->rincian;  ?> </td>
    <td width="8%" align="center" class="kiri-kanan <?php echo $class ?>" scope="col"> </td>
    <td width="8%" align="center" class="kiri-kanan <?php echo $class ?>" scope="col"><?php   ?></td>
    <td width="13%" align="right" class="kiri-kanan kanan <?php echo $class ?>" scope="col"><?php    ?></td>
    <td  width="17%" align="right" class="kiri-kanan kanan <?php echo $class ?>" scope="col"><?php echo   rupiah($total_rincian); ?></td>
 </tr>
  <?php 
    $rec_detail_belanja = $this->dm->get_rec_detail("belanja_detail", "id_belanja_rincian", $row_rincian->id_belanja_rincian);
    foreach($rec_detail_belanja->result() as $detail_belanja) :  

            $satuan =  $detail_belanja->satuan1 ; 
            $satuan .= (!empty( $detail_belanja->satuan2))?"/". $detail_belanja->satuan2:"";
            $satuan .= (!empty( $detail_belanja->satuan3))?"/". $detail_belanja->satuan3:"";

 
            
             $jumlah = $detail_belanja->vol1;
             $j2 = empty($detail_belanja->vol2)?1:$detail_belanja->vol2;
             $j3 = empty($detail_belanja->vol3)?1:$detail_belanja->vol3;
             

             $jj = $jumlah * $j2 * $j3; 
       
            
            ?>
            
  <tr>
    <td width="12%" class="kiri-kanan <?php echo $class ?>" scope="col"></td>
    <td width="42%" class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo spasi($belanja->kode."0000")."- ".$detail_belanja->uraian; ?></td>
    <td width="8%" align="center" class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo  $jj ?></td>
    <td width="8%" align="center" class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo  $satuan; ?></td>
    <td width="13%" align="right" class="kiri-kanan kanan <?php echo $class ?>" scope="col"><?php echo rupiah($detail_belanja->harga); ?></td>
    <td  width="17%" align="right" class="kiri-kanan kanan <?php echo $class ?>" scope="col"><?php echo rupiah($detail_belanja->total); ?></td>
  </tr> 
   
    <?php 
  endforeach;
  ?>
  
   <?php 
   endforeach; 
   endforeach;
   ?>
  
  
  
  
</table>
