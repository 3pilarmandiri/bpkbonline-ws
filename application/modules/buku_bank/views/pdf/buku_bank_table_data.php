<?php 
	$tahun=$this->session->userdata("tahun_anggaran");
	$tahun_sebelum = $tahun - 1;
	$id_desa  = $this->session->userdata("id_desa");
	$data_desa = $this->cm->data_desa();
	$perdes = $this->cm->perdes();
	
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
        <td width="22%" align="right" valign="top"><img width="50px" height="60px" src="<?php echo base_url(); ?>/assets/images/ksb-header.png" /></td>
        <td width="56%" align="center" valign="top"><b><font size="8px">PEMERINTAH <?php echo $data_desa->kota; ?> KECAMATAN <?php echo $data_desa->kecamatan ?> <br />
DESA <?php echo $data_desa->desa ?><br />
        </font> <font size="12px"> BUKU PEMBANTU BANK <br />
        </font> <font size="10px"> PERIODE <?php echo $nama_periode; ?> TAHUN <?php echo $tahun; ?></font></b></td>
        <td width="22%" align="center" valign="top">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table class="cetak" width="100%" border="0" cellpadding="3">
  <thead>
  <tr>
    <th width="4%" rowspan="2" class="full-border" scope="col"><strong><br>
      NO</strong></th>
    <th width="8%" rowspan="2" class="full-border" scope="col"><strong>TANGGAL</strong></th>
    <th width="19%" rowspan="2" class="full-border" scope="col"><strong>URAIAN <br>
      TRANSAKSI</strong></th>
    <th width="8%" rowspan="2" class="full-border" scope="col"><strong> BUKTI <br>
      TRANSFER</strong></th>
    <th colspan="2" class="full-border" scope="col" width="22%"><strong>PEMASUKAN</strong></th>
    <th colspan="3" class="full-border" scope="col" width="28%"><strong>PENGELUARAN</strong></th>
    <th width="11%" rowspan="2" class="full-border" scope="col"><strong>SALDO</strong></th>
  </tr>
  <tr>
    <th width="12%" class="full-border" scope="col"><strong>SETORAN</strong></th>
    <th width="10%" class="full-border" scope="col"><strong>BUNGA BANK</strong></th>
    <th width="10%" class="full-border" scope="col"><strong>PENARIKAN</strong></th>
    <th width="8%" class="full-border" scope="col"><strong>PAJAK</strong></th>
    <th width="10%" class="full-border" scope="col"><strong>BIAYA<br>
      ADMINISTRASI</strong></th>
    </tr>
  <tr>
    <th class="full-border" width="4%" scope="col"><strong>1</strong></th>
    <th class="full-border"  width="8%" scope="col"><strong>2</strong></th>
    <th class="full-border"  width="19%" scope="col"><strong>3</strong></th>
    <th class="full-border"  width="8%" scope="col"><strong>4</strong></th>
    <th class="full-border"  width="12%" scope="col"><strong>5</strong></th>
    <th class="full-border"  width="10%" scope="col"><strong>6</strong></th>
    <th class="full-border"  width="10%" scope="col"><strong>7</strong></th>
    <th class="full-border"  width="8%" scope="col"><strong>8</strong></th>
    <th class="full-border"  width="10%" scope="col"><strong>9</strong></th>
    <th class="full-border"  width="11%" scope="col"><strong>10</strong></th>
  </tr>
  </thead>
  <TBODY>
   <tr>
    <td width="4%" class="full-border"  scope="col">&nbsp;</td>
    <td width="8%" class="full-border"  scope="col">&nbsp;</td>
    <td width="19%" class="full-border"  scope="col">SALDO SEBELUMNYA</td>
    <td width="8%" class="full-border"  scope="col">&nbsp;</td>
    <td width="12%" class="full-border"  scope="col">&nbsp;</td>
    <td width="10%" align="right" class="full-border"  scope="col">&nbsp;</td>
    <td align="right" class="full-border"  scope="col">&nbsp;</td>
    <td width="8%" align="right" class="full-border"  scope="col">&nbsp;</td>
    <td width="10%" align="right" class="full-border"  scope="col">&nbsp;</td>
    <td width="11%" align="right" class="full-border"  scope="col"><?php 
		$saldo_sebelum = $this->dm->saldo_sebelum($periode,$bulan); 
		echo rupiah($saldo_sebelum);
		$saldo =  $saldo_sebelum;
	?></td>
  </tr>
  <?php 
  $i=0;
  
   $saldo_triwulan =0;
   
  foreach($record->result() as $row) : 
  $saldo = $saldo + ($row->m11 + $row->m12)  - ($row->k21 + $row->k22 + $row->k23);
 // $saldo1  = $saldo;
 // $saldo = $saldo +  ($row->masuk - $row->keluar);
 // $saldo = null;
  
  $saldo_triwulan += ( ($row->m11 + $row->m12)  - ($row->k21 + $row->k22 + $row->k23)  );
  $i++;
  ?>
 
  <tr>
    <td class="full-border"  scope="col"><?php echo  $i; ?></td>
    <td width="8%" class="full-border"  scope="col"><?php echo flipdate($row->tanggal); ?></td>
    <td width="19%" class="full-border"  scope="col"><?php echo $row->transaksi; ?></td>
    <td width="8%" class="full-border"  scope="col"><?php echo $row->no_bukti; ?></td>
    <td width="12%" align="right" class="full-border"  scope="col"><?php echo   rupiah($row->m11); ?></td>
    <td width="10%" align="right" class="full-border"  scope="col"><?php echo   rupiah($row->m12); ?></td>
    <td align="right" class="full-border"  scope="col"><?php echo   rupiah($row->k21); ?></td>
    <td width="8%" align="right" class="full-border"  scope="col"><?php echo rupiah($row->k22); ?></td>
    <td align="right" class="full-border"  scope="col"><?php echo rupiah($row->k23); ?></td>
    <td width="11%" align="right" class="full-border"  scope="col"><?php echo rupiah($saldo); // echo "<br /> $saldo += ($row->masuk - $row->keluar);"; ?></td>
  </tr>
 
  <?php
  	endforeach;
  ?>
  

  
  
  
   <tr>
    <td class="full-border"  scope="col">&nbsp;</td>
    <td class="full-border"  scope="col">&nbsp;</td>
    <td class="full-border"  scope="col">&nbsp;</td>
    <td class="full-border"  scope="col">&nbsp;</td>
    <td class="full-border"  scope="col">&nbsp;</td>
    <td align="right" class="full-border"  scope="col">&nbsp;</td>
    <td align="right" class="full-border"  scope="col">&nbsp;</td>
    <td align="right" class="full-border"  scope="col">&nbsp;</td>
    <td align="right" class="full-border"  scope="col">&nbsp;</td>
    <td align="right" class="full-border"  scope="col"><?php echo rupiah($saldo); ?></td>
  </tr>
   <tr>
     <td colspan="5" align="right" class="full-border"  scope="col"><b>SALDO     <?php echo $nama_periode; ?> </b> </td>
     <td align="right" class="full-border"  scope="col">&nbsp;</td>
     <td align="right" class="full-border"  scope="col">&nbsp;</td>
     <td align="right" class="full-border"  scope="col">&nbsp;</td>
     <td align="right" class="full-border tebal"  scope="col">&nbsp;</td>
     <td align="right" class="full-border tebal"  scope="col"><?php echo rupiah($saldo_triwulan); ?></td>
   </tr>
   <tr>
     <td colspan="5" align="right" class="full-border tebal"  scope="col"> SALDO SEBELUMNYA </td>
     <td align="right" class="full-border"  scope="col">&nbsp;</td>
     <td align="right" class="full-border"  scope="col">&nbsp;</td>
     <td align="right" class="full-border tebal"  scope="col">&nbsp;</td>
     <td align="right" class="full-border tebal"  scope="col">&nbsp;</td>
     <td align="right" class="full-border tebal"  scope="col"> &nbsp;<?php echo rupiah($saldo_sebelum ); ?></td>
   </tr>
   <tr>
     <td colspan="5" align="right" class="full-border tebal"  scope="col">SALDO S/D <?php echo $nama_periode; ?></td>
     <td align="right" class="full-border"  scope="col">&nbsp;</td>
     <td align="right" class="full-border"  scope="col">&nbsp;</td>
     <td align="right" class="full-border tebal"  scope="col">&nbsp;</td>
     <td align="right" class="full-border tebal"  scope="col">&nbsp;</td>
     <td align="right" class="full-border tebal"  scope="col"><?php echo rupiah($saldo_triwulan + $saldo_sebelum); ?></td>
   </tr>
  </TBODY>
</table>
