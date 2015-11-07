 <?php 
  $tahun=$this->session->userdata("tahun_anggaran");
  $tahun_sebelum = $tahun - 1;
  $id_desa  = $this->session->userdata("id_desa");
  $data_desa = $this->cm->data_desa();
  $perdes = $this->cm->perdes();
?>
<style>

.kop td, .kop th {
  font-size:8px;
   
  
}


.cetak td, .cetak th {
  font-size:7px;
}
.tebal {
 font-weight:bold;
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
<?php 
$tmp_kode = explode(".",$detail_kegiatan['kode']);
//show_array($tmp_kode); exit;
?>
<table width="100%" border="1" class="kop">
  <tr>
    
    <td  height="62" align="center"  ><table width="100%" border="0">
      <tr>
        <td width="3%">&nbsp;</td>
        <td width="8%"><br />          <br />          <img src="<?php echo base_url(); ?>/assets/images/ksb-header.png" width="42" height="47" align="middle" /></td>
        <td width="74%" align="center"><strong><br /> 
        BUKU KAS PEMBANTU KEGIATAN
<br />
DESA <?php echo $data_desa->desa; ?><br>
KECAMATAN 
        <?php echo $data_desa->kecamatan; ?></strong></td>
        <td width="15%" align="center"><br />
          <strong><br />
            <br />
          </strong></td>
        </tr>
    </table></td>
  </tr>
</table>
<br />
<table width="100%" border="1" cellpadding="3" class="kop">
  <tr>
    <td width="100%" align="center"><strong>PEMERINTAH <?php echo $data_desa->kota; ?><br />
      <font size="8pt">  TAHUN ANGGARAN <?php echo $this->session->userdata("tahun_anggaran"); ?>      </font>
    </strong><br /> </td>
  </tr>
  <tr>
    <td><table width="100%" border="0" class="kop">
      <tr>
        <td width="23%">  <strong>KECAMATAN</strong></td>
        <td width="1%">:</td>
        <td width="14%"><?php echo $data_desa->kode_kecamatan;?></td>
        <td width="62%"><?php echo $data_desa->kecamatan;?></td>
      </tr>
      <tr>
        <td>  <strong>DESA</strong></td>
        <td>:</td>
        <td><?php echo $data_desa->kode_kecamatan;?>.<?php echo $data_desa->kode_desa;?></td>
        <td><?php echo $data_desa->desa;?></td>
      </tr>
      <tr>
        <td>  <strong>BIDANG</strong></td>
        <td>:</td>
        <td><?php echo $data_desa->kode_kecamatan.".".$data_desa->kode_desa.".".$detail_bidang['kode'] ?></td>
        <td><?php echo $detail_bidang['nama'] ?></td>
      </tr>
      <tr>
        <td>  <strong>KEGIATAN</strong></td>
        <td>:</td>
        <td><?php echo $data_desa->kode_kecamatan.".".$data_desa->kode_desa.".".$detail_kegiatan['kode'] ?></td>
        <td><?php echo $detail_kegiatan['kegiatan'] ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" class="cetak">
  <thead>
    <tr>
      <th width="5%" rowspan="2" align="center" scope="col"><strong><br />
        <br />
      NOMOR</strong></th>
      <th width="6%" rowspan="2" align="center" scope="col"><strong><br />
        <br />
      TANGGAL</strong></th>
      <th width="20%" rowspan="2" align="center" scope="col"><strong><br />
        <br />
      URAIAN</strong></th>
      <th colspan="2" align="center" scope="col" width="20%">PENERIMAAN</th>
      <th width="9%" rowspan="2" align="center" scope="col"><br />
        <br />
      NOMOR BUKTI</th>
      <th colspan="2" align="center" scope="col" width="20%">PENGELUARAN</th>
      <th width="10%" rowspan="2" align="center" scope="col">JUMLAH PENGEMBALIAN KE BENDAHARA</th>
      <th width="10%" rowspan="2" align="center" scope="col"><br />
        <br />
      SALDO KAS </th>
    </tr>
    <tr>
      <th width="10%" align="center" scope="col">DARI<br /> 
      BENDAHARA</th>
      <th width="10%" align="center" scope="col">SWADAYA MASYARAKAT</th>
      <th width="10%" align="center" scope="col">BELANJA BARANG DAN JASA</th>
      <th width="10%" align="center" scope="col">BELANJA <br />
      MODAL </th>
    </tr>
    <tr>
      <th align="center"><strong>1</strong></th>
      <th align="center"><strong>2</strong></th>
      <th align="center"><strong>3</strong></th>
      <th align="center">4</th>
      <th align="center">5</th>
      <th width="9%" align="center">6</th>
      <th width="10%" align="center">7</th>
      <th align="center">8</th>
      <th align="center">9</th>
      <th align="center"><strong>10</strong></th>
    </tr>
  </thead>
  <tbody>
    <?php 
	$x=0;
	$saldo=0;
	
	$tmasuk_bendahara = 0;
	$tmasuk_swadaya = 0;
	$tkeluar_barang_jasa = 0; 
	$tkeluar_modal =0;
	foreach($record->result() as $row) : 
	
	$tmasuk_bendahara += $row->masuk_bendahara;
	$tmasuk_swadaya += $row->masuk_swadaya;
	$tkeluar_barang_jasa += $row->keluar_barang_jasa ; 
	$tkeluar_modal += $row->keluar_modal;
	
	
	$saldo += ($row->masuk-$row->keluar);
	$x++;
	?>
    <tr>
      <td width="5%"  align="left"><?php echo $x; ?></td>
      <td width="6%" ><?php echo flipdate($row->tanggal); ?></td>
      <td width="20%"  ><?php echo $row->uraian; ?></td>
      <td width="10%"  align="right"><?php echo rupiah($row->masuk_bendahara); ?></td>
      <td width="10%"  align="right"><?php echo rupiah($row->masuk_swadaya); ?></td>
      <td width="9%"  align="right"><?php echo rupiah($row->uraian); ?></td>
      <td width="10%"  align="right"><?php echo rupiah($row->keluar_barang_jasa); ?></td>
      <td width="10%"  align="right"><?php echo rupiah($row->keluar_modal); ?></td>
      <td width="10%"  align="right">&nbsp;</td>
      <td width="10%"  align="right"><?php echo rupiah($saldo); ?></td>
    </tr>
   <?php 
   endforeach;
   ?> 
   <tr>
      <td width="5%"  align="left">&nbsp;</td>
      <td width="6%" >&nbsp;</td>
      <td width="20%"  >JUMLAH</td>
      <td width="10%"  align="right"><?php echo rupiah($tmasuk_bendahara); ?></td>
      <td width="10%"  align="right"><?php echo rupiah($tmasuk_swadaya); ?></td>
      <td width="9%"  align="right">&nbsp;</td>
      <td width="10%"  align="right"><?php echo rupiah($tkeluar_barang_jasa); ?></td>
      <td width="10%"  align="right"><?php echo rupiah($tkeluar_modal); ?></td>
      <td width="10%"  align="right">&nbsp;</td>
      <td width="10%"  align="right">&nbsp;</td>
    </tr>
   <tr>
     <td width="5%"  align="left">&nbsp;</td>
     <td  width="6%"  >&nbsp;</td>
     <td  width="20%" >TOTAL PENERIMAAN </td>
     <td  align="right"><?php echo rupiah(($tmasuk_bendahara   + $tmasuk_swadaya)); ?></td>
     <td  align="right">&nbsp;</td>
     <td  align="right">&nbsp;</td>
     <td width="30%" colspan="3"  align="left">TOTAL PENGELUARAN </td>
     <td  align="right"><?php echo rupiah(($tkeluar_barang_jasa   + $tkeluar_modal)); ?></td>
   </tr>
   <tr>
     <td  align="left">&nbsp;</td>
     <td >&nbsp;</td>
     <td  >&nbsp;</td>
     <td  align="right">&nbsp;</td>
     <td  align="right">&nbsp;</td>
     <td  align="right">&nbsp;</td>
     <td colspan="3"  align="left">TOTAL PENGELURAN + SALDO KAS </td>
     <td  align="right"><?php echo rupiah(( $saldo +  $tkeluar_barang_jasa   + $tkeluar_modal)); ?></td>
   </tr>
  </tbody>
</table>
