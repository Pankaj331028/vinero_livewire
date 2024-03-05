<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SellerService;

class SellerServiceController extends Controller
{
    public function edit(Request $request, $id = NULl){

        $title = 'Edit';
       return view('admin.sellerservice.edit', compact('title','id'));
    }
}
