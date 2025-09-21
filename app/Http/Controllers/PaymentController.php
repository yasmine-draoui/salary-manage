<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\employer;
use App\Models\Configuration;
use Carbon\Carbon;
use Illuminate\Support\Str;
use PDF;

class PaymentController extends Controller
{
    public function index(){
        $defaultPaymentDateQuery = Configuration::where('type','PAYMENT_DATE')->first();
        $defaultPaymentDate=$defaultPaymentDateQuery->value;
        $convertedPaymentDate = intval($defaultPaymentDate);

        $today = date('d');
        $isPaymentDay = false;

        if($today == $convertedPaymentDate){
            $isPaymentDay = true;
        }

        $payments=Payment::latest()->orderBy('id','desc')->paginate(10);
        return view('payment.index',compact('payments','isPaymentDay','convertedPaymentDate'));
    }

    public function initPayment(){
        $monthMapping = [
            'JANUARY'=>'JANVIER',
        'FEBRUARY'=>'FEVRIER',
        'MARCH'=>'MARS',
        'APRIL'=>'AVRIL',
        'MAY'=>'MAI',
        'JUNE'=>'JUIN',
        'JULY'=>'JUILLET',
        'AUGUST'=>'AOUT',
        'SEPTEMBER'=>'SEPTEMBRE',
        'OCTOBER'=>'OCTOBRE',
        'NOVEMBER'=>'NOVEMBRE',
        'DECEMBER'=>'DECEMBRE'
    ];

        $currentMonth=strtoupper(Carbon::now()->formatLocalized('%B'));
        $currentMonthInFrench = $monthMapping[$currentMonth] ?? '';


        $currentYear = strtoupper(Carbon::now()->format('Y'));


        //simuler les paiements pour tous les employés dans le mois en cours
        //les paiements concerne les employés qui n'ont pas encore été payé dans le mois actuel

        //recuperer la liste des employers qui n'ont pas ete payer pour le mois en cours
        $employers = employer::whereDoesntHave('payments', function($query) use ($currentMonthInFrench, $currentYear){
            $query->where('month','=',$currentMonthInFrench)->where('year','=',$currentYear);
        })->get();


        //faire les paiements pour ces employers (dans le cas reel quand on a des comptes à débité et tout avec stripe..)
        foreach($employers as $employer){
            $hasBeenPaied = $employer->payments()->where('month', '=' , $currentMonthInFrench)->where('year','=',$currentYear)->exists();

            if(!$hasBeenPaied){
                $salaire = $employer->montant_journalier*30;

                $payment= new Payment([
                    'reference'=> strtoupper(Str::random(10)),
                    'employer_id'=>$employer->id,
                    'amount'=> $salaire,
                    'launch_date'=>now(),
                    'done_time'=>now(),
                    'status'=>'SUCCESS',
                    'month'=>$currentMonthInFrench,
                    'year'=>$currentYear
                ]);

                $payment->save();

            }
        }
        //redirect
        return redirect()->back()->with('success','Paiement des employés pour le mois de '.$currentMonthInFrench);
    }

    public function downloadInvoice(Payment $payment){
        try {
            $fullPaymentInfo = Payment::with('employer')->find($payment->id);
            //générer le pdf
            //return view('payment.facture', compact('fullPaymentInfo'));

            $pdf = PDF::loadView('payment.facture', compact('fullPaymentInfo'));
            return $pdf->download('fiche de paie '.$fullPaymentInfo->employer->nom. '.pdf');
        } catch (Exception $e) {
            throw new Exception("Une erreur est survenue lors du téléchargement de la fiche de paie");
        }
    }

}
