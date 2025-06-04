

	<div class="card card-flush h-xl-100">
		<!--begin::Body-->
		<div class=" row card-body pt-5">



			<!-- <div class="row g-5 g-xl-10"> -->
				<div class="col-xl-6">
					<!--begin::List widget 11-->
					<div class="card card-flush h-xl-100">
						<!--begin::Header-->
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body" style="padding-left: 0px; padding-top: 0px;">


							<div class="" style="padding:5px; background-color: #f1faff; margin-top: 10px; border-radius: 5px; margin-bottom: 5px;">
								<div class="">
									<div class="fw-semibold pe-10 text-gray-600 fs-5">Site Information
										@if(Auth::user()->hasPermissionTo('update site'))
											<a style="float: right;" href="{{route('update-site', $site->id)}}" class="badge badge-dark">Edit</a>
										@endif
									</div>
								</div>
							</div>		

							<div class="mw-300px">
								<div class="d-flex flex-stack mb-3">
									<div class="fw-semibold pe-10 text-gray-600 fs-7">Site:</div>
									<div class="text-end fw-bold fs-6 text-gray-800" style="text-align: left !important;">{{$site['site']}}</div>
								</div>
							</div>

							<div class="mw-300px">
								<div class="d-flex flex-stack mb-3">
									<div class="fw-semibold pe-10 text-gray-600 fs-7">Address:</div>
									<div class="text-end fw-bold fs-6 text-gray-800" style="text-align: left !important;">{{$site['address']}}</div>
								</div>
							</div>

							<div class="mw-300px">
								<div class="d-flex flex-stack mb-3">
									<div class="fw-semibold pe-10 text-gray-600 fs-7">Postcode:</div>
									<div class="text-end fw-bold fs-6 text-gray-800" style="text-align: left !important;">{{$site['postcode']}}</div>
								</div>
							</div>

							<div class="mw-300px">
								<div class="d-flex flex-stack mb-3">
									<div class="fw-semibold pe-10 text-gray-600 fs-7">Lat:</div>
									<div class="text-end fw-bold fs-6 text-gray-800" style="text-align: left !important;">{{$site['lat']}}</div>
								</div>
							</div>

							<div class="mw-300px">
								<div class="d-flex flex-stack mb-3">
									<div class="fw-semibold pe-10 text-gray-600 fs-7">Long:</div>
									<div class="text-end fw-bold fs-6 text-gray-800" style="text-align: left !important;">{{$site['lng']}}</div>
								</div>
							</div>


							@if(!empty($contacts->count()))

								<div class="" style="padding:5px; background-color: #f1faff; margin-top: 10px; border-radius: 5px; margin-bottom: 5px;">
									<div class="">
										<div class="fw-semibold pe-10 text-gray-600 fs-5">Contacts</div>
									</div>
								</div>		

							@foreach($contacts as $contact)
								<div style="background-color:#f5f8fa; padding:10px; margin-bottom:10px; border-radius: 5px;">
									<div class="mw-300px">
										<div class="d-flex flex-stack mb-3">
											<div class="fw-semibold pe-10 text-gray-600 fs-7">Name:</div>
											<div class="text-end fw-bold fs-6 text-gray-800" style="text-align: left !important;">{{$contact['name']}}</div>
										</div>
									</div>

									<div class="mw-300px">
										<div class="d-flex flex-stack mb-3">
											<div class="fw-semibold pe-10 text-gray-600 fs-7">Mobile:</div>
											<div class="text-end fw-bold fs-6 text-gray-800" style="text-align: left !important;">{{$contact['mobile']}}</div>
										</div>
									</div>

									<div class="mw-300px">
										<div class="d-flex flex-stack mb-3">
											<div class="fw-semibold pe-10 text-gray-600 fs-7">Email:</div>
											<div class="text-end fw-bold fs-6 text-gray-800" style="text-align: left !important;">{{$contact['email']}}</div>
										</div>
									</div>

									<div class="mw-300px">
										<div class="d-flex flex-stack mb-3">
											<div class="fw-semibold pe-10 text-gray-600 fs-7">Position:</div>
											<div class="text-end fw-bold fs-6 text-gray-800" style="text-align: left !important;">{{$contact['position']}}</div>
										</div>
									</div>
								</div>

							@endforeach
						@endif

						@if(!empty($site->notes))
							<div class="" style="padding:5px; background-color: #f1faff; margin-top: 10px; border-radius: 5px; margin-bottom: 5px;">
								<div class="">
									<div class="fw-semibold pe-10 text-gray-600 fs-5">Notes</div>
								</div>
							</div>						

							<div class="mw-300px">
								<div class="d-flex flex-stack mb-3">
									{{$site->notes}}
								</div>
							</div>
						@endif


						</div>
						<!--end::Body-->
					</div>
					<!--end::List widget 11-->
				</div>

				<div class="col-xl-6">
					<!--begin::List widget 11-->
					<div class="card card-flush h-xl-100">
						<!--begin::Header-->
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body" style="padding-left: 0px; padding-top: 0px;">


							<div class="" style="padding:5px; background-color: #f1faff; margin-top: 10px; border-radius: 5px; margin-bottom: 5px;">
								<div class="">
									<div class="fw-semibold pe-10 text-gray-600 fs-5">Site Entrance Location (What 3 Words)</div>
								</div>
							</div>		



							<div class="mw-300px">
								<div class="d-flex flex-stack mb-3">
									<div class="text-end fw-bold fs-6 text-gray-800" style="text-align: left !important;">{{$site['location']}}</div>
								</div>
							</div>

							


						</div>
						<!--end::Body-->
					</div>
					<!--end::List widget 11-->
				</div>

<!-- 								<div class="col-xxl-6 mb-5 mb-xl-0">
					<div class="card card-flush h-lg-100" style="background-color: #31596b12; border-radius: 10px;">
						<div class="card-header mb-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bold text-gray-800">Documents Display </span>

							</h3>
							<span>

							<button type="button" onclick="showUpload();" class="btn btn-primary" style="padding:3px 10px 3px 10px;margin-top:22px;">Upload</button></span>
						</div>
						<div class="card-body pt-0" id="documents" style="padding-left:10px; padding-right: 10px;">
						</div>
					</div>
				</div> -->


			<!-- <div> -->




		</div>
		<!--end::Body-->
	</div>
