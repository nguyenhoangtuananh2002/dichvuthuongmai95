<?php

namespace App\Api\V1\Repositories\Employee;

interface EmployeeRepositoryInterface
{
	/**
     * Find a single record
     *
     * @param int $id
     * @return mixed
     *
     */
	public function find($id);

    public function findByKey($key, $value);
    /**
     * Find a single record
     *
     * @param int $id
     * @return mixed
     *
     */
    public function findOrFail($id);
    /**
     * Create a new record
     *
     * @param array $data The input data
     * @return object model instance
     *
     */
    public function create(array $data);

    /**
     * Update the model instance
     *
     * @param int $id The model id
     * @param array $data The input data
     * @return boolean true false
     *
     */
    public function update($id, array $data);

    public function updateObject($employee, $data);
    /**
     * Delete a record
     *
     * @param int $id Model id
     * @return object model instance
     * @throws \Exception
     * @return boolean true false
     */
    public function delete($id);
    /**
     * make query
     *
     * @return mixed
     */
    public function getQueryBuilder();
}
