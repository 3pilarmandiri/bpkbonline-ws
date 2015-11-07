<html>
<head>
<!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url("assets") ?>/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>SISTEM KEUANGAN DESA</title>
</head>
<body>
<table width="59%" class="logtable">
  <?php 
  foreach($rec_kecamatan->result() as $row): 
  ?>
  <tr>
    <td width="81%"><strong><?php echo $row->kecamatan; ?></strong></td>
    <td width="19%">&nbsp;</td>
  </tr>
  <?php 
  $rec_desa = $this->dm->get_data_desa($row->id);
  	$belum = 0;
	$sudah = 0;
  	foreach($rec_desa->result() as $row_desa ) :
	if($row_desa->jumlah == "0") { 
		$belum++;
	} 
	else {
		$sudah++;
	}
  ?>
  <tr>
    <td><?php echo $row_desa->desa; ?></td>
    <td><?php echo ($row_desa->jumlah == 0)?"Belum":"Sudah"; // echo "xx = ".$row_desa->jumlah ?></td>
  </tr>
  <?php endforeach; ?>
  <tr>
    <td><strong>Jumlah yang sudah</strong></td>
    <td><strong><?php echo $sudah; ?></strong></td>
  </tr>
  <tr>
    <td><strong>Jumlah yang belum </strong></td>
    <td><strong><?php echo $belum; ?></strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php 
  endforeach;
  ?>
</table>
</body>


 <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  <!-- Bootstrap Core JavaScript -->
  <script src="<?php echo base_url("assets") ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url("assets") ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 <?php 
$this->load->view("js/global_js");
 ?>
</html>