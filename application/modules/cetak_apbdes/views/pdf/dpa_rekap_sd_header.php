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
    1.2 </font></strong></td>
  </tr>
  <tr>
    <td width="5%" align="center" valign="middle" class="kode" style="padding-top:5px;"><strong><?php echo $data_desa->kode_kecamatan; ?></strong></td>
    <td  width="5%" align="center" valign="middle" class="kode" style="padding-top:5px;"><strong><?php echo $data_desa->kode_desa; ?></strong></td>
    <td  width="5%" align="center" valign="middle" class="kode" style="padding-top:5px;"><strong>1</strong></td>
    <td  width="5%" align="center" valign="middle" class="kode" style="padding-top:5px;">&nbsp;</td>
    <td style="padding-top:5px;"  width="5%" align="center" valign="middle">&nbsp;</td>
  </tr>
   
</table>
<br />
<table width="100%" border="1" cellpadding="3" class="kop">
  <tr>
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
  </tr>
  <tr>
    <td colspan="4" align="center" class="judul"><strong>REKAPITULASI SUMBER DANA </strong></td>
  </tr>
</table>
<table width="100%" border="1" cellpadding="2" class="cetak">
 	<thead>
    <tr>
      <th width="16%" align="center" scope="col"><strong>KODE REKENING</strong></th>
      <th width="61%" align="center" scope="col"><strong>      URAIAN</strong></th>
      <th width="23%" align="center" scope="col"><strong>JUMLAH (RUPIAH)</strong></th>
      </tr>
    <tr>
      <th align="center" scope="col"><strong>1</strong></th>
      <th align="center" scope="col"><strong>2</strong></th>
      <th align="center" scope="col"><strong>3</strong></th>
      </tr>
    
    </thead>
    <tbody>
    <?php 
	 $total  = 0;
	
	 
	
	foreach($get_rekap_kegiatan->result() as $row) : 
	$total += $row->total;
	?>
    <tr>
      <td class="<?php echo $class ?>" width="16%" scope="col"><?php echo $row->kode; ?></td>
      <td class="<?php echo $class ?> uraian"  width="61%"  scope="col">&nbsp; &nbsp; &nbsp; &nbsp; <?php echo $row->nama; ?></td>
      <td class="<?php echo $class ?>"  width="23%"  scope="col" align="right"><?php echo  rupiah($row->total);  ?></td>
      </tr>
   
    <?php 
	endforeach;
	?> 
    <tr>
      <th colspan="2" class="<?php echo $class ?>" scope="col"><strong>JUMLAH </strong></th>
      <th class="<?php echo $class ?>"  scope="col" align="right"><strong><?php echo rupiah($total); ?></strong></th>
    </tr>
  </tbody>
</table>
