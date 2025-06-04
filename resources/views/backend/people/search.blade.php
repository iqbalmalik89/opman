@extends('backend.layouts.auth')
@section('title', App\Library\ModuleConfig::getAction($data) .' '.App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name'])
@section('content')

<div class="d-flex flex-column flex-column-fluid">
	<!--begin::Toolbar-->
	<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-2">
<!-- 		<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
			<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
				<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module_title']}}</h1>
			</div>
		</div> -->
	</div>
	<!--end::Toolbar-->
	<!--begin::Content-->
	<div id="kt_app_content" class="app-content flex-column-fluid">





		<!--begin::Content container-->
		<div id="kt_app_content_container" class="app-container container-xxl">
			<!--begin::Navbar-->


			<form action="javascript:;">
				<!--begin::Card-->
				<div class="card mb-7">
					<!--begin::Card body-->
					<div class="card-body">
						<!--begin::Compact form-->
						<!--end::Compact form-->
						<!--begin::Advance form-->
						<div class="collapse show" id="kt_advanced_search_form">
							<!--begin::Separator-->
							<!--end::Separator-->
							<!--begin::Row-->
							<!--begin::Row-->
							<div class="row g-8">
								<!--begin::Col-->
								<div class="col-xxl-12">
									<!--begin::Row-->
									<div class="row g-8">
										<div class="col-lg-3">
											<label class="fs-6 form-label fw-bold text-dark">Search by name</label>
											<input type="text" class="form-control form-control form-control-solid" onkeyup="searchPeople();" name="name" id="name">
										</div>

										<?php /*
										<div class="col-lg-4">
											<!--begin::Label-->
											<label class="fs-6 form-label fw-bold text-dark">
												<span>Category</span>
											</label>
											<!--end::Label-->
											<!--begin::Input-->

											<select name="cat_id" onchange="getDocClasses(this);" id="cat_id" aria-label="Select Category" data-control="select2" data-placeholder="Select Category" class="form-select form-select-solid form-select-lg">
												<option value="">Select Category</option>
			                                    @foreach($categories as $category)
			                                        <option  value="{{$category->id}}">{{$category->category}}</option>
			                                    @endforeach
											</select>									

											<!--end::Input-->
										</div>
										<?php */ ?>

										<div class="col-lg-4">
											<!--begin::Label-->
											<label class="fs-6 form-label fw-bold text-dark">
												<span>Select Skills</span>
											</label>
											<!--end::Label-->
											<!--begin::Input-->

											<select id="skill" name="skill[]" aria-label="Select Skill" data-control="select2" data-placeholder="Select Skill" class="form-select form-select-solid form-select-lg" multiple="multiple">
												<option value="">Select Skills</option>

												@foreach($categories as $category)
													<optgroup label="{{$category->category}}"></optgroup>
													@foreach($category->certifications as $cert)
														<option value="{{$cert->id}}">{{$cert->certification}}</option>
													@endforeach
												@endforeach
											</select>									

											<!--end::Input-->
										</div>

										<div class="col-lg-2">
											<!--begin::Label-->
											<label class="fs-6 form-label fw-bold text-dark">
												<span>Status</span>
											</label>
											<!--end::Label-->
											<!--begin::Input-->

											<select id="status" name="status" aria-label="Select Status" data-placeholder="Select Status" class="form-select form-select-solid form-select-lg">
												<option value="">Select Status</option>
												<option value="Active">Active</option>
												<option value="Inactive">Inactive</option>
												
											</select>									

											<!--end::Input-->
										</div>

										<div class="col-lg-2">
											<!--begin::Label-->
											<label class="fs-6 form-label fw-bold text-dark">
												<span>Postcode</span>
											</label>
											<!--end::Label-->
											<!--begin::Input-->

											<input type="text" name="postcode" id="postcode" value="" class="form-control">
											<!--end::Input-->
										</div>


										<div class="col-lg-1">
											<!--begin::Label-->
											<i onclick="searchPeople();" class="fa-solid mt-10 fa-search text-primary fs-1" style="cursor: pointer;"></i>
											<!--end::Input-->
										</div>



										<!--end::Col-->
									</div>
									<!--end::Row-->
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<!--end::Col-->
							</div>
							<!--end::Row-->
						</div>
						<!--end::Advance form-->
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			</form>



			<!--end::Navbar-->
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
						<div class="card-body pt-5" style="padding:10px" id="kt_chat_contacts_body">
							<!--begin::List-->
							<div class="scroll-y me-n5 pe-5 h-200px h-lg-auto people-list" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_toolbar, #kt_app_toolbar, #kt_footer, #kt_app_footer, #kt_chat_contacts_header" data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_contacts_body" data-kt-scroll-offset="5px">
								<!--begin::User-->
								<!--begin::User-->

								<div class="no-result text-gray-700 fs-3">Searched people will appear here</div>

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

@endsection
