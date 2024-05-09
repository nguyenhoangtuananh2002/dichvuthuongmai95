<?php

namespace App\Admin\Repositories\Employee;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface EmployeeRepositoryInterface extends EloquentRepositoryInterface
{
    public function searchAllLimit($value = '', $meta = [], $select = [], $limit = 10);
    public function getQueryBuilderOrderBy($column = 'id', $sort = 'DESC');
}
