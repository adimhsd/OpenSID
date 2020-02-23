<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>LETTER C-DESA</title>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="<?= base_url()?>assets/css/letter-c.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="content" class="container_12 clearfix">
            <div id="content-main">
             
             <div class="header">
                <h4 class="kop">LETTER C-DESA</h4>
                <h4 class="kop">NOMOR : <?= sprintf("%04s", $persil_detail['c_desa'])?></h4>
                <h5 class="kop2">DESA <?= strtoupper($desa["nama_desa"])?> KECAMATAN <?= strtoupper($desa["nama_kecamatan"])?> KABUPATEN <?= strtoupper($desa["nama_kabupaten"])?></h5>
                <div style="text-align: center;">
                    <hr class="style" />
                </div>
            </div>

            <div class="clear"></div>
            <div id="isi">
                <table style="font-size: 14px;padding-left: 32px;margin-left: 7px; margin-bottom: unset;">
                    <?php if ($persil_detail['jenis_pemilik'] != '2'): ?>
                        <tr>
                            <td  width="150">PEMILIK TANAH</td>
                            <td width="10">:</td>
                            <td><b><?= strtoupper($persil_detail["namapemilik"])?></b></td>
                        </tr>
                        <tr>
                            <td>ALAMAT</td>
                            <td>:</td>
                            <td>RT: <?= $persil_detail["rt"]?> RW: <?= $persil_detail["rw"]?> Dusun <?= strtoupper($persil_detail["dusun"])?></td>
                        </tr>
                        <?php else : ?>
                            <tr>
                                <td width="150"> PEMILIK TANAH</td>
                                <td width="10">:</td>
                                <td><b><?= strtoupper($persil_detail["namapemilik"])?></b></td>
                            </tr>
                            <tr>
                                <td >ALAMAT</td>
                                <td >:</td>
                                <td><?= $persil_detail["alamat_luar"]?></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                    <div align="center">
                        <table width="100%" class="border thick">
                            <thead>
                                <tr class="border thick">
                                    <th colspan="6" class="head batas" >TANAH BASAH</th>
                                    <th colspan="6" class="head batas" >TANAH KERING</th>                                   
                                </tr>
                                <tr class="bg">
                                    <th rowspan="3" width="70">Nomor Persil / Blok</th>
                                    <th rowspan="3" width="34" class="vertikal">Kelas Desa</th>
                                    <th colspan="3" width="100">Menurut Daftar Perincian</th>
                                    <th rowspan="3" width="80"  class="batas" >Sebab dan Tanggal Perubahan</th>
                                    <th rowspan="3" width="70">Nomor Persil / Blok</th>
                                    <th rowspan="3" width="34" class="vertikal">Kelas Desa</th>
                                    <th colspan="3" width="100">Menurut Daftar Perincian</th>
                                    <th rowspan="3" width="80">Sebab dan Tanggal Perubahan</th>
                                </tr>
                                <tr class="bg">
                                    <th>Luas</th>
                                    <th>Milik</th>
                                    <th>Pajak</th>
                                    <th>Luas</th>
                                    <th>Milik</th>
                                    <th>Pajak</th>
                                </tr>
                                <tr class="bg">
                                    <th>ha</th>
                                    <th>m2</th>
                                    <th>Rp</th>
                                    <th>ha</th>
                                    <th>m2</th>
                                    <th>Rp</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i=0; $i < 16; $i++) { ?>
                                    <tr>
                                        <td class="row" > <?= $basah[$i]["nopersil"] ?></td>
                                        <td class="row" ><?= $basah[$i]["kode"] ?></td>
                                        <td class="row" ><?= $basah[$i]["ha"] ?></td>
                                        <td class="row" ><?= $basah[$i]["luas"] ?></td>
                                        <td class="row" ><?= $basah[$i]["pajak"] ?></td>
                                        <td class="row batas" ><?= $basah[$i]["keterangan"] ?></td> 

                                        <td class="row" > <?= $kering[$i]["nopersil"] ?></td>
                                        <td class="row" ><?= $kering[$i]["kode"] ?></td>
                                        <td class="row" ><?= $kering[$i]["ha"] ?></td>
                                        <td class="row" ><?= $kering[$i]["luas"] ?></td>
                                        <td class="row" ><?= $kering[$i]["pajak"] ?></td>
                                        <td class="row " ><?= $kering[$i]["keterangan"] ?></td> 
                                    </tr>
                                <?php  }   ?>
                            </tbody>
                        </table>
                        <table width="100%">
                            <tr>
                                <td class="info">
                                    <p>Keterangan:<br />
                                        Setiap ada perubahan status tanah karena :<br />
                                        &nbsp;1. JUal Beli<br />
                                        &nbsp;2. Waris<br />
                                        &nbsp;3. Hibah / Lintri<br />
                                        Salinan Letter C ini Wajib dibawa Ke kantor Desa oleh<br />
                                        Pemilik Tanah untuk dicocokkan / disesuaikan dengan<br />
                                        ASLI-nya pada Buku C-Desa Oleh Kepala Desa Atau<br />
                                        Sekretariat <?= ucwords(strtolower($this->setting->sebutan_desa))?> <?= ucwords(strtolower($desa['nama_desa'])) ?>
                                    </p>
                                </td>
                                <td>
                                    <p align="center"> <?= $desa['nama_desa'] ?>, <?= tgl_indo(date("Y m d"))?><br>
                                        Mengetahui <br>
                                        KEPALA  <?= strtoupper($this->setting->sebutan_desa)?> <?= strtoupper($desa['nama_desa']) ?> <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <?= strtoupper($desa['nama_kepala_desa']) ?>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

