<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Queries\DomainQuery;
use App\Http\Requests\Domain\CreateDomainRequest;
use App\Http\Requests\Domain\UpdateDomainRequest;
use App\Http\Resources\BaseResource;
use App\Models\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Domain::class);
    }

    public function index(Request $request, DomainQuery $query)
    {
        $domains = $query->paginate();

        return BaseResource::collection($domains);
    }

    public function list(Request $request)
    {
        $domains = Domain::whereNull('user_id')
            ->orWhere('user_id', $request->user()->id)
            ->get();

        return BaseResource::collection($domains);
    }

    public function show(Domain $domain)
    {
        return new BaseResource($domain);
    }

    public function store(CreateDomainRequest $request)
    {
        $domain = Domain::create($request->validated());

        return new BaseResource($domain);
    }

    public function update(UpdateDomainRequest $request, Domain $domain)
    {
        $domain->update($request->validated());

        return new BaseResource($domain);
    }

    public function destroy(Domain $domain)
    {
        $domain->delete();

        return response()->noContent();
    }
}
