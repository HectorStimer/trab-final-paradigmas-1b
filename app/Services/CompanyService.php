<?php

namespace App\Services;

use App\Repositories\CompanyRepository;
use App\Models\Company;

class CompanyService
{
    protected $repo;

    public function __construct(CompanyRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list(array $filters = [])
    {
        // aqui pode entrar outras regras de negócio antes de retornar
        return $this->repo->all($filters);
    }

    public function get(int $id): ?Company
    {
        return $this->repo->find($id);
    }

    public function create(array $data): Company
    {
        // regras de negócio (ex: formatar campos) antes da criação
        return $this->repo->create($data);
    }

    public function update(int $id, array $data): ?Company
    {
        $company = $this->repo->find($id);
        if (!$company) {
            return null;
        }

        return $this->repo->update($company, $data);
    }

    public function delete(int $id): bool
    {
        $company = $this->repo->find($id);
        if (!$company) {
            return false;
        }

        return $this->repo->delete($company);
    }
}
