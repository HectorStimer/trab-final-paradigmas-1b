<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{
    protected $service;

    public function __construct(CompanyService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['name', 'responsible_id']);
        $companies = $this->service->list($filters);

        return response()->json($companies);
    }

    public function store(StoreCompanyRequest $request)
    {
        $data = $request->validated();
        $company = $this->service->create($data);

        return response()->json($company, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $company = $this->service->get((int)$id);
        if (!$company) {
            return response()->json(['message' => 'Empresa não encontrada.'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($company);
    }

    public function update(UpdateCompanyRequest $request, $id)
    {
        $data = $request->validated();
        $company = $this->service->update((int)$id, $data);

        if (!$company) {
            return response()->json(['message' => 'Empresa não encontrada.'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($company);
    }

    public function destroy($id)
    {
        $deleted = $this->service->delete((int)$id);

        if (!$deleted) {
            return response()->json(['message' => 'Empresa não encontrada.'], Response::HTTP_NOT_FOUND);
        }

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
