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

<table class="cetak" width="100%"  border="1" cellpadding="3">
<thead>
    <tr>
      <th width="9%" align="center" scope="col">KODE REKENING</th>
      <th width="45%" align="center" scope="col">URAIAN</th>
      <th width="12%" align="center" scope="col">JUMLAH ANGGARAN</th>
      <th width="12%" align="center" scope="col">JUMLAH REALISASI</th>
      <th width="14%" align="center" scope="col">LEBIH/KURANG</th>
      <th width="8%" align="center" scope="col">KET</th>
    </tr>
    <tr>
      <th width="9%" align="center">1</th>
      <th width="45%" align="center">2</th>
      <th width="12%" align="center">3</th>
      <th width="12%" align="center">4</th>
      <th width="14%" align="center">5</th>
      <th width="8%" align="center">6</th>
    </tr>
  </thead>
  </table>