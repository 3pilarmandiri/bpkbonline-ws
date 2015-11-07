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
  </table>