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

<table class="cetak" width="100%"  border="0" cellpadding="3">
  <thead>
  <tr>
    <th class="full-border" width="4%" scope="col">NO</th>
    <th class="full-border"  width="12%" scope="col">TANGGAL</th>
    <th class="full-border"  width="14%" scope="col">NOMOR BUKTI </th>
    <th class="full-border"  width="26%" scope="col">KETERANGAN</th>
    <th class="full-border"  width="15%" scope="col">PEMASUKAN</th>
    <th class="full-border"  width="13%" scope="col">PENGELUARAN </th>
    <th class="full-border"  width="16%" scope="col">SALDO</th>
  </tr>
  <thead>
  </table>