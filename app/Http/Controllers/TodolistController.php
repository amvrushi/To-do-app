<?php

namespace App\Http\Controllers;

use App\Models\listgroup;
use App\Models\todolist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodolistController extends Controller
{
    public function index($id = 0)
    {
        $appearance = listgroup::find($id)
            ->theme ?? '/13.jpg';
        $tasks = todolist::where('is_completed', 0)
            ->where('list_id', $id)
            ->where('user_id', Auth::id())
            ->get();
        $lists = listgroup::where('user_id', Auth::id())
            ->get();
        return view('dashboard', compact('tasks', 'lists', 'id', 'appearance'));
    }
    public function create(Request $req)
    {
        // dd($req->all());

        $todolist = new todolist;
        $todolist->user_id = Auth::id();

        $todolist->list_id = $req->talent;
        $todolist->task = $req->task;

        $todolist->priority = $req->priority;
        $todolist->is_completed = 0;

        $todolist->save();

        return redirect()->back();
    }
    public function update(Request $req, $id)
    {

        $todolist = todolist::findOrFail($id);

        $todolist->task = $req->task;
        $todolist->priority = $req->priority;
        $todolist->is_completed = 0;
        $todolist->save();
        return redirect()->back();
    }
    public function complete(Request $req, $id)
    {
        $todolist = todolist::findOrFail($id);
        $todolist->is_completed = 1;
        $todolist->save();
        return redirect()->back();
    }

    public function delete(Request $req, $id)
    {
        $todolist = todolist::destroy($id);
        return redirect()->back();
    }
}
