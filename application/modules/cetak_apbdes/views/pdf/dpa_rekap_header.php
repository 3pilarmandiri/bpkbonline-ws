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
<table width="100%" border="1" class="kop">
  <tr>
    <td width="85%" align="center"  ><table width="100%" border="0">
      <tr>
        <td width="6%">&nbsp;</td>
        <td width="16%"><br />
          <br />
          <img src="<?php echo base_url(); ?>/assets/images/ksb-header.png" width="60" height="70" align="middle" /></td>
        <td width="78%" align="center"><br />
            <br />
            <strong>            DOKUMEN PELAKSANAAN ANGGARAN<br />
            DESA <?php echo $data_desa->desa; ?> KECAMATAN <?php echo $data_desa->kecamatan; ?> <br />
          KABUPATEN <?php echo $data_desa->kota; ?> <br />
          TAHUN ANGGARAN <?php echo $tahun; ?></strong></td>
      </tr>
    </table></td>
    <td width="15%" align="center"><strong><br />
      FORMULIR<br />
      DPA DESA<br />
      2.1</strong></td>
  </tr>
</table>
<br />
 <table width="100%" border="1" cellpadding="3" class="kop">
  <!--<tr>
    <td width="76%" class="judul"><TABLE width="100%">
      <tr>
        <th width="17%" align="left"><span class="kode">KABUPATEN</span></th>
        <td width="15%"><span class="kode">:</span></td>
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
    <td colspan="4" align="center" class="judul"><strong>REKAPITULASI BELANJA MENURUT BIDANG &amp; KEGIATAN  </strong></td>
  </tr>
</table>  
<!-- 
  <table width="100%" border="1" cellpadding="3" class="kop">
  <tr>
    <td colspan="3" align="center"><strong>PEMERINTAH <?php echo $data_desa->kota; ?><br />
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
    <td colspan="3" align="center" class="judul"><strong>REKAPITULASI BELANJA MENURUT BIDANG &amp; KEGIATAN </strong></td>
  </tr>
</table>   -->
<table width="100%" border="1" cellpadding="2" class="cetak">
 	<thead>
    <tr>
      <th width="7%" rowspan="2" align="center" scope="col"><strong>KODE PROGRAM KEGIATAN</strong></th>
      <th width="29%" rowspan="2" align="center" scope="col"><strong><br>
      URAIAN</strong></th>
      <th width="9%" rowspan="2" align="center" scope="col"><strong>LOKASI KEGIATAN</strong></th>
      <th width="5%" rowspan="2" align="center" scope="col"><strong>TARGET KERJA</strong></th>
      <th width="8%" rowspan="2" align="center" scope="col"><strong>SUMBER DANA</strong></th>
      <th colspan="4" align="center" scope="col" width="32%"><strong>TRIWULAN</strong></th>
      <th width="10%" rowspan="2" align="center" scope="col"><strong><br>
      JUMLAH</strong></th>
    </tr> 
    <tr>
      <th width="8%" align="center" scope="col"><strong>I</strong></th>
      <th width="8%" align="center" scope="col"><strong>II</strong></th>
      <th width="8%" align="center" scope="col"><strong>III</strong></th>
      <th width="8%" align="center" scope="col"><strong>IV</strong></th>
    </tr>
    <tr>
      <th align="center" scope="col"><strong>1</strong></th>
      <th align="center" scope="col"><strong>2</strong></th>
      <th align="center" scope="col"><strong>3</strong></th>
      <th align="center" scope="col"><strong>4</strong></th>
      <th align="center" scope="col"><strong>5</strong></th>
      <th align="center" scope="col"><strong>6</strong></th>
      <th align="center" scope="col"><strong>7</strong></th>
      <th align="center" scope="col"><strong>8</strong></th>
      <th align="center" scope="col"><strong>9</strong></th>
      <th align="center" scope="col"><strong>10</strong></th>
    </tr>
    
    </thead>
    <tbody>
    <?php 
	$tahun = $this->session->userdata("tahun_anggaran");
	$id_desa = $this->session->userdata("id_desa");
	
	$tt1=0; $tt2=0; $tt3=0; $tt4=0;  $ttotal=0; 
	
		foreach($get_rekap_kegiatan->result() as $row) : 
		$class="";
		
		
		$t1 = $this->add->get_total_by_id("belanja","t1",$row->id,$this->id_desa,$this->tahun);
		$t2 = $this->add->get_total_by_id("belanja","t2",$row->id,$this->id_desa,$this->tahun);
		$t3 = $this->add->get_total_by_id("belanja","t3",$row->id,$this->id_desa,$this->tahun);
		$t4 = $this->add->get_total_by_id("belanja","t4",$row->id,$this->id_desa,$this->tahun);
		$total = $this->add->get_total_by_id("belanja","total",$row->id,$this->id_desa,$this->tahun);
		
		
		if(strlen($row->id) == 3) {
			$class="tebal";
		}
		else {
			$class ="";
			$tt1 += $t1;
			$tt2 += $t2;
			$tt3 += $t3;
			$tt4 += $t4;
			$ttotal += $total;
			
			$lokasi = $this->dm->get_kegiatan_detail($row->id);
		}
		
		
		
		
		
		
	?>
    <tr>
      <td class="<?php echo $class ?>" width="7%" scope="col"><?php echo $row->kode; ?></td>
      <td class="<?php echo $class ?>"  width="29%"  scope="col"><?php echo $row->nama; ?></td>
      <td class="<?php echo $class ?>"  width="9%"  scope="col"><?php echo isset($lokasi['lokasi'])?$lokasi['lokasi']:""; ?></td>
      <td class="<?php echo $class ?>"   width="5%" scope="col"><?php echo isset($lokasi['hasil_target'])?$lokasi['hasil_target']:""; ?></td>
      <td class="<?php echo $class ?>"  width="8%"  scope="col"><?php echo strlen($row->id) > 3? $this->dm->get_sumber_dana($row->id):""; ?></td>
      <td class="<?php echo $class ?>"  width="8%" align="right"  scope="col"><?php echo rupiah($t1); ?></td>
      <td class="<?php echo $class ?>"  width="8%" align="right"  scope="col"><?php echo rupiah($t2); ?></td>
      <td class="<?php echo $class ?>"  width="8%" align="right"  scope="col"><?php echo rupiah($t3); ?></td>
      <td class="<?php echo $class ?>"  width="8%" align="right"  scope="col"><?php echo rupiah($t4); ?></td>
      <td class="<?php echo $class ?>"  width="10%" align="right"  scope="col"><?php echo rupiah($total); ?></td>
    </tr>
    <?php 
	endforeach;

    $tt1 = $this->add->get_total_by_id("belanja","t1","2",$this->id_desa,$this->tahun);
    $tt2 = $this->add->get_total_by_id("belanja","t2","2",$this->id_desa,$this->tahun);
    $tt3 = $this->add->get_total_by_id("belanja","t3","2",$this->id_desa,$this->tahun);
    $tt4 = $this->add->get_total_by_id("belanja","t4","2",$this->id_desa,$this->tahun);
    $ttotal = $this->add->get_total_by_id("belanja","total","2",$this->id_desa,$this->tahun);

	?>
    <tr>
      <td colspan="5" align="right" class="<?php echo $class ?>"  scope="col"><strong>JUMLAH</strong></td>
     
      <td class="<?php echo $class ?>"  width="8%" align="right"  scope="col"><strong><?php echo rupiah($tt1); ?></strong></td>
      <td class="<?php echo $class ?>"  width="8%" align="right"  scope="col"><strong><?php echo rupiah($tt2); ?></strong></td>
      <td class="<?php echo $class ?>"  width="8%" align="right"  scope="col"><strong><?php echo rupiah($tt3); ?></strong></td>
      <td class="<?php echo $class ?>"  width="8%" align="right"  scope="col"><strong><?php echo rupiah($tt4); ?></strong></td>
      <td class="<?php echo $class ?>"  width="10%" align="right"  scope="col"><strong><?php echo rupiah($ttotal); ?></strong></td>
    </tr>
  </tbody>
</table>
