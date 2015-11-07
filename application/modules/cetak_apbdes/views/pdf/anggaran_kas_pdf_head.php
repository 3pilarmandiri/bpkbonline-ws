<?php 
  $tahun=$this->session->userdata("tahun_anggaran");
  $tahun_sebelum = $tahun - 1;
  $id_desa  = $this->session->userdata("id_desa");
  $data_desa = $this->cm->data_desa();
?>
<style>
* {
  font-size: 10px;
  font-family:  verdana;
}
.full-border {
  border  : #000 solid 1px;
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

<table width="100%" border="1" cellpadding="3">
  <tr>
    <td><table width="100%" border="0" cellpadding="7" cellspacing="0">
      <tr>
        <td width="18%" align="right" valign="top"><img width="47px" height="60px" src="<?php echo base_url(); ?>/assets/images/ksb-header.png" /></td>
        <td width="82%" align="center" valign="top"><b> <font size="10px"> PEMERINTAH DESA <?php echo $data_desa->desa ?> KECAMATAN <?php echo $data_desa->kecamatan ?><br />
          <?php echo $data_desa->kota; ?> </font> <font size="14px"> <br />
            ANGGARAN KAS<br />
          </font> <font size="10px"> TAHUN ANGGARAN <?php echo $tahun; ?></font></b></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" class="cetak">
 <thead>
  <tr>
    <th width="7%" rowspan="2" align="center" valign="middle" scope="col"><strong>NOMOR URUT</strong></th>
    <th width="43%" rowspan="2" align="center" valign="middle" scope="col"><strong>URAIAN</strong></th>
    <th width="10%" rowspan="2" align="center" valign="middle" scope="col"><strong>PAGU ANGGARAN</strong></th>
    <th  width="40%"  colspan="5" align="center" valign="middle" scope="col"><strong>TRIWULAN</strong></th>
  </tr>
  <tr>
    <th width="9%" align="center" valign="middle" scope="col"><strong>I</strong></th>
    <th width="9%" align="center" valign="middle" scope="col"><strong>II</strong></th>
    <th width="9%" align="center" valign="middle" scope="col"><strong>III</strong></th>
    <th width="9%" align="center" valign="middle" scope="col"><strong>IV</strong></th>
    <th width="4%" align="center" valign="middle" scope="col"><strong>KET</strong></th>
  </tr>
  <tr>
    <th align="center" valign="middle" scope="col"><strong>1</strong></th>
    <th align="center" valign="middle" scope="col"><strong>2</strong></th>
    <th align="center" valign="middle" scope="col"><strong>3</strong></th>
    <th align="center" valign="middle" scope="col"><strong>4</strong></th>
    <th align="center" valign="middle" scope="col"><strong>5</strong></th>
    <th align="center" valign="middle" scope="col"><strong>6</strong></th>
    <th align="center" valign="middle" scope="col"><strong>7</strong></th>
    <th align="center" valign="middle" scope="col"><strong>8</strong></th>
  </tr>
  </thead>
  <tbody>

   <?php 
  $sisa = 0;
  /// PENDAPATAN 
  // subtotal2($id,$tb_name,$kolom,$tahun,$id_desa) 
    foreach($rec_penjabaran_pendapatan->result() as $row_pendapatan) : 
     $pagu = $row_pendapatan->total;
   	 $t1 = $row_pendapatan->t1;
	 $t2 = $row_pendapatan->t2;
	 $t3 = $row_pendapatan->t3;
	 $t4 = $row_pendapatan->t4;
	 
  if( $row_pendapatan->has_child  == 1 ) {
    $class = "tebal";
	
	//subtotal_tw
  }
  else { 
  $class="";
    
	 $sisa += $pagu;
  }
  
  ?>
  <tr>
    <td width="7%" class="kiri-kanan  <?php echo $class ?>"><?php echo $row_pendapatan->kode; ?></td>
    <td width="43%" class="kiri-kanan <?php echo $class ?>"><?php echo spasi($row_pendapatan->kode). $row_pendapatan->nama; ?></td>
    <td width="10%" align="right" class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($pagu); ?></td>
    <td width="9%" align="right" class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t1); ?></td>
    <td width="9%" align="right" class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t2); ?></td>
    <td width="9%" align="right" class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t3); ?></td>
    <td width="9%" align="right" class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t4); ?></td>
    <td width="4%" align="right" class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
  </tr>
   <?php endforeach; ?>
  
  
  <tr>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
  </tr>


   <?php 
   /// belanja 
  
    foreach($rec_penjabaran_belanja->result() as $row_belanja) : 
    $pagu = $row_belanja->total;
   	 $t1 = $row_belanja->t1;
	 $t2 = $row_belanja->t2;
	 $t3 = $row_belanja->t3;
	 $t4 = $row_belanja->t4;
	
  if( $row_belanja->has_child  == 1 ) {
    $class = "tebal";
	
	//subtotal_tw
  }
  else { 
  $class="";
   $sisa -= $pagu;
    
  }
  ?>
   <tr>
    <td class="kiri-kanan  <?php echo $class ?>"><?php echo $row_belanja->kode; ?></td>
    <td class="kiri-kanan <?php echo $class ?>"><?php echo spasi($row_belanja->kode). $row_belanja->nama; ?></td>
    <td align="right" class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($pagu); ?></td>
    <td align="right" class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t1); ?></td>
    <td align="right" class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t2); ?></td>
    <td align="right" class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t3); ?></td>
    <td align="right" class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t4); ?></td>
    <td align="right" class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
  </tr>
  
  <?php endforeach; ?>
  
    <tr>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
  </tr>
  
  <tr>
    <td class="tebal kiri-kanan <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="tebal kiri-kanan <?php echo $class ?>">SURPLUS/(DEFISIT)</td>
    <td align="right" class="tebal kiri-kanan kanan <?php echo $class ?>"> 
	<?php echo rupiah($sisa); 
	/*($sisa>=0)?rupiah($sisa):"(".rupiah($sisa).")"; */
	?> </td>
    <td align="right" class="tebal kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="tebal kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="tebal kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="tebal kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="tebal kiri-kanan <?php echo $class ?>">&nbsp;</td>
  </tr>
  
   <tr>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
  </tr>
  
  
  <?php 
   foreach($rec_penjabaran_pembiayaan->result() as $row_pembiayaan) : 
    $pagu = $row_pembiayaan->total;
   	 $t1 = $row_pembiayaan->t1;
	 $t2 = $row_pembiayaan->t2;
	 $t3 = $row_pembiayaan->t3;
	 $t4 = $row_pembiayaan->t4;
  if( $row_pembiayaan->has_child  == 1 ) {
    $class = "tebal";
	 
	//subtotal_tw
  }
  else { 
  $class="";
    
  }
  ?>
    <tr>
    <td class="kiri-kanan  <?php echo $class ?>"><?php echo $row_pembiayaan->kode; ?></td>
    <td class="kiri-kanan <?php echo $class ?>"><?php echo spasi($row_pembiayaan->kode). $row_pembiayaan->nama; ?></td>
    <td align="right" class="kiri-kanan kanan <?php echo $class ?>"><?php if(strlen($row_pembiayaan->id) == 1 ) echo ""; else { echo ($pagu>0)?rupiah($pagu):""; }  ?></td>
    <td align="right" class="kiri-kanan kanan <?php echo $class ?>">
	<?php if(strlen($row_pembiayaan->id) == 1 ) echo ""; else { echo ($t1>0)?rupiah($t1):""; }  ?></td>
    <td align="right" class="kiri-kanan kanan <?php echo $class ?>"><?php if(strlen($row_pembiayaan->id) == 1 ) echo ""; else { echo ($t2>0)?rupiah($t2):""; }  ?></td>
    <td align="right" class="kiri-kanan kanan <?php echo $class ?>"
    ><?php if(strlen($row_pembiayaan->id) == 1 ) echo ""; else { echo ($t3>0)?rupiah($t3):""; }  ?></td>
    <td align="right" class="kiri-kanan kanan <?php echo $class ?>"><?php if(strlen($row_pembiayaan->id) == 1 ) echo ""; else { echo ($t4>0)?rupiah($t4):""; }  ?></td>
    <td align="right" class="kiri-kanan <?php echo $class ?>"></td>
  </tr>
  
    <?php endforeach; ?>
    
    <?php 
	$biaya_terima = $this->add->get_total_by_id("pembiayaan","total","3_1",$this->id_desa,$this->tahun);
	$biaya_keluar = $this->add->get_total_by_id("pembiayaan","total","3_2",$this->id_desa,$this->tahun);
	$netto = $biaya_terima - $biaya_keluar;
	$sisa_sekarang = $sisa + $netto;
	?>
    <tr>
      <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
      <td align="right" class="kiri-kanan <?php echo $class ?>"><strong>PEMBIAYAAN NETTO</strong></td>
      <td align="right" class="kiri-kanan kanan <?php echo $class ?>"><strong><?php echo rupiah($netto); ?></strong></td>
      <td align="right" class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
      <td align="right" class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
      <td align="right" class="kiri-kanan kanan <?php echo $class ?>"
    >&nbsp;</td>
      <td align="right" class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
      <td align="right" class="kiri-kanan <?php echo $class ?>"></td>
    </tr>
    <tr>
      <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
      <td align="right" class="kiri-kanan <?php echo $class ?>"><strong>SISA LEBIH PEMBIAYAAN ANGGARAN TAHUN BERKENAAN </strong></td>
      <td align="right" class="kiri-kanan kanan <?php echo $class ?>"><strong><?php echo rupiah($sisa_sekarang); ?></strong></td>
      <td align="right" class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
      <td align="right" class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
      <td align="right" class="kiri-kanan kanan <?php echo $class ?>"
    >&nbsp;</td>
      <td align="right" class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
      <td align="right" class="kiri-kanan <?php echo $class ?>"></td>
    </tr>
  
</tbody>
  
</table>
<p>&nbsp;</p>
