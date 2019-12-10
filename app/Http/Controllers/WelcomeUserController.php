<?php

namespace integradora\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeUserController extends Controller
{
    public function __invoke($apodo,$mote=null)
    {
    	if ($mote) {
		return "Saludos {$apodo}, tu mote es {$mote}";
	}
	else
	{
		return "Saludos {$apodo}";
	}
    }
}
