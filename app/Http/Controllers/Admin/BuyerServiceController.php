<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BuyerService;

class BuyerServiceController extends Controller
{
    public function edit(Request $request, $id = NULl){

        $title = 'Edit';
       return view('admin.buyerservice.edit', compact('title','id'));
    }
}
