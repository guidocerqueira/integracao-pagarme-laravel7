<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostbackController extends Controller
{
    public function postback(Request $request)
    {
        dd($request);
        return;
    }
}
