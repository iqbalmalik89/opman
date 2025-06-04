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
						<h2>
						@if(Auth::user()->hasPermissionTo('add subcontractor'))
							{{App\Library\ModuleConfig::getAction($data)}} 
						@else
							View
						@endif

							{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name']}}</h2>
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
										<span>Name</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="subcontractor_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Name" value="{{$data['name'] ?? ''}}" />
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
										<span>Company Number</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="company_number" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Company Number" value="{{$data['company_number'] ?? ''}}" />
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
										<span>Address </span>
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
										<span>Postcode </span>
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
							<div class="col">
								<!--begin::Input group-->
								<div class="fv-row mb-7">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Gross Status</span>
									</label>

									<!--end::Label-->
									<!--begin::Input-->

							            <div class="dropzone dropzone-queue mb-2" id="gross_status">
							                <!--begin::Controls-->
			                                <input type="hidden" style="width:1000px;" id="gross_status_path" name="gross_status_path" value="@if(!empty($data->gross_status_path)){{ltrim($data->gross_status_path, ',')}}@endif">
			                                <!-- <input type="" style="width:1000px;" id="doc_id" name="doc_id"> -->

			                                @if(!empty($data->gross_status_path))
												<span>												
												<a target="_blank" href="{{\Storage::url('gross-status/' . $data->gross_status_path)}}">{{ltrim($data->gross_status_path, ',')}}</a>
												@if(Auth::user()->hasPermissionTo('add subcontractor'))
													<i onclick="removeFileObj('#gross_status_path', this);" class="fa-solid fa-trash fs-1 text-danger"></i></span>
												@endif
											@endif

											@if(Auth::user()->hasPermissionTo('add subcontractor'))
								                <div class="dropzone-panel mb-lg-0 mb-2">
								                    <a class="dropzone-select btn btn-sm btn-primary me-2">Attach files</a>
								                    <a class="dropzone-remove-all btn btn-sm btn-light-primary">Remove All</a>
								                </div>
							                @endif
							                <!--end::Controls-->

							                <!--begin::Items-->
							                <div class="dropzone-items wm-200px">
							                    <div class="dropzone-item" style="display:none">
							                        <!--begin::File-->
							                        <div class="dropzone-file">
							                            <div class="dropzone-filename" title="some_image_file_name.jpg">
							                                <span data-dz-name>some_image_file_name.jpg</span>
							                                <strong>(<span data-dz-size>340kb</span>)</strong>
							                            </div>

							                            <div class="dropzone-error" data-dz-errormessage></div>
							                        </div>
							                        <!--end::File-->

							                        <!--begin::Progress-->
							                        <div class="dropzone-progress">
							                            <div class="progress">
							                                <div
							                                    class="progress-bar bg-primary"
							                                    role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress>
							                                </div>
							                            </div>
							                        </div>
							                        <!--end::Progress-->

							                        <!--begin::Toolbar-->
							                        <div class="dropzone-toolbar">
							                            <span class="dropzone-delete" data-dz-remove><i class="bi bi-x fs-1"></i></span>
							                        </div>
							                        <!--end::Toolbar-->
							                    </div>
							                </div>
							                <!--end::Items-->
							            </div>

									<!--end::Input-->
								</div>
								<!--end::Input group-->
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
									@if(Auth::user()->hasPermissionTo('add subcontractor'))
	
										@if(empty($key))
											<a onclick="addContact();" href="javascript:void(0);"><i class="fa-solid fa-circle-plus fs-1 text-info" style="margin-top: 42px;"></i></a>
										@else
											<a onclick="removeContact(this);" href="javascript:void(0);"><i class="fa-solid fa-trash fs-1 text-danger" style="margin-top: 42px;"></i></a>
										@endif
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
							@if(Auth::user()->hasPermissionTo('add subcontractor'))

								<a href="{{route('subcontractors')}}" class="btn btn-light me-3">Cancel</a>
								<!--end::Button-->
								<!--begin::Button-->
								<button type="submit" class="btn btn-primary" id="{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}-form-btn">Save Changes</button>

							@endif
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
