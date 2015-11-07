<?php 
	$tahun=$this->session->userdata("tahun_anggaran");
	$tahun_sebelum = $tahun - 1;
	$id_desa  = $this->session->userdata("id_desa");
	$data_desa = $this->cm->data_desa();
?>
<style>
body{
 }
th  {
 font-size: 6px;
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
/*	border:#000 solid 3px;
	border-style:double;*/
}

table.cetak td {
	 
	border:0.5px solid #000;
	
} 

hr {
	margin:10px 0px;
}

/*.double {
	
}*/

.double {
	font-size:8px;
}
</style>

<table width="100%" border="1" cellpadding="3" class="cetak">
   <thead>
    <tr class="tebal">
      <th    width="12%"  align="center" valign="middle" class="double1" scope="col"> KODE REKENING <br /></th>
      <th   width="35%" align="center" valign="middle" class="double1" scope="col"><br />
          <br />
        URAIAN <br /></th>
      <th   width="11%" align="center" valign="middle" class="double1" scope="col"><br />
          <br />
        SATUAN</th>
      <th    width="9%" align="center" valign="middle" class="double1" scope="col"><br />
          <br />
        VOLUME</th>
      <th    width="12%" align="center" valign="middle" class="double1" scope="col">HARGA SATUAN (RP)</th>
      <th    width="13%" align="center" valign="middle" class="double1" scope="col">JUMLAH <br />
        (RP)</th>
      <th    width="8%" align="center" valign="middle" class="double1" scope="col"><br />
          <br />
        KET.<br /></th>
    </tr>
    <tr>
      <th align="center" class="tebal" scope="col">1</th>
      <th align="center" class="tebal" scope="col">2</th>
      <th align="center" class="tebal" scope="col">3</th>
      <th align="center" class="tebal" scope="col">4</th>
      <th align="center" class="tebal" scope="col">5</th>
      <th align="center" class="tebal" scope="col">6</th>
      <th align="center" class="tebal" scope="col">7</th>
    </tr>
  </thead>
 
  </table>