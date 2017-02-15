<?php 
include_once "WEB-INF/module/service/common_service.php";

class base_service_impl implements common_service{
	protected $dao;
	
	/**
	 * Select database $model sesuai dengan object $model
	 * @param object $model
	 * @return array hasil query
	 */
	public function select($model)
	{
		return $this->dao->select($model);
	}
	
	/**
	 * Select database $model sesuai dengan object $model
	 * @param object $model
	 * @return array object
	 */
	public function select_model($model)
	{
		return $this->dao->select_model($model);
	}
	
	/**
	 * Select database $model sesuai dengan object $model dan start size di limit query
	 * @param object $model
	 * @return array hasil query
	 */
	public function select_paged($model, $start, $size)
	{
		return $this->dao->select_paged($model, $start, $size);
	}
	
	/**
	 * Select count database $model sesuai dengan object $model
	 * @param object $model
	 * @return number count
	 */
	public function select_count($model)
	{
		return $this->dao->select_count($model);
	}
	
	/**
	 * Select count database $model sesuai dengan object $model dan start size di limit query
	 * @param object $model
	 * @return number count
	 */
	public function select_count_paged($model, $start, $size)
	{
		return $this->dao->select_count_paged($model, $start, $size);
	}
	
	/**
	 * Melakukan penyimpanan object ke database
	 * @param object $model
	 */
	public function save($model)
	{
		$this->dao->save($model);
	}
	
	/**
	 * Melakukan penyimpanan object ke database dan mengembalikan id object di database
	 * @param object $model
	 * @return id
	 */
	public function save_and_get_id($model)
	{
		return $this->dao->save_and_get_id($model);
	}
	
	/**
	 * Melakukan update object ke database
	 * @param object $model
	 */
	public function update($model)
	{
		$this->dao->update($model);
	}
	
	/**
	 * Melakukan delete object ke database
	 * @param object $model
	 */
	public function delete($model)
	{
		$this->dao->delete($model);
	}
		
	/**
	 * Melakukan set deaktif object ke database
	 * @param object $model dengan set_id berisi list array
	 */
	public function soft_delete($model)
	{
		$this->dao->soft_delete($model);
	}
	
	/**
	 * Melakukan exekusi Query SQL
	 * @param object $query
	 */
	public function execute_query($query)
	{
		$this->dao->execute_query($query);
	}
}