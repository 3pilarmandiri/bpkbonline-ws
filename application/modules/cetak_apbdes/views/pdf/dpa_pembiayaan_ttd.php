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

<p>&nbsp;</p>
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
