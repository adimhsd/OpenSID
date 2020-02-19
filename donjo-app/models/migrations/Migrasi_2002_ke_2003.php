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

			$query = "INSERT INTO `data_persil_kelas` (`kode`, `tipe`,`ndesc`) VALUES
				('S-1', 'SAWAH', 'Persawahan Dekat dengan Pemukiman'),
				('S-2', 'SAWAH', 'Persawahan Agak Jauh dengan Pemukiman'),
				('S-3', 'SAWAH', 'Persawahan Jauh dengan Pemukiman'),
				('S-4', 'SAWAH', 'Persawahan Sangat Jauh dengan Pemukiman'),
				('D-1', 'KERING', 'Lahan Kering Dekat dengan Pemukiman'),
				('D-2', 'KERING', 'Lahan Kering Agak Jauh dengan Pemukiman'),
				('D-3', 'KERING', 'Lahan Kering Jauh dengan Pemukiman'),
				('D-4', 'KERING', 'Lahan Kering Sangat Jauh dengan Pemukiman')
			";
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

		//tambahkan kolom untuk beberapa data persil
		if (!$this->db->field_exists('id_c_desa','data_persil'))
		{
			$this->db->query("ALTER TABLE data_persil ADD `id_c_desa` INT NOT NULL AFTER `id`");
			$this->db->query("ALTER TABLE data_persil ADD `pajak` INT NULL AFTER `persil_peruntukan_id`");
			$this->db->query("ALTER TABLE data_persil ADD `keterangan` text NULL AFTER `pajak`");
			$this->db->query("ALTER TABLE data_persil ADD `lokasi` TEXT  NULL AFTER `pemilik_luar`");
		}

		//tambahkan Persil Jenis Sebagai kunci kelas
		$strSQL = "SELECT nama FROM data_persil_jenis WHERE nama = 'SAWAH'";
		$query = $this->db->query($strSQL);
		if ($query->num_rows() <= 0)
		{
			$this->db->query("INSERT INTO `data_persil_jenis` (`nama`, `ndesc`) VALUES('SAWAH', 'SAWAH')");
		}

		$strSQL = "SELECT nama FROM data_persil_jenis WHERE nama = 'KERING'";
		$query = $this->db->query($strSQL);
		if ($query->num_rows() <= 0)
		{
			$this->db->query("INSERT INTO `data_persil_jenis` (`nama`, `ndesc`) VALUES('KERING', 'TANAH kERING')");
		}

	}
}
