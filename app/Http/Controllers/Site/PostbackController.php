<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostbackController extends Controller
{
    public function postback(Request $request)
    {
        $file = fopen(env('APP_URL') . '/log.txt', 'a');
        $results = print_r($request, true);
        fwrite($file, $results);
        fclose($file);
        return;
    }
}
