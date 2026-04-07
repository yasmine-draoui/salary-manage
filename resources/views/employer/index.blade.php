@extends('layouts.template')

@section('content')

<div class="app-content pt-3 p-md-3 p-lg-4">
<div class="container-xl">

    {{-- ================= HEADER ================= --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h1 class="app-page-title mb-1">Employés</h1>
            <small class="text-muted">
                Gestion des employés de l'entreprise —
                <strong>{{ $employer->count() }}</strong> employés
            </small>
        </div>

        <a href="{{ route('employer.create') }}" class="btn btn-success shadow-sm">
            <i class="fas fa-user-plus me-2"></i>
            Nouvel employé
        </a>

    </div>

    {{-- ================= SUCCESS MESSAGE ================= --}}
    @if (Session::get('success_message'))
        <div class="alert alert-success">
            {{ Session::get('success_message') }}
        </div>
    @endif

    {{-- ================= TABLE CARD ================= --}}
    <div class="app-card app-card-orders-table shadow-sm mb-5">

        <div class="app-card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Employé</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Département</th>
                            <th>Salaire journalier</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($employer as $e)
                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <div class="fw-bold">
                                    {{ $e->prenom }} {{ $e->nom }}
                                </div>
                            </td>

                            <td>{{ $e->email }}</td>

                            <td>{{ $e->contact }}</td>

                            <td>
                                <span class="badge bg-info-subtle" style="color:#212529;" >
                                    {{ $e->departement->nom ?? '-' }}
                                </span>
                            </td>

                            <td class="fw-bold text-success">
                                {{ number_format($e->montant_journalier,2) }} DZD
                            </td>

                            {{-- ================= ACTIONS ================= --}}
                            <td class="text-center">

                                <a href="{{ route('employer.edit',$e->id) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   title="Modifier">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <button
                                    class="btn btn-sm btn-outline-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $e->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </td>

                        </tr>

                        {{-- ================= DELETE MODAL ================= --}}
                        <div class="modal fade"
                             id="deleteModal{{ $e->id }}"
                             tabindex="-1">

                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Confirmation suppression
                                        </h5>
                                        <button class="btn-close"
                                                data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        Voulez-vous supprimer
                                        <strong>{{ $e->prenom }} {{ $e->nom }}</strong> ?
                                    </div>

                                    <div class="modal-footer">

                                        <button class="btn btn-secondary"
                                                data-bs-dismiss="modal">
                                            Annuler
                                        </button>

                                        <form action="{{ route('employer.delete',$e->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger">
                                                Supprimer
                                            </button>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                Aucun employé trouvé
                            </td>
                        </tr>
                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- ================= PAGINATION ================= --}}
    <div class="d-flex justify-content-center">
        {{ $employer->links() }}
    </div>

</div>
</div>

@endsection
