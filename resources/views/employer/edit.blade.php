@extends('layouts.template')

@section('content')

	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    <h1 class="app-page-title">Employé</h1>
			    <hr class="mb-4">
                <div class="row g-4 settings-section">
	                <div class="col-12 col-md-4">
		                <h3 class="section-title">Editer</h3>
		                <div class="section-intro">Modifier un employé</div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">

						    <div class="app-card-body">
							    <form class="settings-form" method="POST" action="{{ route('employer.update',$employer->id) }}">
                                    @method("PUT")
                                    @csrf
								    <div class="mb-3">
                                        <label for="setting-input-2" class="form-label">Département</label>
                                        <select name="departement_id" id="departement_id" class="form-control" >
                                            <option value="">
												Modifier le departement</option>
												@foreach ($departements as $departement)
													<option value="{{$departement->id}}" {{old($departement->nom,$employer->departement_id??'')==$departement->id ? 'selected': ''}}>{{$departement->nom}}</option>
												@endforeach

                                        </select>
										@error('departement_id')
											<div class="text-danger">{{$message }}</div>
										@enderror
									    <label for="setting-input-1" class="form-label">Nom de l'employé<span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info."></span></label>
									    <input type="text" class="form-control" id="setting-input-1" name="nom" value="{{ old('nom', $employer->nom) }}" required>


                                        <label for="setting-input-1" class="form-label">Prénom de l'employé<span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info."></span></label>
									    <input type="text" class="form-control" id="setting-input-1" name="prenom" value="{{ old('nom', $employer->prenom) }}" required>

                                        <label for="setting-input-1" class="form-label">Email de l'employé<span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info."></span></label>
									    <input type="text" class="form-control" id="setting-input-1" name="email" value="{{ old('email', $employer->email) }}" required>

                                        <label for="setting-input-1" class="form-label">Contact de l'employé<span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info."></span></label>
									    <input type="text" class="form-control" id="setting-input-1" name="contact" value="{{ old('contact', $employer->contact) }}" required>

                                        <label for="setting-input-1" class="form-label">Le montant journalier<span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info."></span></label>
									    <input type="text" class="form-control" id="setting-input-1" name="montant_journalier" value="{{ old('montant_journalier', $employer->montant_journalier) }}" required>
									<button type="submit" class="btn app-btn-primary" >Enregistrer</button>
							    </form>
						    </div><!--//app-card-body-->

						</div><!--//app-card-->
	                </div>
                </div><!--//row-->

			    <hr class="my-4">
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->




    <!-- Javascript -->
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script>
@endsection
