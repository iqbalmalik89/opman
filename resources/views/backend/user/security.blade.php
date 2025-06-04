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
						<h2>Two Factor Auth</h2>
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
						

						<div class="row row-cols-1 row-cols-sm-1 rol-cols-md-1 row-cols-lg-1 mb-10">
							<!--begin::Col-->


							<div class="pb-10">
								<!--begin::Option-->

								@if(!empty(Auth::user()['email']))
									<input type="radio" class="btn-check" name="auth_option" value="email" @if(Auth::user()['two_fact_auth'] == 'email') checked="checked" @endif id="kt_modal_two_factor_authentication_option_1">
									<label class="btn btn-outline  btn-outline-dashed btn-active-light-primary  p-7 d-flex align-items-center mb-5" for="kt_modal_two_factor_authentication_option_1">
									<i class="ki-duotone ki-setting-2 fs-4x me-4">
										<span class="path1"></span>
										<span class="path2"></span>
									</i>
									<span class="d-block fw-semibold text-start">
										<span class="text-dark fw-bold d-block fs-3">Email</span>
										<span class="text-muted fw-semibold fs-6">We will send an email to <strong class="fs-4 text-gray-700">{{Auth::user()['email']}}</strong></span>
									</span>
									</label>
								@endif

								<!--end::Option-->
								<!--begin::Option-->
								@if(!empty(Auth::user()['phone']))
								<input type="radio" @if(Auth::user()['two_fact_auth'] == 'phone') checked="checked" @endif class="btn-check" name="auth_option" value="phone" id="kt_modal_two_factor_authentication_option_2">
								<label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center" for="kt_modal_two_factor_authentication_option_2">
									<i class="ki-duotone ki-message-text-2 fs-4x me-4">
										<span class="path1"></span>
										<span class="path2"></span>
										<span class="path3"></span>
									</i>
									<span class="d-block fw-semibold text-start">
										<span class="text-dark fw-bold d-block fs-3">SMS</span>
										<span class="text-muted fw-semibold fs-6">We will send a code via SMS to <strong class="fs-4 text-gray-700">{{Auth::user()['phone']}}</strong>.</span>
									</span>
								</label>
								@endif
								<!--end::Option-->
							</div>
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
