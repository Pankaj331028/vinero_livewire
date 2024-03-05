<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\DataTables\ContactDataTable;

class ContactUsController extends Controller
{
    // public function index(Request $request)
    // {
    //     // return $dt->render('admin.contactus.index',['title' => 'contactus']);
    //     return view('admin.contactus.index');
    // }
    public function index(Request $request, ContactDataTable $dt)
    {

        return $dt->render('admin.contactus.index',['title' => 'contact-us']);
    }
}
