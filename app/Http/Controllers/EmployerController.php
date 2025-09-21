<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employer;
use App\Models\departement;
use App\Http\Requests\SaveEmployerRequest;

class EmployerController extends Controller
{
    public function index(){
        $employer = Employer::with('departement')->paginate(10);
        return view('employer.index',compact('employer'));
    }

    public function create(){
        try{
            $departements = Departement::orderBy('nom')->get();
            return view('employer.create',compact('departements'));
        }catch(Exception $e){
            dd($e);
        }
    }

    public function store(SaveEmployerRequest $request)
    {

        try {
            $employer = new Employer();
            $employer->departement_id = $request->departement_id;
            $employer->nom = $request->nom;
            $employer->prenom = $request->prenom;
            $employer->email = $request->email;
            $employer->contact = $request->contact;
            $employer->montant_journalier = $request->montant_journalier;
            $employer->save();

            return redirect()->route('employer.index')
                         ->with('success_message', 'Employé enregistré avec succès');

        } catch (Exception $e) {
            dd($e); // Arrête le script et affiche l’erreur
        }
    }

    public function edit(Employer $employer){
        $departements= Departement::all();
        return view('employer.edit',compact('employer','departements'));
    }

    public function update(Employer $employer, SaveEmployerRequest $request){
        try{
            $employer->departement_id = $request->departement_id;
            $employer->nom = $request->nom;
            $employer->prenom = $request->prenom;
            $employer->email = $request->email;
            $employer->contact = $request->contact;
            $employer->montant_journalier = $request->montant_journalier;
            $employer->update();  //sauvegarde en base
            return redirect()->route('employer.index')->with('success', 'Employer mis à jour avec succès');
        } catch (Exception $e) {
            dd($e); // Arrête le script et affiche l’erreur
        }
    }

    public function delete(Employer $employer)
    {
        $employer->delete();
        return redirect()->route('employer.index')->with('success', 'Employer supprimé');
    }


}
