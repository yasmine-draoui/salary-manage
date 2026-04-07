@extends('layouts.template')

@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            {{-- ================= HEADER ================= --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

                <div>
                    <h1 class="app-page-title mb-1">Départements</h1>
                    <small class="text-muted">
                        Gestion des départements de l'entreprise
                    </small>
                </div>

                <a class="btn app-btn-secondary" href="{{ route('departement.create') }}">
                    <i class="bi bi-plus-circle me-2"></i>
                    Ajouter un département
                </a>

            </div>

            {{-- ================= SUCCESS MESSAGE ================= --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            {{-- ================= TABLE ================= --}}
            <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-body">

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nom du département</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($departements as $departement)
                                    <tr>

                                        {{-- ID --}}
                                        <td class="fw-bold">
                                            {{ $departement->id }}
                                        </td>

                                        {{-- NOM --}}
                                        <td>
                                            <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2">
                                                {{ $departement->nom }}
                                            </span>
                                        </td>

                                        {{-- ACTIONS --}}
                                        <td class="text-center">

                                            <a href="{{ route('departement.edit', $departement->id) }}"
                                                class="btn btn-sm btn-outline-primary" title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <a href="{{ route('departement.delete', $departement->id) }}"
                                                class="btn btn-sm btn-outline-danger" title="Supprimer">
                                                <i class="bi bi-trash"></i>
                                            </a>

                                        </td>

                                    </tr>

                                    {{-- ================= DELETE MODAL ================= --}}
                                    <div class="modal fade" id="deleteDepartement{{ $departement->id }}" tabindex="-1">

                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header pastel-green">
                                                    <h5 class="modal-title">
                                                        Confirmation de suppression
                                                    </h5>

                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    Voulez-vous supprimer le département :
                                                    <strong>{{ $departement->nom }}</strong> ?
                                                </div>

                                                <div class="modal-footer">

                                                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                        Annuler
                                                    </button>

                                                    <form method="POST"
                                                        action="{{ route('departement.delete', $departement->id) }}">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button class="btn btn-pastel-green">
                                                            Oui, supprimer
                                                        </button>
                                                    </form>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4">
                                            Aucun département trouvé
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>
                        @foreach ($departements as $departement)
                            <div class="modal fade" id="deleteDepartement{{ $departement->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content shadow">

                                        <div class="modal-header bg-light">
                                            <h5 class="modal-title">
                                                <i class="bi bi-exclamation-triangle text-danger me-2"></i>
                                                Confirmation
                                            </h5>

                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            Supprimer le département :
                                            <strong>{{ $departement->nom }}</strong> ?
                                        </div>

                                        <div class="modal-footer">

                                            <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                Annuler
                                            </button>

                                            <form method="POST"
                                                action="{{ route('departement.delete', $departement->id) }}">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger">
                                                    <i class="bi bi-trash me-1"></i>
                                                    Supprimer
                                                </button>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
