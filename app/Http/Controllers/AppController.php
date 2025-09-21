<?php

namespace App\Http\Controllers;

use App\Models\departement;
use App\Models\employer;
use App\Models\configuration;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\carbon;
class AppController extends Controller
{
    public function index()
    {
        $totalDepartements = Departement::all()->count();
        $totalEmployers = Employer::all()->count();
        $totalAdministrateurs = User::all()->count();


        $appName = Configuration::where('type','APP_NAME')->first();

        $paymentNotification="";

        $currentDate = Carbon::now()->day;

        $defaultPaymentDate=null;

        $defaultPaymentDateQuery = Configuration::where('type','PAYMENT_DATE')->first();

        if($defaultPaymentDateQuery ){
            $defaultPaymentDate=$defaultPaymentDateQuery->value;
            $convertedPaymentDate = intval($defaultPaymentDate);

            if($currentDate < $convertedPaymentDate){
                $paymentNotification = "Le paiement doit avoir lieu le ".$defaultPaymentDate." de ce mois";
            }else{
                $nextMonth = Carbon::now()->addMonth();
                $nextMonthName = $nextMonth->format('F');

                $paymentNotification = "Le paiement doit avoir lieu le ".$defaultPaymentDate. " du mois de ".$nextMonthName;
            }
        }


        return view('dashboard', compact('totalDepartements', 'totalEmployers', 'totalAdministrateurs', 'paymentNotification'));
    }
}
