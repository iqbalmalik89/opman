@extends('backend.layouts.auth')
@section('title', App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['plural'])
@section('content')
<?php

if(!empty($_GET['project_id']))
	echo '<input type="hidden" class="load-project" value="'.$_GET['project_id'].'">';

?>


<input type="hidden" name="status" value="{{$status ?? ''}}">

<div class="d-flex flex-column flex-column-fluid module" data-module="{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}">
	<!--begin::Toolbar-->
	<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
		<!--begin::Toolbar container-->
		<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
			<!--begin::Page title-->
			<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
				<!--begin::Title-->
				<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{$status ?? ''}} {{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['plural']}} List</h1>
				<!--end::Title-->
				<!--begin::Breadcrumb-->
				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
			<!--begin::Actions-->

			<!--end::Actions-->
		</div>
		<!--end::Toolbar container-->
	</div>
	<!--end::Toolbar-->
	<!--begin::Content-->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!--begin::Content container-->
		<div id="kt_app_content_container" class="app-container container-xxl">
			<!--begin::Card-->

			<div class="page-loader flex-column bg-dark bg-opacity-25">
			    <span class="spinner-border text-primary" role="status"></span>
			</div>

			<div class="row g-5 g-xl-10 mb-5 mb-xl-10 project-detail">
			</div>

			@if(!empty(session('message')))
				<div class="alert alert-success d-flex align-items-center p-5">
				    <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
				    <div class="d-flex flex-column">
				        <h4 class="mb-1 text-dark">Success</h4>
				        <span>{{session('message')}}</span>
				    </div>
				</div>
			@endif




			<div class="card project-listing">
				<!--begin::Card header-->
				<div class="card-header border-0 pt-6">
					<!--begin::Card title-->
					<div class="card-title">
						<!--begin::Search-->





						<div class="d-flex align-items-center position-relative my-1">
							<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
							<span class="svg-icon svg-icon-1 position-absolute ms-6">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
									<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
								</svg>
							</span>
							<!--end::Svg Icon-->
							<input type="text" data-kt-{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search {{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name']}}" />
						</div>
						<!--end::Search-->
					</div>
					<!--begin::Card title-->
					<!--begin::Card toolbar-->
					<div class="card-toolbar">
						<!--begin::Toolbar-->

<div class="d-flex flex-stack mb-5">
    <!--begin::Search-->
<!--     <div class="d-flex align-items-center position-relative my-1">
        <span class="svg-icon svg-icon-2">...</span>
        <input type="text" data-kt-{{$GLOBALS['module']}}-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Customers"/>
    </div> -->
    <!--end::Search-->

    <!--begin::Toolbar-->
    <div class="d-flex justify-content-end" data-kt-{{$GLOBALS['module']}}-table-toolbar="base">

						<div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
								<!--begin::Header-->
								<div class="px-7 py-5">
									<div class="fs-5 text-dark fw-bold">Filter Options</div>
								</div>
								<!--end::Header-->
								<!--begin::Separator-->
								<div class="separator border-gray-200"></div>
								<!--end::Separator-->
								<!--begin::Content-->
								<div class="px-7 py-5" data-kt-{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}-table-filter="form">
									<!--begin::Input group-->
									<div class="mb-10">
										<label class="form-label fs-6 fw-semibold">Role:</label>
										<select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}-table-filter="role" data-hide-search="true">
											<option></option>
											<option value="Administrator">Administrator</option>
											<option value="Analyst">Analyst</option>
											<option value="Developer">Developer</option>
											<option value="Support">Support</option>
											<option value="Trial">Trial</option>
										</select>
									</div>
									<!--end::Input group-->
									<!--begin::Input group-->
									<div class="mb-10">
										<label class="form-label fs-6 fw-semibold">Two Step Verification:</label>
										<select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}-table-filter="two-step" data-hide-search="true">
											<option></option>
											<option value="Enabled">Enabled</option>
										</select>
									</div>
									<!--end::Input group-->
									<!--begin::Actions-->
									<div class="d-flex justify-content-end">
										<button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}-table-filter="reset">Reset</button>
										<button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}-table-filter="filter">Apply</button>
									</div>
									<!--end::Actions-->
								</div>
								<!--end::Content-->
							</div>



        <!--begin::Add customer-->

@if(Auth::user()->hasPermissionTo('add project') && empty($status))
	        <a class="btn btn-primary" href="{{route('create-'.App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module'])}}">
	            Add {{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name']}}
	        </a>
@endif
        <!--end::Add customer-->
    </div>
    <!--end::Toolbar-->

    <!--begin::Group actions-->
    <div class="d-flex justify-content-end align-items-center d-none" data-kt-{{$GLOBALS['module']}}-table-toolbar="selected">
        <div class="fw-bold me-5">
            <span class="me-2" data-kt-{{$GLOBALS['module']}}-table-select="selected_count"></span> Selected
        </div>

        <button type="button" class="btn btn-danger" data-kt-{{$GLOBALS['module']}}-table-select="delete_selected">
            Delete
        </button>
    </div>
    <!--end::Group actions-->
</div>


						<!--end::Modal - Add task-->
					</div>
					<!--end::Card toolbar-->
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body py-4 projects-list">
					<!--begin::Table-->

					<!--end::Table-->
				</div>
				<!--end::Card body-->
			</div>
			<!--end::Card-->
		</div>
		<!--end::Content container-->
	</div>
	<!--end::Content-->
</div>

@endsection
