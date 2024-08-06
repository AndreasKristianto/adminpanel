<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Transaksi_d List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Transaksi H</th>
		<th>Kd Barang</th>
		<th>Nama Barang</th>
		<th>Qty</th>
		<th>Subtotal</th>
		
            </tr><?php
            foreach ($transaksi_d_data as $transaksi_d)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $transaksi_d->id_transaksi_h ?></td>
		      <td><?php echo $transaksi_d->kd_barang ?></td>
		      <td><?php echo $transaksi_d->nama_barang ?></td>
		      <td><?php echo $transaksi_d->qty ?></td>
		      <td><?php echo $transaksi_d->subtotal ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>