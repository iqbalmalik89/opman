@extends('backend.layouts.auth')
@section('title', App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['plural'])
@section('content')

<input type="hidden" name="category_id" id="category_id" value="{{$category_id ?? ''}}" />

<div class="d-flex flex-column flex-column-fluid module" data-module="{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}">
	<!--begin::Toolbar-->
	<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
		<!--begin::Toolbar container-->
		<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
			<!--begin::Page title-->
			<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
				<!--begin::Title-->
				<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['plural']}} List</h1>
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
			<div class="card">
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
        <!--begin::Filter-->
<!--         <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
			<span class="svg-icon svg-icon-2">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor" />
				</svg>
			</span>
            Filter
        </button> -->
        <!--end::Filter-->

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

<?php /* 		@if(Auth::user()->hasPermissionTo('add project')) */ ?>
	        <a class="btn btn-primary" href="{{route('create-'.App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module'], $category_id)}}">
	            Add {{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name']}}
	        </a>
<?php /*	    @endif */ ?>
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
				<div class="card-body py-4">
					<!--begin::Table-->

					<table id="{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}_listing" class="table align-middle table-row-dashed fs-6 gy-5">
					    <thead>
					    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
					        <th class="w-10px pe-2">
					            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
					                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}_listing .form-check-input" value="1"/>
					            </div>
					        </th>
					        <th>Certification</th>
					        <th class="text-end min-w-100px">Actions</th>
					    </tr>
					    </thead>
					    <tbody class="text-gray-600 fw-semibold">
					    </tbody>
					</table>

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
