<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Models\CountactUs;

class ContactUsControllers extends Controller
{
    //
    public function __construct()
    {
        $this->contact_us = new CountactUs();
    }

    public function index()
    {
        return view('contact.contact');
    }

    public function getContacr()
    {
        return $this->contact_us->all();
    }

    public function update($id)
    {
        $input = Request()->all();
        $this->contact_us->find($id)->update($input);
    }
}
