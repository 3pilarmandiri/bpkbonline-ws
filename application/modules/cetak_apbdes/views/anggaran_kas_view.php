<?php 
  $tahun=$this->session->userdata("tahun_anggaran");
  $tahun_sebelum = $tahun - 1;
  $id_desa  = $this->session->userdata("id_desa");
  $data_desa = $this->cm->data_desa();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rencana</title>
</head>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/test_print.css" /> 
 
<body onLoad="//window.print();">
<table width="100%" class="cetak"  >
  <tr>
    <td class="full-border" colspan="5"><table width="100%" border="0">
      <tr>
        <td width="14%" align="center" valign="top"><img src="<?php echo base_url(); ?>/assets/images/ksb-header.png" /></td>
        <td width="86%" align="center" valign="top"><h3>PEMERINTAH DESA <?php echo $data_desa->desa ?> KECAMATAN  <?php echo $data_desa->kecamatan ?> </h3>          <h2><?php echo $data_desa->kota; ?> </h3> <h2>ANGGARAN KAS </h2>
          <h4>TAHUN ANGGARAN <?php echo $tahun; ?> </h4></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%"  class="cetak">
 <thead>
  <tr>
    <th width="8%" rowspan="2" class="full-border">NOMOR URUT</th>
    <th width="42%" rowspan="2" class="full-border">URAIAN</th>
    <th width="11%" rowspan="2" class="full-border">PAGU <br>
      ANGGARAN</th>
    <th colspan="5" class="full-border">TRIWULAN N</th>
    </tr>
  <tr>
    <th width="7%" class="full-border">I</th>
    <th width="8%" class="full-border">II</th>
    <th width="8%" class="full-border">III</th>
    <th width="8%" class="full-border">IV</th>
    <th width="8%" class="full-border">KET</th>
  </tr>
  <tr>
    <th class="full-border">1</th>
    <th class="full-border">2</th>
    <th class="full-border">3</th>
    <th class="full-border">4</th>
    <th class="full-border">5</th>
    <th class="full-border">6</th>
    <th class="full-border">7</th>
    <th class="full-border">8</th>
  </tr>
  </thead>

 <?php 
  $sisa = 0;
  /// PENDAPATAN 
  // subtotal2($id,$tb_name,$kolom,$tahun,$id_desa) 
    foreach($rec_penjabaran_pendapatan->result() as $row_pendapatan) : 
    
  if( $row_pendapatan->has_child  == 1 ) {
    $class = "tebal";
	$pagu = $this->add->subtotal2($row_pendapatan->id,"v_pendapatan","total",$tahun,$id_desa) ;
	$t1 = $this->add->subtotal_tw($row_pendapatan->id,"v_pendapatan","t1",$tahun,$id_desa) ;
	$t2 = $this->add->subtotal_tw($row_pendapatan->id,"v_pendapatan","t2",$tahun,$id_desa) ;
	$t3 = $this->add->subtotal_tw($row_pendapatan->id,"v_pendapatan","t3",$tahun,$id_desa) ;
	$t4 = $this->add->subtotal_tw($row_pendapatan->id,"v_pendapatan","t4",$tahun,$id_desa) ;
	//subtotal_tw
  }
  else { 
  $class="";
    $pagu = $row_pendapatan->total;
   	 $t1 = $row_pendapatan->t1;
	 $t2 = $row_pendapatan->t2;
	 $t3 = $row_pendapatan->t3;
	 $t4 = $row_pendapatan->t4;
	 
	 $sisa += $pagu;
  }
  
  ?>

  <tr>
    <td class="kiri-kanan  <?php echo $class ?>"><?php echo $row_pendapatan->kode; ?></td>
    <td class="kiri-kanan <?php echo $class ?>"><?php echo spasi($row_pendapatan->kode). $row_pendapatan->nama; ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($pagu); ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t1); ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t2); ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t3); ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t4); ?></td>
    <td class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
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
    
  if( $row_belanja->has_child  == 1 ) {
    $class = "tebal";
	$pagu = $this->add->subtotal2($row_belanja->id,"v_belanja","total",$tahun,$id_desa) ;
	$t1 = $this->add->subtotal_tw($row_belanja->id,"v_belanja","t1",$tahun,$id_desa) ;
	$t2 = $this->add->subtotal_tw($row_belanja->id,"v_belanja","t2",$tahun,$id_desa) ;
	$t3 = $this->add->subtotal_tw($row_belanja->id,"v_belanja","t3",$tahun,$id_desa) ;
	$t4 = $this->add->subtotal_tw($row_belanja->id,"v_belanja","t4",$tahun,$id_desa) ;
	//subtotal_tw
  }
  else { 
  $class="";
    $pagu = $row_belanja->total;
   	 $t1 = $row_belanja->t1;
	 $t2 = $row_belanja->t2;
	 $t3 = $row_belanja->t3;
	 $t4 = $row_belanja->t4;
	 $sisa -= $pagu;
  }
  ?>
   <tr>
    <td class="kiri-kanan  <?php echo $class ?>"><?php echo $row_belanja->kode; ?></td>
    <td class="kiri-kanan <?php echo $class ?>"><?php echo spasi($row_belanja->kode). $row_belanja->nama; ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($pagu); ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t1); ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t2); ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t3); ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t4); ?></td>
    <td class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
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
    <td class="tebal kiri-kanan <?php echo $class ?>">Surplus (Defisit) </td>
    <td class="tebal kiri-kanan kanan <?php echo $class ?>"> <?php echo rupiah($sisa); ?> </td>
    <td class="tebal kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="tebal kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="tebal kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="tebal kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="tebal kiri-kanan <?php echo $class ?>">&nbsp;</td>
    </tr>
  
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
   foreach($rec_penjabaran_pembiayaan->result() as $row_pembiayaan) : 
    
  if( $row_pembiayaan->has_child  == 1 ) {
    $class = "tebal";
	$pagu = $this->add->subtotal2($row_pembiayaan->id,"v_pembiayaan","total",$tahun,$id_desa) ;
	$t1 = $this->add->subtotal_tw($row_pembiayaan->id,"v_pembiayaan","t1",$tahun,$id_desa) ;
	$t2 = $this->add->subtotal_tw($row_pembiayaan->id,"v_pembiayaan","t2",$tahun,$id_desa) ;
	$t3 = $this->add->subtotal_tw($row_pembiayaan->id,"v_pembiayaan","t3",$tahun,$id_desa) ;
	$t4 = $this->add->subtotal_tw($row_pembiayaan->id,"v_pembiayaan","t4",$tahun,$id_desa) ;
	//subtotal_tw
  }
  else { 
  $class="";
    $pagu = $row_pembiayaan->total;
   	 $t1 = $row_pembiayaan->t1;
	 $t2 = $row_pembiayaan->t2;
	 $t3 = $row_pembiayaan->t3;
	 $t4 = $row_pembiayaan->t4;
  }
  ?>
    <tr>
    <td class="kiri-kanan  <?php echo $class ?>"><?php echo $row_pembiayaan->kode; ?></td>
    <td class="kiri-kanan <?php echo $class ?>"><?php echo spasi($row_pembiayaan->kode). $row_pembiayaan->nama; ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($pagu); ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t1); ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t2); ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t3); ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($t4); ?></td>
    <td class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
  </tr>
  
  <?php endforeach; ?>





</table>

 
<div class="nobreak"> 
<table width="30%" border="0" align="right">
  <tr>
    <td align="center"><?php echo "$data_desa->desa, ". date("d-m-Y");?></td>
  </tr>
  <tr>
    <td align="center">KEPALA DESA </td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><?php echo $data_desa->nama_kepala_desa;?></td>
  </tr>
</table> </div>
</body>

</html>