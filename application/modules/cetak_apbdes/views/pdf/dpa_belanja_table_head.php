 <?php 
  $tahun=$this->session->userdata("tahun_anggaran");
  $tahun_sebelum = $tahun - 1;
  $id_desa  = $this->session->userdata("id_desa");
  $data_desa = $this->cm->data_desa();
  $perdes = $this->cm->perdes();
?>
<style>

.kop td, .kop th {
  font-size:8px;
   
  
}


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
<table width="100%" border="0" cellpadding="3" class="cetak" >
  <thead>
    <tr>
      <th width="9%" rowspan="2" align="center" scope="col"><strong>KODE <br />
      REKENING</strong></th>
      <th width="45%" rowspan="2" align="center" scope="col"><strong>URAIAN</strong></th>
      <th width="29%" colspan="3" align="center" scope="col"><strong>RINCINAN PERHITUNGAN</strong></th>
      <th width="17%" rowspan="2" align="center" scope="col"><strong>JUMLAH<br />
        (RP)</strong></th>
    </tr>
    <tr>
      <th width="8%" align="center"><strong>VOLUME</strong></th>
      <th width="8%" align="center"><strong>SATUAN</strong></th>
      <th width="13%" align="center"><strong>TARIF/HARGA</strong></th>
    </tr>
    <tr>
      <th align="center"><strong>1</strong></th>
      <th align="center"><strong>2</strong></th>
      <th align="center"><strong>3</strong></th>
      <th align="center"><strong>4</strong></th>
      <th align="center"><strong>5</strong></th>
      <th align="center"><strong>6</strong></th>
    </tr>
  </thead>
  </table>