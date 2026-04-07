@extends('layouts.template')

@section('content')
    <div class="app-content pt-3 p-md-4 p-lg-4">
        <div class="container-xl">

            {{-- ================= HEADER ================= --}}

            <div class="d-flex justify-content-between align-items-center mb-4">


                <div>
                    <h1 class="app-page-title mb-1">
                        <i class="fas fa-user-plus me-2 text-success"></i>
                        Nouvel Employé
                    </h1>
                    <small class="text-muted">
                        Ajouter un employé au système de gestion RH
                    </small>
                </div>

                <a href="{{ route('employer.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Retour
                </a>


            </div>

            {{-- ================= CARD FORM ================= --}}

            <div class="app-card shadow-sm border-0">

                <div class="app-card-header bg-light py-3">
                    <h5 class="mb-0 fw-semibold">
                        Informations de l'employé
                    </h5>
                </div>

                <div class="app-card-body p-4">

                    <form method="POST" action="{{ route('employer.store') }}">
                        @csrf

                        <div class="row g-4">

                            {{-- ================= DEPARTEMENT ================= --}}

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Département</label>

                                <select name="departement_id"
                                    class="form-select @error('departement_id') is-invalid @enderror">

                                    <option value="">Sélectionner un département</option>

                                    @foreach ($departements as $departement)
                                        <option value="{{ $departement->id }}"
                                            {{ old('departement_id') == $departement->id ? 'selected' : '' }}>
                                            {{ $departement->nom }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('departement_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ================= CONTACT ================= --}}

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Contact</label>

                                <input type="text" name="contact"
                                    class="form-control @error('contact') is-invalid @enderror" placeholder="0550 00 00 00"
                                    value="{{ old('contact') }}">

                                @error('contact')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ================= NOM ================= --}}

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nom</label>

                                <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
                                    placeholder="Nom" value="{{ old('nom') }}">

                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ================= PRENOM ================= --}}

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Prénom</label>

                                <input type="text" name="prenom"
                                    class="form-control @error('prenom') is-invalid @enderror" placeholder="Prénom"
                                    value="{{ old('prenom') }}">

                                @error('prenom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ================= EMAIL ================= --}}

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>

                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="exemple@email.com" value="{{ old('email') }}">

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ================= SALAIRE ================= --}}

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Montant Journalier (DZD)
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text">DZD</span>

                                    <input type="number" step="0.01" name="montant_journalier"
                                        class="form-control @error('montant_journalier') is-invalid @enderror"
                                        placeholder="0.00" value="{{ old('montant_journalier') }}">

                                </div>

                                @error('montant_journalier')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        {{-- ================= ACTION BUTTONS ================= --}}

                        <hr class="my-4">

                        <div class="d-flex justify-content-end gap-2">

                            <a href="{{ route('employer.index') }}" class="btn btn-light">
                                Annuler </a>

                            <button type="submit" class="btn btn-success shadow-sm px-4"> <i class="fas fa-save me-2"></i>
                                Enregistrer </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
