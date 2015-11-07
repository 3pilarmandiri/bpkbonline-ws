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
<?php 
$tmp_kode = explode(".",$detail_kegiatan['kode']);
//show_array($tmp_kode); exit;
?>
<table width="100%" border="1" class="kop">
  <tr>
    
    <td  height="62" align="center"  ><table width="100%" border="0">
      <tr>
        <td width="3%">&nbsp;</td>
        <td width="8%"><br />          <br />          <img src="<?php echo base_url(); ?>/assets/images/ksb-header.png" width="42" height="47" align="middle" /></td>
        <td width="74%" align="center"><strong><br />
SURAT PERMINTAAN PEMBAYARAN (SPP)<br />
DESA <?php echo $data_desa->desa; ?><br>
KECAMATAN 
        <?php echo $data_desa->kecamatan; ?></strong></td>
        <td width="15%" align="center"><br />
          <strong><br />
            <br />
          </strong></td>
        </tr>
    </table></td>
  </tr>
</table>
<br />
<table width="100%" border="1" cellpadding="3" class="kop">
  <tr>
    <td width="100%" align="center"><strong>PEMERINTAH <?php echo $data_desa->kota; ?><br>
      <font size="8pt">  TAHUN ANGGARAN <?php echo $this->session->userdata("tahun_anggaran"); ?>
      </font>
    </strong><br />
      
 </td>
  </tr>
  <tr>
    <td><table width="100%" border="0" class="kop">
      <tr>
        <td width="23%">  <strong>KECAMATAN</strong></td>
        <td width="1%">:</td>
        <td width="14%"><?php echo $data_desa->kode_kecamatan;?></td>
        <td width="62%"><?php echo $data_desa->kecamatan;?></td>
      </tr>
      <tr>
        <td>  <strong>DESA</strong></td>
        <td>:</td>
        <td><?php echo $data_desa->kode_kecamatan;?>.<?php echo $data_desa->kode_desa;?></td>
        <td><?php echo $data_desa->desa;?></td>
      </tr>
      <tr>
        <td>  <strong>BIDANG</strong></td>
        <td>:</td>
        <td><?php echo $data_desa->kode_kecamatan.".".$data_desa->kode_desa.".".$detail_bidang['kode'] ?></td>
        <td><?php echo $detail_bidang['nama'] ?></td>
      </tr>
      <tr>
        <td>  <strong>KEGIATAN</strong></td>
        <td>:</td>
        <td><?php echo $data_desa->kode_kecamatan.".".$data_desa->kode_desa.".".$detail_kegiatan['kode'] ?></td>
        <td><?php echo $detail_kegiatan['kegiatan'] ?></td>
      </tr>
      <tr>
        <td>  <strong>WAKTU PELAKSANAAN </strong></td>
        <td>: </td>
        <td colspan="2"><?php echo $tanggal; ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="judul"><strong>SURAT PERMINTAAN PEMBAYARAN (SPP)</strong></td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="3" class="cetak">
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
      <th align="center"><strong>3</strong></th>
      <th align="center"><strong>4</strong></th>
      <th align="center"><strong>5</strong></th>
      <th align="center"><strong>6</strong></th>
      <th align="center"><strong>7</strong></th>
    </tr>
      </thead>
    <tbody>  
    <?php foreach($record->result() as $row):  
	// $sd_lalu = $this->dm->jumlah_sd(flipdate($tanggal),$row->id,$row->tahun,$row->id_desa);
	// $sd_sekarang = $sd_lalu + $row->jumlah;
	// $sisa = $row->total - $sd_sekarang;
		$total = $row->total; 
      // $jumlah = intval($row->jumlah); 
    if($row->has_child==1) {
      //  echo "hangsat..";
        //$total = $this->add->get_total_by_id("perubahan_belanja","total",$row->id,$this->id_desa,$this->tahun);
		//$total = $this->add->subtotal_($row->id,"perubahan_belanja","total",$this->tahun,$this->id_desa );
        $jumlah = intval($this->dm->subtotal($tanggal,$row->id,$this->tahun,$this->id_desa ));
        $jumlah_sd = intval($this->dm->jumlah_sd_subtotal($tanggal,$row->id,$this->tahun,$this->id_desa )); 

        // $responce->rows[$i]['total']  = "<b>".rupiah($total)."</b>";
        // $responce->rows[$i]['jumlah']  = intval($this->dm->subtotal($tanggal,$result[$i]['id'],$tahun,$id_desa ));
        // $responce->rows[$i]['jumlah_sd']  = intval($this->dm->jumlah_sd_subtotal($tanggal,$result[$i]['id'],$tahun,$id_desa )); 
        $class="tebal";
      }
      else {
       /*$total = $row->total; 
       $jumlah = intval($row->jumlah); */
       $jumlah_sd = intval($this->dm->jumlah_sd($tanggal,$row->id,$this->tahun,$id_desa ));
       $class  = "";
      }

      $jumlah_semua = $jumlah_sd  + $jumlah;
      $sisa  = $total - $jumlah_semua;
      


	
	?>
    <tr>
      <td class="<?php echo $class ?>" width="10%"  align="left"><?php echo $row->kode; ?></td>
      <td class="<?php echo $class ?>" width="31%" ><?php echo $row->nama; ?></td>
      <td class="<?php echo $class ?>" width="11%"  align="right"><?php echo rupiah($total); ?></td>
      <td class="<?php echo $class ?>" width="11%"  align="right"><?php echo rupiah($jumlah_sd); ?></td>
      <td class="<?php echo $class ?>" width="12%"  align="right"><?php echo rupiah($jumlah); ?></td>
      <td class="<?php echo $class ?>" width="12%"  align="right"><?php echo rupiah($jumlah_semua); ?></td>
      <td class="<?php echo $class ?>" width="13%"  align="right"><?php echo rupiah($sisa); ?></td>
    </tr>
    <?php endforeach; ?>
	</tbody>
</table>
