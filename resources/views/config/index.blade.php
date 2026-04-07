@extends('layouts.template')

@section('content')
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Configurations</h1>
                </div>
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <form class="table-search-form row gx-1 align-items-center">
                                    <div class="col-auto">
                                        <input type="text" id="search-orders" name="searchorders"
                                            class="form-control search-orders" placeholder="Recherche">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn app-btn-secondary">Recherche</button>
                                    </div>
                                </form>

                            </div><!--//col-->
                            <div class="col-auto">

                                <select class="form-select w-auto">
                                    <option selected value="option-1">Tous</option>
                                    <option value="option-2">This week</option>
                                    <option value="option-3">This month</option>
                                    <option value="option-4">Last 3 months</option>

                                </select>
                            </div>
                            <div class="col-auto">
                                <a class="btn app-btn-secondary" href="{{ route('config.create') }}">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="7" y="1" width="2" height="14" />
                                        <rect x="1" y="7" width="14" height="2" />
                                    </svg>

                                    Nouvelle configuration
                                </a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->

            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table align-middle app-table-hover mb-0">

                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Configuration</th>
                                            <th>Valeur</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @forelse($allConfigurations as $config)
                                            <tr>
                                                <td class="fw-semibold text-muted">
                                                    #{{ $config->id }}
                                                </td>

                                                <td>
                                                    <div class="fw-semibold">
                                                        @if ($config->type == 'PAYMENT_DATE')
                                                            <i class="bi bi-calendar-event text-primary me-2"></i>
                                                            Date de paiement
                                                        @elseif($config->type == 'DEVELOPPER_NAME')
                                                            <i class="bi bi-people text-success me-2"></i>
                                                            Équipe de développement
                                                        @elseif($config->type == 'APP_NAME')
                                                            <i class="bi bi-window text-info me-2"></i>
                                                            Nom de l'application
                                                        @else
                                                            <i class="bi bi-gear text-secondary me-2"></i>
                                                            Autre configuration
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info-subtle" style="color:#008346;">
                                                        {{ $config->value }}
                                                        @if ($config->type == 'PAYMENT_DATE')
                                                            de chaque mois
                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="text-end">

                                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                        data-bs-target="#confirmDeleteModal{{ $config->id }}">

                                                        <i class="bi bi-trash"></i>

                                                    </button>

                                                </td>

                                                <div class="modal fade" id="confirmDeleteModal{{ $config->id }}"
                                                    tabindex="-1" aria-labelledby="confirmDeleteLabel{{ $config->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header pastel-green">
                                                                <h5 class="modal-title"
                                                                    id="confirmDeleteLabel{{ $config->id }}">Confirmation
                                                                    de suppression</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                            </div>
                                                            <div class="modal-body text-dark">
                                                                Voulez-vous vraiment supprimer <strong>{{ $config->type }}
                                                                    {{ $config->value }}</strong> ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary"
                                                                    data-bs-dismiss="modal">Annuler</button>

                                                                <form action="{{ route('config.delete', $config->id) }}"
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" class="btn btn-pastel-green">Oui,
                                                                        supprimer</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="3" class="cell text-center">Aucune configuration trouvée
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->

                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                    <nav class="app-pagination">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav><!--//app-pagination-->

                </div><!--//tab-pane-->


            </div><!--//tab-content-->



        </div><!--//container-fluid-->
    </div><!--//app-content-->
@endsection
