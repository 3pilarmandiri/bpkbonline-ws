<?php 
	$tahun=$this->session->userdata("tahun_anggaran");
	$tahun_sebelum = $tahun - 1;
	$id_desa  = $this->session->userdata("id_desa");
	$data_desa = $this->cm->data_desa();
	$perdes = $this->cm->perdes();
	
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
<table width="100%" border="1" cellpadding="3">
  <tr>
    <td><table width="100%" border="0" cellpadding="7" cellspacing="0">
      <tr>
        <td width="18%" align="right" valign="top"><img width="50px" height="60px" src="<?php echo base_url(); ?>/assets/images/ksb-header.png" /></td>
        <td width="64%" align="center" valign="top"><b> <font size="8px"> PEMERINTAH <?php echo $data_desa->kota; ?> KECAMATAN <?php echo $data_desa->kecamatan ?> <br />
DESA <?php echo $data_desa->desa ?></font> <font size="12px"> <br />
BUKU PEMBANTU PAJAK <br />
</font> <font size="10px"><?php if($periode=="y") { 
	echo "TAHUN ANGGARAN ".$tahun;
} else { ?>
PERIODE <?php echo $nama_periode; ?> TAHUN <?php echo $tahun; } ?>
</font></b></td>
        <td width="18%" align="center" valign="top">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table class="cetak" width="100%" border="0" cellpadding="3">
  <thead>
  <tr>
    <th class="full-border" width="5%" scope="col">NO</th>
    <th class="full-border"  width="10%" scope="col">TANGGAL</th>
    <th class="full-border"  width="48%" scope="col">URAIAN</th>
    <th class="full-border"  width="12%" scope="col">PEMASUKAN</th>
    <th class="full-border"  width="12%" scope="col">PENYETORAN</th>
    <th class="full-border"  width="13%" scope="col">SALDO</th>
    </tr>
    <tr>
    <th width="5%" align="center" class="full-border"  scope="col"><strong>1</strong></th>
    <th width="10%" align="center" class="full-border"  scope="col"><strong>2</strong></th>
    <th width="48%" align="center" class="full-border"  scope="col"><strong>3</strong></th>
    <th width="12%" align="center" class="full-border"  scope="col"><strong>4</strong></th>
    <th width="12%" align="center" class="full-border"  scope="col"><strong>5</strong></th>
    <th width="13%" align="center" class="full-border"  scope="col"><strong>6</strong></th>
  </tr>
  </thead>
  <TBODY>
  <?php 
  $i=0;
  $saldo = 0;
  $tmasuk =0; 
  $tkeluar =0;
  foreach($record->result() as $row) : 
  $saldo += ($row->masuk-$row->keluar);
  $tmasuk += $row->masuk;
  $tkeluar += $row->keluar;
  $i++;
  
  if($row->masuk==0) {
	  $ket = str_replace("Penerimaan","Penyetoran",$row->detail);
  }
  else {
  		 $ket = str_replace("Penerimaan","Pemotongan",$row->detail);
  }	
  
  ?>
  
  <tr>
    <td width="5%" class="full-border"  scope="col"><?php echo $i; ?></td>
    <td width="10%" class="full-border"  scope="col"><?php echo flipdate($row->tanggal); ?></td>
    <td width="48%" class="full-border"  scope="col"><?php echo $ket; ?></td>
    <td width="12%" align="right" class="full-border"  scope="col"><?php echo rupiah($row->masuk); ?></td>
    <td width="12%" align="right" class="full-border"  scope="col"><?php echo rupiah($row->keluar); ?></td>
    <td width="13%" align="right" class="full-border"  scope="col"><?php echo rupiah($saldo); ?></td>
    </tr>
 
  <?php
  	endforeach;
  ?>
  
   <tr>
    <td class="full-border"  scope="col">&nbsp;</td>
    <td class="full-border"  scope="col">&nbsp;</td>
    <td align="right" class="tebal"  scope="col">JUMLAH</td>
    <td align="right" class="tebal"  scope="col"><?php echo rupiah($tmasuk); ?></td>
    <td align="right" class="tebal"  scope="col"><?php echo rupiah($tkeluar); ?></td>
    <td align="right" class="tebal"  scope="col"><?php echo rupiah($saldo); ?></td>
    </tr>
    </TBODY>
</table>
