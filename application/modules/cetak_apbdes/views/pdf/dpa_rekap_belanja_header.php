 <?php 
  $tahun=$this->session->userdata("tahun_anggaran");
  $tahun_sebelum = $tahun - 1;
  $id_desa  = $this->session->userdata("id_desa");
  $data_desa = $this->cm->data_desa();
  
  $total_belanja = $this->add->subtotal2("2","v_belanja","total",$this->tahun,$this->id_desa);
	//echo "total belanja ".$total_belanja; exit; 
  
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
          RINGKASAN DOKUMEN PELAKSANAAN ANGGARAN 
            DESA </font></strong></td>
      </tr>
    </table></td>
    <td height="40" colspan="5" align="center" width="25%"><strong><font size="8px">
      <br>
      NOMOR DPA DESA</font></strong></td>
    <td width="14%" rowspan="2" align="center"><strong><br />
    <font size="8px">  FORMULIR<br />
      DPA DESA<br />
    2.2 </font></strong></td>
  </tr>
  <tr>
    <td width="5%" align="center" valign="middle" class="kode" style="padding-top:5px;"><strong><?php echo $data_desa->kode_kecamatan; ?></strong></td>
    <td  width="5%" align="center" valign="middle" class="kode" style="padding-top:5px;"><strong><?php echo $data_desa->kode_desa; ?></strong></td>
    <td  width="5%" align="center" valign="middle" class="kode" style="padding-top:5px;"><strong>1</strong></td>
    <td  width="5%" align="center" valign="middle" class="kode" style="padding-top:5px;">&nbsp;</td>
    <td style="padding-top:5px;"  width="5%" align="center" valign="middle">&nbsp;</td>
  </tr>
   
</table>
<!-- <table width="100%" border="1" class="kop">
  <tr>
    <td width="61%" rowspan="2" align="center"  ><table width="100%" border="0">
      <tr>
        <td width="6%">&nbsp;</td>
        <td width="16%"><br />
          <br />
          <img src="<?php echo base_url(); ?>/assets/images/ksb-header.png" width="40" height="47" align="middle" /></td>
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
      FORMULIR<br />
      DPA DESA<br />
    2.2</strong></td>
  </tr>
  <tr>
    <td style="padding-top:5px;" width="5%" align="center" valign="middle"><strong><?php echo $data_desa->kode_kecamatan; ?></strong></td>
    <td style="padding-top:5px;"  width="5%" align="center" valign="middle"><strong><?php echo $data_desa->kode_desa; ?></strong></td>
    <td style="padding-top:5px;"  width="5%" align="center" valign="middle"><strong>2</strong></td>
    <td style="padding-top:5px;"  width="5%" align="center" valign="middle">&nbsp;</td>
    <td style="padding-top:5px;"  width="5%" align="center" valign="middle">&nbsp;</td>
  </tr>
</table> -->
<br />
<!-- <table width="100%" border="1" cellpadding="3" class="kop">
  <tr>
    <td colspan="3" align="center"><strong>PEMERINTAH <?php echo $data_desa->kota; ?> <br />
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
    <td colspan="3" align="center" class="judul"><strong>REKAPITULASI BELANJA</strong></td>
  </tr>
</table> -->

<table width="100%" border="1" cellpadding="3" class="kop">
  <tr>
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
  </tr>
  <tr>
    <td colspan="4" align="center" class="judul"><strong>REKAPITULASI BELANJA </strong></td>
  </tr>
</table>  
<table width="100%" border="1" cellpadding="2" class="cetak">
 	<thead>
    <tr>
      <th width="14%" align="center" scope="col"><strong>KODE REKENING</strong></th>
      <th width="65%" align="center" scope="col"><strong>      URAIAN</strong></th>
      <th width="13%" align="center" scope="col"><strong>JUMLAH </strong></th>
      <th width="8%" align="center" scope="col"><strong>%</strong></th>
      </tr>
    <tr>
      <th align="center" scope="col"><strong>1</strong></th>
      <th align="center" scope="col"><strong>2</strong></th>
      <th align="center" scope="col"><strong>3</strong></th>
      <th align="center" scope="col"><strong>4</strong></th>
      </tr>
    
    </thead>
    <tbody>
   
    
    <?php 
 	// ($id,$tb_name,$kolom,$tahun,$id_desa)
	$total_pendapatan = $this->add->subtotal2("1","v_pendapatan","total",$this->tahun,$this->id_desa);
	
	foreach($rec_pendapatan->result() as $row) : 
	
	if($row->has_child == 1){
		$class = "tebal";
		$jumlah = $this->add->subtotal2($row->id,"v_pendapatan","total",$this->tahun,$this->id_desa);
	}
	else {
		$class ="";
		$jumlah = $row->total;
		 
	}
	
	$persen = $jumlah / $total_pendapatan * 100;
	
	?>
    <tr>
      <td class="<?php echo $class ?>" width="14%" scope="col"><?php echo $row->kode; ?></td>
      <td class="<?php echo $class ?>"  width="65%"  scope="col"><?php echo $row->nama; ?></td>
      <td class="<?php echo $class ?>"  width="13%"  scope="col" align="right"><?php echo  rupiah($jumlah);  ?></td>
      <td class="<?php echo $class ?>"  width="8%"  scope="col" align="right"><?php echo ($row->kode=="1")?"":  rupiah($persen);  ?></td>
      </tr>
   
    <?php 
	endforeach;
	?> 
    
    
    
    
      <tr>
      <td class="<?php echo $class ?>" width="14%" scope="col"> </td>
      <td class="tebal"  width="65%"  scope="col">  </td>
      <td class="tebal"  width="13%"  scope="col" align="right"> </td>
      <td class="tebal"  width="8%"  scope="col" align="right"> </td>
      </tr>
    
    
    <?php 
	 $total  = 0;
	
	$total_belanja = $this->add->subtotal2("2","v_belanja","total",$this->tahun,$this->id_desa);
	
	
	?>
    <tr>
      <td class="<?php echo $class ?>" width="14%" scope="col"> </td>
      <td class="tebal"  width="65%"  scope="col">BELANJA </td>
      <td class="tebal"  width="13%"  scope="col" align="right"> <?php echo rupiah($total_belanja); ?> </td>
      <td class="tebal"  width="8%"  scope="col" align="right"> </td>
      </tr>
    <?
 	// ($id,$tb_name,$kolom,$tahun,$id_desa)
	foreach($get_rekap_belanja->result() as $row) : 
	
	if($row->has_child == 1){
		$class = "tebal";
		$jumlah = $this->add->subtotal_belanja($row->id);
	}
	else {
		$class ="";
		$jumlah = $row->total;
		$total += $jumlah;
	}
	
	$persen = $jumlah / $total_belanja * 100;
	
	?>
    <tr>
      <td class="<?php echo $class ?>" width="14%" scope="col"><?php echo $row->kode; ?></td>
      <td class="<?php echo $class ?>"  width="65%"  scope="col"><?php echo $row->nama; ?></td>
      <td class="<?php echo $class ?>"  width="13%"  scope="col" align="right"><?php echo  rupiah($jumlah);  ?></td>
      <td class="<?php echo $class ?>"  width="8%"  scope="col" align="right"><?php echo  rupiah($persen);  ?></td>
      </tr>
   
    <?php 
	endforeach;
	?> 
    
   <tr>
      <td class="<?php echo $class ?>" width="14%" scope="col"> </td>
      <td class="<?php echo $class ?>"  width="65%"  scope="col">  </td>
      <td class="<?php echo $class ?>"  width="13%"  scope="col" align="right"><?php //echo  rupiah($jumlah);  ?></td>
      <td class="<?php echo $class ?>"  width="8%"  scope="col" align="right"><?php //echo  rupiah($persen);  ?></td>
      </tr>  
    
    <?php 
	 $total  = 0;
	
	//$total_belanja = $this->add->subtotal2("2","v_belanja","total",$this->tahun,$this->id_desa);
	
	
	 
 	// ($id,$tb_name,$kolom,$tahun,$id_desa)
	foreach($rec_pembiayaan->result() as $row) : 
	
	if($row->has_child == 1){
		$class = "tebal";
		$jumlah = $this->add->subtotal2($row->id,"v_pembiayaan","total",$this->tahun,$this->id_desa);

	}
	else {
		$class ="";
		$jumlah = $row->total;
		 
	}
	
	//$persen = $jumlah / $total_belanja * 100;
	
	?>
    <tr>
      <td class="<?php echo $class ?>" width="14%" scope="col"><?php echo $row->kode; ?></td>
      <td class="<?php echo $class ?>"  width="65%"  scope="col"><?php echo $row->nama; ?></td>
      <td class="<?php echo $class ?>"  width="13%"  scope="col" align="right"><?php echo  rupiah($jumlah);  ?></td>
      <td class="<?php echo $class ?>"  width="8%"  scope="col" align="right"><?php //echo  rupiah($persen);  ?></td>
      </tr>
   
    <?php 
	endforeach;
	?> 
    
    
    
  </tbody>
</table>
