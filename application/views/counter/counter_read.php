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
        <h2 style="margin-top:0px">Counter Read</h2>
        <table class="table">
	    <tr><td>Bulan</td><td><?php echo $bulan; ?></td></tr>
	    <tr><td>Tahun</td><td><?php echo $tahun; ?></td></tr>
	    <tr><td>Counter</td><td><?php echo $counter; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('counter') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>