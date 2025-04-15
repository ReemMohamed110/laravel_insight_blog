<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactAction(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'message' => 'required',
            
        ]);
        return back()->with('success', 'message sent successfully');;
    }
}
