<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Subject;
use App\Http\Models\Grade;
use App\Http\Models\Year;


class SubjectControllers extends Controller
{
    //

    public function __construct()
    {
        $this->subject = new Subject();
        $this->grade = new Grade();
        $this->year = new Year();
        $this->baseurl = 'http://muthaber-admin.muthaberapp.com/';
        $this->realbath = '/var/www/alreadapp/html/public/';

    }

    public function index()
    {
        return view('subject.subject');
    }

    public function getall()
    {
        $output = $this->subject
            ->select(
                $this->subject->getTable() . '.*',
                $this->year->getTable() . '.*',
                $this->grade->getTable() . '.*'
            )
            ->leftjoin($this->grade->getTable(), $this->subject->getTable() . '.grade_id', '=', $this->grade->getTable() . '.grade_id')
            ->leftjoin($this->year->getTable(), $this->subject->getTable() . '.year_id', '=', $this->year->getTable() . '.year_id')
            ->get();
        return $output;
    }

    public function GetSubjectWhenAssgin($year_id, $grade_id)
    {
        $output = $this->subject
            ->select(
                $this->subject->getTable() . '.*',
                $this->year->getTable() . '.*',
                $this->grade->getTable() . '.*'
            )
            ->leftjoin($this->grade->getTable(), $this->subject->getTable() . '.grade_id', '=', $this->grade->getTable() . '.grade_id')
            ->leftjoin($this->year->getTable(), $this->subject->getTable() . '.year_id', '=', $this->year->getTable() . '.year_id')
            ->where($this->subject->getTable() . '.year_id', $year_id)
            ->where($this->subject->getTable() . '.grade_id', $grade_id)
            ->get();
        return $output;
    }

    public function store()
    {
        $input = Request()->all();
        if (!empty($input["image"])) {
            $image = $input["image"];
            $jpg_name = "photo-" . time() . ".jpg";
            $path = $this->realbath . "/subject_image/" . $jpg_name;
            $input["image"] = $this->baseurl . "subject_image/" . $jpg_name;
            $img = substr($image, strpos($image, ",") + 1);//take string after ,
            $imgdata = base64_decode($img);
            $success = file_put_contents($path, $imgdata);
        }
        $output = $this->subject->create($input);
        $subject_id = $output->subject_id;
        $output = $this->subject
            ->select(
                $this->subject->getTable() . '.*',
                $this->year->getTable() . '.*',
                $this->grade->getTable() . '.*'
            )
            ->leftjoin($this->grade->getTable(), $this->subject->getTable() . '.grade_id', '=', $this->grade->getTable() . '.grade_id')
            ->leftjoin($this->year->getTable(), $this->subject->getTable() . '.year_id', '=', $this->year->getTable() . '.year_id')
            ->where($this->subject->getTable() . '.subject_id', '=', $subject_id)
            ->get();
        return $output;

    }

    public function update($id)
    {
        $input = Request()->all();

        if (!empty($input["image"])) {
            $image = $input["image"];
            $jpg_name = "photo-" . time() . ".jpg";
            $path = $this->realbath . "/subject_image/" . $jpg_name;
            $input["image"] = $this->baseurl . "subject_image/" . $jpg_name;
            $img = substr($image, strpos($image, ",") + 1);//take string after ,
            $imgdata = base64_decode($img);
            $success = file_put_contents($path, $imgdata);
        }

        $this->subject->find($id)->update($input);
        return $this->subject
            ->leftjoin($this->grade->getTable(), $this->subject->getTable() . '.grade_id', '=', $this->grade->getTable() . '.grade_id')
            ->leftjoin($this->year->getTable(), $this->subject->getTable() . '.year_id', '=', $this->year->getTable() . '.year_id')
            ->where('subject_id', '=', $id)
            ->get();
    }

    public function delete($id)
    {
        return $this->subject->where('subject_id', '=', $id)->delete();
    }
}
