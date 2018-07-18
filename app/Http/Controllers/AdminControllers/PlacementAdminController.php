<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;

use App\Http\Models\Placement;
use App\Http\Models\PlacementExam;
use App\Http\Models\PlacementQuestions;
use App\Http\Models\Explanations;
use App\Http\Models\PlacementPayment;
use App\Http\Models\Users;
use Illuminate\Http\Request;

class PlacementAdminController extends Controller
{
    //
    public function __construct()
    {
        $this->placement = new Placement();
        $this->placement_exam = new PlacementExam();
        $this->placement_questions = new PlacementQuestions();
        $this->explantions = new Explanations();
        $this->placement_payment = new PlacementPayment();
        $this->users = new Users();
    }

    public function PlacemmentIndex()
    {
        return view('placement.placement');
    }

    public function GetPlacement()
    {
        return $this->placement->all();
    }

    public function CreatePlacement()
    {
        $input = Request()->all();
        return $this->placement->create($input);
    }

    public function UpdatePlacement($id)
    {
        $input = Request()->all();
        $this->placement->find($id)->update($input);
    }

    public function DeletePlacement($id)
    {
        $this->placement->find($id)->delete();
        return ['state' => '202'];
    }

    /*Placement Determine start*/
    public function Placement_Determine_index()
    {
        return view('placementdetermine.placementdetermine');
    }

    public function GetAllQuestions()
    {
        return $this->placement_questions->all();
    }

    public function CreateQuestion()
    {
        $input = Request()->all();
        return $this->placement_questions->create($input);
    }

    public function UpdateQuestions($id)
    {
        $input = Request()->all();
        $this->placement_questions->find($id)->update($input);
    }

    public function DeleteQuestions($id)
    {
        $this->placement_questions->find($id)->delete();
    }
    /*Placement Determine End*/
}
