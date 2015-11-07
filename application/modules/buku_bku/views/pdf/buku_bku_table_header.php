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
    <th class="full-border" width="3%" scope="col">NO</th>
    <th class="full-border"  width="10%" scope="col">NOMOR BUKTI</th>
    <th class="full-border"  width="9%" scope="col"> TANGGAL</th>
    <th class="full-border"  width="9%" scope="col">KODE REKENING </th>
    <th class="full-border"  width="7%" scope="col">PROG/<br />
      KEG</th>
    <th class="full-border"  width="27%" scope="col">KETERANGAN</th>
    <th class="full-border"  width="11%" scope="col">PEMASUKAN</th>
    <th class="full-border"  width="12%" scope="col">PENGELUARAN </th>
    <th class="full-border"  width="12%" scope="col">SALDO</th>
  </tr>
  <thead>
  </table>