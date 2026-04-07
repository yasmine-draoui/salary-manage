@extends('layouts.template')

@section('content')
    <div class="app-content pt-3 p-md-4 p-lg-4">
        <div class="container-xl">

            {{-- HEADER --}}
            <div class="mb-4">
                <h1 class="app-page-title mb-1">Nouvel Administrateur</h1>
                <small class="text-muted">
                    Création d’un compte administrateur système
                </small>
            </div>

            <div class="row justify-content-center">

                <div class="col-lg-7">

                    <div class="app-card shadow-sm border-0">

                        {{-- CARD HEADER --}}
                        <div class="app-card-header bg-light border-bottom py-3">
                            <strong>Informations administrateur</strong>
                        </div>

                        <div class="app-card-body p-4">

                            <form method="POST" action="{{ route('admin.store') }}">
                                @csrf

                                {{-- NOM --}}
                                <div class="mb-3">
                                    <label class="form-label small fw-semibold">
                                        Nom complet
                                    </label>

                                    <input type="text" name="name"
                                        class="form-control form-control-sm @error('name') is-invalid @enderror"
                                        placeholder="Ex : Nom Prénom" value="{{ old('name') }}">

                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- EMAIL --}}
                                <div class="mb-3">
                                    <label class="form-label small fw-semibold">
                                        Adresse Email
                                    </label>

                                    <input type="email" name="email"
                                        class="form-control form-control-sm @error('email') is-invalid @enderror"
                                        placeholder="admin@entreprise.dz" value="{{ old('email') }}">

                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- PASSWORD --}}
                                <div class="mb-4">
                                    <label class="form-label small fw-semibold">
                                        Mot de passe
                                    </label>

                                    <input type="password" name="password"
                                        class="form-control form-control-sm @error('password') is-invalid @enderror"
                                        placeholder="********">

                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- ACTIONS --}}
                                <div class="d-flex justify-content-end gap-2">

                                    <a href="{{ route('admin.index') }}" class="btn btn-light">
                                        Annuler
                                    </a>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Enregistrer
                                    </button>

                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
