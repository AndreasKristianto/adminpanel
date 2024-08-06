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
        <h2>Transaksi_h List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Customer</th>
		<th>Nomer Transaksi</th>
		<th>Tanggal Transaksi</th>
		<th>Total Transaksi</th>
		
            </tr><?php
            foreach ($transaksi_h_data as $transaksi_h)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $transaksi_h->id_customer ?></td>
		      <td><?php echo $transaksi_h->nomer_transaksi ?></td>
		      <td><?php echo $transaksi_h->tanggal_transaksi ?></td>
		      <td><?php echo $transaksi_h->total_transaksi ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>