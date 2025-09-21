<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;
use App\Http\Requests\SavedDepartementRequest;

class DepartementController extends Controller
{
    public function index()
    {
        $departements = Departement::all();
        return view('departement.index', compact('departements'));
    }

    public function create()
    {
        return view('departement.create');
    }

    public function store(Departement $departement, SavedDepartementRequest $request)
    {
        $departement->nom = $request->nom;
        $departement->save();  //sauvegarde en base
        return redirect()->route('departement.index')->with('success', 'Département enregistrer avec succès');
    }

    public function edit(Departement $departement)
    {
        return view('departement.edit', compact('departement'));
    }

    public function update(Departement $departement, SavedDepartementRequest $request)
    {
        $departement->nom = $request->nom;
        $departement->update();  //sauvegarde en base
        return redirect()->route('departement.index')->with('success', 'Département mis à jour avec succès');
    }

    public function delete(Departement $departement)
    {
        $departement->delete();
        return redirect()->route('departement.index')->with('success', 'Département supprimé');
    }
}
