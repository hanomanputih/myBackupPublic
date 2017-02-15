<?php 
interface common_service{
	
	/**
	 * Select database $model sesuai dengan object $model
	 * @param object $model
	 * @return array hasil query
	 */
	public function select($model);
	
	/**
	 * Select database $model sesuai dengan object $model
	 * @param object $model
	 * @return array object
	 */
	public function select_model($model);
	
	/**
	 * Select database $model sesuai dengan object $model dan start size di limit query
	 * @param object $model
	 * @return array hasil query
	 */
	public function select_paged($model, $start, $size);
	
	/**
	 * Select count database $model sesuai dengan object $model
	 * @param object $model
	 * @return number count
	 */
	public function select_count($model);
	
	/**
	 * Select count database $model sesuai dengan object $model dan start size di limit query
	 * @param object $model
	 * @return number count
	 */
	public function select_count_paged($model, $start, $size);
	
	/**
	 * Melakukan penyimpanan object ke database
	 * @param object $model
	 */
	public function save($model);

	/**
	 * Melakukan penyimpanan object ke database dan mengembalikan id object di database
	 * @param object $model
	 * @return id
	 */
	public function save_and_get_id($model);
	
	/**
	 * Melakukan update object ke database
	 * @param object $model
	 */
	public function update($model);
	
	/**
	 * Melakukan delete object ke database
	 * @param object $model
	 */
	public function delete($model);
	
	/**
	 * Melakukan set deaktif object ke database
	 * @param object $model dengan set_id berisi list array
	 */
	public function soft_delete($model);
}