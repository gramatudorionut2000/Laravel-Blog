<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class JurnalistController extends Controller
{
    public function index()
    {
        return view('blog.unnapproved_journalists', [
            'journalists' =>User::where('role', '1')->get(),
        ]);
    }

    public function edit($id)
    { 
        return view('blog.jurnalist.edit', [
            'journalist' => User::where('id', $id)->first(),
        ]);
    }

    public function update(Request $request, $id)
    {
        User::where('id', $id)->update([
            'activated'=> 1,
        ]);
        return redirect(route('unnapproved_journalists'));
    }


    public function destroy($id)
    {
        User::destroy($id);
        return redirect(route('unnapproved_journalists'))->with('message', 'Journalist account creation denied');
    }

}
