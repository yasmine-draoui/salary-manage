@extends('layouts.template')

@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            {{-- ================= HEADER ================= --}}
            <div class="d-flex justify-content-between align-items-center pb-3 mb-2 border-bottom">

                <div>
                    <h2 class="fw-bold mb-0">Gestion des Paiements</h2>
                    <small class="text-muted">
                        Tableau de suivi des paiements salariés
                    </small>
                </div>

                @if ($isPaymentDay)
                    <a href="{{ route('payment.init') }}" class="btn btn-primary shadow-sm">
                        <i class="fa fa-play me-1"></i>
                        Lancer les paiements
                    </a>
                @endif

            </div>

            @if (!$isPaymentDay)
                <div class="alert alert-warning d-flex align-items-center shadow-sm">

                    <i class="fa fa-calendar-alt fs-4 me-3"></i>

                    <div>
                        Paiement autorisé uniquement le
                        <strong>{{ $convertedPaymentDate }}</strong>
                        de chaque mois.
                    </div>

                </div>
            @endif
            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif



            {{-- ================= STATS ================= --}}
            <div class="row g-4 mb-4">

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <h6 class="text-muted">Transactions</h6>
                            <h3 class="fw-bold">
                                {{ $payments->total() }}
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <h6 class="text-muted">Total payé</h6>
                            <h3 class="fw-bold">
                                {{ number_format($payments->sum('amount'), 2) }} DZD
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">

                            <p class="text-muted mb-1">Mois courant</p>
                            <h4 class="fw-bold text-primary">
                                {{ now()->translatedFormat('F') }}
                            </h4>

                        </div>
                    </div>
                </div>

            </div>



            {{-- ================= TABLE ================= --}}
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">
                                <tr>
                                    <th>Référence</th>
                                    <th>Employé</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                    <th>Mois</th>
                                    <th>Année</th>
                                    <th>Status</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($payments as $payment)
                                    <tr>

                                        <td>{{ $payment->reference }}</td>

                                        <td>
                                            {{ $payment->employer->nom }}
                                        </td>

                                        <td>
                                            <strong>{{ number_format($payment->amount, 2) }} DZD</strong>
                                        </td>

                                        <td>{{ $payment->launch_date }}</td>

                                        <td>{{ $payment->month }}</td>

                                        <td>{{ $payment->year }}</td>

                                        <td>

                                            @php
                                                $statusColor = match (strtolower($payment->status)) {
                                                    'paid' => 'success',
                                                    'pending' => 'warning',
                                                    'failed' => 'danger',
                                                    default => 'secondary',
                                                };
                                            @endphp

                                            <span class="badge rounded-pill bg-{{ $statusColor }}">
                                                {{ ucfirst($payment->status) }}
                                            </span>

                                        </td>

                                        <td class="text-end">

                                            <div class="btn-group">

                                                <a href="{{ route('payment.download', $payment->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="fa fa-download"></i>
                                                </a>

                                                <button class="btn btn-sm btn-outline-danger btn-delete"
                                                    data-id="{{ $payment->id }}"
                                                    data-reference="{{ $payment->reference }}" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="8" class="text-center">
                                            Aucune transaction effectuée
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>



            {{-- ================= PAGINATION REAL ================= --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $payments->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>



    {{-- ================= DELETE MODAL (ONE ONLY) ================= --}}
    <div class="modal fade" id="deleteModal" tabindex="-1">

        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Voulez-vous supprimer le paiement :
                    <strong id="paymentRef"></strong> ?
                </div>

                <div class="modal-footer">

                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Annuler
                    </button>

                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger">
                            Oui supprimer
                        </button>

                    </form>

                </div>

            </div>
        </div>
    </div>



    {{-- ================= SCRIPT DELETE ================= --}}
    <script>
        document.querySelectorAll('.btn-delete')
            .forEach(button => {

                button.addEventListener('click', function() {

                    let id = this.dataset.id;
                    let reference = this.dataset.reference;

                    document.getElementById('paymentRef').textContent = reference;

                    document.getElementById('deleteForm')
                        .action = "/payment/" + id;

                });

            });
    </script>
@endsection
