<?php 
	$tahun=$this->session->userdata("tahun_anggaran");
	$tahun_sebelum = $tahun - 1;
	$id_desa  = $this->session->userdata("id_desa");
	$data_desa = $this->cm->data_desa();
	$perdes = $this->cm->perdes();
	
	
	$ket = ($periode=="b")?"Bulan":"Triwulan";
?>
<style>
th  {
 font-size: 7px;
 padding: 1px;
 text-align:center;
 vertical-align:middle;
 font-weight:bold;d
}
td  {
 font-size: 6px;
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
            <?php echo $sumber_dana; ?><br />
ANGGARAN PENDAPATAN &amp; BELANJA DESA <br>
</font> <font size="10px"><!--<br><font size="8px">PEMERINTAH DESA </font><font size="8px"> DESA <?php echo $data_desa->desa ?> </font> <br>
--> 
<?php echo $nama_periode; ?> &nbsp;
TAHUN <?php echo $tahun; ?></font></b></td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<table width="100%" border="0" cellpadding="3" class="cetak">
  <thead>
    <tr>
      <th width="8%" align="center" scope="col">KODE <br />
      REKENING</th>
      <th width="38%" align="center" scope="col">URAIAN</th>
      <th width="10%" align="center" scope="col">JUMLAH ANGGARAN</th>
      <th width="11%" align="center" scope="col">S.D LALU</th>
      <th width="11%" align="center" scope="col">JUMLAH REALISASI</th>
      <th width="10%" align="center" scope="col">JUMLAH TERPAKAI</th>
      <th width="12%" align="center" scope="col">LEBIH/<br />
      KURANG</th>
    </tr>
    <tr>
      <th width="8%" align="center">1</th>
      <th width="38%" align="center">2</th>
      <th width="10%" align="center">3</th>
      <th width="11%" align="center">4</th>
      <th width="11%" align="center">5</th>
      <th width="10%" align="center">6</th>
      <th width="12%" align="center">7</th>
    </tr>
  </thead>
    <tbody>
     
	 <?php 
	 foreach($record->result() as $row): 
	 if($row->has_child == "1"){
	 	$class = "tebal";
	 	$anggaran = $this->add->subtotal_sd($row->id,"total");
	 	$sd_lalu = $this->add->subtotal_sd($row->id,"sebelum");
		$sekarang = $this->add->subtotal_sd($row->id,"sekarang");
		 
	 }
	 else {
	 	$anggaran = $row->total;
	 	$sd_lalu = $row->sebelum;
		$sekarang = $row->sekarang;
		
		$class = "";
	 }
	 
	 $sd_sekarang = $sd_lalu + $sekarang;
	 $selisih = $anggaran - $sd_sekarang;
	 
	 
	 ?>
    <tr>
      <td class="<?php echo $class ?>" width="8%"><?php echo $row->kode; ?></td>
      <td class="<?php echo $class ?>" width="38%"><?php echo $row->nama; ?></td>
      <td   width="10%" align="right" class="<?php echo $class ?>"><?php echo rupiah($anggaran); ?></td>
      <td   width="11%" align="right" class="<?php echo $class ?>"><?php echo rupiah($sd_lalu); ?></td>
      <td  width="11%" align="right" class="<?php echo $class ?>"><?php echo rupiah($sekarang); ?></td>
      <td  width="10%" align="right" class="<?php echo $class ?>"><?php echo rupiah($sd_sekarang); ?></td>
      <td width="12%" align="right" class="<?php echo $class ?>"><?php echo rupiah($selisih); ?></td>
      </tr>
     <?php 
	 endforeach;
	 ?>
  </tbody>
</table>
<br />
<br />
<br />
