<?php

namespace App\Http\Controllers;

use App\Models\dato;
use Illuminate\Http\Request;

use App\Mail\ConcatanosMailable;
use Illuminate\Support\Facades\Mail;

class ContactanosController extends Controller
{
    public function index(){
        return view('contactanos.index');

    }

    public function store(Request $request){
        $email = new ConcatanosMailable($request);

        $request->validate([
            'name' => 'required',
            'correo' => 'required|email'


        ]);

        Mail::to($request->get('correo'))->send($email);
        $dato = new dato();
        $dato->name = $request->name;
        $dato->email = $request->correo;

        $dato->save();


        return redirect()->route('inicio.principal');
    
    }
}
