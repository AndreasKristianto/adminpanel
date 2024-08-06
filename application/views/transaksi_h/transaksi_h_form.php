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
        <h2 style="margin-top:0px">Transaksi_h <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Customer <?php echo form_error('id_customer') ?></label>
            <input type="text" class="form-control" name="id_customer" id="id_customer" placeholder="Id Customer" value="<?php echo $id_customer; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nomer Transaksi <?php echo form_error('nomer_transaksi') ?></label>
            <input type="text" class="form-control" name="nomer_transaksi" id="nomer_transaksi" placeholder="Nomer Transaksi" value="<?php echo $nomer_transaksi; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Transaksi <?php echo form_error('tanggal_transaksi') ?></label>
            <input type="text" class="form-control" name="tanggal_transaksi" id="tanggal_transaksi" placeholder="Tanggal Transaksi" value="<?php echo $tanggal_transaksi; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Total Transaksi <?php echo form_error('total_transaksi') ?></label>
            <input type="text" class="form-control" name="total_transaksi" id="total_transaksi" placeholder="Total Transaksi" value="<?php echo $total_transaksi; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('transaksi_h') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>