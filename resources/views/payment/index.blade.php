@extends('layouts.template')

@section('content')



	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">


			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Paiements</h1>
				    </div>
                    @if (!$isPaymentDay)
                        <div class="alert alert-danger">Vous ne pourrez pas effectuer un paiement qu'à la date de paiement qui est programmée le {{$convertedPaymentDate}} de chaque mois</div>
                    @endif
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
                                    @if ($isPaymentDay)
                                        <a class="btn app-btn-secondary" href="{{ route('payment.init') }}">
									    <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="7" y="1" width="2" height="14"/>
                                        <rect x="1" y="7" width="14" height="2"/>
                                        </svg>

									    Lancer les paiements
									</a>


                                    @endif

							    </div>

						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

			    </div><!--//row-->

				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">Référence</th>
												<th class="cell">Employer</th>
                                                <th class="cell">Montant payé</th>
												<th class="cell">Date de transaction</th>
                                                <th class="cell">Mois</th>
                                                <th class="cell">Année</th>
                                                <th class="cell">Status</th>
                                                <th></th>
											</tr>
										</thead>

										<tbody>
                                            @forelse($payments as $payment)
                                            <tr>
												<td class="cell">{{$payment->reference}}</td>
												<td class="cell">{{$payment->employer->nom}}<span class="truncate"></span></td>
                                                <td class="cell">{{$payment->amount}}<span class="truncate"></span></td>
                                                <td class="cell">{{$payment->launch_date}}</td>
                                                <td class="cell">{{$payment->month}}</td>
                                                <td class="cell">{{$payment->year}}</td>
                                                <td>
                                                    <span class="badge bg-success" style="font-size: 0.85rem;">
                                                        {{ $payment->status }}
                                                    </span>
                                                </td>

                                                <td class="cell">
                                                    <a href="{{ route('payment.download', $payment->id )}}">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                </td>

                                                <td><button type="button"
                                                    class="btn-retirer-pastel"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteModal"
                                                    title="Supprimer">
                                                    <i class="fas fa-trash icon-delete"></i>
                                                    </button>
                                                </td>
                                                <td></td>
                                                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header pastel-green">
                                                                <h5 class="modal-title" id="confirmDeleteLabel">Confirmation de suppression</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                            </div>
                                                            <div class="modal-body text-dark">
                                                                Voulez-vous vraiment supprimer <strong></strong> ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>

                                                                <form action="" method="POST" style="display: inline;">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" class="btn btn-pastel-green">Oui, supprimer</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

											</tr>

											@empty
                                            <tr>
                                                <td colspan="8" class="cell text-center">Aucune transaction effectuée</td>
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
