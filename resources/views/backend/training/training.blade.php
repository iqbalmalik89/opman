		<div class="modal fade" tabindex="-1" id="training_modal">
			<form id="training_form">
				<input type="hidden" id="training_id" name="training_id">
			    <div class="modal-dialog modal-lg">
			        <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title">Add Training</h3>
			                <!--begin::Close-->
			                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
			                </div>
			                <!--end::Close-->
			            </div>

			            <div class="modal-body" id="training_id_print">

							<div class="row g-9 mb-8">
								<div class="col-md-4" style="border-right: 1px solid #ebebeb;">


									<div class="mb-6">
										<h2 id="t-name">{{$data->first_name ?? ''}} {{$data->last_name ?? ''}}</h2>
									</div>										

									<div class="mb-6">
										<div class="fw-semibold text-gray-600 fs-7">Address:</div>
										<div id="t-address1" class="fw-bold text-gray-800 fs-6">{{$data->address1 ?? ''}}</div>
									</div>										

									<div class="mb-6">
										<div class="fw-semibold text-gray-600 fs-7">Postcode:</div>
										<div id="t-postcode" class="fw-bold text-gray-800 fs-6">{{$data->postcode ?? ''}}</div>
									</div>										

									<div class="mb-6">
										<div class="fw-semibold text-gray-600 fs-7">D.O.B:</div>
										<div id="t-dob" class="fw-bold text-gray-800 fs-6">@if(!empty($data->dob)){{date('d/m/Y', strtotime($data->dob)) ?? ''}}@endif</div>
									</div>										

									<div class="mb-6">
										<div class="fw-semibold text-gray-600 fs-7">NI Number:</div>
										<div id="t-ni_number" class="fw-bold text-gray-800 fs-6">{{$data->ni_number ?? ''}}</div>
									</div>										

									<div class="mb-6">
										<div class="fw-semibold text-gray-600 fs-7">Mobile:</div>
										<div id="t-mobile" class="fw-bold text-gray-800 fs-6">{{$data->mobile ?? ''}}</div>
									</div>								

								</div>
							

								<div class="col-md-8">

									<div class="mb-2 fv-plugins-icon-container">
										<label class="required fs-5 fw-semibold mb-2">Select Skill</label>
										<select name="doc_class" class="form-select" data-control="select2" data-placeholder="Select an option">
											<option value="">Select Document</option>

											@foreach($categories as $category)
												<optgroup label="{{$category->category}}"></optgroup>
												@foreach($category->certifications as $cert)
													<option value="{{$cert->id}}">{{$cert->certification}}</option>
												@endforeach
											@endforeach

										</select>
									</div>

									<div class="mb-2 fv-plugins-icon-container">
										<label class="required fs-5 fw-semibold mb-2">Course Provider</label>
										<input type="text" name="course_provider" class="form-control">
									</div>

									<div class="mb-2 fv-plugins-icon-container">
										<label class="required fs-5 fw-semibold mb-2">Course Date</label>
										<input type="text" name="course_date" class="form-control">
									</div>


									<div class="mb-2 fv-plugins-icon-container">
										<label class="required fs-5 fw-semibold mb-2">Course Location</label>
										<input type="text" name="course_location" class="form-control">
									</div>


								</div>

							</div>

			            </div>

			            <div class="modal-footer">
			                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
							<button type="submit" id="training_form_btn" class="btn btn-sm fw-bold btn-primary">
								<span class="indicator-label">Save</span>
								<span class="indicator-progress">Please wait...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>
							<button type="submit" id="training_form_download_btn" class="btn btn-sm fw-bold btn-primary">
								<span class="indicator-label">Save + Download</span>
								<span class="indicator-progress">Please wait...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>

			            </div>
			        </div>
			    </div>
			</form>
		</div>
