@extends('layouts.template')

@section('content')



	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">

			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Employés</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								    <form class="table-search-form row gx-1 align-items-center">
					                    <div class="col-auto">
					                        <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Recherche">
					                    </div>
					                    <div class="col-auto">
					                        <button type="submit" class="btn app-btn-secondary">Recherche</button>
					                    </div>
					                </form>

							    </div><!--//col-->
							    <div class="col-auto">

								    <select class="form-select w-auto" >
										  <option selected value="option-1">Tous</option>
										  <option value="option-2">This week</option>
										  <option value="option-3">This month</option>
										  <option value="option-4">Last 3 months</option>

									</select>
							    </div>
							    <div class="col-auto">
								    <a class="btn app-btn-secondary" href="{{ route('employer.create') }}">
									    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <rect x="7" y="1" width="2" height="14"/>
  <rect x="1" y="7" width="14" height="2"/>
</svg>

									    Ajouter un employé
									</a>
							    </div>
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->

                @if (Session::get('success_message'))
                    <div class="alert alert-success">{{Session::get('success_message')}}</div>

                @endif

				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">#</th>
												<th class="cell">Nom</th>
                                                <th class="cell">Prénom</th>
                                                <th class="cell">Email</th>
                                                <th class="cell">Contact</th>
                                                <th class="cell">Département</th>
                                                <th class="cell">Montant journalier</th>
												<th class="cell">Actions</th>
											</tr>
										</thead>

										<tbody>
                                            @forelse($employer as $e)
                                            <tr>
												<td class="cell">{{$e->id}}</td>
												<td class="cell"><span class="truncate">{{$e->nom}}</span></td>
                                                <td class="cell"><span class="truncate">{{$e->prenom}}</span></td>
                                                <td class="cell"><span class="truncate">{{$e->email}}</span></td>
                                                <td class="cell"><span class="truncate">{{$e->contact}}</span></td>
                                                <td class="cell"><span class="truncate">{{$e->departement->nom}}</span></td>
                                                <td class="cell"><span class="truncate">{{$e->montant_journalier}}</span></td>

                                                <td class="cell">
    <!-- Bouton éditer (crayon) -->
    <a href="{{ route('employer.edit', $e->id) }}" class="btn-editer-pastel" title="Modifier">
        <i class="fas fa-pen icon-edit"></i>
    </a>

    <!-- Bouton supprimer (poubelle), ouvre un modal -->
    <button type="button"
            class="btn-retirer-pastel"
            data-bs-toggle="modal"
            data-bs-target="#confirmDeleteModal{{ $e->id }}"
            title="Supprimer">
        <i class="fas fa-trash icon-delete"></i>
    </button>
</td>



<!-- Modal personnalisé en vert pastel -->
<div class="modal fade" id="confirmDeleteModal{{ $e->id }}" tabindex="-1" aria-labelledby="confirmDeleteLabel{{ $e->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pastel-green">
                <h5 class="modal-title" id="confirmDeleteLabel{{ $e->id }}">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body text-dark">
                Voulez-vous vraiment supprimer <strong>{{ $e->prenom }} {{ $e->nom }}</strong> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>

                <form action="{{ route('employer.delete', $e->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-pastel-green">Oui, supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>



											</tr>

											@empty
                                            <tr>
                                                <td colspan="3" class="cell text-center">Aucun employé trouvé</td>
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






    <!-- Javascript -->
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>


    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script>



@endsection
