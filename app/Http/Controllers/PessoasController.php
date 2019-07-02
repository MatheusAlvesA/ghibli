<?php

namespace App\Http\Controllers;

use App\Model\Character;
use App\Http\Resources\Pessoas;
use Illuminate\Routing\Controller;

class PessoasController extends Controller
{
    /**
     * Show all the characters and movies
     *
     * @return Resource
     */
    public function show()
    {
        return Pessoas::collection(Character::all());
    }
}