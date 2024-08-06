<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Transaksi_d Read</h2>
        <table class="table">
	    <tr><td>Id Transaksi H</td><td><?php echo $id_transaksi_h; ?></td></tr>
	    <tr><td>Kd Barang</td><td><?php echo $kd_barang; ?></td></tr>
	    <tr><td>Nama Barang</td><td><?php echo $nama_barang; ?></td></tr>
	    <tr><td>Qty</td><td><?php echo $qty; ?></td></tr>
	    <tr><td>Subtotal</td><td><?php echo $subtotal; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('transaksi_d') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>