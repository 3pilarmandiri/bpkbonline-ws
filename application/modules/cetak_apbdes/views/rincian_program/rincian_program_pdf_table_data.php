
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

.prefix {
	font-size:8px;
}
</style>
<table class="prefix" width="100%" border="0" cellpadding="0">
  <tr>
    <td width="57%">&nbsp;</td>
    <td width="43%"><table width="100%" border="0" align="right" cellpadding="0">
      <tr>
        <td width="26%">LAMPIRAN IV</td>
        <td width="3%">:</td>
        <td width="71%" align="left"> RENCANA ANGGARAN BIAYA  APBDES</td>
      </tr>
      <tr>
        <td>NOMOR</td>
        <td>:</td>
        <td align="left"> <?php echo isset($perdes->nomor_peraturan)?$perdes->nomor_peraturan:""; ?></td>
      </tr>
      <tr>
        <td>TANGGAL</td>
        <td>:</td>
        <td align="left"> <?php echo isset($perdes->tgl_peraturan)?tgl_indo(flipdate($perdes->tgl_peraturan)):""; ?></td>
      </tr>
    </table></td>
  </tr>
</table>
<p><br />
</p>
<table width="100%" border="1" cellpadding="3">
  <tr>
    <td><table width="100%" border="0" cellpadding="7" cellspacing="0">
      <tr>
        <td width="11%" align="left" valign="top"><img width="50px" height="60px" src="<?php echo base_url(); ?>/assets/images/ksb-header.png" /></td>
        <td width="89%" align="center" valign="top"><b><font size="8px">PEMERINTAH DESA <?php echo $data_desa->desa ?> KECAMATAN <?php echo $data_desa->kecamatan ?><br />
              <?php echo $data_desa->kota; ?></font> <font size="12px"> <br />
RENCANA ANGGARAN BELANJA<br />
          </font> <font size="10px"> TAHUN ANGGARAN <?php echo $tahun; ?></font></b></td>
      </tr>
      <tr>
        <td colspan="2" align="left" valign="top"><table width="100%" border="0">
          <tbody>
            <tr>
              <td width="16%">Bidang</td>
              <td width="1%">:</td>
              <td width="7%"><?php echo $kode_program; ?></td>
              <td width="76%"><?php echo $program; ?></td>
            </tr>
            <tr>
              <td>Kegiatan</td>
              <td>:</td>
              <td><?php echo $kode; ?></td>
              <td><?php echo $nama; ?></td>
            </tr>
            <tr>
              <td>Waktu Pelaksanaan</td>
              <td>:</td>
              <td colspan="2">Tahun Anggaran <?php echo $this->tahun; ?></td>
              </tr>
          </tbody>
        </table></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" class="cetak">
  <thead>
    <tr>
      <th width="9%" align="center" scope="col"><strong>KODE <br />
REKENING</strong></th>
      <th width="45%" align="center" scope="col"><strong>URAIAN</strong></th>
      <th width="8%" align="center"><strong>VOLUME</strong></th>
      <th width="8%" align="center"><strong>SATUAN</strong></th>
      <th width="13%" align="center"><strong>TARIF/HARGA</strong></th>
      <th width="17%" align="center" scope="col"><strong>JUMLAH<br />
(RP)</strong></th>
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
  foreach($get_rekening_rincian->result() as $belanja) : 
  if($belanja->has_child == 1) {
    $class  = "tebal";
  $jumlah = $this->add->subtotal2($belanja->id,"v_belanja","total",$tahun,$id_desa);
  }
  else {
    $class = "";
  $jumlah = $belanja->total;
  }
  ?>
  <tr>
    <td width="9%" class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo $belanja->kode; ?></td>
    <td width="45%" class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo spasi($belanja->kode).$belanja->nama; ?></td>
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
    <td width="9%" class="kiri-kanan <?php echo $class ?>" scope="col"></td>
    <td width="45%" class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo spasi($belanja->kode."00").$row_rincian->rincian;  ?></td>
    <td width="8%" align="center" class="kiri-kanan <?php echo $class ?>" scope="col"></td>
    <td width="8%" align="center" class="kiri-kanan <?php echo $class ?>" scope="col"><?php   ?></td>
    <td width="13%" align="right" class="kiri-kanan kanan <?php echo $class ?>" scope="col"><?php    ?></td>
    <td  width="17%" align="right" class="kiri-kanan kanan <?php echo $class ?>" scope="col"><?php echo   rupiah($total_rincian); ?></td>
  </tr>
  <?php 
    $rec_detail_belanja = $this->dm->get_rec_detail("v_belanja_detail", "id_belanja_rincian", $row_rincian->id_belanja_rincian);
    foreach($rec_detail_belanja->result() as $detail_belanja) :  

            $satuan =  $detail_belanja->satuan1 ; 
            $satuan .= (!empty( $detail_belanja->satuan2))?"/". $detail_belanja->satuan2:"";
            $satuan .= (!empty( $detail_belanja->satuan3))?"/". $detail_belanja->satuan3:"";

 
            
             $jumlah = $detail_belanja->vol1;
             $j2 = empty($detail_belanja->vol2)?1:$detail_belanja->vol2;
             $j3 = empty($detail_belanja->vol3)?1:$detail_belanja->vol3;
             

            //$jj = $jumlah * $j2 * $j3; 
			 
			 
			
			$jj =  $detail_belanja->vol1 ; 
            $jj .= (!empty( $detail_belanja->vol2))?"x". $detail_belanja->vol2:"";
            $jj .= (!empty( $detail_belanja->vol3))?"x". $detail_belanja->vol3:"";
       
            
            ?>
  <tr>
    <td width="9%" class="kiri-kanan <?php echo $class ?>" scope="col"></td>
    <td width="45%" class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo spasi($belanja->kode."0000")."- ".$detail_belanja->uraian; ?></td>
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
