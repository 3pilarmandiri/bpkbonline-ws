<?php 
	$tahun=$this->session->userdata("tahun_anggaran");
	$tahun_sebelum = $tahun - 1;
	$id_desa  = $this->session->userdata("id_desa");
	$data_desa = $this->cm->data_desa();
	$perdes = $this->cm->perdes();
	
	
	$ket = ($periode=="b")?"Bulan":"Triwulan";
	
	//echo "PERIODE = $periode <br />";
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
	vertical-align:middle;
}

table.cetak td {
	/*border-left : 1px solid #000;
	border-right : 1px solid #000;*/
	border:0.5px solid #000;
	
}

.double {
	font-size:9px;
}
</style>

<p>&nbsp;</p>
<table width="100%" border="0" cellpadding="3">
  <tr>
    <td><table width="100%" border="0" cellpadding="7" cellspacing="0">
      <tr>
        <td width="18%" align="right" valign="top"><img width="50px" height="60px" src="<?php echo base_url(); ?>/assets/images/ksb-header.png" /></td>
        <td width="82%" align="center" valign="top"><b>  <font size="12px">
            LAPORAN REALISASI PELAKSANAAN<br>
ANGGARAN PENDAPATAN &amp; BELANJA DESA <br>
</font> <font size="10px"> <?php if($periode=="y") { 
	echo "TAHUN ANGGARAN ".$tahun;
} else { ?>
 <?php echo $nama_periode; ?> <br>
<!--<br><font size="8px">PEMERINTAH DESA </font><font size="8px"> DESA <?php echo $data_desa->desa ?> </font> <br>
--> TAHUN <?php echo $tahun; } ?></font></b></td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<table width="100%" border="0" cellpadding="3" class="cetak">
  <thead>
    <tr>
      <th width="12%" align="center" scope="col">KODE REKENING</th>
      <th width="40%" align="center" scope="col">URAIAN</th>
      <th width="13%" align="center" scope="col">JUMLAH ANGGARAN</th>
      <th width="13%" align="center" scope="col">JUMLAH REALISASI</th>
      <th width="14%" align="center" scope="col">LEBIH/KURANG</th>
      <th width="8%" align="center" scope="col">KET</th>
    </tr>
    <tr>
      <th width="12%" align="center">1</th>
      <th width="40%" align="center">2</th>
      <th width="13%" align="center">3</th>
      <th width="13%" align="center">4</th>
      <th width="14%" align="center">5</th>
      <th width="8%" align="center">6</th>
    </tr>
  </thead>
    <tbody>
    <?php 
	$arr = array("s1","y","b");
	
	
		if( !in_array($periode,$arr) or ( $periode=="b" and $bulan==1  )  ) {
			$sisa_realisasi = $saldo; 
			//echo "sisa realiasi ". $sisa_realisasi;  exit;
	 ?>
     <tr> 
      <td width="12%"> </td>
      <td class="tebal" width="40%"> PEMINDAHAN SALDO  </td>
      <td class="tebal"  width="13%" align="right"  > </td>
      <td class="tebal"  width="13%" align="right" > <?php echo rupiah($saldo); ?>  </td>
      <td class="tebal"  width="14%" align="right" >  </td>
      <td width="8%">&nbsp;</td>
    </tr>
    <?php 
		}
		else 
		{
			$sisa_realisasi = 0;
		}
	?>
    
    <?php 
	$sisa_anggaran = 0;
	
	$sisa_selisih = 0;
	
	$total_pendapatan  =0;
	$total_realisasi  =0;
	foreach($record_pendapatan->result() as $row_pendapatan) : 
	if($row_pendapatan->has_child == 1 ) {
		$total = $row_pendapatan->total;
		$jumlah = $this->add->subtotal_lap($row_pendapatan->id,"tmp_laporan_pendapatan","jumlah",$this->tahun,$this->id_desa);
		$class="tebal";
	}
	else {
		$total = $row_pendapatan->total;
		$jumlah = $row_pendapatan->jumlah;
		$class="";
		
		$sisa_anggaran += $total;
		$sisa_realisasi += $jumlah ;
		
		$total_pendapatan += $total;
		$total_realisasi += $jumlah;
	}
	
	$sisa = $total - $jumlah;
	$sisa_selisih += $sisa;
	?>
    <tr>
      <td class="<?php echo $class ?>" width="12%"><?php echo $row_pendapatan->kode; ?></td>
      <td class="<?php echo $class ?>" width="40%"><?php echo $row_pendapatan->nama; ?></td>
      <td width="13%" align="right" class="<?php echo $class ?>"><?php echo rupiah($total); ?></td>
      <td width="13%" align="right" class="<?php echo $class ?>"><?php echo rupiah($jumlah); ?></td>
      <td width="14%" align="right" class="<?php echo $class ?>"><?php echo rupiah($sisa); ?></td>
      <td class="<?php echo $class ?>" width="8%">&nbsp;</td>
    </tr>
    <?php endforeach; ?>
    
    
     <tr>
      <td width="12%"> </td>
      <td width="40%"> </td>
      <td width="13%" align="right"  > </td>
      <td width="13%" align="right" > </td>
      <td width="14%" align="right" > </td>
      <td width="8%">&nbsp;</td>
    </tr>
    
    <tr>
      <td width="12%"> </td>
      <td class="tebal" width="40%"> JUMLAH PENDAPATAN </td>
      <td class="tebal"  width="13%" align="right"  ><?php echo rupiah($total_pendapatan); ?> </td>
      <td class="tebal"  width="13%" align="right" > <?php echo rupiah($total_realisasi); ?>  </td>
      <td class="tebal"  width="14%" align="right" ><?php echo rupiah($total_pendapatan -$total_realisasi );  ?> </td>
      <td width="8%">&nbsp;</td>
    </tr>
    
    <tr>
      <td width="12%"> </td>
      <td width="40%"> </td>
      <td width="13%" align="right"  > </td>
      <td width="13%" align="right" > </td>
      <td width="14%" align="right" > </td>
      <td width="8%">&nbsp;</td>
    </tr>
     
    
    <?php 
	$total_belanja = 0;
	$total_belanja_realisasi = 0;
	foreach($record_belanja->result() as $row_belanja) : 
	if($row_belanja->has_child == 1 ) {
		//$total = $this->add->subtotal_lap($row_belanja->id,"tmp_laporan_belanja","total",$this->tahun,$this->id_desa);
		$total = $row_belanja->total;
		$jumlah = $this->add->subtotal_lap($row_belanja->id,"tmp_laporan_belanja","jumlah",$this->tahun,$this->id_desa);
		$class="tebal";
	}
	else {
		$total = $row_belanja->total;
		$jumlah = $row_belanja->jumlah;
		$class="";
		$total_belanja += $total;
		$total_belanja_realisasi += $jumlah;
		$sisa_realisasi -= $jumlah;
	}
	
	$sisa = $total - $jumlah;
	$sisa_selisih -= $sisa;
	?>
    <tr>
      <td class="<?php echo $class ?>" width="12%"><?php echo $row_belanja->kode; ?></td>
      <td class="<?php echo $class ?>" width="40%"><?php echo $row_belanja->nama; ?></td>
      <td width="13%" align="right" class="<?php echo $class ?>"><?php echo rupiah($total); ?></td>
      <td width="13%" align="right" class="<?php echo $class ?>"><?php echo rupiah($jumlah); ?></td>
      <td width="14%" align="right" class="<?php echo $class ?>"><?php echo rupiah($sisa); ?></td>
      <td class="<?php echo $class ?>" width="8%">&nbsp;</td>
    </tr>
    <?php endforeach; ?>
    
    
    
     <tr>
      <td width="12%"> </td>
      <td width="40%"> </td>
      <td width="13%" align="right"  > </td>
      <td width="13%" align="right" > </td>
      <td width="14%" align="right" > </td>
      <td width="8%">&nbsp;</td>
    </tr>
    
    <tr>
      <td width="12%"> </td>
      <td class="tebal" width="40%"> JUMLAH BELANJA </td>
      <td class="tebal"  width="13%" align="right"  ><?php echo rupiah($total_belanja); ?> </td>
      <td class="tebal"  width="13%" align="right" > <?php echo rupiah($total_belanja_realisasi); ?>  </td>
      <td class="tebal"  width="14%" align="right" ><?php echo rupiah($total_belanja -$total_belanja_realisasi );  ?> </td>
      <td width="8%">&nbsp;</td>
    </tr>
    
    <tr>
      <td width="12%"> </td>
      <td width="40%"> </td>
      <td width="13%" align="right"  > </td>
      <td width="13%" align="right" > </td>
      <td width="14%" align="right" > </td>
      <td width="8%">&nbsp;</td>
    </tr>
    
    <?php
	 
	?>
    <tr>
      <td width="12%"> </td>
      <td class="tebal" width="40%">SURPLUS/DEFISIT </td>
      <td class="tebal"  width="13%" align="right"  ><?php echo rupiah($total_pendapatan - $total_belanja); ?> </td>
      <td class="tebal"  width="13%" align="right" > <?php echo rupiah($sisa_realisasi); ?>  </td>
      <td class="tebal"  width="14%" align="right" ><?php echo rupiah($total_pendapatan - $total_belanja -  $sisa_realisasi );  ?> </td>
      <td width="8%">&nbsp;</td>
    </tr>
    
    <tr>
      <td width="12%"> </td>
      <td width="40%"> </td>
      <td width="13%" align="right"  > </td>
      <td width="13%" align="right" > </td>
      <td width="14%" align="right" > </td>
      <td width="8%">&nbsp;</td>
    </tr>
    
    <?php 
	foreach($record_pembiayaan->result() as $row_pembiayaan) : 
	if($row_pembiayaan->has_child == 1 ) {
		//$total = $this->add->subtotal_lap($row_pembiayaan->id,"tmp_laporan_pembiayaan","total",$this->tahun,$this->id_desa);
		$total = $row_pembiayaan->total;
		$jumlah = $this->add->subtotal_lap($row_pembiayaan->id,"tmp_laporan_pembiayaan","jumlah",$this->tahun,$this->id_desa);
		$class="tebal";
	}
	else {
		$total = $row_pembiayaan->total;
		$jumlah = $row_pembiayaan->jumlah;
		$class="";
	}
	
	$sisa = $total - $jumlah;
	?>
    <tr>
      <td class="<?php echo $class ?>" width="12%"><?php echo $row_pembiayaan->kode; ?></td>
      <td class="<?php echo $class ?>" width="40%"><?php echo $row_pembiayaan->nama; ?></td>
      <td width="13%" align="right" class="<?php echo $class ?>"><?php  echo ($row_pembiayaan->kode=="3")?"": rupiah($total); ?></td>
      <td width="13%" align="right" class="<?php echo $class ?>"><?php echo ($row_pembiayaan->kode=="3")?"":rupiah($jumlah); ?></td>
      <td width="14%" align="right" class="<?php echo $class ?>"><?php echo ($row_pembiayaan->kode=="3")?"":rupiah($sisa); ?></td>
      <td class="<?php echo $class ?>" width="8%">&nbsp;</td>
    </tr>
    <?php  endforeach; ?>
    
  </tbody>
</table>
<br />
<br />
<br />
