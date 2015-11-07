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
  font-size:7px;
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
      <th width="10%" align="center" scope="col"><strong>KODE <br />
      REKENING</strong></th>
      <th width="31%" align="center" scope="col"><strong>URAIAN</strong></th>
      <th width="11%" align="center" scope="col"><strong>PAGU</strong></th>
      <th width="11%" align="center" scope="col"><strong>PENCAIRAN <br>
      S.D LALU</strong></th>
      <th width="12%" align="center" scope="col"><strong>PERMINTAAN SEKARANG</strong></th>
      <th width="12%" align="center" scope="col"><strong>JUMLAH S.D<br>
SAAT INI </strong></th>
      <th width="13%" align="center" scope="col"><strong>SISA DANA<br />
      </strong></th>
    </tr>
    <tr>
      <th align="center"><strong>1</strong></th>
      <th align="center"><strong>2</strong></th>
      <th align="center">3</th>
      <th align="center">4</th>
      <th align="center">5</th>
      <th align="center">6</th>
      <th align="center"><strong>7</strong></th>
    </tr>
      </thead>
  </table>