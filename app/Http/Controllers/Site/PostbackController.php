<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostbackController extends Controller
{
    public function postback(Request $request)
    {
        // DB::table('postbacks')->insert([
        //     'postback' => json_encode($request->all())
        // ]);

        dd($request->all());
        return;
    }
}
