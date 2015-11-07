<?php
  $tahun=$this->session->userdata("tahun_anggaran");
  $tahun_sebelum = $tahun - 1;
  $id_desa  = $this->session->userdata("id_desa");
  $data_desa = $this->cm->data_desa();
  $perdes = $this->cm->perdes();
?>
<style>
th  {
 font-size: 8px;
 padding: 1px;
 text-align:center;
 vertical-align:middle;
 font-weight:bold;d
}
td  {
 font-size: 8px;
 padding: 3px;
 text-align:left;
 vertical-align:middle;
}

.tebal {
  font-weight:bold;
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

<table width="100%" border="0" cellpadding="0">
  <tr>
    <td width="58%">&nbsp;</td>
    <td width="42%"><table width="100%" border="0" align="right" cellpadding="0">
      <tr>
        <td width="24%">LAMPIRAN I</td>
        <td width="3%">:</td>
        <td width="73%">RINGKASAN   APBDES</td>
      </tr>
      <tr>
        <td>NOMOR</td>
        <td>:</td>
        <td><?php echo $perdes->nomor_peraturan; ?></td>
      </tr>
      <tr>
        <td>TANGGAL</td>
        <td>:</td>
        <td><?php echo tgl_indo(flipdate($perdes->tgl_peraturan)); ?></td>
      </tr>
    </table></td>
  </tr>
</table>
<p><br />
</p>
<table border="1" cellpadding="3">
  <tr>
    <td><table width="100%" border="0" cellpadding="7" cellspacing="0">
      <tr>
        <td width="18%" align="right" valign="top"><img width="47px" height="60px" src="<?php echo base_url(); ?>/assets/images/ksb-header.png" /></td>
        <td width="82%" align="center" valign="top"><b> <font size="8px"> PEMERINTAH DESA <?php echo $data_desa->desa ?> KECAMATAN <?php echo $data_desa->kecamatan ?><br />
          <?php echo $data_desa->kota; ?> </font> <font size="12px"> <br />
            ANGGARAN PENDAPATAN BELANJA DESA<br />
          </font> <font size="10px"> TAHUN ANGGARAN <?php echo $tahun; ?></font></b></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="3" class="cetak">
 <thead>
  <tr>
    <th width="15%" align="center" valign="middle" class="double"><br />
      <br />
      NO.  URUT</th>
    <th width="62%" align="center" valign="middle" class="double"><br />
      <br />
      URAIAN</th>
    <th width="12%" align="center" valign="middle" class="double"><br />
      ANGGARAN<br>
      (RP)</th>
    <th width="11%" align="center" valign="middle" class="double"><br />
      <br />
      KET.</th>
  </tr>
  <tr>
    <th class="full-border">1</th>
    <th class="full-border">2</th>
    <th class="full-border">4</th>
    <th class="full-border">5</th>
  </tr>
  </thead>
  
  
  
 <?php 
  $sisa_sebelumnya =0; $sisa_sekarang = 0 ;
  /// PENDAPATAN 
  // subtotal2($id,$tb_name,$kolom,$tahun,$id_desa) 
    foreach($rec_pendapatan->result() as $row_pendapatan) : 
  
  $jumlah_sekarang = $row_pendapatan->total;
  if( $row_pendapatan->has_child == "1" ) {
    $class = "tebal";
   
  }
  else { 
  $class="";
  
  

   //$sisa_sebelumnya  += $jumlah_sebelumnya;
   $sisa_sekarang    += $jumlah_sekarang ;
  }
   
  ?>

  <tr>
    <td  width="15%"    class="kiri-kanan  <?php echo $class ?>"><?php echo $row_pendapatan->kode; ?></td>
    <td  width="62%"  class="kiri-kanan <?php echo $class ?>"><?php echo spasi($row_pendapatan->kode). $row_pendapatan->nama; ?></td>
    <td  width="12%"   align="right" class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($jumlah_sekarang); //($jumlah_sekarang>0)?rupiah($jumlah_sekarang):""; ?></td>
    <td  width="11%"   class="kiri-kanan <?php echo $class ?>"><?php //echo rupiah($sisa_sekarang);?>< </td>
  </tr>
   <?php endforeach; ?>

 <tr>
    <td class="<?php echo $class ?>">&nbsp;</td>
    <td class="<?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
  </tr>


   <?php 
  //// BELANJA 
  // subtotal2($id,$tb_name,$kolom,$tahun,$id_desa) 
    foreach($rec_belanja->result() as $row_belanja) : 
  
  $jumlah_sekarang =  $row_belanja->total;
  if( $row_belanja->has_child =="1" ) {
    $class = "tebal";
    

  }
  else{ $class="";
    
    
     
     $sisa_sekarang    -= $jumlah_sekarang ;
  }
  ?>
  <tr>
    <td class=" <?php echo $class ?>"><?php echo $row_belanja->kode; ?></td>
    <td class=" <?php echo $class ?>"><?php echo spasi($row_belanja->kode). $row_belanja->nama; ?></td>
    <td align="right" class="<?php echo $class ?>"><?php echo rupiah($jumlah_sekarang);// ($jumlah_sekarang>0)?rupiah($jumlah_sekarang):""; ?></td>
    <td class="<?php echo $class ?>"><?php //echo rupiah($sisa_sekarang);?></td>
  </tr>
  
  <?php endforeach; ?>
  
  
  
  <tr>
    <td class="<?php echo $class ?>">&nbsp;</td>
    <td class="<?php echo $class ?>">&nbsp;</td>
    <td class="<?php echo $class ?>">&nbsp;</td>
    <td class="<?php echo $class ?>">&nbsp;</td>
  </tr>

  <tr>
  <td class="tebal <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="tebal kiri-kanan <?php echo $class ?>"> SURPLUS/(DEFISIT) </td>
    <td align="right" class="tebal kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($sisa_sekarang); ?></td>
    <td class="tebal kiri-kanan <?php echo $class ?>">&nbsp;</td>
  </tr>
   <tr>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
  </tr>

<?php 

  
  /// bembiayaan 
  // subtotal2($id,$tb_name,$kolom,$tahun,$id_desa) 
  $nnn = 0 ;
    foreach($rec_pembiayaan->result() as $row_pembiayaan) : 
  $nnn++;
  	$jumlah_sekarang   = $row_pembiayaan->total;
  if( $row_pembiayaan->has_child == 1 ) {
    $class = "tebal";
	}
  else {
  $class="";
  $jumlah_sekarang = $row_pembiayaan->total; 
  }
  $total_masuk = 0 ;  $total_keluar = 0;
  
  /*if($row_pembiayaan->id=="3_1") {
  	$total_masuk = $row_pembiayaan->total;
	//echo "id 31".$row_pembiayaan->id;
  }
  if($row_pembiayaan->id=="3_2") {
  	$total_keluar = $row_pembiayaan->total;
	//echo "id 32".$row_pembiayaan->id;
  }
  echo "total keluar $total_keluar <br />";
   echo "total masuk $total_masuk <br />";
  $netto = $total_masuk  - $total_keluar;*/
  ?>
  <tr>
    <td class="kiri-kanan  <?php echo $class ?>"><?php echo $row_pembiayaan->kode; ?></td>
    <td class="kiri-kanan  <?php echo $class ?>"><?php echo spasi($row_pembiayaan->kode). $row_pembiayaan->nama  ?></td>
    <td align="right" class="kiri-kanan kanan <?php echo $class ?>"><span class="<?php echo $class ?>"><?php  echo (strlen($row_pembiayaan->kode)==1)?"":rupiah($jumlah_sekarang); ?></span></td>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
  </tr>  <?php endforeach; ?>
  <tr>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
  </tr>
  <?php 
 
  $masuk = $this->add->get_total_by_id("pembiayaan","total","3_1",$this->id_desa,$this->tahun);
  $keluar = $this->add->get_total_by_id("pembiayaan","total","3_2",$this->id_desa,$this->tahun);
  $netto = $masuk- $keluar;
  
  $sisa_sekarang = $sisa_sekarang + $netto;
   if($nnn > 0) { 
  ?>
  
  <tr>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="tebal"><strong>PEMBIAYAAN NETTO</strong></td>
    <td align="right" class="tebal"><?php 
  echo  ($netto ==0)?"":rupiah($netto);
  //echo rupiah($netto); 
  
  ?></td>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
  </tr>
  <?php } ?>
  <tr>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="tebal">SISA LEBIH PEMBIAYAAN ANGGARAN TAHUN BERKENAAN </td>
    <td align="right" class="tebal"><?php echo rupiah($sisa_sekarang); ?></td>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
  </tr>
  

  </table>
