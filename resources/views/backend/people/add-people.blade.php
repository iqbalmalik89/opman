@extends('backend.layouts.auth')
@section('title', App\Library\ModuleConfig::getAction($data) .' '.App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name'])
@section('content')



<form id="people_form">
	<input type="hidden" id="id" class="people_id" name="id" value="{{$data->id ?? ''}}">
	<input type="hidden" id="rid" name="rid" value="@if(!isset($data['id'])) {{time()}} @endif">

<div class="d-flex flex-column flex-column-fluid">
	<!--begin::Toolbar-->
	<div id="kt_app_toolbar" class="app-toolbar py- py-lg-2" >
		<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
			<div style="margin-top:10px; margin-bottom: 10px;" class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
				<h1  class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
				@if(!empty($data->id))
					{{$data->first_name}} {{$data->last_name}}
				@else				
					Add People
				@endif
				</h1>
			</div>


			<div class="d-flex align-items-center gap-2 gap-lg-3">

				@if(!empty($data->id))
					<a href="{{route('download-people', $data->id)}}" class="btn btn-sm fw-bold btn-secondary"><i class="fa-solid fa-download text-dark"></i></a>
				@endif
				
				<button onclick="history.back()" type="button" class="btn btn-sm fw-bold btn-secondary">Back
				</button>

			@if(Auth::user()->hasPermissionTo('add people'))

				<button type="submit" id="people_form-btn" class="btn btn-sm fw-bold btn-primary">
					<span class="indicator-label">Save Changes</span>
					<span class="indicator-progress">Please wait...
					<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
				</button>

			@endif

			</div>
		</div>
	</div>


	
	<!--end::Toolbar-->
	<!--begin::Content-->
	<div id="kt_app_content" class="app-content flex-column-fluid">





		<!--begin::Content container-->
		<div id="kt_app_content_container" class="app-container container-xxl">

			<!--begin::Basic info-->
			<div class="d-flex flex-column flex-lg-row">
				<!--begin::Sidebar-->
				<div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
					<!--begin::Contacts-->
					<div class="card card-flush">
						<!--begin::Card header-->
<!-- 						<div class="card-header pt-7" id="kt_chat_contacts_header">
							<form class="w-100 position-relative" autocomplete="off">
								<span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
										<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
									</svg>
								</span>
								<input type="text" class="form-control form-control-solid px-15" name="search" value="" placeholder="Search by username or email..." />

							</form>
						</div> -->
						<!--end::Card header-->
						<!--begin::Card body-->
						<div class="card-body pt-5 personal-info" style="padding:10px" id="kt_chat_contacts_body">
							<!--begin::List-->
							<div class="scroll-y me-n5 pe-5 h-200px h-lg-auto " data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto">
								<!--begin::User-->
								<!--begin::User-->


								<div class="d-flex flex-stack" style="padding-top: 20px;padding-bottom: 20px; text-align: center; margin: auto 0; margin-left: 120px;">

									@php
										if(empty($data->photo_path))
											$url = global_asset('assets/media/svg/avatars/blank.svg');
										else
											$url = \Storage::url('people-photos/' . $data->photo_path);
									@endphp
									 <div class="image-input image-input-empty" data-kt-image-input="true" style="background-image: url({{$url}})">

									     <!--begin::Image preview wrapper-->
									     <div class="image-input-wrapper w-125px h-125px"></div>
									     <!--end::Image preview wrapper-->

									     <!--begin::Edit button-->
											 @if(Auth::user()->hasPermissionTo('add people'))

									     <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
									        data-kt-image-input-action="change"
									        data-bs-toggle="tooltip"
									        data-bs-dismiss="click"
									        title="Change avatar">

									         <i style="margin-left: 21px;" class="bi bi-pencil-fill fs-7"></i>
									         <!--begin::Inputs-->
									         <input type="file" name="photo" accept=".png, .jpg, .jpeg" />
									         <input type="" id="photo_path" name="photo_path" value="{{$data['photo_path'] ?? ''}}">
									         <input type="hidden" name="avatar_remove" />
									         <!--end::Inputs-->
									     </label>

									     									         @endif

									     <!--end::Edit button-->

									     <!--begin::Cancel button-->
									     <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
									        data-kt-image-input-action="cancel"
									        data-bs-toggle="tooltip"
									        data-bs-dismiss="click"
									        title="Cancel avatar">
									         <i class="bi bi-x fs-2"></i>
									     </span>
									     <!--end::Cancel button-->

									     <!--begin::Remove button-->
									     <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
									        data-kt-image-input-action="remove"
									        data-bs-toggle="tooltip"
									        data-bs-dismiss="click"
									        title="Remove avatar">
									         <i class="bi bi-x fs-2"></i>
									     </span>
									     <!--end::Remove button-->
									 </div>

	                            </div>

								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">First Name</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="first_name" value="{{$data['first_name'] ?? ''}}">
	                                </div>
	                            </div>


								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">Last Name</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="last_name" value="{{$data['last_name'] ?? ''}}">
	                                </div>
	                            </div>

								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">Address 1</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="address1" value="{{$data['address1'] ?? ''}}">
	                                </div>
	                            </div>

								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">Address 2</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="address2" value="{{$data['address2'] ?? ''}}">
	                                </div>
	                            </div>

								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">Postcode</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="postcode" value="{{$data['postcode'] ?? ''}}">
	                                </div>
	                            </div>

								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">County</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="county" value="{{$data['county'] ?? ''}}">
	                                </div>
	                            </div>



								<div class="d-flex flex-stack d-none">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">Country</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">

                                        <select class="form-select" data-control="select2" data-placeholder="Select Country" id="country" name="country" style="padding:0px;">
                                            <option value="">Select Country</option>
                                            @foreach(App\Library\Utility::getCountries() as $code => $country)
                                                <option @if(!empty($data['country']) && $data['country'] == $code) selected @endif value="{{$code}}">{{$country}}</option>
                                            @endforeach
                                        </select>


	                                </div>
	                            </div>

								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">Mobile</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="mobile" value="{{$data['mobile'] ?? ''}}">
	                                </div>
	                            </div>

								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">Email</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="email" value="{{$data['email'] ?? ''}}">
	                                </div>
	                            </div>

								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">D.O.B</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" value="@if(!empty($data['dob'])){{date('d/m/Y', strtotime($data['dob']))}}@endif" name="dob">
	                                </div>
	                            </div>

								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">Next of Kin</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="nok" value="{{$data['nok'] ?? ''}}">
	                                </div>
	                            </div>

								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">NOK Contact</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="nok_contact" value="{{$data['nok_contact'] ?? ''}}">
	                                </div>
	                            </div>

								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">NI Number</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="ni_number" value="{{$data['ni_number'] ?? ''}}">
	                                </div>
	                            </div>

								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">CPCS Number</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="cpcs_number" value="{{$data['cpcs_number'] ?? ''}}">
	                                </div>
	                            </div>

								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">EUSR Number</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="eusr_number" value="{{$data['eusr_number'] ?? ''}}">
	                                </div>
	                            </div>

								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">NPORS Number</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="nposr_number" value="{{$data['nposr_number'] ?? ''}}">
	                                </div>
	                            </div>

								<div class="d-flex flex-stack d-none">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">UTR Number:</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="utr_number" value="{{$data['utr_number'] ?? ''}}">
	                                </div>
	                            </div>


								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">Employ Start:</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="employ_start" value="@if(!empty($data['employ_start'])){{date('d/m/Y', strtotime($data['employ_start']))}}@endif">
	                                </div>
	                            </div>


								<div class="d-flex flex-stack d-none" style="padding:5px; background-color: #f1faff; margin-top: 10px; border-radius: 5px;">
									<div class="d-flex">
	                                    <div class="ms-5">
										<h3 class="text-gray-700">Confidential</h3>
										</div>
									</div>
	                            </div>

								<div class="d-flex flex-stack d-none">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">Account Number:</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="bank_detail" value="{{$data['bank_detail'] ?? ''}}">
	                                </div>
	                            </div>


								<div class="d-flex flex-stack d-none">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">Sort Code:</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="sort_code" value="{{$data['sort_code'] ?? ''}}">
	                                </div>
	                            </div>



							</div>
						</div>
						<!--end::Card body-->
					</div>
					<!--end::Contacts-->
				</div>
				<!--end::Sidebar-->
				<!--begin::Content-->

				<!-- <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10"> -->
					<!--begin::Messenger-->



				<div class="col-xl-8 flex-lg-row-fluid ms-lg-7 ms-xl-10" id="people-detail">
					<!--begin::Chart widget 17-->



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
													<div class="fw-semibold  text-gray-600 fs-5">Holidays <span style="float:right;">
														@if(Auth::user()->hasPermissionTo('add people'))
														<a onclick="addMoreHolidays();" href="javascript:void(0);"><i class="fa-solid fa-circle-plus text-info"></i> Add</a>
														@endif
													</span></div>
												</div>
											</div>						

											@if(!isset($holidays) || empty($holidays->count()))

												<div class="mw-300px">
													<div class="d-flex flex-stack mb-3">
														<input type="text" name="holiday_from[]" class="form-control smart-field" style="margin-right: 4px;" placeholder="Holiday Start">
														<input type="text" name="holiday_to[]" class="form-control smart-field" placeholder="Holiday End" style="margin-right: 10px;">
																						
													</div>
												</div>
											@else
												@foreach($holidays as $key => $holiday)

												<div class="mw-350px">
													<div class="d-flex flex-stack mb-3">
														<input type="text" name="holiday_from[]" class="form-control smart-field" style="margin-right: 4px;" placeholder="Holiday Start" value="{{date('d/m/Y', strtotime($holiday->from))}}">

														<input type="text" name="holiday_to[]" class="form-control smart-field" placeholder="Holiday End" style="margin-right: 10px;" value="{{date('d/m/Y', strtotime($holiday->to))}}">

														@if(Auth::user()->hasPermissionTo('add people'))

															@if($key == 0)

																<a onclick="removeBasicHoliday(this);" href="javascript:void(0);"><i class="fa-solid fa-trash text-danger"></i></a>	
															@else
																<a onclick="removeHoliday(this);" href="javascript:void(0);"><i class="fa-solid fa-trash text-danger"></i></a>		
															@endif														

														@endif						
													</div>
												</div>

												@endforeach
											@endif

											<div class="holidaysdiv">
											</div>

											@if(!empty($data->id))

												<div class="" style="padding:5px; background-color: #f1faff; margin-top: 10px; border-radius: 5px; margin-bottom: 5px;">
													<div class="">
														<div class="fw-semibold  text-gray-600 fs-5">Assignment
															<span style="float:right;">

															@if(Auth::user()->hasPermissionTo('add people'))

																<a data-bs-toggle="modal" onclick="resetAssignForm()" data-bs-target="#assign_modal" href="javascript:void(0);"><i class="fa-solid fa-circle-plus text-info"></i> Assign</a>
															@endif
															</span>
														</div>
													</div>
												</div>	


												<!--begin::Card-->
												@foreach($data->assignments as $assignment)



													<!--begin::Card header-->
													<!--end:: Card header-->
													<!--begin:: Card body-->
													@if(!empty($assignment->project))
														<div id="assignment-{{$assignment->id}}" style="border: solid 1px #faf8ff; margin-bottom:10px; padding:10px; border-radius:5px; background-color:#faf8ff">

															<!--begin::Name-->
															@if(Auth::user()->hasPermissionTo('add people'))

															<div class="d-flex" style="float: right;">
							                                    <i onclick="showEditAssignment({{$assignment->id}});" class="fs-8 me-3 d-block fas text-dark fa-pencil"></i>
							                                    <i onclick="deleteAssignmentAlert({{$assignment->id}});" class="fs-8 me-3 d-block fas  text-danger fa-trash"></i>
															</div>
															@endif

															<div class="fs-5 fw-bold text-dark">
																@if ((date('Y-m-d') >= $assignment->start_date) && (date('Y-m-d') <= $assignment->end_date))
																	<i class="fa-solid text-danger fa-star"></i>
																@endif
																{{$assignment->project->name}}</div>
															<!--end::Name-->
															<!--begin::Description-->
															<p class="text-gray-600 fw-semibold fs-7 mt-1 mb-1">
																@if($assignment->doc && in_array($assignment->doc->status, ['Expired']))
																<i title="Expired" class="fa-solid text-danger fa-triangle-exclamation"></i>
																@endif
																@if($assignment->doc)
																	{{$assignment->doc->skill->certification}}</p>
																@endif
															<!--end::Description-->
															<!--begin::Info-->

																<div class="fw-semibold  text-gray-800 fs-8">{{date('M j, Y', strtotime($assignment->start_date))}} - {{date('M j, Y', strtotime($assignment->end_date))}}</div>
															<!--end::Info-->
															<!--begin::Progress-->
															<!-- <div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="This project 30% completed">
																<div class="bg-info rounded h-4px" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
															</div> -->
															<!--end::Progress-->

														</div>
													@endif
													<!--end:: Card body-->

												@endforeach
												<!--end::Card-->

													<div class="" style="padding:5px; background-color: #f1faff; margin-top: 10px; border-radius: 5px; margin-bottom: 5px;">
														<div class="">
															<div class="fw-semibold  text-gray-600 fs-5">Active Trainings
																<span style="float:right;">
																	@if(Auth::user()->hasPermissionTo('add people'))
																		<a data-bs-toggle="modal" onclick="resetTrainingForm()" data-bs-target="#training_modal" href="javascript:void(0);"><i class="fa-solid fa-circle-plus text-info"></i> Create</a>
																	@endif
																</span>
															</div>
														</div>
													</div>	


													<!--begin::Card-->

													@forelse($data->trainings as $training)

														<!--begin::Card header-->
														<!--end:: Card header-->
														<!--begin:: Card body-->
															<div id="training-{{$training->id}}" style="border: solid 1px #faf8ff; margin-bottom:10px; padding:10px; border-radius:5px; background-color:#faf8ff">
																<!--begin::Name-->
																@if(Auth::user()->hasPermissionTo('add people'))

																<div class="d-flex" style="float: right;">
								                                    <i onclick="showEditTraining({{$training->id}});" class="fs-8 me-3 d-block fas text-dark fa-pencil"></i>
								                                    <i onclick="deleteTrainingAlert({{$training->id}});" class="fs-8 me-3 d-block fas  text-danger fa-trash"></i>
																</div>

																@endif

																<div class="fs-6 fw-bold text-dark"><a class="text-gray-800" href="{{route('pdf-training',$training->id )}}"><i class="fa-solid text-dark fa-file-pdf"></i> {{$training->skill->certification}}</a></div>
																<!--end::Name-->
																<!--begin::Description-->
																<p class="text-gray-600 fw-semibold fs-7 mt-1 mb-7">{{$training->course_provider}}</p>
																<!--end::Description-->
																<!--begin::Info-->
																<div class="d-flex flex-wrap">
																	<!--begin::Due-->
																	<div class=" rounded min-w-100px">
																		<div class="fs-7 text-gray-800 fw-bold">Course Date: {{date('M j, Y', strtotime($training->course_date))}}</div>
																	</div>
																	<!--end::Due-->
																	<!--begin::Budget-->
																	<!--end::Budget-->
																</div>
																<!--end::Info-->
																<!--begin::Progress-->
																<!-- <div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="This project 30% completed">
																	<div class="bg-info rounded h-4px" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
																</div> -->
																<!--end::Progress-->

															</div>

													@empty
													    <p class="fs-5 fw-semibold text-gray-600" style="text-align: center;">No trainings found</p>
													@endforelse
												<!--end::Card-->

												@if(!empty($data->pending_trainings->count()))
													<div class="" style="padding:5px; background-color: #f1faff; margin-top: 10px; border-radius: 5px; margin-bottom: 5px;">
														<div class="">
															<div class="fw-semibold  text-gray-600 fs-5">Pending Trainings</div>
														</div>
													</div>	

													@foreach($data->pending_trainings as $training)

														<!--begin::Card header-->
														<!--end:: Card header-->
														<!--begin:: Card body-->
															<div id="training-{{$training->id}}" style="border: solid 1px #faf8ff; margin-bottom:10px; padding:10px; border-radius:5px; background-color:#faf8ff">
																<!--begin::Name-->
																@if(Auth::user()->hasPermissionTo('add people'))

																<div class="d-flex" style="float: right;">
								                                    <i onclick="showEditTraining({{$training->id}});" class="fs-8 me-3 d-block fas text-dark fa-pencil"></i>
								                                    <i onclick="deleteTrainingAlert({{$training->id}});" class="fs-8 me-3 d-block fas  text-danger fa-trash"></i>
																</div>

																@endif

																<div class="fs-6 fw-bold text-dark"><a class="text-gray-800" href="{{route('pdf-training',$training->id )}}"><i class="fa-solid text-dark fa-file-pdf"></i> {{$training->skill->certification}}</a></div>
																<!--end::Name-->
																<!--begin::Description-->
																<p class="text-gray-600 fw-semibold fs-7 mt-1 mb-7">{{$training->course_provider}}</p>
																<!--end::Description-->
																<!--begin::Info-->
																<div class="d-flex flex-wrap">
																	<!--begin::Due-->
																	<div class=" rounded min-w-100px">
																		<div class="fs-7 text-gray-800 fw-bold">Course Date: {{date('M j, Y', strtotime($training->course_date))}}</div>
																	</div>
																	<!--end::Due-->
																	<!--begin::Budget-->
																	<!--end::Budget-->
																</div>
																<!--end::Info-->
																<!--begin::Progress-->
																<!-- <div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="This project 30% completed">
																	<div class="bg-info rounded h-4px" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
																</div> -->
																<!--end::Progress-->

															</div>


													@endforeach
												@endif

											@endif					



										</div>
										<!--end::Body-->
									</div>
									<!--end::List widget 11-->
								</div>

								<div class="col-xxl-6 mb-5 mb-xl-0">
									<!--begin::List widget 8-->
									<div class="card card-flush h-lg-100" style="background-color: #31596b12; border-radius: 10px;">
										<!--begin::Header-->
										<div class="card-header mb-5">
											<!--begin::Title-->
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bold text-gray-800">Documents Display </span>

											</h3>

										@if(Auth::user()->hasPermissionTo('add people document'))
											<span>
												<button type="button" onclick="showUpload();" class="btn btn-primary" style="padding:3px 10px 3px 10px;margin-top:22px;">Edit/Upload</button>
											</span>
										@endif
											<!--end::Title-->
											<!--begin::Toolbar-->
											<!-- <div class="card-toolbar">
												<a href="../../demo1/dist/apps/ecommerce/sales/listing.html" class="btn btn-sm btn-light">View All</a>
											</div> -->
											<!--end::Toolbar-->
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card-body pt-0" id="documents" style="padding-left:10px; padding-right: 10px;">
											<!--begin::Item-->
											
											
											
										</div>
										<!--end::Body-->
									</div>
									<!--end::LIst widget 8-->
								</div>


							<!-- <div> -->




						</div>
						<!--end::Body-->
					</div>







					<!--end::Chart widget 17-->
				</div>



					<!--end::Messenger-->
				<!-- </div> -->



				<!--end::Content-->
			</div>




			<!--end::Basic info-->
			<!--begin::Sign-in Method-->

			<!--end::Sign-in Method-->


			</div>
		<!--end::Content container-->
	</div>
	<!--end::Content-->




</div>
</form>

	@if(!empty($data))
		@include('backend.training.training')
	@endif


@endsection
