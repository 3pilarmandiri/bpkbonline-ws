<?php 
  $tahun=$this->session->userdata("tahun_anggaran");
  $tahun_sebelum = $tahun - 1;
  $id_desa  = $this->session->userdata("id_desa");
  $data_desa = $this->cm->data_desa();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/test_print.css" /> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jseasyui/jquery-1.8.0.min.js"></script>
<title>RANCANGAN PENJABARAN</title>
</head>

<script type="text/javascript">
  $(document).ready(function(){
   // $(".full-border:last-child, .kiri-kanan:last-child").addClass('last');
    $(".full-border:last-child, .kiri-kanan:last-child").addClass('last');
  });

</script>

<body>
<table width="100%" class="cetak"  >
  <tr>
    <td class="full-border" colspan="5"><table width="100%" border="0">
      <tr>
        <td width="14%" align="center" valign="top"><img src="<?php echo base_url(); ?>/assets/images/ksb-header.png" /></td>
        <td width="86%" align="center" valign="top"><h3>PEMERINTAH DESA <?php echo $data_desa->desa ?> KECAMATAN  <?php echo $data_desa->kecamatan ?> </h3>          <h2><?php echo $data_desa->kota; ?> </h3> <h2>PENJABARAN  ANGGARAN PENDAPATAN BELANJA DESA</h2>
          <h4>TAHUN ANGGARAN <?php echo $tahun; ?> </h4></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php 
$class = "";
?>
<table width="100%" border="0" class="cetak">
<thead>
  <tr>
    <th class="full-border" width="9%" scope="col">KODE REKENING</th>
    <th class="full-border" width="45%" scope="col">URAIAN </th>
    <th class="full-border" width="8%" scope="col">JUMLAH</th>
    <th class="full-border" width="38%" scope="col">KETERANGAN</th>
  </tr>
  <tr>
    <th class="full-border" scope="col">1</th>
    <th class="full-border" scope="col">2</th>
    <th class="full-border" scope="col">3</th>
    <th class="full-border" scope="col">4</th>
  </tr>
   </thead>
  <?php 
  foreach($rec_penjabaran_pendapatan->result() as $pendapatan) : 
  if($pendapatan->has_child == 1) {
    $class  = "tebal";
  $jumlah = $this->add->subtotal2($pendapatan->id,"v_pendapatan","total",$tahun,$id_desa);
  }
  else {
    $class = "";
  $jumlah = $pendapatan->total;
  }
  ?>
    <tr>
    <td class="kiri-kanan  <?php echo $class ?>"  ><?php echo $pendapatan->kode; ?></td>
    <td class="kiri-kanan  <?php echo $class ?>"  ><?php echo spasi($pendapatan->kode).$pendapatan->nama; ?></td>
    <td class="kanan kiri-kanan  <?php echo $class ?>"  ><?php echo rupiah($jumlah); ?></td>
    <td class="kiri-kanan  <?php echo $class ?>"  >
    <?php
     $rec_detail = $this->dm->get_rec_detail("v_pendapatan_detail", "id_pendapatan", $pendapatan->id_pendapatan);
      echo "<br />"; 
      echo ($pendapatan->has_child == 0)?$pendapatan->nama."<br />":"";

      foreach($rec_detail->result() as $detail ) : 

       // echo "<pre>"; print_r($detail); echo "</pre>";
        echo $detail->uraian . " ". $detail->vol1. " ".$detail->satuan1." " ; 
         
        echo (!empty($detail->vol2))?"x".$detail->vol2. " ".$detail->satuan2:" "; 
        echo $detail->vol3. " ".$detail->satuan3." "; 
        echo "x ".rupiah($detail->harga)." = ".rupiah($detail->total). "<br />";  
      endforeach;
    ?>
    </td>
  </tr>
  <?php endforeach; ?>
   <tr>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
  </tr>

   <?php 
  foreach($rec_penjabaran_belanja->result() as $belanja) : 
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
    <td class="kiri-kanan  <?php echo $class ?>"  ><?php echo $belanja->kode; ?></td>
    <td class="kiri-kanan  <?php echo $class ?>"  ><?php echo spasi($belanja->kode).$belanja->nama; ?></td>
    <td class="kanan kiri-kanan  <?php echo $class ?>"  ><?php echo rupiah($jumlah); ?></td>
    <td class="kiri-kanan  <?php echo $class ?>"  >
    <?php
     $rec_detail = $this->dm->get_rec_detail("v_belanja_detail", "id_belanja", $belanja->id_belanja);
      echo "<br />"; 
      
      echo ($belanja->has_child == 0)?"Sumber Dana : $belanja->sumber_dana <br />":"";
      echo ($belanja->has_child == 0)?$belanja->nama."<br />":"";

      foreach($rec_detail->result() as $detail ) : 
        
       // echo "<pre>"; print_r($detail); echo "</pre>";
        echo $detail->uraian . " ". $detail->vol1. " ".$detail->satuan1." " ; 
         
        echo (!empty($detail->vol2))?"x".$detail->vol2. " ".$detail->satuan2:" "; 
        echo $detail->vol3. " ".$detail->satuan3." "; 
        echo "x ".rupiah($detail->harga)." = ".rupiah($detail->total). "<br />";  
      endforeach;
    ?>
    </td>
  </tr>
   <?php endforeach; ?>

    <tr>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
  </tr>

 
 <?php 
  foreach($rec_penjabaran_pembiayaan->result() as $pembiayaan) : 
  if($pembiayaan->has_child == 1) {
    $class  = "tebal";
  $jumlah = $this->add->subtotal2($pembiayaan->id,"v_pembiayaan","total",$tahun,$id_desa);
  }
  else {
    $class = "";
  $jumlah = $pembiayaan->total;
  }
  ?>

  <tr>
    <td class="kiri-kanan  <?php echo $class ?>"  ><?php echo $pembiayaan->kode; ?></td>
    <td class="kiri-kanan  <?php echo $class ?>"  ><?php echo spasi($pembiayaan->kode).$pembiayaan->nama; ?></td>
    <td class="kanan kiri-kanan  <?php echo $class ?>"  ><?php echo rupiah($jumlah); ?></td>
    <td class="kiri-kanan  <?php echo $class ?>"  >
    <?php
     $rec_detail = $this->dm->get_rec_detail("v_pembiayaan_detail", "id_pembiayaan", $pembiayaan->id_pembiayaan);
      echo "<br />"; 
      echo ($pembiayaan->has_child == 0)?$pembiayaan->nama."<br />":"";

      foreach($rec_detail->result() as $detail ) : 

       // echo "<pre>"; print_r($detail); echo "</pre>";
        echo $detail->uraian . " ". $detail->vol1. " ".$detail->satuan1." " ; 
         
        echo (!empty($detail->vol2))?"x".$detail->vol2. " ".$detail->satuan2:" "; 
        echo $detail->vol3. " ".$detail->satuan3." "; 
        echo "x ".rupiah($detail->harga)." = ".rupiah($detail->total). "<br />";  
      endforeach;
    ?>
    </td>
  </tr>
   <?php endforeach; ?>


</table>
<br />
<br />
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