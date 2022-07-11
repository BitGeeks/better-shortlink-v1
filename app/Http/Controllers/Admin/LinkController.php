<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Queries\LinkQuery;
use App\Http\Requests\LinkRequest;
use App\Http\Resources\BaseResource;
use App\Models\Link;

class LinkController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Link::class);
    }

    public function index(LinkQuery $query)
    {
        $links = $query->paginate();

        return BaseResource::collection($links);
    }

    public function show(Link $link)
    {
        $link->load('tags');

        return new BaseResource($link);
    }

    public function store(LinkRequest $request)
    {
        $link = Link::create($request->validated());

        $link->tags()->sync(
            $request->getTags()
        );

        return new BaseResource($link);
    }

    public function update(LinkRequest $request, Link $link)
    {
        $link->update($request->validated());

        $link->tags()->sync(
            $request->getTags()
        );

        return new BaseResource($link);
    }

    public function destroy(Link $link)
    {
        $link->delete();

        return response()->noContent();
    }
}
