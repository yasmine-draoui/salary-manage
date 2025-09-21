@extends('layouts.template')

@section('content')

	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    <h1 class="app-page-title">Département</h1>
			    <hr class="mb-4">
                <div class="row g-4 settings-section">
	                <div class="col-12 col-md-4">
		                <h3 class="section-title">Ajout</h3>
		                <div class="section-intro">Ajouter un nouveau département</div>
	                </div>
	                <div class="col-12 col-md-8">
		                <div class="app-card app-card-settings shadow-sm p-4">

						    <div class="app-card-body">
							    <form class="settings-form" method="POST" action="{{ route('departement.store') }}">
                                    @method("POST")
                                    @csrf
								    <div class="mb-3">
									    <label for="setting-input-1" class="form-label">Nom du département<span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info.">
                                            </span></label>
									    <input type="text" class="form-control" id="setting-input-1" name="nom" placeholder="Entrer le nom du département" required>
                                        @error('nom')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
									</div>

									<button type="submit" class="btn app-btn-primary">Enregistrer</button>
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
