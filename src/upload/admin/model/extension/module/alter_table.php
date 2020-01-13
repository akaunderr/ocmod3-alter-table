<?php
/**
 * The «Alter Table» extension is for Opencart CMS 3.x.
 * It is an helper tool for other extensions and modules making it easy to
 * create/delete tables and columns in the Opencart DB.
 *
 * @package    Alter Table
 * @version    1.0
 *
 * @author     Andrii Burkatskyi aka underr, <underr.ua@gmail.com>
 * @copyright  Copyright © 2020, Andrii Burkatskyi aka underr
 * @license    https://raw.githubusercontent.com/underr-ua/ocmod3-alter-table/master/LICENSE.txt  MIT License
 *
 * @link       https://underr.space/notes/projects/project-019.html
 * @link       https://github.com/underr-ua/ocmod3-alter-table
 */
class ModelExtensionModuleAlterTable extends Model {
	public function hasColumn($table, $column) {
		$query = $this->db->query('DESC ' . DB_PREFIX . $table . ' ' . $column);

        return (bool)$query->num_rows;
	}

	public function addColumn($table, $column, $column_type) {
		$query = $this->hasColumn($table, $column);

		if (!$query->num_rows) {
			$this->db->query('ALTER TABLE ' . DB_PREFIX . $table .' ADD ' . $column . ' ' . $column_type);
		}
	}

	public function delColumn($table, $column) {
        $query = $this->db->query('ALTER TABLE ' . DB_PREFIX .  $table . ' DROP IF EXISTS ' . $column);
	}


	public function hasTable($table) {
        $query = $this->db->query('SHOW TABLES LIKE ' . DB_PREFIX .  $table);

        return (bool)$query->num_rows;
    }

	public function addTable($table, $columns, $engine) {
		$query = $this->db->query('CREATE TABLE IF NOT EXISTS ' . DB_PREFIX . $table . ' (' . $columns . ') ' . $engine);
	}

	public function delTable($table) {
		$query = $this->db->query('DROP TABLE IF EXISTS ' . DB_PREFIX . $table);
	}
}
