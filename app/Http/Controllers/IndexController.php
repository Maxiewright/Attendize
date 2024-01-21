<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * redirect index page
     *
     * @param  Request  $request http request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showIndex(Request $request): RedirectResponse
    {
        return redirect()->route('showSelectOrganiser');
    }
}
