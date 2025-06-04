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
										<span>Title</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<select name="title" aria-label="Select a Title" data-control="select2" data-placeholder="Select a Role" class="form-select form-select-solid form-select-lg">
										<option value="">Select a Title</option>
										@foreach(['Mr', 'Mrs'] as $title)
											<option @if(!empty($data) && $title == $data->title) selected @endif value="{{$title}}">{{$title}}</option>
										@endforeach
									</select>									
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
										<span>Email</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="email" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Email" value="{{$data['email'] ?? ''}}" />
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
										<span>First Name</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="first_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="First name" value="{{$data['first_name'] ?? ''}}" />
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
										<span>Last Name</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="last_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Last name" value="{{$data['last_name'] ?? ''}}" />
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
										<span>Mobile 1</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="mobile1" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Mobile 1" value="{{$data['mobile1'] ?? ''}}" />
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
										<span>Mobile 2</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="mobile2" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Mobile 2" value="{{$data['mobile2'] ?? ''}}" />
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
										<span>Address 1</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="address1" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Address 1" value="{{$data['address1'] ?? ''}}" />
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
										<span>Address 2</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="address2" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Address 2" value="{{$data['address2'] ?? ''}}" />
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
										<span>Address 3</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="address3" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Address 3" value="{{$data['address3'] ?? ''}}" />
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
										<span>Postcode</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="postcode" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Postcode" value="{{$data['postcode'] ?? ''}}" />
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
										<span>Country</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="country" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Country" value="{{$data['country'] ?? ''}}" />
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
										<span>Instagram</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="instagram_handle" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Instagram Handle" value="{{$data['instagram_handle'] ?? ''}}" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>
							<!--end::Col-->
						</div>
						<!--end::Row-->



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
