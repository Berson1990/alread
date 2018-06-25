<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Models\AboutPolicy;

class AbouutPolicyControllers extends Controller
{
    //
    public function __construct()
    {
        $this->aboutpolicy = new AboutPolicy();
    }

    public function index()
    {
        return view('about.about');

    }

    public function getAbout()
    {

        return $this->aboutpolicy->all();
    }

    public function update($id)
    {

        $input = Request()->all();
        $this->aboutpolicy->find($id)->update($input);
    }

}
