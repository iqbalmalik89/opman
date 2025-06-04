@extends('backend.layouts.auth')
@section('title', App\Library\ModuleConfig::getAction($data) .' '.App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name'])
@section('content')

<div class="d-flex flex-column flex-column-fluid">
	<!--begin::Toolbar-->

	<div id="kt_app_toolbar" class="app-toolbar py- py-lg-2" >
		<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
			<div style="margin-top:10px; margin-bottom: 10px;" class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
				<h1  class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Site Search</h1>
			</div>
									
			<div class="d-flex align-items-center gap-2 gap-lg-3">
				@if(Auth::user()->hasPermissionTo('add site'))

					<a href="{{route('create-site')}}" class="btn btn-sm fw-bold btn-primary">
						<span class="indicator-label">Add New Site</span>
					</a>

				@endif
			</div>
		</div>
	</div>



	<!--end::Toolbar-->
	<!--begin::Content-->
	<div id="kt_app_content" class="app-content flex-column-fluid">





		<!--begin::Content container-->
		<div id="kt_app_content_container" class="app-container container-xxl">
			<!--begin::Navbar-->





			<!--end::Navbar-->
			<!--begin::Basic info-->



			<div class="d-flex flex-column flex-lg-row">
				<!--begin::Sidebar-->
				<div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
					<!--begin::Contacts-->
					<div class="card card-flush">
						<!--begin::Card header-->
						<div class="card-header pt-7" id="kt_chat_contacts_header">
							<form class="w-100 position-relative" autocomplete="off">
								<span class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
										<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
									</svg>
								</span>
								<input type="text" class="form-control form-control-solid px-15" name="site_search" id="site_search" onkeyup="searchSite();" value="" placeholder="Search by site or job ref" />

							</form>
						</div>
						<!--end::Card header-->
						<!--begin::Card body-->
						<div class="card-body pt-5" style="padding:10px" id="kt_chat_contacts_body">
							<!--begin::List-->
							<div class="scroll-y me-n5 pe-5 h-800px site-list" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_toolbar, #kt_app_toolbar, #kt_footer, #kt_app_footer, #kt_chat_contacts_header" data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_contacts_body" data-kt-scroll-offset="5px">


								

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



				<div class="col-xl-8 flex-lg-row-fluid ms-lg-7 ms-xl-10" id="site-detail">
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
