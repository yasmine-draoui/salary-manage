<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Fiche de paie</title>

<style>

body{
    font-family: DejaVu Sans, sans-serif;
    background:#f5f6fa;
    margin:0;
    padding:30px;
}

/* ===== Container ===== */

.payslip{
    max-width:800px;
    margin:auto;
    background:#fff;
    padding:30px;
    border-radius:8px;
    box-shadow:0 0 10px rgba(0,0,0,.05);
}

/* ===== Header ===== */

.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:2px solid #eee;
    padding-bottom:15px;
    margin-bottom:25px;
}

.header h2{
    margin:0;
    color:#2c3e50;
}

/* ===== Employee Info ===== */

.info{
    margin-bottom:25px;
}

.info-row{
    display:flex;
    justify-content:space-between;
    padding:6px 0;
    border-bottom:1px dashed #eee;
}

.label{
    color:#555;
}

.value{
    font-weight:bold;
}

/* ===== Table ===== */

table{
    width:100%;
    border-collapse:collapse;
}

thead{
    background:#2c3e50;
    color:white;
}

th,td{
    padding:10px;
    text-align:left;
}

tbody tr:nth-child(even){
    background:#f7f9fb;
}

/* ===== Total ===== */

.total{
    text-align:right;
    margin-top:15px;
    font-size:18px;
    font-weight:bold;
    color:#27ae60;
}

/* ===== Footer ===== */

.footer{
    margin-top:40px;
    text-align:center;
    font-size:12px;
    color:#999;
}

</style>
</head>

<body>

<div class="payslip">

    <!-- HEADER -->
    <div class="header">
        <h2>Fiche de paie</h2>
        <div>
            {{$fullPaymentInfo->month}} / {{$fullPaymentInfo->year}}
        </div>
    </div>

    <!-- EMPLOYEE INFO -->
    <div class="info">

        <div class="info-row">
            <span class="label">Identifiant</span>
            <span class="value">EMP{{$fullPaymentInfo->employer->id}}</span>
        </div>

        <div class="info-row">
            <span class="label">Nom & Prénom</span>
            <span class="value">
                {{$fullPaymentInfo->employer->nom}}
                {{$fullPaymentInfo->employer->prenom}}
            </span>
        </div>

        <div class="info-row">
            <span class="label">Email</span>
            <span class="value">{{$fullPaymentInfo->employer->email}}</span>
        </div>

        <div class="info-row">
            <span class="label">Département</span>
            <span class="value">
                {{$fullPaymentInfo->employer->departement->nom}}
            </span>
        </div>

    </div>

    <!-- PAYMENT TABLE -->
    <table>
        <thead>
            <tr>
                <th>Date paiement</th>
                <th>Montant</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>{{$fullPaymentInfo->launch_date}}</td>
                <td>{{$fullPaymentInfo->amount}} DZD</td>
            </tr>
        </tbody>
    </table>

    <div class="total">
        Total : {{$fullPaymentInfo->amount}} DZD
    </div>

    <div class="footer">
        Document généré automatiquement — SalaireGest
    </div>

</div>

</body>
</html>
