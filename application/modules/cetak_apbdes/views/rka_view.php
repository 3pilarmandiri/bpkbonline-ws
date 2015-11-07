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
<title>Dokumen Pelaksanaan Anggaran</title>
</head>
 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/test_print.css" /> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/jseasyui/jquery-1.8.0.min.js"></script>
<style>
.boxtengah {
	margin:0px; auto;
	width:100%;
 	text-align:center;
}
.judul {
	font-size:24px;
	font-weight:bold;
}

.desa td {
	font-size:12px;
	font-weight:bold;
	text-transform:uppercase;
}
</style>
<body>
<div class="boxtengah">
  <p><br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
  <img src="<?php echo base_url(); ?>/assets/images/ksb-header.png" /></p>
  <h3>PEMERINTAH <?php echo $data_desa->kota; ?></h3>
  <h2>RENCANA KERJA ANGGARAN</h2>
  <h3>PEMERINTAH DESA <?php echo $data_desa->desa ?> KECAMATAN  <?php echo $data_desa->kecamatan ?></h3>
  <h3>TAHUN ANGGARAN <?php echo $tahun; ?> </h3>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p class="judul">&nbsp;  </p>
</div>
<div class="pagebreak"></div>
<table width="100%" class="cetak"  >
  <tr>
    <td class="full-border" colspan="5"><table width="100%" border="0">
      <tr>
        <td width="14%" align="center" valign="top"><img src="<?php echo base_url(); ?>/assets/images/ksb-header.png" /></td>
        <td width="86%" align="center" valign="top"><h3>RENCANA KERJA DAN ANGGARAN DESA </h3>
          <h2>&nbsp;</h2></td>
      </tr>
      
    </table></td>
  </tr>
  <tr>
        <td colspan="2" align="center" valign="top" class="full-border"><h2>PEMERINTAH <?php echo $data_desa->kota; ?></h2>
        <h4>TAHUN ANGGARAN <?php echo $tahun; ?></h4></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" clas><table width="50%" border="0">
      <tr>
        <td width="31%" class="tebal">KECAMATAN</td>
        <td width="2%" class="tebal">:</td>
        <td width="67%" class="tebal"><?php echo $data_desa->kecamatan; ?></td>
      </tr>
      <tr>
        <td class="tebal">DESA</td>
        <td class="tebal">:</td>
        <td class="tebal"><?php echo $data_desa->desa; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="full-border"><h4>RINCIAN   ANGGARAN PENDAPATAN DESA </h4></td>
  </tr>

</table>
<table width="100%" border="0" class="cetak">
<thead>
  <tr>
    <th class="full-border" width="9%" rowspan="2" scope="col">KODE REKENING</th>
    <th class="full-border" width="48%" rowspan="2" scope="col">URAIAN</th>
    <th class="full-border" colspan="3" scope="col">RICIAN PERHITUNGAN</th>
    <th class="full-border" width="14%" rowspan="2" scope="col">JUMLAH<br />
      (Rp)</th>
  </tr>
  <tr>
    <th class="full-border" width="7%" scope="col">VOLUME</th>
    <th class="full-border" width="8%" scope="col">SATUAN</th>
    <th class="full-border" width="14%" scope="col">TARIF/HARGA</th>
  </tr>
  <tr>
    <th class="full-border" scope="col">1</th>
    <th class="full-border" scope="col">2</th>
    <th class="full-border" scope="col">3</th>
    <th class="full-border" scope="col">4</th>
    <th class="full-border" scope="col">5</th>
    <th class="full-border" scope="col">6 = 3 x 5</th>
  </tr>
  </thead>
  
    <?php 
   $class = "";
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
    <td class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo $pendapatan->kode; ?></td>
    <td class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo spasi($pendapatan->kode).$pendapatan->nama; ?></td>
    <td class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo ($pendapatan->has_child==0)?"1":""; ?></td>
    <td class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo ($pendapatan->has_child==0)?"thn":""; ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>" scope="col"><?php echo rupiah($jumlah); ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>" scope="col"><?php echo rupiah($jumlah); ?></td>
  </tr>
  <?php endforeach; ?>
 
</table>
<p>&nbsp;</p> <div class="nobreak">
<table width="100%" border="0" class="cetak">
  <tr>
    <td width="37%" align="center" valign="top" class="tebal full-border">KETERANGAN</td>
    <td width="44%" rowspan="2" align="center" valign="top" class="full-border"><?php echo "$data_desa->desa, ". date("d-m-Y");?><br />
      <br />
      <br />
      <br />
      <br />
      <br />
    <br />
    <u><b><?php echo $data_desa->nama_kepala_desa;?></b></u><br />
    <?php echo $data_desa->nip_kepala_desa;?></td>
  </tr>
  <tr>
    <td valign="top" class="full-border">&nbsp;</td>
  </tr>
</table></div>
<p>&nbsp;</p>
 
 



<!-- BELANJJAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAs -->
<p>&nbsp;</p>
<div class="pagebreak"></div>
<table width="100%" class="cetak"  >
  <tr>
    <td class="full-border" colspan="5"><table width="100%" border="0">
      <tr>
        <td width="14%" align="center" valign="top"><img src="<?php echo base_url(); ?>/assets/images/ksb-header.png" /></td>
        <td width="86%" align="center" valign="top"><h3>RENCANA KERJA DAN ANGGARAN DESA</h3>
          <h2>&nbsp;</h2></td>
      </tr>
      <tr>
        <td align="center" valign="top">&nbsp;</td>
        <td align="center" valign="top">&nbsp;</td>
      </tr>
      
    </table></td>
  </tr>
  <tr>
        <td colspan="2" align="center" valign="top" class="full-border"><h2>PEMERINTAH </h2>
        <h4>TAHUN ANGGARAN <?php echo $tahun; ?></h4></td>
  </tr>
   <tr>
    <td colspan="2" align="left" valign="top" clas><table width="50%" border="0">
      <tr>
        <td width="31%" class="tebal">KECAMATAN</td>
        <td width="2%" class="tebal">:</td>
        <td width="67%" class="tebal"><?php echo $data_desa->kecamatan; ?></td>
      </tr>
      <tr>
        <td class="tebal">DESA</td>
        <td class="tebal">:</td>
        <td class="tebal"><?php echo $data_desa->desa; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="full-border"><h4>RINCIAN  ANGGARAN BELANJA DESA </h4></td>
  </tr>
</table>
<table width="100%" border="0" class="cetak">
<thead>
  <tr>
    <th class="full-border" width="9%" rowspan="2" scope="col">KODE REKENING</th>
    <th class="full-border" width="48%" rowspan="2" scope="col">URAIAN</th>
    <th class="full-border" colspan="3" scope="col">RICIAN PERHITUNGAN</th>
    <th class="full-border" width="14%" rowspan="2" scope="col">JUMLAH<br />
      (Rp)</th>
  </tr>
  <tr>
    <th class="full-border" width="7%" scope="col">VOLUME</th>
    <th class="full-border" width="8%" scope="col">SATUAN</th>
    <th class="full-border" width="14%" scope="col">TARIF/HARGA</th>
  </tr>
  <tr>
    <th class="full-border" scope="col">1</th>
    <th class="full-border" scope="col">2</th>
    <th class="full-border" scope="col">3</th>
    <th class="full-border" scope="col">4</th>
    <th class="full-border" scope="col">5</th>
    <th class="full-border" scope="col">6 = 3 x 6</th>
  </tr>
  </thead>
  
    <?php 
   $class = "";
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
    <td class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo $belanja->kode; ?></td>
    <td class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo spasi($belanja->kode).$belanja->nama; ?></td>
    <td class="kiri-kanan <?php echo $class ?>" scope="col"><?php //echo ($belanja->has_child==0)?"1":""; ?></td>
    <td class="kiri-kanan <?php echo $class ?>" scope="col"><?php //echo ($belanja->has_child==0)?"thn":""; ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>" scope="col"><?php //echo rupiah($jumlah); ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>" scope="col"><?php echo rupiah($jumlah); ?></td>
  </tr>
    <!-- begin of detail belanja  -->
    <?php 

        if($belanja->has_child == 0  ) { // if bukan parent 
        $rec_detail_belanja = $this->dm->get_rec_detail("v_belanja_detail", "id_belanja", $belanja->id_belanja);
          foreach($rec_detail_belanja->result() as $detail_belanja) :  

            $satuan =  $detail_belanja->satuan1 ; 
            $satuan .= (!empty( $detail_belanja->satuan2))?"/". $detail_belanja->satuan2:"";
            $satuan .= (!empty( $detail_belanja->satuan3))?"/". $detail_belanja->satuan3:"";


            // $jumlah = $detail_belanja->vol1;
            // $jumlah = $jumlah *  (!empty($detail_belanja->vol2))?$detail_belanja->vol2:1;
            // $jumlah = $jumlah *  (!empty($detail_belanja->vol3))?$detail_belanja->vol3:1;
            
             $jumlah = $detail_belanja->vol1;
             $j2 = empty($detail_belanja->vol2)?1:$detail_belanja->vol2;
             $j3 = empty($detail_belanja->vol3)?1:$detail_belanja->vol3;
             

             $jj = $jumlah * $j2 * $j3;
            // lah = $jumlah *  (!empty($detail_belanja->vol2))?$detail_belanja->vol2:1;
            //$jumlah = $jumlah *  (!empty($detail_belanja->vol3))?$detail_belanja->vol3:1;
            ?>
            <tr>
            <td class="kiri-kanan <?php echo $class ?>" scope="col"> </td>
            <td class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo spasi($belanja->kode." ").$detail_belanja->uraian; ?></td>
            <td class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo  $jj ?></td>
            <td class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo  $satuan; ?></td>
            <td class="kiri-kanan kanan <?php echo $class ?>" scope="col"><?php echo rupiah($detail_belanja->harga); ?></td>
            <td class="kiri-kanan kanan <?php echo $class ?>" scope="col"><?php echo rupiah($detail_belanja->total); ?></td>
            </tr>
        <?php 
        endforeach;
        } // endif bukan parent 
    ?>
     <!-- end of detail belanja  -->
  <?php endforeach; ?>
 
</table>


<p>&nbsp;</p> <div class="nobreak">
<table width="100%" border="0" class="cetak">
  <tr>
    <td width="37%" align="center" valign="top" class="tebal full-border">KETERANGAN</td>
    <td width="44%" rowspan="2" align="center" valign="top" class="full-border"><?php echo "$data_desa->desa, ". date("d-m-Y");?><br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <u><b><?php echo $data_desa->nama_kepala_desa;?></b></u><br />
      <?php echo $data_desa->nip_kepala_desa;?></td>
  </tr>
  <tr>
    <td valign="top" class="full-border">&nbsp;</td>
  </tr>
</table>
</div>
<!-- BEGIN OF PEMBIAYAAN --> 

<p>&nbsp;</p>
<div class="pagebreak"></div>
<table width="100%" class="cetak"  >
  <tr>
    <td class="full-border" colspan="5"><table width="100%" border="0">
      <tr>
        <td width="14%" align="center" valign="top"><img src="<?php echo base_url(); ?>/assets/images/ksb-header.png" /></td>
        <td width="86%" align="center" valign="top"><h3>RENCANA KERJA DAN ANGGARAN DESA</h3>
          <h2>&nbsp;</h2></td>
      </tr>
      <tr>
        <td align="center" valign="top">&nbsp;</td>
        <td align="center" valign="top">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="full-border"><h2>PEMERINTAH <?php echo $data_desa->kota; ?></h2>
      <h4>TAHUN ANGGARAN <?php echo $tahun; ?></h4></td>
  </tr>
   <tr>
    <td colspan="2" align="left" valign="top" clas><table width="50%" border="0">
      <tr>
        <td width="31%" class="tebal">KECAMATAN</td>
        <td width="2%" class="tebal">:</td>
        <td width="67%" class="tebal"><?php echo $data_desa->kecamatan; ?></td>
      </tr>
      <tr>
        <td class="tebal">DESA</td>
        <td class="tebal">:</td>
        <td class="tebal"><?php echo $data_desa->desa; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" class="full-border"><h4>RINCIAN   PEMBIAYAAN DESA </h4></td>
  </tr>
</table>
<table width="100%" border="0" class="cetak">
  <thead>
    <tr>
      <th class="full-border" width="9%" scope="col">KODE REKENING</th>
      <th class="full-border" width="48%" scope="col">URAIAN</th>
      <th class="full-border" width="14%" scope="col">JUMLAH<br />
        (Rp)</th>
    </tr>
    <tr>
      <th class="full-border" scope="col">1</th>
      <th class="full-border" scope="col">2</th>
      <th class="full-border" scope="col">3</th>
    </tr>
  </thead>
  <?php 
   $class = "";
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
    <td class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo $pembiayaan->kode; ?></td>
    <td class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo spasi($pembiayaan->kode).$pembiayaan->nama; ?></td>
    <td class="kiri-kanan kanan <?php echo $class ?>" scope="col"><?php echo rupiah($jumlah); ?></td>
  </tr>
  
    
    <?php 

        if($pembiayaan->has_child == 0  ) { // if bukan parent 
        $rec_detail_pembiayaan = $this->dm->get_rec_detail("v_pembiayaan_detail", "id_pembiayaan", $pembiayaan->id_pembiayaan);
          foreach($rec_detail_pembiayaan->result() as $detail_pembiayaan) :  

            $satuan =  $detail_pembiayaan->satuan1 ; 
            $satuan .= (!empty( $detail_pembiayaan->satuan2))?"/". $detail_pembiayaan->satuan2:"";
            $satuan .= (!empty( $detail_pembiayaan->satuan3))?"/". $detail_pembiayaan->satuan3:"";


            // $jumlah = $detail_pembiayaan->vol1;
            // $jumlah = $jumlah *  (!empty($detail_pembiayaan->vol2))?$detail_pembiayaan->vol2:1;
            // $jumlah = $jumlah *  (!empty($detail_pembiayaan->vol3))?$detail_pembiayaan->vol3:1;
            
             $jumlah = $detail_pembiayaan->vol1;
             $j2 = empty($detail_pembiayaan->vol2)?1:$detail_pembiayaan->vol2;
             $j3 = empty($detail_pembiayaan->vol3)?1:$detail_pembiayaan->vol3;
             

             $jj = $jumlah * $j2 * $j3;
            // lah = $jumlah *  (!empty($detail_pembiayaan->vol2))?$detail_pembiayaan->vol2:1;
            //$jumlah = $jumlah *  (!empty($detail_pembiayaan->vol3))?$detail_pembiayaan->vol3:1;
            ?>
            <tr>
            <td class="kiri-kanan <?php echo $class ?>" scope="col"> </td>
            <td class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo spasi($pembiayaan->kode." ").$detail_pembiayaan->uraian; ?></td>
 
            <td class="kiri-kanan kanan <?php echo $class ?>" scope="col"><?php echo rupiah($detail_pembiayaan->total); ?></td>
            </tr>
        <?php 
        endforeach;
        } // endif bukan parent 
    ?>
    
    
    
    
    
    
  
  <?php endforeach; ?>
</table>

<p>&nbsp;</p> <div class="nobreak">
<table width="100%" border="0" class="cetak">
  <tr>
    <td width="37%" align="center" valign="top" class="tebal full-border">KETERANGAN</td>
    <td width="44%" rowspan="2" align="center" valign="top" class="full-border"><?php echo "$data_desa->desa, ". date("d-m-Y");?><br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <u><b><?php echo $data_desa->nama_kepala_desa;?></b></u><br />
      <?php echo $data_desa->nip_kepala_desa;?>
    </td>
  </tr>
  <tr>
    <td valign="top" class="full-border">&nbsp;</td>
  </tr>
</table>
</div>



<!-- RINGKASAN  --> 

<!-- BEGIN OF PEMBIAYAAN --> 
<p>&nbsp;</p>
</body>
</html>