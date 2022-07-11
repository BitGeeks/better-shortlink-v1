<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Models\Domain;

class DomainController extends Controller
{
    public function __invoke()
    {
        $domains = Domain::whereNull('user_id')->get();

        return BaseResource::collection($domains);
    }
}
