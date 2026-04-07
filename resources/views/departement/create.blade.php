@extends('layouts.template')

@section('content')

<div class="app-content p-md-4 p-lg-4">
<div class="container-xl">

    {{-- ================= PAGE HEADER ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="app-page-title mb-1">Départements</h1>
            <p class="text-muted mb-0">
                Gestion de la structure organisationnelle de l'entreprise
            </p>
        </div>

        <a href="{{ route('departement.index') }}"
           class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i>
            Retour
        </a>

    </div>


    {{-- ================= FORM CARD ================= --}}
<div class="app-card shadow-sm">

    {{-- HEADER --}}
    <div class="rh-card-header">
        <div>
            <h5>Informations du département</h5>
            <small>Créer un nouveau département organisationnel</small>
        </div>
    </div>

    {{-- BODY --}}
    <div class="app-card-body p-4">

        <form method="POST" action="{{ route('departement.store') }}">
            @csrf

            <div class="row">

                <div class="col-md-6 rh-form-row">
                    <label class="form-label">Nom du département</label>
                    <input type="text"
                           name="nom"
                           class="form-control"
                           placeholder="Ressources Humaines">
                </div>

                <div class="col-md-3 rh-form-row">
                    <label class="form-label">Code</label>
                    <input type="text"
                           class="form-control"
                           placeholder="RH01">
                </div>

                <div class="col-md-3 rh-form-row">
                    <label class="form-label">Responsable</label>
                    <input type="text"
                           class="form-control"
                           placeholder="Nom responsable">
                </div>

                <div class="col-12 rh-form-row">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" rows="3"></textarea>
                </div>

            </div>

            <div class="border-top pt-3 d-flex justify-content-end gap-2">

                <a href="{{ route('departement.index') }}"
                   class="btn btn-light">
                    Annuler
                </a>

                <button class="btn app-btn-primary">
                    Enregistrer
                </button>

            </div>

        </form>

    </div>

</div>

</div>
</div>

@endsection
