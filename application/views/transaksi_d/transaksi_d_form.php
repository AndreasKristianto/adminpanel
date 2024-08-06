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
        <h2 style="margin-top:0px">Transaksi_d <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Transaksi H <?php echo form_error('id_transaksi_h') ?></label>
            <input type="text" class="form-control" name="id_transaksi_h" id="id_transaksi_h" placeholder="Id Transaksi H" value="<?php echo $id_transaksi_h; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Kd Barang <?php echo form_error('kd_barang') ?></label>
            <input type="text" class="form-control" name="kd_barang" id="kd_barang" placeholder="Kd Barang" value="<?php echo $kd_barang; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Barang <?php echo form_error('nama_barang') ?></label>
            <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="<?php echo $nama_barang; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Qty <?php echo form_error('qty') ?></label>
            <input type="text" class="form-control" name="qty" id="qty" placeholder="Qty" value="<?php echo $qty; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Subtotal <?php echo form_error('subtotal') ?></label>
            <input type="text" class="form-control" name="subtotal" id="subtotal" placeholder="Subtotal" value="<?php echo $subtotal; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('transaksi_d') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>