<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Models\Grade;

class GradeControllers extends Controller
{
    //
    public function __construct()
    {
        $this->grade = new Grade();

    }

    public function index()
    {
        return view('grade.grade');
    }

    public function getall()
    {
        return $this->grade->all();
    }

    public function store()
    {
        $input = Request()->all();
        return $this->grade->create($input);
    }

    public function update($id)
    {
        $input = Request()->all();
        $this->grade->find($id)->update($input);
        return $this->grade->where('grade_id', '=',$id)->get();
    }

    public function delete($id)
    {
        return $this->grade->where('grade_id','=', $id)->delete();
    }
}
