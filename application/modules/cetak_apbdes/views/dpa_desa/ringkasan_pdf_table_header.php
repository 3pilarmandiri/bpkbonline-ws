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

<table width="100%"  border="1" cellpadding="3">
<thead>
  <tr>
    <th width="18%" align="center" valign="middle" class="double"><br />
      <br />
      NO.  URUT</th>
    <th width="65%" align="center" valign="middle" class="double"><br />
      <br />
      URAIAN</th>
    <th width="17%" align="center" valign="middle" class="double"><br />
      TAHUN <br />
      BERJALAN <br>
      (RP)</th>
    </tr>
  <tr>
    <th class="full-border">1</th>
    <th class="full-border">2</th>
    <th class="full-border">4</th>
    </tr>
  </thead>
  </table>