<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\User;
use App\Models\ResetCodePassword;
use Illuminate\Support\Facades\Hash;
use App\Notifications\SendEmailToAdminAfterRegistrationNotification;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\submitDefineAccessRequest;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    public function create(){
        return view('admin.create');
    }

    public function edit(User $user){
        return view('admin.edit',compact('user'));
    }

    //enregistrer un admin en BD et envoyer un mail
    public function store(StoreAdminRequest $request, User $user){
        try {
            //logique de création de compte

            $user = new User();

            $user->name= $request->name;
            $user->email= $request->email;
            $user->password = Hash::make('default');
            $user->save();

            //envoyer un email pour puisse confirmer son compte

            //envoyer un code pour verification

            if($user){
                ResetCodePassword::where('email', $user->email)->delete();
                $code = rand(1000, 4000);

                $data= [
                    'code'=>$code,
                    'email'=>$user->email
                ];

                ResetCodePassword::create($data);

                Notification::route('mail', $user->email)->notify(new SendEmailToAdminAfterRegistrationNotification($code, $user->email));

                //rediriger le user vers une url

                return redirect()->route('admin.index')->with('success','Administrateur ajouté');
            }

        } catch (Exception $e) {
            dd($e);
            throw new Exception('une erreur est survenue lors de la création de cet administrateur');
        }
    }

    public function update(UpdateAdminRequest $request, User $user){
        try {
            //logique de mise a jour
        } catch (Exception $e) {
            dd($e);
            throw new Exception('une erreur est survenue lors de la mise à jour de cet administrateur');
        }
    }

    public function delete(User $user){
        try {

            $connectedAdminID = Auth::user()->id;

            if($connectedAdminID != $user->id){
                $user->delete();
                return redirect()->route('admin.index')->with('success','Administrateur supprimé');
            }else{
                return redirect()->back()->with('error_message','Vous ne pouvez pas supprimer votre compte');
            }
        } catch (Exception $e) {
            dd($e);
        }

    }

    public function defineAccess($email){
        $checkUserExist = User::where('email', $email)->first();
        if($checkUserExist){
            return view('auth.validate-account',compact('email'));
        }else{
            //return redirect()->route('login');
        }
    }
    public function submitDefineAccess(submitDefineAccessRequest $request){
        try {
            $user = User::where('email', $request->email)->first();
            if($user){
                $user->password = Hash::make($request->password);
                $user->update();

                return redirect()->route('login')->with('success', 'vos accès ont été correctement défini');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

}
