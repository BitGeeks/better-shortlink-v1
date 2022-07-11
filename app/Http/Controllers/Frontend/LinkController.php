<?php

namespace App\Http\Controllers\Frontend;

use App\Actions\RecordClickAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckPasswordRequest;
use App\Http\Requests\LinkRequest;
use App\Http\Resources\LinkResource;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function show(Request $request, $hash)
    {
        $link = Link::getByHash($hash);

        (new RecordClickAction())->execute($request, $link);

        if ($link->is_protected || $link->is_expired) {
            return view('app', [
                'is_expired' => $link->is_expired,
            ]);
        }

        return redirect($link->url);
    }

    public function store(LinkRequest $request)
    {
        $link = Link::create($request->validated());

        return new LinkResource($link);
    }

    public function check(CheckPasswordRequest $request)
    {
        return new LinkResource($request->getLink());
    }
}
