
<div class="content-wrapper">
	<section class="content-header">
		<h1>Pengelolaan Data C-Desa <?=ucwords($this->setting->sebutan_desa)?> <?= $desa["nama_desa"];?></h1>
		<ol class="breadcrumb">
			<li><a href="<?=site_url('hom_sid')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?=site_url('data_persil/clear')?>"> Daftar C-Desa</a></li>
			<li class="active">Pengelolaan Data C-Desa</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-3">
				<?php $this->load->view('data_persil/menu_kiri.php')?>
			</div>
			<div class="col-md-9">
				<div class="box box-info">
					<div class="box-body">
						<div class="row">
							<div class="col-sm-12">
								<?php if(empty($persil_detail["id"])): ?>
									<form action="" id="main" name="main" method="POST" class="form-horizontal">
										<div class="box-body">
											<div class="form-group">
												<label class="col-sm-3 control-label" >Cari Nama Pemilik</label>
												<div class="col-sm-8">
													<select class="form-control input-sm select2" style="width: 100%;" id="nik" name="nik" onchange="$('#'+'main').submit();">
														<option value>-- Silakan Masukan NIK / Nama --</option>
														<?php foreach ($penduduk as $item): ?>
															<option value="<?= $item['id']?>">Nama : <?= $item['nama']." Alamat : ".$item['info']?></option>
														<?php endforeach;?>
													</select>
												</div>
											</div>
										</div>
									</form>
								<?php endif; ?>
								<form name='mainform' action="<?= site_url('data_persil/simpan_persil')?>" method="POST"  id="validasi" class="form-horizontal">
									<div class="box-body">
										<input name="jenis_pemilik" type="hidden" value="1">
										<?php if ($pemilik): ?>
											<div class="form-group">
												<label class="col-sm-3 control-label">Nama Penduduk</label>
												<div class="col-sm-8">
													<input  class="form-control input-sm" type="text" placeholder="Nama Pemilik" value="<?= $pemilik["nama"] ?>" disabled >
													<input type="hidden" name="nik_lama" value="<?= $pemilik["nik_lama"] ?>"/>
													<input type="hidden" name="nik" value="<?= $pemilik["nik"] ?>"/>
													<?php if ($mode === 'edit'): ?>
														<input type="hidden" name="id" value="<?= $persil_detail["id"] ?>"/>
													<?php endif; ?>
														<input type="hidden" name="c_desa" value="<?= $persil_detail["c_desa"] ?>"/>
													
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">NIK Pemilik</label>
												<div class="col-sm-8">
													<input  class="form-control input-sm" type="text" placeholder="NIK Pemilik" value="<?= $pemilik["nik"] ?>" disabled >
												</div>
											</div>
											<div class="form-group">
												<label for="alamat"  class="col-sm-3 control-label">Alamat Pemilik</label>
												<div class="col-sm-8">
													<textarea  class="form-control input-sm" placeholder="Alamat Pemilik" disabled><?= "RT ".$pemilik["rt"]." / RT ".$pemilik["rw"]." - ".strtoupper($pemilik["dusun"]) ?></textarea>
												</div>
											</div>
										<?php endif; ?>
										<div class="form-group">
											<label for="c_desa"  class="col-sm-3 control-label">Nomor C-DESA</label>
											<div class="col-sm-8">
												<input  id="c_desa" class="form-control input-sm angka required" type="text" placeholder="Nomor Surat C-DESA" name="c_desa" value="<?= ($persil_detail["c_desa"])?sprintf("%04s", $persil_detail["c_desa"]): NULL ?>" <?= ($mode !== 0 )? 'disabled': NULL ?>>
											</div>
										</div>
										<div class="form-group">
											<label for="nama"  class="col-sm-3 control-label">Nomor Persil</label>
											<div class="col-sm-8">
												<input  id="nama" class="form-control input-sm angka required" type="text" placeholder="Nomor Surat Persil" name="nama" value="<?= $persil_detail["nopersil"] ?>">
											</div>
										</div>
										<div class="form-group">
											<label for="cid"  class="col-sm-3 control-label required">Jenis Persil</label>
											<div class="col-sm-4">
												<select class="form-control input-sm required" id="cid" name="cid" >
													<option value>-- Pilih Jenis Persil--</option>
													<?php foreach ($persil_jenis as $key => $item): ?>
														<option value="<?= $item['id'] ?>" <?php selected($key, $persil_detail["persil_jenis_id"]) ?>><?= $item['nama']?></option>
													<?php endforeach;?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="kelas"  class="col-sm-3 control-label required">Tipe Tanah</label>
											<div class="col-sm-4">
												<select class="form-control input-sm required" id="tipe" name="tipe"  type="text"  placeholder="Tuliskan Kelas Tanah" >
													<option value>-- Pilih Tipe Tanah--</option>
													<option value="BASAH" <?php if ('BASAH'==$persil_detail["tipe"]): ?>selected<?php endif; ?>>Tanah Basah</option>
													<option value="KERING" <?php if ('KERING'==$persil_detail["tipe"]): ?>selected<?php endif; ?>>Tanah Kering</option>
													</select>
											</div>
										</div>
										<div class="form-group">
											<label for="kelas"  class="col-sm-3 control-label required">Kelas Tanah</label>
											<div class="col-sm-4">
												<select class="form-control input-sm required" id="kelas" name="kelas"  type="text"  placeholder="Tuliskan Kelas Tanah" >
													<option value>-- Pilih Jenis Kelas--</option>
													<?php foreach ($persil_kelas  as $item): ?>
														<option value="<?= $item['id'] ?>" <?php selected($item['id'], $persil_detail["kelas"]); ?>><?= $item['kode'].' '.$item['ndesc']?></option>
													<?php endforeach;?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="luas_tanah"  class="col-sm-3 control-label">Luas Tanah (M<sup>2</sup>)</label>
											<div class="col-sm-4">
												<input  id="luas" name="luas"  type="text"  class="form-control input-sm luas required" placeholder="Luas" value="<?= $persil_detail["luas"] ?>">
											</div>
										</div>
										<div class="form-group">
											<label for=""  class="col-sm-3 control-label"></label>
											<div class="col-sm-8">
												<p class="help-block"><code>Gunakan tanda titik (.) untuk bilangan pecahan</code></p>
											</div>
										</div>
										<div class="form-group">
											<label for="nama"  class="col-sm-3 control-label">Pajak</label>
											<div class="col-sm-8">
												<input  id="pajak" class="form-control input-sm angka" type="text" placeholder="Pajak" name="pajak" value="<?= $persil_detail["pajak"] ?>">
											</div>
										</div>
										
											<?php if ($mode !== 'edit'): ?>
											<div class="form-group">
											<label for="nama"  class="col-sm-3 control-label">Sebab Dan Tanggal Perubahan</label>
											<div class="col-sm-8">
												<div class="form-group">
													<label for="nama"  class="col-sm-3 control-label">Tanggal Perubahan</label>
													<div class="col-sm-4">
														<div class="input-group input-group-sm date">
															<div class="input-group-addon">
																<i class="fa fa-calendar"></i>
															</div>
															<input class="form-control input-sm pull-right" id="tgl_1" name="tanggalmutasi" type="text" value="">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label for="nama"  class="col-sm-3 control-label">Sebab Mutasi</label>
													<div class="col-sm-4">
														<select class="form-control input-sm" name="sebabmutasi" >
															<option value>-- Pilih Sebab Mutasi--</option>
															<?php foreach ($persil_sebab_mutasi as $key => $item): ?>
																<option value="<?= $item['id'] ?>" <?php selected($key, $persil_detail["persil_sebab_mutasi"]) ?>><?= $item['nama']?></option>
															<?php endforeach;?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label for="nama"  class="col-sm-3 control-label">Luas Mutasi</label>
													<div class="col-sm-9">
														<input  name="luasmutasi"  type="text"  class="form-control input-sm luas" placeholder="Luas Mutasi" value="<?= $persil_detail["luas"] ?>">
													</div>
												</div>
												<div class="form-group">
													<label for="nama"  class="col-sm-3 control-label">Perolehan Dari</label>
													<div class="col-sm-9">
														<input name="c_desa_awal"  type="text"  class="form-control input-sm angka" placeholder="Nomor C-DESA" value="<?= $persil_detail["luas"] ?>">
													</div>
												</div>
												<div class="form-group">
													<label for="nama"  class="col-sm-3 control-label">Keterangan</label>
													<div class="col-sm-9">
														<textarea  id="ket" class="form-control input-sm" type="text" placeholder="Sebab Dan Tanggal Perubahan" name="ket" ><?= $persil_detail["keterangan"] ?></textarea>
													</div>
												</div>
											</div>
											</div>
											<?php else : ?>
												<div class="form-group">
												<label for="nama"  class="col-sm-3 control-label">Sebab Dan Tanggal Perubahan</label>
													<div class="col-sm-8">
													<?php $no =1; foreach($persil_mutasi as $item) : ?>
														 <div class="input-sm col-sm-8">
															 <?= $no++ ?>. <?= tgl_indo_out($item['tanggalmutasi']) ?> <?= $item['sebabmutasi'] ?> 
															 <?= !empty($item['luasmutasi']) ? "seluas ".number_format($item['luasmutasi'])." m2 " : null ?>
															  <?= !empty($item['c_desa_awal']) ? "dari C-DESA ".$item['c_desa_awal']: null ?>
														 </div>
														 <div class="col-xs-4"><a href="<?= site_url("data_persil/mutasi/edit/".$item["id"]) ?>" class="btn bg-yellow btn-flat btn-sm " title="Edit"><i class="fa fa-edit"></i></a>
														 <a href="<?= site_url("data_persil/hapus_mutasi/".$item["id_persil"]."/".$item["id"]) ?>" class="btn bg-red btn-flat btn-sm " title="Hapus"><i class="fa fa-edit"></i></a></div>
													<?php endforeach; ?>
													</div>
												</div>
												<div class="form-group">
													<label for="nama"  class="col-sm-3 control-label"></label>
													<div class="col-sm-8">
														<a href="<?= site_url("data_persil/mutasi/".$persil_detail["id"]) ?>" class="btn btn-social btn-flat btn-success btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Data"><i class="fa fa-plus"></i> Sebab Dan Tanggal Perubahan</a>
													</div>
												</div>
												<?php endif; ?>
												<div class="form-group">
											<label for="sid"  class="col-sm-3 control-label">Peruntukan</label>
											<div class="col-sm-4">
												<select class="form-control  input-sm select2" id="sid" name="sid">
													<option value >-- Pilih Peruntukan--</option>
													<?php foreach ($persil_peruntukan as $key=>$item): ?>
														<option value="<?= $key?>" <?php if ($key==$persil_detail["persil_peruntukan_id"]): ?>selected<?php endif; ?>><?= $item[0]?></option>
													<?php endforeach;?>
												</select>
											</div>
										</div>
										<div class="form-group ">
											<label for="pid"  class="col-sm-3 control-label">Lokasi Tanah</label>
											<div class="btn-group col-sm-8 kiri" data-toggle="buttons">
												<label  class="btn btn-info btn-flat btn-sm col-sm-3 form-check-label <?= $persil_detail["lokasi"]?NULL : 'active'  ?>">
													<input type="radio"  name="pilihan" class="form-check-input" type="radio" value="1"  autocomplete="off" onchange="pilih_lokasi(this.value);"> Pilih Lokasi
												</label>
												<label  class="btn btn-info btn-flat btn-sm col-sm-3 form-check-label  <?= $persil_detail["lokasi"]?'active' : NULL  ?>">
													<input type="radio"  name="pilihan" class="form-check-input" type="radio" value="2" autocomplete="off" onchange="pilih_lokasi(this.value);"> Tulis Manual
												</label>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label"></label>
											<div id= "pilih" <?= $persil_detail["lokasi"]?'style="display:none"' : NULL  ?>>
												<div class="col-sm-4" >
													<select class="form-control  input-sm select2" id="pid" name="pid" >
														<option width="100%" value >-- Pilih Lokasi Tanah--</option>
														<?php foreach ($persil_lokasi as $key=>$item): ?>
															<option value="<?= $item["id"] ?>" <?php if ($item["id"]==$persil_detail["id_clusterdesa"]): ?>selected<?php endif; ?>><?= strtoupper($item["dusun"])." - RW ".$item["rw"]." / RT ".$item["rt"] ?></option>
														<?php endforeach;?>
													</select>
												</div>
											</div>
											<div id= "manual" <?= $persil_detail["lokasi"]?NULL: 'style="display:none"' ?> >
												<div class="col-sm-8">
													<textarea  id="lokasi" class="form-control input-sm" type="text" placeholder="Lokasi" name="lokasi" ><?= $persil_detail["lokasi"] ?></textarea>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="sppt"  class="col-sm-3 control-label">Nomor SPPT PBB</label>
											<div class="col-sm-8">
												<input  id="sppt" name="sppt"  type="text"  class="form-control input-sm" placeholder="Tuliskan Nomor SPPT PBB" value="<?= $persil_detail["no_sppt_pbb"] ?>">
											</div>
										</div>
									</div>
									<div class="box-footer">
										<div class="col-xs-12">
											<button type="reset" class="btn btn-social btn-flat btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
											<button type="submit" class="btn btn-social btn-flat btn-info btn-sm pull-right"><i class="fa fa-check"></i> Simpan</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</div>
<script>
	$(document).ready(function(){
		$('#tipe').change(function(){ 
			var id=$(this).val();
			$.ajax({
				url : "<?=site_url('data_persil/kelasid')?>",
				method : "POST",
				data : {id: id},
				async : true,
				dataType : 'json',
				success: function(data){
					var html = '';
					var i;
					for(i=0; i<data.length; i++){
						html += '<option value='+data[i].id+'>'+data[i].kode+' '+data[i].ndesc+'</option>';
					}
					$('#kelas').html(html);
				}
			});
			return false;
		}); 
	});

	function pilih_lokasi(pilih)
	{
		if (pilih == 1)
		{
			$("#manual").hide();
			$("#pilih").show();
		}
		else
		{
			$("#manual").removeClass('hidden');
			$("#manual").show();
			$("#pilih").hide();
		}
	}
</script>

