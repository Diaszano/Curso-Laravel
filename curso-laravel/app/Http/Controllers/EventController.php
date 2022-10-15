<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        $nome = "Lucas Dias";
        $arr = [1,2,3,4,5];
        $nomes = ['Lucas', 'Raila', 'Luana'];

        return view('welcome',['nome' => $nome, 'arr' => $arr, 'nomes' => $nomes]);
    }

    public function create(){
        return view('events.create');
    }
}
