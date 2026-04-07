@extends('layouts.template')

@section('content')

<div class="app-content pt-3 p-md-4 p-lg-4">
<div class="container-xl">

{{-- ================= HEADER ================= --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h1 class="app-page-title mb-1">Administrateurs</h1>
        <small class="text-muted">
            Gestion des comptes administrateurs du système
        </small>
    </div>

    <a href="{{ route('admin.create') }}"
       class="btn btn-primary shadow-sm">
        <i class="bi bi-person-plus me-2"></i>
        Nouvel administrateur
    </a>

</div>

{{-- ================= CARD ================= --}}
<div class="app-card shadow-sm">

<div class="app-card-body">

{{-- SEARCH --}}
<div class="row mb-3">

    <div class="col-md-4">
        <input type="text"
               class="form-control form-control-sm"
               placeholder="Rechercher administrateur...">
    </div>

</div>

{{-- TABLE --}}
<div class="table-responsive">

<table class="table table-hover align-middle">

<thead class="table-light">
<tr>
    <th>#</th>
    <th>Nom</th>
    <th>Email</th>
    <th class="text-center">Actions</th>
</tr>
</thead>

<tbody>

@forelse($users as $user)
<tr>

<td class="fw-semibold">{{ $user->id }}</td>

<td>
    <div class="d-flex align-items-center gap-2">
        <div class="avatar-circle">
            {{ strtoupper(substr($user->name,0,1)) }}
        </div>
        {{ $user->name }}
    </div>
</td>

<td class="text-muted">
    {{ $user->email }}
</td>

<td class="text-center">

<button class="btn btn-sm btn-outline-danger"
        data-bs-toggle="modal"
        data-bs-target="#deleteUser{{ $user->id }}">
    <i class="bi bi-trash"></i>
</button>

</td>

</tr>

{{-- MODAL DELETE --}}
<div class="modal fade" id="deleteUser{{ $user->id }}">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">
Supprimer administrateur
</h5>
<button class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
Voulez-vous supprimer :
<strong>{{ $user->name }}</strong> ?
</div>

<div class="modal-footer">

<button class="btn btn-light"
        data-bs-dismiss="modal">
Annuler
</button>

<form method="POST"
      action="{{ route('admin.delete',$user->id) }}">
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
<td colspan="4" class="text-center py-4 text-muted">
Aucun administrateur trouvé
</td>
</tr>
@endforelse

</tbody>

</table>

</div>

</div>
</div>

</div>
</div>

@endsection
