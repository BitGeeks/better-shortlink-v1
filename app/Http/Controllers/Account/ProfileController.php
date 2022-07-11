<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Http\Requests\User\UploadImageRequest;
use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;
use Storage;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return new BaseResource($request->user());
    }

    public function update(UpdateProfileRequest $request)
    {
        $request->user()->update($request->validated());

        return new BaseResource($request->user());
    }

    public function uploadImage(UploadImageRequest $request)
    {
        $path = Storage::put('images', $request->getFile());
        $url = Storage::url($path);

        return response()->json([
            'url' => $url,
            'path' => $path,
        ]);
    }
}
