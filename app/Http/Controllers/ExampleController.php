<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExample;
use ParseError;

class ExampleController extends Controller
{
    public function index(storeexample $request)
    {
        $this;
        # code...
        dd($request);

        $request->validated();
    }

}
