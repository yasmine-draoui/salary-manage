<!DOCTYPE html>
<html lang="en">




<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>



    <style>
        body {
            font-family: sans-serif;
        }

        .box-container {
            width: 80%;
            padding: 2rem;
            border: 1px solid #f2f2f2;
            border-radius: 5px;
            background-color: #ffffff;
            margin-left: 10%;
            margin-right: 10%;
        }

        .box-container .title {
            font-weight: bold;
            padding: 1rem;
            border-bottom: 1px solid #f2f2f2;
            background-color: #f2f2f2;
        }

        .transaction-box {
            margin-top: 1rem;
        }

        .transaction-box .item {
            display: table;
            width: 100%;
            margin-bottom: 1rem;
        }

        .transaction-box .item>* {
            display: table-cell;
            vertical-align: middle;
        }

        .transaction-box .item> :first-child {
            text-align-last: left;
        }

        .transaction-box .item> :last-child {
            text-align-last: right;
            font-weight: bold;
        }

        .transaction_details_box {
            margin-top: 3rem;
            border-radius: 5px;
            display: table;
            width: 100%;
            margin-bottom: 3rem;
        }

        .transaction_details_box .left {
            display: table;
            margin-bottom: 1rem;
            width: 100%;
        }

        .transaction_details_box .left>* {
            display: table-cell;
            vertical-align: middle;
        }



        .transaction_details_box .left .item {
            display: table;
            width: 100%;
            float: left;
            margin-bottom: 1rem;
        }

        .transaction_details_box .left .item>* {
            display: table-cell;
            vertical-align: middle;

            width: 100%;
            margin-bottom: 1rem;
        }

        .transaction_details_box .left .item> :first-child {
            text-align: left;
        }

        .transaction_details_box .left .item> :last-child {
            text-align: right;
        }

        .transaction_details_box .right {
            display: table;
            width: 100%;
        }

        .transaction_details_box .right table {
            width: 100%;
        }

        .transaction_details_box .right .payment_tile {
            margin-top: 2rem;
            margin-bottom: 2rem;
            text-transform: uppercase;
            font-weight: bold;
        }

        th {
            background: #8a97a0;
            color: #fff;
        }

        tr {
            background: #f4f7f8;
        }

        tr:nth-child(even) {
            background: #e8eeef;
        }

        th,
        td {
            padding: 0.5rem;
        }

        .single_item .value {
            font-weight: bold;
        }
    </style>



</head>

<body>
    <div class="box-container">

        <div class="title">
            <b>Fiche de paie</b>
        </div>

        <div class="transaction-box">


            <div class="item">
                <div class="label">Identifiant employer:</div>
                <div class="value">Emp{{$fullPaymentInfo->employer->id}}</div>
            </div>
            <div class="item">
                <div class="label">Nom & prénom:</div>
                <div class="value">{{$fullPaymentInfo->employer->nom}} {{$fullPaymentInfo->employer->prenom}} ({{$fullPaymentInfo->employer->email}})</div>
            </div>
            <div class="item">
                <div class="label">Département:</div>
                <div class="value">{{$fullPaymentInfo->employer->departement->nom}}</div>
            </div>
            <div class="item">
                <div class="label">Mois & Année:</div>
                <div class="value">{{$fullPaymentInfo->month}} / {{$fullPaymentInfo->year}} </div>
            </div>



        </div>

        <div class="last_item">

            <div class="title"> Détails du paiement
            </div>
            <div class="transaction_details_box">

                <div class="right">

                    <table>
                        <thead>
                            <th>
                                Date
                            </th>
                            <th>Montant</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$fullPaymentInfo->launch_date}}</td>
                                <td>{{$fullPaymentInfo->amount}}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="single_item"> <span>Total</span>
                                        <span class="value">{{$fullPaymentInfo->amount}} DZD</span>
                                    </div>
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
