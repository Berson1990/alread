<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Models\Year;
use App\Http\Models\Grade;

class YearControllers extends Controller
{
    public function __construct()
    {
        $this->year = new Year();
        $this->grade = new Grade();

    }

    public function index()
    {
        return view('year.year');
    }

    public function getall()
    {
        return $this->year
            ->select(
                $this->year->getTable() . '.*',
                $this->grade->getTable() . '.*'
            )
            ->join($this->grade->getTable(), $this->year->getTable() . '.grade_id', '=', $this->grade->getTable() . '.grade_id')
            ->get();
    }

    public function store()
    {
        $input = Request()->all();
        $year = $this->year->create($input);

      $output=    $this->year
            ->select(
                $this->year->getTable() . '.*',
                $this->grade->getTable() . '.*'
            )
            ->join($this->grade->getTable(), $this->year->getTable() . '.grade_id', '=', $this->grade->getTable() . '.grade_id')
            ->where('year_id', '=', $year->year_id)
            ->get();

        return $output[0];
    }

    public function update($id)
    {
        $input = Request()->all();
        $this->year->find($id)->update($input);
        return $this->year->where('year_id', '=', $id)->get();
    }

    public function delete($id)
    {
        return $this->year->where('year_id', '=', $id)->delete();
    }
}
