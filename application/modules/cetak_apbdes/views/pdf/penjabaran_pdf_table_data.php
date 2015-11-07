<?php 
	$tahun=$this->session->userdata("tahun_anggaran");
	$tahun_sebelum = $tahun - 1;
	$id_desa  = $this->session->userdata("id_desa");
	$data_desa = $this->cm->data_desa();
	$perdes = $this->cm->perdes();
?>
<style>
body{
 }
th  {
 font-size: 6px;
 padding: 1px;
 text-align:center;
 vertical-align:middle;
 font-weight:bold;d
}
td  {
 font-size: 7px;
 padding: 3px;
 text-align:left;
 vertical-align:middle;
}

.tebal {
	font-weight:bold;
	 
}

 

table.cetak th {
	border : 1px solid #000;
/*	border:#000 solid 3px;
	border-style:double;*/
}

table.cetak td {
	 
	border:0.5px solid #000;
	
} 

hr {
	margin:10px 0px;
}

/*.double {
	
}*/

.double {
	font-size:8px;
}
</style>

<table width="100%" border="0" cellpadding="0">
  <tr>
    <td width="68%">&nbsp;</td>
    <td width="32%"><table width="100%" border="0" align="right" cellpadding="0">
      <tr>
        <td width="28%">LAMPIRAN II</td>
        <td width="4%">:</td>
        <td width="68%"> PENJABARAN    APBDES</td>
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
<table width="100%" border="1" cellpadding="3">
  <tr>
<td>

<table width="100%" border="0" cellpadding="7" cellspacing="0">
  <tr>
    <td width="11%" align="left" valign="top"><img width="50px" height="60px" src="<?php echo base_url(); ?>/assets/images/ksb-header.png" /></td>
    <td width="89%" align="center" valign="top"> <b> 
    <font size="8px">  PEMERINTAH DESA <?php echo $data_desa->desa ?> KECAMATAN  <?php echo $data_desa->kecamatan ?><br />
    <?php echo $data_desa->kota; ?>
    </font>
     <font size="12px">
<br />
PENJABARAN    ANGGARAN PENDAPATAN BELANJA DESA<br />
</font>
<font size="10px">
TAHUN ANGGARAN <?php echo $tahun; ?> </font> </b>

</td>
  </tr>
  
</table> 
</td>
</tr>
</table> 

<table width="100%" border="0" cellpadding="3" class="cetak">
  <thead>
    <tr class="tebal">
      <th    width="12%"  align="center" valign="middle" class="double1" scope="col"> KODE REKENING <br /></th>
      <th   width="35%" align="center" valign="middle" class="double1" scope="col"><br />
          <br />
        URAIAN <br /></th>
      <th   width="11%" align="center" valign="middle" class="double1" scope="col"><br />
          <br />
        SATUAN</th>
      <th    width="9%" align="center" valign="middle" class="double1" scope="col"><br />
          <br />
        VOLUME</th>
      <th    width="12%" align="center" valign="middle" class="double1" scope="col">HARGA SATUAN (RP)</th>
      <th    width="13%" align="center" valign="middle" class="double1" scope="col">JUMLAH <br />
        (RP)</th>
      <th    width="8%" align="center" valign="middle" class="double1" scope="col"><br />
          <br />
        KET.<br /></th>
    </tr>
    <tr>
      <th align="center" class="tebal" scope="col">1</th>
      <th align="center" class="tebal" scope="col">2</th>
      <th align="center" class="tebal" scope="col">3</th>
      <th align="center" class="tebal" scope="col">4</th>
      <th align="center" class="tebal" scope="col">5</th>
      <th align="center" class="tebal" scope="col">6</th>
      <th align="center" class="tebal" scope="col">7</th>
    </tr>
  </thead>
  <?php 
 $surplus_defisit = 0; 
 
 
  foreach($rec_penjabaran_pendapatan->result() as $pendapatan) : 
  $jumlah = $pendapatan->total;
  if($pendapatan->has_child == 1) {
  	$class  = "tebal";
	 
  }
  else {
  	$class = "";
	
	$surplus_defisit += $jumlah;
  }
  ?>
  <tr>
    <td  width="12%"  class="kiri-kanan  <?php echo $class ?>"  ><?php echo $pendapatan->kode; ?></td>
    <td  width="35%"  class="kiri-kanan  <?php echo $class ?>"  ><?php echo $pendapatan->nama; ?></td>
    <td width="11%" align="center"  class="kanan kiri-kanan  <?php echo $class ?>"  >&nbsp;</td>
    <td  width="9%" align="center"  class="kiri-kanan  <?php echo $class ?>"  >&nbsp;</td>
    <td  width="12%" align="right"  class="kiri-kanan  <?php echo $class ?>"  >&nbsp;</td>
    <td  width="13%" align="right"  class="kiri-kanan  <?php echo $class ?>"  ><span class="kanan kiri-kanan  <?php echo $class ?>"><?php echo rupiah($jumlah); ?></span></td>
    <td  width="8%"  class="kiri-kanan  <?php echo $class ?>"  >&nbsp;</td>
  </tr>
  <?php 
  $rec_detail = $this->dm->get_rec_detail("pendapatan_detail", "id_pendapatan", $pendapatan->id_pendapatan);
  //echo $this->db->last_query(); exit;
  foreach($rec_detail->result() as $detail ) : 
  
  			$satuan =  $detail->satuan1 ; 
            $satuan .= (!empty( $detail->satuan2))?"/". $detail->satuan2:"";
            $satuan .= (!empty( $detail->satuan3))?"/". $detail->satuan3:"";
			
			$vol =  $detail->vol1 ; 
            $vol .= (!empty( $detail->vol2))?"x". $detail->vol2:"";
            $vol .= (!empty( $detail->vol3))?"x". $detail->vol3:"";
  
  ?>
  <tr>
    <td  width="12%"  class="kiri-kanan  <?php echo $class ?>"  ></td>
    <td  width="35%"  class="kiri-kanan  <?php echo $class ?>"  >- <?php echo $detail->uraian ; ?></td>
    <td width="11%" align="center"  class="kanan kiri-kanan  <?php echo $class ?>"  ><?php echo $satuan ; ?></td>
    <td  width="9%" align="center"  class="kiri-kanan  <?php echo $class ?>"  ><?php echo $vol ; ?></td>
    <td  width="12%" align="right"  class="kiri-kanan  <?php echo $class ?>"  ><?php echo rupiah($detail->harga) ; ?></td>
    <td  width="13%" align="right"  class="kiri-kanan  <?php echo $class ?>"  ><?php echo rupiah($detail->total); ?> </td>
    <td  width="8%"  class="kiri-kanan  <?php echo $class ?>"  ></td>
  </tr>
  <?php endforeach;  ?>
  <?php endforeach;
  $class = "";
  ?>
  <tr>
    <td width="12%"  class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td width="35%" class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td width="11%" align="center" class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td width="9%" align="center" class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td width="12%" align="right" class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td width="13%" align="right" class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td width="8%" class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
  </tr>
  <?php 
  foreach($rec_penjabaran_belanja->result() as $belanja) : 
   $jumlah = $belanja->total;
  if($belanja->has_child == 1) {
    $class  = "tebal";
  
  }
  else {
    $class = "";
 
  $surplus_defisit -= $jumlah; 
  }
  ?>
  <tr>
    <td width="12%"  class="  <?php echo $class ?>"  ><?php echo $belanja->kode; ?></td>
    <td width="35%"  class="  <?php echo $class ?>"  ><?php echo $belanja->nama; ?></td>
    <td width="11%" align="center" class=" <?php echo $class ?>"  >&nbsp;</td>
    <td width="9%" align="center" class=" <?php echo $class ?>"  >&nbsp;</td>
    <td width="12%" align="right" class=" <?php echo $class ?>"  >&nbsp;</td>
    <td width="13%" align="right" class=" <?php echo $class ?>"  ><?php echo rupiah($jumlah); ?></td>
    <td width="8%" class=" <?php echo $class ?>"  >&nbsp;</td>
  </tr>
  <!-- rincian -->
  <?php 
	$rec_rincian  = $this->add->get_belanja_rincian($belanja->id); 
	foreach($rec_rincian->result() as $row_rincian) :
	?>
  <tr>
    <td width="12%"  class="  <?php echo $class ?>"  ></td>
    <td width="35%"  class="  <?php echo $class ?>"  ><?php echo $row_rincian->rincian; ?></td>
    <td width="11%" align="center" class=" <?php echo $class ?>"  >&nbsp;</td>
    <td width="9%" align="center" class=" <?php echo $class ?>"  >&nbsp;</td>
    <td width="12%" align="right" class=" <?php echo $class ?>"  >&nbsp;</td>
    <td width="13%" align="right" class=" <?php echo $class ?>"  ></td>
    <td width="8%" class=" <?php echo $class ?>"  ><?php echo $row_rincian->singkatan; ?></td>
  </tr>
  <?php 
			$rec_detail = $this->dm->get_rec_detail("belanja_detail", "id_belanja_rincian", 
			$row_rincian->id_belanja_rincian);
			$sub_jumlah = 0; 
			foreach($rec_detail->result() as $detail ) : 
			
			$satuan =  $detail->satuan1 ; 
            $satuan .= (!empty( $detail->satuan2))?"/". $detail->satuan2:"";
            $satuan .= (!empty( $detail->satuan3))?"/". $detail->satuan3:"";
			
			$vol =  $detail->vol1 ; 
            $vol .= (!empty( $detail->vol2))?"x". $detail->vol2:"";
            $vol .= (!empty( $detail->vol3))?"x". $detail->vol3:"";

			
			?>
  <tr>
    <td width="12%"  class="  <?php echo $class ?>"  ></td>
    <td width="35%"  class="  <?php echo $class ?>"  >- <?php echo $detail->uraian ?></td>
    <td width="11%" align="center" class=" <?php echo $class ?>"  ><?php echo $satuan ?></td>
    <td width="9%" align="center" class=" <?php echo $class ?>"  ><?php echo $vol ?></td>
    <td width="12%" align="right" class=" <?php echo $class ?>"  ><?php echo rupiah($detail->harga) ?></td>
    <td width="13%" align="right" class=" <?php echo $class ?>"  ><?php echo rupiah($detail->total) ?> </td>
    <td width="8%" class=" <?php echo $class ?>"  ></td>
  </tr>
  <?php endforeach; ?>
  <?php endforeach; ?>
  <!-- end of rincian  -->
  <?php endforeach; ?>
  <tr>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td align="center" class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td align="center" class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
  </tr>
  <tr>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="tebal">SURPLUS / (DEFISIT)</td>
    <td align="center" class="tebal">&nbsp;</td>
    <td align="center" class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="kiri-kanan  <?php echo $class ?>"><span class="tebal">
      <?php 
	  /*echo ($surplus_defisit > 0 ) 
	  ? rupiah($surplus_defisit) :  "(". rupiah(abs($surplus_defisit)).")"  
	  ; */
	  echo rupiah($surplus_defisit);
	  ?>
    </span></td>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
  </tr>
  <tr>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td align="center" class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td align="center" class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td align="right" class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
    <td class="kiri-kanan  <?php echo $class ?>">&nbsp;</td>
  </tr>
  <?php $nnn=0;
  foreach($rec_penjabaran_pembiayaan->result() as $pembiayaan) : 
  $nnn++;
   $jumlah = $pembiayaan->total;
  if($pembiayaan->has_child == 1) {
    $class  = "tebal";
  
  }
  else {
    $class = "";
   
  }
  ?>
  <tr>
    <td class="kiri-kanan  <?php echo $class ?>"  ><?php echo $pembiayaan->kode; ?></td>
    <td class="kiri-kanan  <?php echo $class ?>"  ><?php echo $pembiayaan->nama; ?></td>
    <td align="center" valign="top" class="kanan kiri-kanan  <?php echo $class ?>"  >&nbsp;</td>
    <td align="center" class="kiri-kanan  <?php echo $class ?>"  >&nbsp;</td>
    <td align="right" class="kiri-kanan  <?php echo $class ?>"  >&nbsp;</td>
    <td align="right" class="kiri-kanan  <?php echo $class ?>"  ><span class="kanan kiri-kanan  <?php echo $class ?>">
      <?php  echo (strlen($pembiayaan->id)>1)?rupiah($jumlah):""; ?>
    </span></td>
    <td class="kiri-kanan  <?php echo $class ?>"  >&nbsp;</td>
  </tr>
  <?php 
         $rec_detail = $this->dm->get_rec_detail("pembiayaan_detail", "id_pembiayaan", $pembiayaan->id_pembiayaan);
            foreach($rec_detail->result() as $detail ) : 
      
                $satuan =  $detail->satuan1 ; 
                $satuan .= (!empty( $detail->satuan2))?"/". $detail->satuan2:"";
                $satuan .= (!empty( $detail->satuan3))?"/". $detail->satuan3:"";
                
                $vol =  $detail->vol1 ; 
                $vol .= (!empty( $detail->vol2))?"x". $detail->vol2:"";
                $vol .= (!empty( $detail->vol3))?"x". $detail->vol3:"";
      
      ?>
  <tr>
    <td  width="12%"  class="kiri-kanan  <?php echo $class ?>"  ></td>
    <td  width="35%"  class="kiri-kanan  <?php echo $class ?>"  >- <?php echo $detail->uraian ; ?></td>
    <td width="11%" align="center"  class="kanan kiri-kanan  <?php echo $class ?>"  ><?php echo $satuan ; ?></td>
    <td  width="9%" align="center"  class="kiri-kanan  <?php echo $class ?>"  ><?php echo $vol ; ?></td>
    <td  width="12%" align="right"  class="kiri-kanan  <?php echo $class ?>"  ><?php echo rupiah($detail->harga) ; ?></td>
    <td  width="13%" align="right"  class="kiri-kanan  <?php echo $class ?>"  ><?php echo rupiah($detail->total); ?> </td>
    <td  width="8%"  class="kiri-kanan  <?php echo $class ?>"  >&nbsp;</td>
  </tr>
  <?php endforeach;  ?>
  <?php endforeach; ?>
  <?php
  	$biaya_terima = $this->add->get_total_by_id("pembiayaan","total","3_1",$this->id_desa,$this->tahun);
	 
	$biaya_keluar = $this->add->get_total_by_id("pembiayaan","total","3_2",$this->id_desa,$this->tahun);
	$netto = $biaya_terima - $biaya_keluar;
	
	$sisa = $surplus_defisit + $netto;
  
  
  if($nnn > 0) { 
  ?>
  <tr>
    <td class="kiri-kanan  <?php echo $class ?>"  >&nbsp;</td>
    <td align="right" class="tebal"  >PEMBIAYAAN NETTO</td>
    <td align="center" valign="top" class="tebal"  >&nbsp;</td>
    <td align="center" class="kiri-kanan  <?php echo $class ?>"  >&nbsp;</td>
    <td align="right" class="kiri-kanan  <?php echo $class ?>"  >&nbsp;</td>
    <td align="right" class="kiri-kanan  <?php echo $class ?>"  ><span class="tebal"><?php echo rupiah($netto); ?></span></td>
    <td class="kiri-kanan  <?php echo $class ?>"  >&nbsp;</td>
  </tr>
  <?php }  ?>
  <tr>
    <td class="kiri-kanan  <?php echo $class ?>"  >&nbsp;</td>
    <td align="right" class="tebal"  >SISA LEBIH PEMBIAYAAN ANGARAN TAHUN BERKENAAN </td>
    <td align="right" valign="top" class="tebal"  >&nbsp;</td>
    <td class="tebal" align="right"  ></td>
    <td class="tebal" align="right"  ></td>
    <td class="tebal" align="right"  ><?php echo rupiah($sisa);
	
	//echo  ($sisa>=0)?rupiah($sisa):"(".rupiah(abs($sisa)).")"; ?></td>
    <td class="tebal" align="right"  ></td>
  </tr>
</table>
