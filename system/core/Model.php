<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Model
{

	/**
	 * Class constructor
	 *
	 * @link	https://github.com/bcit-ci/CodeIgniter/issues/5332
	 * @return	void
	 */
	public function __construct()
	{
	}

	/**
	 * __get magic
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param	string	$key
	 */
	public function __get($key)
	{
		// Debugging note:
		//	If you're here because you're getting an error message
		//	saying 'Undefined Property: system/core/Model.php', it's
		//	most likely a typo in your model code.
		return get_instance()->$key;
	}
}

class Database extends CI_Model
{
	protected $base; /* Custom PDO variable */

	function __construct()
	{
		parent::__construct();

		$this->base = $this->dbconnect();
	}

	protected function dbconnect()
	{
		$host = $this->config->item("host");
		$database = $this->config->item("database");
		$username = $this->config->item("username");
		$password = $this->config->item("password");

		try {
			$pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
			return $pdo;
		} catch (Exception $error) {
			die("Error : " . $error->getMessage());
		}
	}

	/**
	 * @param $table
	 * @param $data
	 * @return mixed
	 */
	public function insertData($table, $data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}


	/**
	 * @param $table
	 * @param $where
	 */
	public function deleteData($table, $where)
	{
		$this->db->delete($table, $where);
	}


	/**
	 * @param $data
	 * @param $where
	 * @param $table
	 * @return mixed
	 */
	public function updateData($data, $where, $table, $replace = false)
	{
		$this->db->where($where);
		if (!$replace)
			$this->db->update($table, $data);
		else
			$this->db->replace($table, $data);

		return $this->db->affected_rows();
	}


	/**
	 * @param $query
	 * @return mixed
	 */
	public function execQuery($query, $oneResult = false)
	{
		$query = $this->db->query($query);
		if (!$oneResult)
			return $query->result();
		else
			return $query->last_row();
	}

	public function countQuery($query)
	{
		$query = $this->db->query($query);
		//$query = $this->db->count_all_results();
		return $query->count_all_results();
	}

	/**
	 * @param $table
	 * @param $where
	 * @param string $what
	 * @return mixed
	 */
	public function getthis($table, $where, $what = "*")
	{
		$this->db->select($what)->from($table)->where($where);
		$query = $this->db->get();
		return $query->last_row();
	}

	/**
	 * @param $table
	 * @param string $what
	 * @return mixed
	 */
	public function get($table, $what = "*")
	{
		$this->db->select($what)->from($table);
		$query = $this->db->get();
		return $query->result();
	}


	public function getwhere($table, $where = "", $what = "*", $limit = 200, $orderby = "", $direction = "ASC")
	{
		if ($where == "")
			$this->db->limit($limit)->order_by($orderby, $direction)->select($what)->from($table);
		else {
			$this->db->limit($limit)->order_by($orderby, $direction)->select($what)->from($table)->where($where);
		}
		$query = $this->db->get();
		return $query->result();
	}



	/**
	 * @param $table
	 * @param string $where
	 * @param string $what
	 * @return mixed
	 */
	public function sumWhere($table, $where = "", $what = "*")
	{
		if ($where == "")
			$this->db->select_sum($what)->from($table);
		else {
			$this->db->select_sum($what)->from($table);
			$this->db->where($where);
		}
		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * @param $table
	 * @param string $where
	 * @param string $what
	 * @return mixed
	 */
	public function countWhere($table, $where = "", $what = "*")
	{
		if ($where == "")
			$this->db->from($table);
		else {
			$this->db->where($where);
			$this->db->from($table);
		}
		$query = $this->db->count_all_results();
		return $query;
	}
}
