  <?php 
  $tahun=$this->session->userdata("tahun_anggaran");
  $tahun_sebelum = $tahun - 1;
  $id_desa  = $this->session->userdata("id_desa");
  $data_desa = $this->cm->data_desa();
?>

<style>
body{
	border : 1px solid #000;
}
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
}

table.cetak td {
	/*border-left : 1px solid #000;
	border-right : 1px solid #000;*/
	border:0.5px solid #000;
	
}
</style>
<?php 
$pendapatan['t1'] = $this->add->get_total_by_id("pendapatan","t1","1",$this->id_desa,$this->tahun);
//$this->add->subtotal_tw("1","v_pendapatan","t1",$tahun,$id_desa) ;
$pendapatan['t2'] = $this->add->get_total_by_id("pendapatan","t2","1",$this->id_desa,$this->tahun);
$pendapatan['t3'] = $this->add->get_total_by_id("pendapatan","t3","1",$this->id_desa,$this->tahun);
$pendapatan['t4'] = $this->add->get_total_by_id("pendapatan","t4","1",$this->id_desa,$this->tahun);
$pendapatan['total'] = $this->add->get_total_by_id("pendapatan","total","1",$this->id_desa,$this->tahun);

$belanja['t1'] = $this->add->get_total_by_id("belanja","t1","2",$this->id_desa,$this->tahun);
//$this->add->subtotal_tw("2","v_belanja","t1",$tahun,$id_desa) ;
$belanja['t2'] = $this->add->get_total_by_id("belanja","t2","2",$this->id_desa,$this->tahun);
$belanja['t3'] = $this->add->get_total_by_id("belanja","t3","2",$this->id_desa,$this->tahun);
$belanja['t4'] = $this->add->get_total_by_id("belanja","t4","2",$this->id_desa,$this->tahun);
$belanja['total'] = $this->add->get_total_by_id("belanja","total","2",$this->id_desa,$this->tahun);

$pembiayaan_masuk['t1'] = $this->add->get_total_by_id("pembiayaan","t1","3_1",$this->id_desa,$this->tahun);
//$this->add->subtotal_tw("3_1","v_pembiayaan","t1",$tahun,$id_desa) ;
$pembiayaan_masuk['t2'] = $this->add->get_total_by_id("pembiayaan","t2","3_1",$this->id_desa,$this->tahun);
$pembiayaan_masuk['t3'] = $this->add->get_total_by_id("pembiayaan","t3","3_1",$this->id_desa,$this->tahun);
$pembiayaan_masuk['t4'] = $this->add->get_total_by_id("pembiayaan","t4","3_1",$this->id_desa,$this->tahun);
$pembiayaan_masuk['total'] = $this->add->get_total_by_id("pembiayaan","total","3_1",$this->id_desa,$this->tahun);

$pembiayaan_keluar['t1'] = $this->add->get_total_by_id("pembiayaan","t1","3_2",$this->id_desa,$this->tahun);
$pembiayaan_keluar['t2'] = $this->add->get_total_by_id("pembiayaan","t2","3_2",$this->id_desa,$this->tahun);
$pembiayaan_keluar['t3'] = $this->add->get_total_by_id("pembiayaan","t3","3_2",$this->id_desa,$this->tahun);
$pembiayaan_keluar['t4'] = $this->add->get_total_by_id("pembiayaan","t4","3_2",$this->id_desa,$this->tahun);
$pembiayaan_keluar['total'] = $this->add->get_total_by_id("pembiayaan","total","3_2",$this->id_desa,$this->tahun);

$pembiayaan['t1'] = $pembiayaan_masuk['t1']  -  $pembiayaan_keluar['t1'];
$pembiayaan['t2'] = $pembiayaan_masuk['t2']  -  $pembiayaan_keluar['t2'];
$pembiayaan['t3'] = $pembiayaan_masuk['t3']  -  $pembiayaan_keluar['t3'];
$pembiayaan['t4'] = $pembiayaan_masuk['t4']  -  $pembiayaan_keluar['t4'];
$pembiayaan['total'] = $pembiayaan_masuk['total']  -  $pembiayaan_keluar['total'];

?>
<table width="100%" border="0" cellpadding="3" class="cetak">
  <tr>
    <th colspan="7" scope="col">Rencana Pelaksaan Anggaran <br />
      Desa Per Triwulan </th>
  </tr>
  <tr>
    <th width="6%" rowspan="2" align="center" scope="col"><br />
        <br />
      NO</th>
    <th width="28%" rowspan="2" align="center" scope="col"><br />
        <br />
      URAIAN</th>
    <th colspan="5" align="center" scope="col" width="66%">TRIWULAN</th>
  </tr>
  <tr>
    <th width="14%" align="center" scope="col">I</th>
    <th width="12%" align="center" scope="col">II</th>
    <th width="12%" align="center" scope="col">III</th>
    <th width="12%" align="center" scope="col">IV</th>
    <th width="16%" align="center" scope="col">JUMLAH</th>
  </tr>
  <tr>
    <th align="center" scope="col">1</th>
    <th align="center" scope="col">2</th>
    <th align="center" scope="col">3</th>
    <th align="center" scope="col">4</th>
    <th align="center" scope="col">5</th>
    <th align="center" scope="col">6</th>
    <th align="center" scope="col">7 = 3 + 4 + 5 + 6</th>
  </tr>
  <tr>
    <td align="center" scope="col">1</td>
    <td scope="col">Pendapatan</td>
    <td align="right" scope="col"><?php echo rupiah($pendapatan['t1']); ?></td>
    <td align="right" scope="col"><?php echo rupiah($pendapatan['t2']); ?></td>
    <td align="right" scope="col"><?php echo rupiah($pendapatan['t3']); ?></td>
    <td align="right" scope="col"><?php echo rupiah($pendapatan['t4']); ?></td>
    <td align="right" scope="col"><?php echo rupiah($pendapatan['total']); ?></td>
  </tr>
  <tr>
    <td align="center" scope="col">2</td>
    <td scope="col">Belanja</td>
    <td align="right" scope="col"><?php echo rupiah($belanja['t1']); ?></td>
    <td align="right" scope="col"><?php echo rupiah($belanja['t2']); ?></td>
    <td align="right" scope="col"><?php echo rupiah($belanja['t3']); ?></td>
    <td align="right" scope="col"><?php echo rupiah($belanja['t4']); ?></td>
    <td align="right" scope="col"><?php echo rupiah($belanja['total']); ?></td>
  </tr>
  <tr>
    <td align="center" scope="col">3.1</td>
    <td scope="col">Penerimaan Pembiayaan</td>
    <td align="right" scope="col"><?php echo rupiah($pembiayaan_masuk['t1']); ?></td>
    <td align="right" scope="col"><?php echo rupiah($pembiayaan_masuk['t2']); ?></td>
    <td align="right" scope="col"><?php echo rupiah($pembiayaan_masuk['t3']); ?></td>
    <td align="right" scope="col"><?php echo rupiah($pembiayaan_masuk['t4']); ?></td>
    <td align="right" scope="col"><?php echo rupiah($pembiayaan_masuk['total']); ?></td>
  </tr>
  <tr>
    <td align="center" scope="col">3.2</td>
    <td scope="col">Pengeluaran Pembiayaan </td>
    <td align="right" scope="col"><?php echo rupiah($pembiayaan_keluar['t1']); ?></td>
    <td align="right" scope="col"><?php echo rupiah($pembiayaan_keluar['t2']); ?></td>
    <td align="right" scope="col"><?php echo rupiah($pembiayaan_keluar['t3']); ?></td>
    <td align="right" scope="col"><?php echo rupiah($pembiayaan_keluar['t4']); ?></td>
    <td align="right" scope="col"><?php echo rupiah($pembiayaan_keluar['total']); ?></td>
  </tr>
</table>
<table width="100%" border="1" cellpadding="3" class="cetak">
  <tr>
    <td width="49%"><h4><span class="tebal full-border"><?php echo $ttd_title; ?></span></h4></td>
    <td width="51%" rowspan="2" align="center" valign="top"><span class="full-border"><?php echo "$data_desa->desa, ". date("d-m-Y");?><br />
      KEPALA DESA <?php echo strtoupper($data_desa->desa); ?> <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <b><?php echo $data_desa->nama_kepala_desa;?></b> <br />
    </span></td>
  </tr>
  <tr>
    <td valign="top"><table  width="84%" border="0">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
       
      </tr>
      <tr>
        <td width="48%">Triwulan I</td>
        <td width="11%">Rp</td>
        <td width="41%" align="right"><?php echo rupiah($t1); ?></td>
      </tr>
      <tr>
        <td>Triwulan II</td>
        <td>Rp</td>
        <td align="right"><?php echo rupiah($t2); ?></td>
      </tr>
      <tr>
        <td>Triwulan III</td>
        <td>Rp</td>
        <td align="right"><?php echo rupiah($t3); ?></td>
      </tr>
      <tr>
        <td>Triwulan IV</td>
        <td>Rp</td>
        <td align="right"><?php echo rupiah($t4); ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td>Jumlah</td>
        <td>Rp</td>
        <td align="right"><?php echo rupiah($total); ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" class="cetak">
  <tr>
    <th colspan="4" align="center" scope="col">TIM PENDAMPING KECAMATAN</th>
  </tr>
  <tr>
    <th width="5%" align="center" scope="col">NO.</th>
    <th width="25%" align="center" scope="col">NAMA / NIP </th>
    <th width="41%" align="center" scope="col">JABATAN / KEDUDUKAN</th>
    <th width="29%" align="center" scope="col">TANDA TANGAN</th>
  </tr>
  <?php 
 $rec = $this->cm->get_verifikatur();
 $i=0;
 foreach($rec->result() as $row) : 
 $i++;
 $align = ($i%2==0)?"right":"left";
 ?>
  <tr>
    <td scope="col"><?php echo $i; ?></td>
    <td scope="col"><?php echo $row->nama ?><br />
      NIP. <?php echo $row->nip ?> </td>
    <td scope="col"><?php echo $row->jabatan ?> / <br />
        <?php echo $row->kedudukan ?></td>
    <td scope="col" align="<?php echo $align; ?>"><br />
        <br />
        <?php echo $i ?>.................................</td>
  </tr>
  <?php endforeach; ?>
</table>
<p>&nbsp;</p>
