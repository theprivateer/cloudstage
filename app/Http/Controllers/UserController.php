<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit()
    {
        return view('user.edit');
    }

    public function update(Request $request)
    {
        $formData = $request->except('_token');

        if(empty($formData['password']))
        {
            unset($formData['password']);
        } else
        {
            $formData['password'] = bcrypt($formData['password']);
        }

        \Auth::user()->fill($formData);

        \Auth::user()->save();

        return redirect()->back();
    }
}
