<?php

namespace App\Http\Repositories;
interface RepositoryInterface {
	/**
	 * Get all
	 * @return mixed
	 */
	public function getAll();

	/**
	 * Get one
	 * @param $id
	 * @return mixed
	 */
	public function find($id, array $with = []);

	/**
	 * Create
	 * @param array $attributes
	 * @return mixed
	 */
	public function create($attributes = []);

	/**
	 * Update
	 * @param $id
	 * @param array $attributes
	 * @return mixed
	 */
	public function update($id, $attributes = []);

	public function updateWithReferenceId($key, $attributes = []);

	public function updateWithPostsId($key, $attributes = []);

	public function updateWithPostsTranslation($key, $langCode, $attributes = []);

	public function updateWithCategoriesTranslation($key, $langCode, $attributes = []);

	public function updateWithTagTranslation($key, $langCode, $attributes = []);

	public function updateWithPagesTranslation($key, $langCode, $attributes = []);

	/**
	 * Delete
	 * @param $id
	 * @return mixed
	 */
	public function delete($id);

	/**
	 * @param array $condition
	 * @return mixed
	 */
	public function restoreBy($id);

	public function checkModeActionWebsite();

	/**
	 * Find a single entity by key value.
	 *
	 * @param array $condition
	 * @param array $select
	 * @param array $with
	 * @return mixed
	 */
	public function getFirstBy(array $condition = [], array $select = [], array $with = []);


	public function createOrUpdate($data, array $condition = []);

	public function allBy(array $condition, array $with = [], array $select = ['*']);

	public function activate($arrId = [], $value = 1);

	public function deactivate($arrId = [], $value = 2);

	public function updateOrCreate($key, $attributes = []);

}