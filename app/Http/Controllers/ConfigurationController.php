<?php

namespace App\Http\Controllers;


use App\Models\configuration;
use App\Http\Requests\SaveConfigRequest;

class ConfigurationController extends Controller
{
    public function index(){
        $allConfigurations = configuration::latest()->paginate(10);
        return view('config.index',compact('allConfigurations'));
    }

    public function create(){
        return view('config.create');
    }

    public function store(SaveConfigRequest $request){
        try{
            configuration::create($request->validated());
            return redirect()->route('config.index')->with('success_message','configuration ajoutée');
        }catch(Exception $e){
            dd($e);
            throw new Exception('Erreur lors de l\'enregistrement de la configuration');
        }
    }

    public function delete(configuration $config)
    {
            $config->delete();
            return redirect()->route('config.index')->with('success_message','configuration supprimée');

    }
}
