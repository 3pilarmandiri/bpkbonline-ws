<?php 
	$tahun=$this->session->userdata("tahun_anggaran");
	$tahun_sebelum = $tahun - 1;
	$id_desa  = $this->session->userdata("id_desa");
	$data_desa = $this->cm->data_desa();
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
</style>

<table width="100%" border="1" cellpadding="3" class="cetak">
  <thead>
    <tr>
      <th class="full-border" width="9%" scope="col">KODE REKENING</th>
      <th class="full-border" width="40%" scope="col">URAIAN </th>
      <th class="full-border" width="11%" scope="col">JUMLAH</th>
      <th class="full-border" width="40%" scope="col">KETERANGAN</th>
    </tr>
    <tr>
      <th class="full-border" scope="col">1</th>
      <th class="full-border" scope="col">2</th>
      <th class="full-border" scope="col">3</th>
      <th class="full-border" scope="col">4</th>
    </tr>
  </thead>
 
  </table>