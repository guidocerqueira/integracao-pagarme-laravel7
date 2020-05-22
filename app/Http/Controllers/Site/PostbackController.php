<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostbackController extends Controller
{
    public function postback(Request $request)
    {
        $file = fopen(url('pagarme.txt'), 'a');
        $results = print_r($request, true);
        fwrite($file, $results);
        fclose($file);
        return;
    }
}
