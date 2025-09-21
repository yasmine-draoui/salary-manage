@extends('layouts.template')


@section('content')
    <h1 class="app-page-title">Employer</h1>
			    <hr class="mb-4">
                <div class="row g-4 settings-section">
	                <div class="col-12 col-md-4">
		                <h3 class="section-title">Ajout</h3>
		                <div class="section-intro">Ajouter ici un nouvel employer</div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">

						    <div class="app-card-body">
							    <form class="settings-form" method="POST" action="{{route('employer.store')}}">
                                    @csrf
                                    @method("POST")

                                    <div class="mb-3">
									    <label for="setting-input-2" class="form-label">Département</label>
                                        <select name="departement_id" id="departement_id" class="form-control" >
                                            <option value="">
												Selectionner le departement</option>
												@foreach ($departements as $departement)
													<option value="{{$departement->id}}">{{$departement->nom}}</option>
												@endforeach

                                        </select>
										@error('departement_id')
											<div class="text-danger">{{$message }}</div>
										@enderror
                                    </div>

								    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">Nom<span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info."></span></label>
									    <input type="text" class="form-control" id="setting-input-1" placeholder="Entrer le nom de l'employer" name="nom" value="{{ old('nom') }}" required>
											@error('nom')
											<div class="text-danger">{{$message }}</div>
										@enderror
									</div>
									<div class="mb-3">
									    <label for="setting-input-2" class="form-label">Prénom</label>
									    <input type="text" class="form-control" id="setting-input-2" name="prenom" placeholder="Entrer le prenom de l'employer" value="{{ old('prenom')}}" required>
										@error('prenom')
											<div class="text-danger">{{$message }}</div>
										@enderror
									</div>
								    <div class="mb-3">
									    <label for="setting-input-3" class="form-label">Email</label>
									    <input type="email" class="form-control" id="setting-input-3" placeholder="Entrer le mail" value="{{ old('email')}}" name="email">
										@error('email')
											<div class="text-danger">{{$message }}</div>
										@enderror
									</div>
                                    <div class="mb-3">
									    <label for="setting-input-3" class="form-label">Contact</label>
									    <input type="text" class="form-control" id="setting-input-3" placeholder="Entrer le contact" value="{{ old('contact')}}" name="contact">
										@error('contact')
											<div class="text-danger">{{$message }}</div>
										@enderror
									</div>
									<div class="mb-3">
									    <label for="setting-input-3" class="form-label">Montant Journalier</label>
									    <input type="number" class="form-control" id="setting-input-3" placeholder="Entrer le montant journalier" name="montant_journalier">
										@error('montant_journalier')
											<div class="text-danger">{{$message }}</div>
										@enderror
									</div>
									<button type="submit" class="btn app-btn-primary" >Enregistrer</button>
							    </form>
						    </div><!--//app-card-body-->

						</div><!--//app-card-->
	                </div>
                </div><!--//row-->

@endsection
