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
						<input type="hidden" name="customer_id" id="customer_id" value="{{$customer_id ?? ''}}" />

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
										<span>Category</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->

									<select name="category_id" id="category_id" aria-label="Select a Category" data-control="select2" data-placeholder="Select a Vehicle" class="form-select form-select-solid form-select-lg">
                                        @foreach($categories as $category)
                                            <option  @if(!empty($cat_id) &&  ($cat_id == $category->id)) selected @endif value="{{$category->id}}">{{$category->category}}</option>
                                        
                                        @endforeach
									</select>									

									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>
							<!--end::Col-->
						</div>



						<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
							<!--begin::Col-->
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col">
								<div class="fv-row mb-7">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Certification</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									@if(empty($data['id']))
									<input name="certification[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" value="{{$data['certification'] ?? ''}}" />
									@else
									<input name="certification" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" value="{{$data['certification'] ?? ''}}" />
									@endif

									<!--end::Input-->
								</div>

							</div>

							@if(empty($data['id']))
								<div class="col mt-15">
									<a onclick="addMoreCertification();" href="javascript:void(0);">Add Another Certification</a>
								</div>
							@endif


							<!--end::Col-->
						</div>

						<div class="more-cert">
						</div>

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
