<?php

namespace App\Http\Controllers;

use App\Models\Link;

class SinglePageController extends Controller
{
    public function __invoke($hash = null)
    {
        if ($hash && Link::getByHash($hash)) {
            return redirect()->route('links.show', $hash);
        }

        return view('app');
    }
}
