 <?php 
  $tahun=$this->session->userdata("tahun_anggaran");
  $tahun_sebelum = $tahun - 1;
  $id_desa  = $this->session->userdata("id_desa");
  $data_desa = $this->cm->data_desa();
?>
<style>
* {
  font-size: 10px;
  font-family:  verdana;
}
.full-border {
  border  : #000 solid 1px;
}
.cetak {
  border-collapse: collapse;
  border-spacing: 1px;
  border: solid 1px #000;
}
.tebal {
	font-weight:bold;
}
</style>
<table width="100%" border="1" cellpadding="3">
  <tr>
    <th width="7%" rowspan="2" align="center" valign="middle" scope="col"><strong>NOMOR URUT</strong></th>
    <th width="43%" rowspan="2" align="center" valign="middle" scope="col"><strong>URAIAN</strong></th>
    <th width="10%" rowspan="2" align="center" valign="middle" scope="col"><strong>PAGU ANGGARAN</strong></th>
    <th  width="40%"  colspan="5" align="center" valign="middle" scope="col"><strong>TRIWULAN</strong></th>
  </tr>
  <tr>
    <th width="8%" align="center" valign="middle" scope="col"><strong>I</strong></th>
    <th width="8%" align="center" valign="middle" scope="col"><strong>II</strong></th>
    <th width="8%" align="center" valign="middle" scope="col"><strong>III</strong></th>
    <th width="8%" align="center" valign="middle" scope="col"><strong>IV</strong></th>
    <th width="4%" align="center" valign="middle" scope="col"><strong>KET</strong></th>
  </tr>
  <tr>
    <th align="center" valign="middle" scope="col"><strong>1</strong></th>
    <th align="center" valign="middle" scope="col"><strong>2</strong></th>
    <th align="center" valign="middle" scope="col"><strong>3</strong></th>
    <th align="center" valign="middle" scope="col"><strong>4</strong></th>
    <th align="center" valign="middle" scope="col"><strong>5</strong></th>
    <th align="center" valign="middle" scope="col"><strong>6</strong></th>
    <th align="center" valign="middle" scope="col"><strong>7</strong></th>
    <th align="center" valign="middle" scope="col"><strong>8</strong></th>
  </tr> 
</table>
 