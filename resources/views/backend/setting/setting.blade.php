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
					

	<div class="py-5">
        <div class="d-flex flex-column flex-md-row ">
			<ul class="nav nav-tabs nav-pills flex-row border-0 flex-md-column me-5 mb-3 mb-md-0 fs-6 min-w-lg-200px">
			    <li class="nav-item w-100 me-0 mb-md-2">
			        <a class="nav-link w-100 active btn btn-flex btn-active-light-success" data-bs-toggle="tab" href="#logos_tab">
			            <span class="svg-icon fs-2"><svg>...</svg></span>
			            <span class="d-flex flex-column align-items-start">
			                <span class="fs-4 fw-bold">Logos</span>
			                <span class="fs-7">Logo and Favicon settings</span>
			            </span>
			        </a>
			    </li>
			    <li class="nav-item w-100 me-0 mb-md-2">
			        <a class="nav-link w-100 btn btn-flex btn-active-light-info" data-bs-toggle="tab" href="#alerts_tab">
			            <span class="svg-icon fs-2"><svg>...</svg></span>
			            <span class="d-flex flex-column align-items-start">
			                <span class="fs-4 fw-bold">Alerts</span>
			                <span class="fs-7">Email/SMS alert settings</span>
			            </span>
			        </a>
			    </li>
			</ul>

			<div class="tab-content" id="myTabContent">
			    <div class="tab-pane fade show active" id="logos_tab" role="tabpanel">

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
										<span>Site Title</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="site_title" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Site Title" value="{{$data['site_title'] ?? ''}}" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col">
								<!--begin::Input group-->
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
										<span>Splash Heading</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="splash_heading" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Splash Heading" value="{{$data['splash_heading'] ?? ''}}" />
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
										<span>Splash Small Text</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="splash_small_text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Splash Small Text" value="{{$data['splash_small_text'] ?? ''}}" />
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
										<span>Logo</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<div class="col-md-9 col-sm-12">
										<x-backend.file id="logo_img" file="{{$data['logo_img_path']}}"/>
									</div>

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
										<span>Favicon</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<div class="col-md-9 col-sm-12">
										<x-backend.file id="favicon_img" file="{{$data['favicon_img_path']}}"/>
									</div>

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
										<span>Splash Image</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<div class="col-md-9 col-sm-12">
										<x-backend.file id="splash_img" file="{{$data['splash_img_path']}}"/>
									</div>

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
										<span>Splash Background</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<div class="col-md-9 col-sm-12">
										<x-backend.file id="splash_bg_img" file="{{$data['splash_bg_img_path']}}"/>
									</div>

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

			    </div>
			    <div class="tab-pane fade" id="alerts_tab" role="tabpanel" style="width:600px;">

					<form id="alert-form" class="form">


						<div id="alert-form-msg"></div>
						<!--begin::Input group-->

						<!--end::Input group-->
						<!--begin::Input group-->

						<!--end::Input group-->

						<!--begin::Row-->
						<div class="row ">
							<!--begin::Col-->
							<div class="col-lg-12">
								<!--begin::Input group-->
								<div class="fv-row mb-7">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Alert Receiving Emails (comma seperated)</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->

									<textarea name="alert_emails" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Alert Emails" class="form-control">{{$data['alert_emails'] ?? ''}}</textarea>

									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->
						
							<!--end::Col-->
						</div>

						<div class="row ">
							<!--begin::Col-->
							<div class="col-lg-12">
								<!--begin::Input group-->
								<div class="fv-row mb-7">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Alert Receiving SMS (comma seperated)</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->

									<textarea name="alert_phone_numbers" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Alert Phone Numbers" class="form-control">{{$data['alert_phone_numbers'] ?? ''}}</textarea>

									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->
						
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
							<button type="submit" class="btn btn-primary" id="alert-form-btn">Save Changes</button>

							<!--end::Button-->
						</div>
						<!--end::Action buttons-->
					</form>

			    </div>
			</div>


		</div>
	</div>




















					
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
