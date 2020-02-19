<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Data Penduduk</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<?php if (is_file(LOKASI_LOGO_DESA . "favicon.ico")): ?>
			<link rel="shortcut icon" href="<?= base_url()?><?= LOKASI_LOGO_DESA?>favicon.ico" />
		<?php else: ?>
			<link rel="shortcut icon" href="<?= base_url()?>favicon.ico" />
		<?php endif; ?>
		<link href="<?= base_url()?>assets/css/report.css" rel="stylesheet" type="text/css">
		<style>
			.textx
			{
				mso-number-format:"\@";
			}
			td,th
			{
				font-size:6.5pt;
			}
		</style>
	</head>
	<body>
		<div id="container">
			<div id="body">
				<div class="header" align="center">
					<label align="left"><?= get_identitas()?></label>
					<h3> DATA C-DESA </h3>
					<h3> <?= $_SESSION['judul_statistik']; ?></h3>
				</div>
				<br>
				<table class="border thick">
					<thead>
						<tr class="border thick">
							<th colspan="2" >NOMOR</th>
							<th colspan="3" >PEMILIK</th>
							<th colspan="2" >LUAS TANAH</th>
							<th rowspan="2" >TANGGAL TERDAFTAR</th>
						</tr>
						<tr>
							<th >URUT</th>
							<th >C-DESA</th>
							<th >NAMA</th>
							<th >NIK</th>
							<th >ALAMAT</th>
							<?php foreach ($persil_jenis as $key => $item): ?>
	                            <th> <?= $item[1] ?> <p>(M2)</p></th>
	                         <?php endforeach ?>
						</tr>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data_persil as $persil): ?>
						<tr>
							<td><?= $persil['no']?></td>
							<td class="textx"><?= sprintf("%04s", $persil['c_desa'])?></td>
							<?php if ($persil['jenis_pemilik'] != '2'): ?>
								<td><?= $persil['namapemilik']?></td>
								<td class="textx"><?= $persil['nik']?></td>
								<td>RT: <?= $persil["rt"]?> RW: <?= $persil["rw"]?> Dusun <?= strtoupper($persil["dusun"])?></td>
							<?php else : ?>
								<td><?= strtoupper($persil["namapemilik"])?></td>
								<td>-</td>
								<td><?= $persil["alamat_luar"]?></td>
							<?php endif; ?>
							<?php foreach ($persil_jenis as $key => $item): ?>
	                            <td> <?= $persil[$item[0]] ?></td>
	                         <?php endforeach ?> 
							<td><?= tgl_indo($persil['tanggal_daftar'])?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<label>Tanggal cetak : &nbsp; </label><?= tgl_indo(date("Y m d"))?>
		</div>
	</body>
</html>
