@extends('backend.layouts.auth')
@section('title', App\Library\ModuleConfig::getAction($data) .' '.App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name'])
@section('content')

<div class="d-flex flex-column flex-column-fluid">
	<!--begin::Toolbar-->
	<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
		<!--begin::Toolbar container-->
		<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
			<!--begin::Page title-->
			<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
				<!--begin::Title-->
				<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module_title']}}</h1>
				<!--end::Title-->
			</div>
			<!--end::Page title-->

		</div>
		<!--end::Toolbar container-->
	</div>
	<!--end::Toolbar-->
	<!--begin::Content-->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!--begin::Content container-->
		<div id="kt_app_content_container" class="app-container container-xxl">
			<!--begin::Navbar-->

			<!--end::Navbar-->
			<!--begin::Basic info-->


			<div class="card card-flush h-lg-100" id="kt_contacts_main">
				<!--begin::Card header-->
				<div class="card-header pt-7" id="kt_chat_contacts_header">
					<!--begin::Card title-->
					<div class="card-title">
						<!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->

						<!--end::Svg Icon-->
						<h2>{{App\Library\ModuleConfig::getAction($data)}} {{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name']}}</h2>
					</div>
					<!--end::Card title-->
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body pt-5">
					<!--begin::Form-->
					<div id="{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}-form-msg"></div>

					<form id="{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}-form" class="form">

						<input type="hidden" name="module_id" id="module_id" value="{{$data['id'] ?? ''}}" />


						<!--begin::Input group-->

						<!--end::Input group-->
						<!--begin::Input group-->

						<!--end::Input group-->

						<!--begin::Row-->
						<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
							<!--begin::Col-->
							<div class="col">
								<!--begin::Input group-->
								<div class="fv-row mb-7">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Site</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="site" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Site" value="{{$data['site'] ?? ''}}" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->

							<div class="col">
								<!--begin::Input group-->
								<div class="fv-row mb-7">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Site Entrance Location (What 3 Words)</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="location" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Location" value="{{$data['location'] ?? ''}}" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>

							<!--end::Col-->
						</div>


						<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
							<!--begin::Col-->
							<div class="col">
								<!--begin::Input group-->
								<div class="fv-row mb-7">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Address</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="address" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Address" value="{{$data['address'] ?? ''}}" />
									<br>
									<input type="text" name="address2" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Address" value="{{$data['address2'] ?? ''}}" />

									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>

							<!--end::Col-->
							<!--begin::Col-->
							<div class="col">
								<div class="fv-row mb-4">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Notes</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<textarea style="height:110px;" class="form-control form-control-solid"  name="notes">{{$data['notes'] ?? ''}}</textarea>

									<!--end::Input-->
								</div>

							</div>
							<!--end::Col-->
						</div>




						<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
							<!--begin::Col-->
							<div class="col-xl-2">
								<!--begin::Input group-->
								<div class="fv-row mb-4">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Post Code</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="postcode" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Postcode" value="{{$data['postcode'] ?? ''}}" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col-xl-2">
								<!--begin::Input group-->
								<div class="fv-row mb-4">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Latitude</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="lat" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Latitude" value="{{$data['lat'] ?? ''}}" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>

							<div class="col-xl-2">
								<!--begin::Input group-->
								<div class="fv-row mb-4">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Longitude</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="lng" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Longitude" value="{{$data['lng'] ?? ''}}" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>

							<div class="col-xl-6">

							</div>

							<!--end::Col-->
						</div>



						<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
							<!--begin::Col-->
							<div class="col-xl-2">
								<h3>Contacts</h3>
							</div>
						</div>

					@if(!empty($contacts))

						@foreach($contacts as $key => $contact)
							<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2 @if(($contacts->count() - 1) == $key) primary-contact @endif">

							<div class="col-xl-3">
								<div class="fv-row mb-4">
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Name</span>
									</label>
									<input type="text" name="name[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Name" value="{{$contact['name']}}" />
								</div>
							</div>

							<div class="col-xl-2">
								<div class="fv-row mb-4">
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Mobile</span>
									</label>
									<input type="text" name="mobile[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Mobile" value="{{$contact['mobile']}}" />
								</div>
							</div>

							<div class="col-xl-3">
								<div class="fv-row mb-4">
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Email</span>
									</label>
									<input type="text" name="email[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Email" value="{{$contact['email']}}" />
								</div>
							</div>

							<div class="col-xl-3">
								<div class="fv-row mb-4">
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Position</span>
									</label>
									<input type="text" name="position[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Position" value="{{$contact['position']}}" />
								</div>
							</div>

							<div class="col-xl-1">
								<div class="fv-row mb-4">
									<label class="fs-6 fw-semibold form-label mt-3">
									</label>
									@if(empty($key))
										<a onclick="addContact();" href="javascript:void(0);"><i class="fa-solid fa-circle-plus fs-1 text-info" style="margin-top: 42px;"></i></a>
									@else
										<a onclick="removeContact(this);" href="javascript:void(0);"><i class="fa-solid fa-trash fs-1 text-danger" style="margin-top: 42px;"></i></a>
									@endif
								</div>
							</div>
							</div>
						@endforeach
					@else


						<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2 primary-contact">

							<div class="col-xl-3">
								<div class="fv-row mb-4">
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Name</span>
									</label>
									<input type="text" name="name[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Name" value="" />
								</div>
							</div>

							<div class="col-xl-2">
								<div class="fv-row mb-4">
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Mobile</span>
									</label>
									<input type="text" name="mobile[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Mobile" value="" />
								</div>
							</div>

							<div class="col-xl-3">
								<div class="fv-row mb-4">
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Email</span>
									</label>
									<input type="text" name="email[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Email" value="" />
								</div>
							</div>

							<div class="col-xl-3">
								<div class="fv-row mb-4">
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Position</span>
									</label>
									<input type="text" name="position[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Position" value="" />
								</div>
							</div>

							<div class="col-xl-1">
								<div class="fv-row mb-4">
									<label class="fs-6 fw-semibold form-label mt-3">
									</label>
									<a onclick="addContact();" href="javascript:void(0);"><i class="fa-solid fa-circle-plus fs-1 text-info" style="margin-top: 42px;"></i></a>
								</div>
							</div>
						</div>

					@endif



						<!--begin::Row-->
						<!--begin::Separator-->
						<div class="separator mb-6"></div>
						<!--end::Separator-->
						<!--begin::Action buttons-->
						<div class="d-flex justify-content-end">
							<!--begin::Button-->
							<button type="reset" data-kt-contacts-type="cancel" class="btn btn-light me-3">Cancel</button>
							<!--end::Button-->
							<!--begin::Button-->
							<button type="submit" class="btn btn-primary" id="{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}-form-btn">Save Changes</button>

							<!--end::Button-->
						</div>
						<!--end::Action buttons-->
					</form>
					<!--end::Form-->
				</div>
				<!--end::Card body-->
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
