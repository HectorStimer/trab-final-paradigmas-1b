<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository
{
    protected $model;

    public function __construct(Company $company)
    {
        $this->model = $company;
    }

    public function all(array $filters = [])
    {
        $query = $this->model->newQuery();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['responsible_id'])) {
            $query->where('responsible_id', $filters['responsible_id']);
        }

        return $query->get();
    }

    public function paginate(array $filters = [], $perPage = 15)
    {
        $query = $this->model->newQuery();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['responsible_id'])) {
            $query->where('responsible_id', $filters['responsible_id']);
        }

        return $query->paginate($perPage);
    }

    public function find(int $id): ?Company
    {
        return $this->model->find($id);
    }

    public function create(array $data): Company
    {
        return $this->model->create($data);
    }

    public function update(Company $company, array $data): Company
    {
        $company->update($data);
        return $company;
    }

    public function delete(Company $company): bool
    {
        return $company->delete();
    }
}
