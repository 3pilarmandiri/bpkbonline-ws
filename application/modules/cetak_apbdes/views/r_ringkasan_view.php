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
        <td width="86%" align="center" valign="top"><h3>PEMERINTAH DESA <?php echo $data_desa->desa ?> KECAMATAN  <?php echo $data_desa->kecamatan ?> </h3>          <h2><?php echo $data_desa->kota; ?> </h3> <h2> ANGGARAN PENDAPATAN BELANJA DESA (RAPBDes)</h2>
          <h4>TAHUN ANGGARAN <?php echo $tahun; ?> </h4></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%"  class="cetak">
 <thead>
  <tr>
    <th width="7%" class="full-border">NOMOR URUT</th>
    <th width="46%" class="full-border">URAIAN</th>
    <th width="17%" class="full-border">TAHUN SEBELUMNYA <br>
      (RP)</th>
    <th width="16%" class="full-border">TAHUN BERJALAN <br>
      (RP)</th>
    <th width="14%" class="full-border">KETERANGAN</th>
  </tr>
  <tr>
    <th class="full-border">1</th>
    <th class="full-border">2</th>
    <th class="full-border">3</th>
    <th class="full-border">4</th>
    <th class="full-border">5</th>
  </tr>
  </thead>

 <?php 
  $sisa_sebelumnya =0; $sisa_sekarang = 0 ;
  /// PENDAPATAN 
  // subtotal2($id,$tb_name,$kolom,$tahun,$id_desa) 
    foreach($rec_pendapatan->result() as $row_pendapatan) : 
  $jumlah_sebelumnya = $this->add->subtotal2($row_pendapatan->id,"v_pendapatan","total",$tahun_sebelum,$id_desa) ;
  $jumlah_sekarang = $this->add->subtotal2($row_pendapatan->id,"v_pendapatan","total",$tahun,$id_desa) ;
  if( strlen($row_pendapatan->id) <= 2 ) {
    $class = "tebal";
  }
  else { 
  $class="";
   $sisa_sebelumnya  += $jumlah_sebelumnya;
   $sisa_sekarang    += $jumlah_sekarang ;
  }
  
  ?>

  <tr>
    <td class="kiri-kanan  <?php echo $class ?>"><?php echo $row_pendapatan->kode; ?></td>
    <td class="kiri-kanan <?php echo $class ?>"><?php echo spasi($row_pendapatan->kode). $row_pendapatan->nama; ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo ($jumlah_sebelumnya>0)?rupiah($jumlah_sebelumnya):""; ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo ($jumlah_sekarang>0)?rupiah($jumlah_sekarang):""; ?></td>
    <td class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
  </tr>
   <?php endforeach; ?>

 <tr>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
  </tr>


   <?php 
  //// BELANJA 
  // subtotal2($id,$tb_name,$kolom,$tahun,$id_desa) 
    foreach($rec_belanja->result() as $row_belanja) : 
  $jumlah_sebelumnya = $this->add->subtotal2($row_belanja->id,"v_belanja","total",$tahun_sebelum,$id_desa) ;
  $jumlah_sekarang = $this->add->subtotal2($row_belanja->id,"v_belanja","total",$tahun,$id_desa) ;
  if( strlen($row_belanja->id) <= 2 ) {
    $class = "tebal";
  }
  else{ $class="";
     $sisa_sebelumnya  -= $jumlah_sebelumnya;
     $sisa_sekarang    -= $jumlah_sekarang ;
  }
  ?>
  <tr>
    <td class="kiri-kanan <?php echo $class ?>"><?php echo $row_belanja->kode; ?></td>
    <td class="kiri-kanan <?php echo $class ?>"><?php echo spasi($row_belanja->kode). $row_belanja->nama; ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo ($jumlah_sebelumnya>0)?rupiah($jumlah_sebelumnya):""; ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo ($jumlah_sekarang>0)?rupiah($jumlah_sekarang):""; ?></td>
    <td class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
  </tr>
  
  <?php endforeach; ?>
    <tr>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
  </tr>

  <td class="tebal kiri-kanan <?php echo $class ?>">&nbsp;</td>
    <td class="tebal kiri-kanan <?php echo $class ?>">Surplus (Defisit) </td>
    <td class="tebal kiri-kanan kanan <?php echo $class ?>"><?php echo ($sisa_sebelumnya==0)?"":rupiah($sisa_sebelumnya); ?></td>
    <td class="tebal kiri-kanan kanan <?php echo $class ?>"><?php echo rupiah($sisa_sekarang); ?></td>
    <td class="tebal kiri-kanan <?php echo $class ?>">&nbsp;</td>
  
   <tr>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan kanan <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan <?php echo $class ?>">&nbsp;</td>
  </tr>

  <?php 
  
  /// bembiayaan 
  // subtotal2($id,$tb_name,$kolom,$tahun,$id_desa) 
    foreach($rec_pembiayaan->result() as $row_pembiayaan) : 
  if( strlen($row_pembiayaan->id) <= 2 ) {
    $class = "tebal";
  }
  else $class="";
  $jumlah_sebelumnya = $this->add->subtotal2($row_pembiayaan->id,"v_pembiayaan","total",$tahun_sebelum,$id_desa) ;
  $jumlah_sekarang = $this->add->subtotal2($row_pembiayaan->id,"v_pembiayaan","total",$tahun,$id_desa) ;
  ?>
  <tr>
    <td class="kiri-kanan  <?php echo $class ?>"><?php echo $row_pembiayaan->kode; ?></td>
    <td class="kiri-kanan  <?php echo $class ?>"><?php echo spasi($row_pembiayaan->kode). $row_pembiayaan->nama; ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo ($jumlah_sebelumnya>0)?rupiah($jumlah_sebelumnya):""; ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>"><?php echo ($jumlah_sekarang>0)?rupiah($jumlah_sekarang):""; ?></td>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
  </tr>
  
  <?php endforeach; ?>

</table>

<p>&nbsp;</p>
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
</table>
</body>

</html>