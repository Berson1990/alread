<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Models\Weak;
class WeekControllers extends Controller
{
    public function __construct()
    {
        $this->week= new Weak();

    }

    public function index()
    {
        return view('week.week');
    }

    public function getall()
    {
        return $this->week->all();
    }

    public function store()
    {
        $input = Request()->all();
        return $this->week->create($input);
    }

    public function update($id)
    {
        $input = Request()->all();
        $this->week->find($id)->update($input);
        return $this->week->where('week_id', '=',$id)->get();
    }

    public function delete($id)
    {
        return $this->week->where('week_id','=', $id)->delete();
    }
}
