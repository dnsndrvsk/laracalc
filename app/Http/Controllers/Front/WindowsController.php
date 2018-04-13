<?php

namespace App\Http\Controllers\Front;

use App\Http\Resources\WindowsResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Wtype;
use App\Models\Wprofile;
use App\Models\Windows;

class WindowsController extends BaseController
{
    public function index()
    {
        $context['wtypes'] = Wtype::all();
        $context['wprofiles'] = Wprofile::all();
        $context['windows'] = Windows::all();

        return view('front.index', $context);
    }

    public function get_windows(Request $request)
    {
        $result = Windows::query();
        if ($request['wtype']) $result->where('wtypes', $request['wtype']);
        return new WindowsResource($result->firstOrFail());
    }
}