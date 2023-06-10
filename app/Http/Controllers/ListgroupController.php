<?php

namespace App\Http\Controllers;

use App\Models\listgroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListgroupController extends Controller
{

    public function create(Request $req)
    {
        // dd($req->all());

        $listgroup = new listgroup();
        $listgroup->user_id = Auth::id();
        $listgroup->name = $req->name;

        $listgroup->save();


        return redirect()->back();
    }
    public function delete(Request $req, $id)
    {

        $listgroup = listgroup::destroy($id);


        return redirect()->back();
    }
    public function update(Request $req, $id)
    {
        $listgroup = listgroup::findOrFail($id);

        $listgroup->name = $req->name;

        $listgroup->save();
        return redirect()->back();
    }
    public function theme(Request $req, $id)
    {
        $listgroup = listgroup::findOrFail($id);

        $listgroup->theme = $req->theme;

        $listgroup->save();

        return redirect()->back();
    }
}
