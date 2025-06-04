@extends('backend.layouts.auth')
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

					<form id="tenant-form" class="form">

						<input type="hidden" name="module_id" id="module_id" value="{{$data['id'] ?? ''}}" />

						<input type="hidden" name="user_id" id="user_id" value="{{$data['super_admin']['id'] ?? ''}}" />

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
										<span>Company Name</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="company" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Company Name" value="{{$data['name'] ?? ''}}" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col">

								<div class="fv-row mb-7">
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>First Name</span>
									</label>

									@foreach(\App\Library\Utility::companyStatus() as $key => $status)

											<div class="form-check form-check-{{$key}} form-check-custom mb-2 form-check-solid">
										    <input name="status" @if(!empty($data['status']) && $data['status'] == $status) checked @endif class="form-check-input" value="{{$status}}" type="radio" value="{{$status}}" id="{{$key}}"/>
										    <label class="form-check-label" for="{{$key}}">
										        {{$status}}
										    </label>
										</div>

									@endforeach


								</div>

							</div>
							<!--end::Col-->
						</div>

						<h3 class="m-0 text-gray-800 mb-10">Super Admin Account</h3>


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
									<input type="text" name="first_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="First name" value="{{$data['super_admin']['first_name'] ?? ''}}" />
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
									<input type="text" name="last_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Last name" value="{{$data['super_admin']['last_name'] ?? ''}}" />
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
										<span>Email</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="email" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Email" value="{{$data['super_admin']['email'] ?? ''}}" />
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
										<span>Password 
											@if(!empty($data['super_admin']))
												<span class="fs-8 italic text-gray-600">(Leave empty if you don't want to update)</span>
											@endif
										</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="password" name="password" class="form-control form-control-lg form-control-solid" placeholder="Password" value="" autocomplete="off"/>
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
										<span>Phone</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<br>
									<input type="text" class="form-control form-control-lg form-control-solid" name="phone" id="phone">
									<input type="hidden" name="phone_full">
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col">
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
