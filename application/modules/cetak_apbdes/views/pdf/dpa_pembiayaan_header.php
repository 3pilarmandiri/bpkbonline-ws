 <?php 
  $tahun=$this->session->userdata("tahun_anggaran");
  $tahun_sebelum = $tahun - 1;
  $id_desa  = $this->session->userdata("id_desa");
  $data_desa = $this->cm->data_desa();
?>
<style>
.cetak td, .cetak th {
  font-size:8px;
}
.tebal {
 font-weight:bold;
}

.uraian {
  padding-left:10px
}

.kode {
  font-size:8px;
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
<!-- <table width="100%" border="1" class="kop">
  <tr>
    <td width="61%" rowspan="2" align="center"  ><table width="100%" border="0">
      <tr>
        <td width="6%">&nbsp;</td>
        <td width="16%"><br />
          <br />
          <img src="<?php echo base_url(); ?>/assets/images/ksb-header.png" width="40" height="50" align="middle" /></td>
        <td width="78%" align="center"><br />
          <strong><br />
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
      3</strong></td>
  </tr>
  <tr>
    <td style="padding-top:5px;" width="5%" align="center" valign="middle"><strong><?php echo $data_desa->kode_kecamatan; ?></strong></td>
    <td style="padding-top:5px;"  width="5%" align="center" valign="middle"><strong><?php echo $data_desa->kode_desa; ?></strong></td>
    <td style="padding-top:5px;"  width="5%" align="center" valign="middle"><strong>3</strong></td>
    <td style="padding-top:5px;"  width="5%" align="center" valign="middle">&nbsp;</td>
    <td style="padding-top:5px;"  width="5%" align="center" valign="middle">&nbsp;</td>
  </tr>
</table> -->

<table width="100%" border="1" class="kop">
  <tr>
    <td width="61%" rowspan="2" align="center"  ><table width="100%" border="0">
      <tr>
        <td width="6%">&nbsp;</td>
        <td width="16%"><br />
          <br />
          <img src="<?php echo base_url(); ?>/assets/images/ksb-header.png" width="30" height="37" align="middle" /></td>
        <td width="78%" align="center"><br />
          <strong> <font size="10px"> <br>
           DOKUMEN PELAKSANAAN ANGGARAN 
            <br />
            DESA <?php echo $data_desa->desa;?> KECAMATAN <?php echo $data_desa->kecamatan;?><br />
            <?php echo $data_desa->kota;?> <br /> TAHUN ANGGARAN <?php echo $this->tahun; ?>
</font></strong></td>
      </tr>
    </table></td>
    <td height="40" colspan="5" align="center" width="25%"><strong><font size="8px">
      <br>
      NOMOR DPA DESA</font></strong></td>
    <td width="14%" rowspan="2" align="center"><strong><br />
    <font size="8px">  FORMULIR<br />
      DPA DESA<br />
    <?php echo $no_dpa; ?> </font></strong></td>
  </tr>
  <tr>
    <td width="5%" align="center" valign="middle" class="kode" style="padding-top:5px;"><strong><?php echo $data_desa->kode_kecamatan; ?></strong></td>
    <td  width="5%" align="center" valign="middle" class="kode" style="padding-top:5px;"><strong><?php echo $data_desa->kode_desa; ?></strong></td>
    <td  width="5%" align="center" valign="middle" class="kode" style="padding-top:5px;"><strong>3</strong></td>
    <td  width="5%" align="center" valign="middle" class="kode" style="padding-top:5px;"><strong><?php echo $dpa_jenis ?></strong></td>
    <td style="padding-top:5px;"  width="5%" align="center" valign="middle">&nbsp;</td>
  </tr>
   
</table>

<br />

<table width="100%" border="1" cellpadding="3" class="kop">
  <!--<tr>
    <td width="76%" class="judul"><TABLE width="100%">
      <tr>
        <th width="17%" align="left"><span class="kode">KABUPATEN</span></th>
        <td width="15%"><span class="kode">: </span></td>
        <td width="61%"><span class="kode"><?php echo $data_desa->kota;?></span></td>
        <td width="7%">&nbsp;</td>
      </tr>
      <tr>
        <th align="left"><span class="kode"><strong>KECAMATAN</strong></span></th>
        <td><span class="kode">: <?php echo $data_desa->kode_kecamatan;?></span></td>
        <td><span class="kode"><?php echo $data_desa->kecamatan;?></span></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <th align="left"><span class="kode"><strong>DESA</strong></span></th>
        <td><span class="kode">: <?php echo $data_desa->kode_kecamatan;?>.<?php echo $data_desa->kode_desa;?></span></td>
        <td><span class="kode"><?php echo $data_desa->desa;?></span></td>
        <td>&nbsp;</td>
      </tr>
    </TABLE></td>
    <td width="24%" colspan="3" align="center" class="judul"><br>
      <br>
    TAHUN ANGGARAN <?php echo $this->tahun; ?></td>
  </tr>-->
  <tr>
    <td colspan="4" align="center" class="judul"><strong> <?php echo $judul; ?></strong></td>
  </tr>
</table>
<!-- <table width="100%" border="1" cellpadding="3" class="kop">
  <tr>
    <td colspan="3" align="center"><strong>PEMERINTAH  <?php echo $data_desa->kota; ?><br />
      <font size="8pt"> TAHUN ANGGARAN <?php echo $this->session->userdata("tahun_anggaran"); ?></font></strong></td>
  </tr>
  <tr>
    <td colspan="3" class="judul"><TABLE width="100%">
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
    </TABLE></td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="judul"><strong>RINCIAN DOKUMEN PELAKSANAAN ANGGARAN PENDAPATAN DESA</strong></td>
  </tr>
</table> -->
<table width="100%" border="0" cellpadding="3" class="cetak">
  <thead>
    <tr>
      <th width="17%" align="center" scope="col"><strong>KODE REKENING</strong></th>
      <th width="65%" align="center" scope="col"><strong>URAIAN</strong></th>
      <th width="18%" align="center" scope="col"><strong>JUMLAH<br />
        (RP)</strong></th>
    </tr>
    <tr>
      <th align="center"><strong>1</strong></th>
      <th align="center"><strong>2</strong></th>
      <th align="center"><strong>3</strong></th>
    </tr>
  </thead> 
  
  <?php 
   $class = "";
  foreach($rec_penjabaran_pembiayaan->result() as $pembiayaan) : 
  $jumlah = $pembiayaan->total;
  if($pembiayaan->has_child == 1) {
    $class  = "tebal";
  }
  else {
    $class = "";
  
  }
  ?>
  <tr>
    <td width="17%" class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo $pembiayaan->kode; ?></td>
    <td width="65%" class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo spasi($pembiayaan->kode).$pembiayaan->nama; ?></td>
    <td width="18%" align="right" class="kiri-kanan kanan <?php echo $class ?>" scope="col">
	
	 
    <?php if(strlen($pembiayaan->id) == 1 ) echo ""; else { echo ($jumlah>0)?rupiah($jumlah):""; }  ?>
    </td>
  </tr>
  
    
    <?php 

        if($pembiayaan->has_child == 0  ) { // if bukan parent 
        $rec_detail_pembiayaan = $this->dm->get_rec_detail("pembiayaan_detail", "id_pembiayaan", $pembiayaan->id_pembiayaan);
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
            <td width="17%" class="kiri-kanan <?php echo $class ?>" scope="col"> </td>
            <td width="65%" class="kiri-kanan <?php echo $class ?>" scope="col"><?php echo spasi($pembiayaan->kode." ").$detail_pembiayaan->uraian; ?></td>
 
            <td width="18%" align="right" class="kiri-kanan kanan <?php echo $class ?>" scope="col"><?php echo rupiah($detail_pembiayaan->total); ?></td>
            </tr>
        <?php 
        endforeach;
        } // endif bukan parent 
    ?>
    
    
    
    
    
    
  
  <?php endforeach; ?>
  
</table>
