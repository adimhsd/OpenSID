<?php
class Migrasi_2003_ke_2004 extends CI_model {

	public function up()
	{
		// Buat tabel jenis Kelas Persil
		if (!$this->db->table_exists('ref_persil_kelas'))
		{
			$fields = array(
				'id' => array(
					'type' => 'INT',
					'constraint' => 5,
					'unsigned' => TRUE,
					'auto_increment' => TRUE
				),
				'tipe' => array(
					'type' => 'VARCHAR',
					'constraint' => 20
				),
				'kode' => array(
					'type' => 'VARCHAR',
					'constraint' => 20
				),
				'ndesc' => array(
					'type' => 'text',
					'null' => TRUE
				)
			);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->add_field($fields);
			$this->dbforge->create_table('ref_persil_kelas');
		}
		else
		{
			$this->db->truncate('ref_persil_kelas');
		}

		$data = [
			['kode' => 'S-I', 'tipe' => 'BASAH', 'ndesc' => 'Persawahan Dekat dengan Pemukiman'],
			['kode' => 'S-II', 'tipe' => 'BASAH', 'ndesc' => 'Persawahan Agak Dekat dengan Pemukiman'],
			['kode' => 'S-III', 'tipe' => 'BASAH', 'ndesc' => 'Persawahan Jauh dengan Pemukiman'],
			['kode' => 'S-IV', 'tipe' => 'BASAH', 'ndesc' => 'Persawahan Sangat Jauh dengan Pemukiman'],
			['kode' => 'D-I', 'tipe' => 'KERING', 'ndesc' => 'Lahan Kering Dekat dengan Pemukiman'],
			['kode' => 'D-II', 'tipe' => 'KERING', 'ndesc' => 'Lahan Kering Agak Dekat dengan Pemukiman'],
			['kode' => 'D-III', 'tipe' => 'KERING', 'ndesc' => 'Lahan Kering Jauh dengan Pemukiman'],
			['kode' => 'D-IV', 'tipe' => 'KERING', 'ndesc' => 'Lahan Kering Sanga Jauh dengan Pemukiman'],
			];
		$this->db->insert_batch('ref_persil_kelas', $data);

		// Buat tabel id C-DESA
		if (!$this->db->table_exists('data_persil_c_desa') )
		{
			$fields = array(
				'id' => array(
					'type' => 'INT',
					'constraint' => 5,
					'unsigned' => TRUE,
					'auto_increment' => TRUE
				),
				'c_desa' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unique' => TRUE,
				),
				'id_pend' => array(
					'type' => 'INT',
					'constraint' => 11,
					'null' => TRUE
				)
			);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->add_field($fields);
			$this->dbforge->create_table('data_persil_c_desa');
		}

		//tambahkan kolom untuk beberapa data persil
		if (!$this->db->field_exists('id_c_desa','data_persil'))
		{
			$fields = array(
				'id_c_desa' => array(
					'type' => 'INT', 
					'after' => 'id'
				),
				'pajak' => array(
					'type' => 'INT',
					'after' => 'persil_peruntukan_id',
					'null' => TRUE					
				),
				'keterangan' => array(
					'type' => 'TEXT',
					'after' => 'pajak',
					'null' => TRUE	
				),
				'lokasi' => array(
					'type' => 'TEXT',
					'after' => 'pemilik_luar',
					'null' => TRUE
				)
			);
			$this->dbforge->add_column('data_persil', $fields);
		}
	}
}
