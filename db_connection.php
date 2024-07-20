<?php 

class SqliteDb
{
	private $db;
	private $db_path;

	function __construct($db_path){
		$this->db_path = $db_path;
	}

	function connect() {
		try {
			$this->db = new SQLite3($this->db_path);
			return $this->db;
		} catch (Exception $ex) {
			die("DB connection failed!" . $ex->getMessage());
		}
    }
	
	public function close()
    {
        if ($this->db) {
            $this->db->close();
        }
    }
}
?>