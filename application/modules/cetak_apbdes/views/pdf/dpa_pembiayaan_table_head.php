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


table.cetak th {
	border : 1px solid #000;
}

table.cetak td {
	/*border-left : 1px solid #000;
	border-right : 1px solid #000;*/
	border:0.5px solid #000;
	
}
</style>
<table width="100%" border="0" cellpadding="3" class="cetak">
  <thead>
    <tr>
      <th width="9%" align="center" scope="col"><strong>KODE REKENING</strong></th>
      <th width="47%" align="center" scope="col"><strong>URAIAN</strong></th>
      <th width="14%" align="center" scope="col"><strong>JUMLAH<br />
        (RP)</strong></th>
    </tr>
    <tr>
      <th align="center"><strong>1</strong></th>
      <th align="center"><strong>2</strong></th>
      <th align="center"><strong>6</strong></th>
    </tr>
  </thead>
  <?php 
   $class = "";
  foreach($rec_penjabaran_pendapatan->result() as $pendapatan) : 
  if($pendapatan->has_child == 1) {
    $class  = "tebal";
  $jumlah = $this->add->subtotal2($pendapatan->id,"v_pendapatan","total",$tahun,$id_desa);
  }
  else {
    $class = "";
  $jumlah = $pendapatan->total;
  }
  ?>
  <?php endforeach; ?>
</table>
 