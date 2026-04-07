@extends('layouts.template')

@section('content')
    <div class="container-fluid">


        <div class="row g-4 mb-4">

            {{-- ================= TITRE ================= --}}
            <div class="col-12">
                <h1 class="app-page-title mb-0">
                    <i class="fa-solid fa-chart-line me-2 text-primary"></i>
                    Tableau de bord
                </h1>
            </div>

            {{-- ================= ALERTE PAIEMENT ================= --}}
            @if ($paymentNotification)
                <div class="col-12">
                    <div class="card border-0 shadow-sm bg-light">
                        <div class="card-body d-flex align-items-center">

                            <div class="me-3">
                                <i class="fa-solid fa-calendar-check fa-2x text-warning"></i>
                            </div>

                            <div>
                                <h5 class="mb-1 fw-bold">Notification de paiement</h5>
                                <p class="mb-0 text-muted">
                                    {{ $paymentNotification }}
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            @endif


            {{-- ================= STATISTIQUES ================= --}}
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">

                        <div class="mb-3">
                            <i class="fa-solid fa-building fa-2x text-primary"></i>
                        </div>

                        <h6 class="text-muted">Départements</h6>

                        <h2 class="fw-bold">
                            {{ $totalDepartements }}
                        </h2>

                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">

                        <div class="mb-3">
                            <i class="fa-solid fa-users fa-2x text-success"></i>
                        </div>

                        <h6 class="text-muted">Employés</h6>

                        <h2 class="fw-bold">
                            {{ $totalEmployers }}
                        </h2>

                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">

                        <div class="mb-3">
                            <i class="fa-solid fa-user-shield fa-2x text-danger"></i>
                        </div>

                        <h6 class="text-muted">Administrateurs</h6>

                        <h2 class="fw-bold">
                            {{ $totalAdministrateurs }}
                        </h2>

                    </div>
                </div>
            </div>


        </div>



        {{-- ================= CHARTS ================= --}}
        <div class="row g-4 mb-4">

            {{-- Chart 1 --}}
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold">
                        Évolution des Paiements (Demo)
                    </div>
                    <div class="card-body">
                        <canvas id="paymentChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Chart 2 --}}
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold">
                        Employés par Département (Demo)
                    </div>
                    <div class="card-body">
                        <canvas id="departmentChart"></canvas>
                    </div>
                </div>
            </div>

        </div>



        {{-- ================= QUICK ACTIONS ================= --}}
        <div class="row g-4">

            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold">
                        Actions rapides
                    </div>

                    <div class="card-body d-flex flex-wrap gap-2">

                        <a href="{{ route('employer.store') }}" class="btn btn-primary">
                            + Ajouter Employé
                        </a>

                        <a href="{{ route('departement.store') }}" class="btn btn-success">
                            + Ajouter Département
                        </a>

                        <a href="#" class="btn btn-warning">
                            Générer Paie
                        </a>

                    </div>
                </div>
            </div>


            {{-- ACTIVITÉ --}}
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold">
                        Activité récente
                    </div>

                    <div class="card-body">

                        <ul class="list-group list-group-flush">

                            <li class="list-group-item">
                                ✔ Nouvel employé ajouté
                            </li>

                            <li class="list-group-item">
                                ✔ Département créé
                            </li>

                            <li class="list-group-item">
                                ✔ Configuration mise à jour
                            </li>

                        </ul>

                    </div>
                </div>
            </div>

        </div>

    </div>



    {{-- ================= CHART JS ================= --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // ===== PAYMENT CHART =====
        const paymentCtx = document.getElementById('paymentChart');

        new Chart(paymentCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun'],
                datasets: [{
                    label: 'Paiements',
                    data: [12000, 15000, 14000, 17000, 16000, 19000],
                    borderWidth: 2
                }]
            }
        });


        // ===== DEPARTMENT CHART =====
        const deptCtx = document.getElementById('departmentChart');

        new Chart(deptCtx, {
            type: 'bar',
            data: {
                labels: ['RH', 'Finance', 'IT', 'Support'],
                datasets: [{
                    label: 'Employés',
                    data: [10, 6, 14, 8],
                    borderWidth: 1
                }]
            }
        });
    </script>
@endsection
