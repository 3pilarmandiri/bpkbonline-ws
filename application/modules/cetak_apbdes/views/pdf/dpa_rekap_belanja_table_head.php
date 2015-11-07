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
      <th width="16%" align="center" scope="col"><strong>KODE REKENING</strong></th>
      <th width="70%" align="center" scope="col"><strong>      URAIAN</strong></th>
      <th width="14%" align="center" scope="col"><strong>JUMLAH </strong></th>
      </tr>
    <tr>
      <th align="center" scope="col"><strong>1</strong></th>
      <th align="center" scope="col"><strong>2</strong></th>
      <th align="center" scope="col"><strong>3</strong></th>
      </tr>
    
    </thead>
    </table>