<?php
class Migrasi_2002_ke_2003 extends CI_model {

	public function up()
	{
		// Hapus setting tombol cetak surat langsung
			$this->db->where('key', 'tombol_cetak_surat')
				->delete('setting_aplikasi');

		// Buat tabel jenis Kelas Persil
		if (!$this->db->table_exists('data_persil_kelas') )
		{
			$query = "
			CREATE TABLE IF NOT EXISTS `data_persil_kelas` (
				  `id` int(10) NOT NULL AUTO_INCREMENT,
				  `tipe` varchar(12) NOT NULL,
				  `kode` varchar(12) NOT NULL,
				  `ndesc` text NULL,
				  PRIMARY KEY (`id`)
			)";
			$this->db->query($query);
		}

		// Buat tabel id C-DESA
		if (!$this->db->table_exists('data_persil_c_desa') )
		{
			$query = "
			CREATE TABLE `data_persil_c_desa`(
			`id` INT(11) NOT NULL AUTO_INCREMENT,
			`c_desa` INT(11) NOT NULL,
    		`id_pend` INT(11) NULL,
    		PRIMARY KEY(`id`),
    		UNIQUE(`c_desa`)
			)";
			$this->db->query($query);
		}

		if (!$this->db->field_exists('id_c_desa','data_persil'))
		{
			$this->db->query("ALTER TABLE data_persil ADD `id_c_desa` INT NOT NULL AFTER `id`");
			$this->db->query("ALTER TABLE data_persil ADD `pajak` INT NULL AFTER `persil_peruntukan_id`");
			$this->db->query("ALTER TABLE data_persil ADD `keterangan` text NULL AFTER `pajak`");
			$this->db->query("ALTER TABLE data_persil ADD `lokasi` TEXT  NULL AFTER `pemilik_luar`");
		}

		
	}
}
