<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    public function changeEmail(){
        $user = Auth::user();
        $email = $user->email;
        return view('emailChange', compact('email'));
    }

    public function changeEmailSubmit(Request $request){
        $email = Auth::user();
        $email->email = $request->input('email');
        $email->save();
        return redirect()->route('home')->with('success', 'Email successfully change');
    }

}
