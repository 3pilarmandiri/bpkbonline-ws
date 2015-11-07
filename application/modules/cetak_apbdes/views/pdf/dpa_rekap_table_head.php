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
<table width="100%" border="1" cellpadding="2" class="cetak">
 	<thead>
    <tr>
      <th width="7%" rowspan="2" align="center" scope="col"><strong>KODE PROGRAM KEGIATAN</strong></th>
      <th width="29%" rowspan="2" align="center" scope="col"><strong><br>
      URAIAN</strong></th>
      <th width="9%" rowspan="2" align="center" scope="col"><strong>LOKASI KEGIATAN</strong></th>
      <th width="5%" rowspan="2" align="center" scope="col"><strong>TARGET KERJA</strong></th>
      <th width="8%" rowspan="2" align="center" scope="col"><strong>SUMBER DANA</strong></th>
      <th colspan="4" align="center" scope="col" width="32%"><strong>TRIWULAN</strong></th>
      <th width="10%" rowspan="2" align="center" scope="col"><strong><br>
      JUMLAH</strong></th>
    </tr> 
    <tr>
      <th width="8%" align="center" scope="col"><strong>I</strong></th>
      <th width="8%" align="center" scope="col"><strong>II</strong></th>
      <th width="8%" align="center" scope="col"><strong>III</strong></th>
      <th width="8%" align="center" scope="col"><strong>IV</strong></th>
    </tr>
    <tr>
      <th align="center" scope="col"><strong>1</strong></th>
      <th align="center" scope="col"><strong>2</strong></th>
      <th align="center" scope="col"><strong>3</strong></th>
      <th align="center" scope="col"><strong>4</strong></th>
      <th align="center" scope="col"><strong>5</strong></th>
      <th align="center" scope="col"><strong>6</strong></th>
      <th align="center" scope="col"><strong>7</strong></th>
      <th align="center" scope="col"><strong>8</strong></th>
      <th align="center" scope="col"><strong>9</strong></th>
      <th align="center" scope="col"><strong>10</strong></th>
    </tr>
    
    </thead>
    </table>