<?php

namespace App\Http\Controllers;

use App\Models\departement;
use App\Models\employer;
use App\Models\User;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $totalDepartements = Departement::all()->count();
        $totalEmployers = Employer::all()->count();
        $totalAdministrateurs = User::all()->count();
        return view('dashboard', compact('totalDepartements', 'totalEmployers', 'totalAdministrateurs'));
    }
}
