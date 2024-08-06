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
        <h2 style="margin-top:0px">Transaksi_h Read</h2>
        <table class="table">
	    <tr><td>Id Customer</td><td><?php echo $id_customer; ?></td></tr>
	    <tr><td>Nomer Transaksi</td><td><?php echo $nomer_transaksi; ?></td></tr>
	    <tr><td>Tanggal Transaksi</td><td><?php echo $tanggal_transaksi; ?></td></tr>
	    <tr><td>Total Transaksi</td><td><?php echo $total_transaksi; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('transaksi_h') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>