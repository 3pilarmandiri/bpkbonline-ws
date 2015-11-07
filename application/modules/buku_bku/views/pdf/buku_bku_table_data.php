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
        <td width="82%" align="center" valign="top"><b> <font size="8px">  PEMERINTAH <?php echo $data_desa->kota; ?> KECAMATAN <?php echo $data_desa->kecamatan ?>  <br />
DESA <?php echo $data_desa->desa ?> </font> <font size="12px"> <br />
            BUKU KAS UMUM<br />
          </font> <font size="10px"> <?php if($periode=="y") { 
	echo "TAHUN ANGGARAN ".$tahun;
} else { ?>
PERIODE <?php echo $nama_periode; ?> TAHUN <?php echo $tahun; } ?></font></b></td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<table class="cetak" width="100%" border="0" cellpadding="3">
  <thead>
    <tr>
      <th width="3%" align="center" class="full-border" scope="col"><strong><br>
        NO</strong></th>
      <th  width="10%" align="center" class="full-border" scope="col"><strong><br>
        TANGGAL</strong></th>
      <th  width="10%" align="center" class="full-border" scope="col"><strong><br>
        KODE REKENING</strong></th>
      <th  width="25%" align="center" class="full-border" scope="col"><strong><br>
        URAIAN</strong></th>
      <th  width="12%" align="center" class="full-border" scope="col"><strong><br>
        PEMASUKAN</strong></th>
      <th  width="10%" align="center" class="full-border" scope="col"><strong><br>
        PENGELUARAN </strong></th>
      <th  width="10%" align="center" class="full-border" scope="col"><strong><br>
        NO. BUKTI</strong></th>
      <th  width="10%" align="center" class="full-border" scope="col"><strong>JUMLAH PENGELUARAN KOMULATIR</strong></th>
      <th  width="10%" align="center" class="full-border" scope="col"><strong><br>
        SALDO</strong></th>
    </tr>
    <tr>
      <th width="3%" align="center" class="full-border"  scope="col">1</th>
      <th width="10%" align="center" class="full-border"  scope="col">2</th>
      <th width="10%" align="center" class="full-border"  scope="col">3</th>
      <th width="25%" align="center" class="full-border"  scope="col">4</th>
      <th width="12%" align="center" class="full-border"  scope="col">5</th>
      <th width="10%" align="center" class="full-border"  scope="col">6</th>
      <th width="10%" align="center" class="full-border"  scope="col">7</th>
      <th width="10%" align="center" class="full-border"  scope="col">8</th>
      <th width="10%" align="center" class="full-border"  scope="col">9</th>
    </tr>
  </thead>
  <TBODY>
    <?php if($periode<>"y") :  ?>
    <tr>
      <td width="3%" class="full-border"  scope="col">&nbsp;</td>
      <td width="10%" class="full-border"  scope="col">&nbsp;</td>
      <td width="10%" class="full-border"  scope="col">&nbsp;</td>
      <td width="25%" class="full-border"  scope="col">SALDO SEBELUMNYA </td>
      <td width="12%" align="right" class="full-border"  scope="col"><?php 
		$saldo_sebelum = $this->dm->saldo_sebelum($periode,$bulan); 
		echo rupiah($saldo_sebelum);
		$saldo = $saldo_sebelum;
		?></td>
      <td width="10%" align="right" class="full-border"  scope="col">&nbsp;</td>
      <td width="10%" align="right" class="full-border"  scope="col">&nbsp;</td>
      <td width="10%" align="right" class="full-border"  scope="col">&nbsp;</td>
      <td width="10%" align="right" class="full-border"  scope="col"><?php 
		$saldo_sebelum = $this->dm->saldo_sebelum($periode,$bulan); 
		echo rupiah($saldo_sebelum);
		$saldo = $saldo_sebelum;
		?></td>
    </tr>
    <?php 
  endif;
  
  $jumlah_masuk =$saldo;
  
  $i=0;
  $jumlah_komulatif=0;
  foreach($record->result() as $row) :  
  $i++;
  $jumlah_komulatif += $row->keluar;
  $saldo += ($row->masuk - $row->keluar);
  $jumlah_masuk += $row->masuk;
  ?>
    <tr>
      <td  width="3%"  class="full-border"  scope="col"><?php echo $i; ?></td>
      <td width="10%"  class="full-border"  scope="col"><?php echo flipdate($row->tanggal); ?></td>
      <td width="10%"   class="full-border"  scope="col"><?php echo $row->kode; ?></td>
      <td width="25%"  class="full-border"  scope="col"><?php echo $row->uraian; ?></td>
      <td width="12%"  align="right" class="full-border"  scope="col"><?php echo rupiah($row->masuk); ?></td>
      <td width="10%"  align="right" class="full-border"  scope="col"><?php echo rupiah($row->keluar); ?></td>
      <td width="10%"  align="right" class="full-border"  scope="col"><?php echo $row->no_bukti; ?></td>
      <td width="10%"  align="right" class="full-border"  scope="col"><?php echo rupiah($jumlah_komulatif); ?></td>
      <td width="10%"  align="right" class="full-border"  scope="col"><?php echo rupiah($saldo); ?></td>
    </tr>
    <?php endforeach;  ?>
    <tr>
      <td colspan="4"  class="full-border"  scope="col"><strong>JUMLAH</strong></td>
      <td  align="right" class="full-border"  scope="col"><strong><?php echo rupiah($jumlah_masuk); ?></strong></td>
      <td  align="right" class="full-border"  scope="col"><strong><?php echo rupiah($jumlah_komulatif); ?></strong></td>
      <td  align="right" class="full-border"  scope="col">&nbsp;</td>
      <td  align="right" class="full-border"  scope="col">&nbsp;</td>
      <td  align="right" class="full-border"  scope="col">&nbsp;</td>
    </tr>
  </TBODY>
</table>
<br />
<br />
<br />
