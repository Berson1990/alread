<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Models\BankAccount;

class BankAccountControllers extends Controller
{
    public function __construct()
    {
        $this->bankaccount = new BankAccount();
        $this->baseurl = 'http://muthaber-admin.muthaberapp.com/';
        $this->realbath = '/var/www/alreadapp/html/public/';
    }

    public function index()
    {
        return view('bankaccount.bankaccount');
    }

    public function getall()
    {
        return $this->bankaccount->all();
    }

    public function store()
    {
        $input = Request()->all();

        if (!empty($input["imge"])) {
            $image = $input["imge"];
            $jpg_name = "photo-" . time() . ".jpg";
            $path = $this->realbath . "/bankaccount/" . $jpg_name;
            $input["imge"] = $this->baseurl . "bankaccount/" . $jpg_name;
            $img = substr($image, strpos($image, ",") + 1);//take string after ,
            $imgdata = base64_decode($img);
            $success = file_put_contents($path, $imgdata);
        }

        return $this->bankaccount->create($input);
    }

    public function update($id)
    {
        $input = Request()->all();

        if (!empty($input["imge"])) {
            $image = $input["imge"];
            $jpg_name = "photo-" . time() . ".jpg";
            $path = $this->realbath . "/bankaccount/" . $jpg_name;
            $input["imge"] = $this->baseurl . "bankaccount/" . $jpg_name;
            $img = substr($image, strpos($image, ",") + 1);//take string after ,
            $imgdata = base64_decode($img);
            $success = file_put_contents($path, $imgdata);
        }

        $this->bankaccount->find($id)->update($input);
        return $this->bankaccount->where('bankaccount_id', '=', $id)->get();
    }

    public function delete($id)
    {
        return $this->bankaccount->where('bankaccount_id', '=', $id)->delete();
    }
}
