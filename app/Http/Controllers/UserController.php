<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit()
    {
        return view('user.edit');
    }

    public function update(UpdateUser $request)
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
