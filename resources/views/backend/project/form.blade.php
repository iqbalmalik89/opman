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
							<div class="col col-lg-4">
								<!--begin::Input group-->
								<div class="fv-row mb-7">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Job No</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="job_no" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Job No" value="{{$data['job_no'] ?? ''}}" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col col-lg-8">
								<div class="fv-row mb-7">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Project Name</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Project Name" value="{{$data['name'] ?? ''}}" />
									<!--end::Input-->
								</div>
							</div>
							<!--end::Col-->
						</div>

						<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
							<!--begin::Col-->
							<div class="col col-lg-4">
								<!--begin::Input group-->
								<div class="fv-row mb-7">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Client</span>
									</label>
									<!--end::Label-->
										<!--begin::Input-->
									<select name="client_id" id="client_id" aria-label="Select a Client" data-control="select2" data-placeholder="Select a Client" class="form-select form-select-solid form-select-lg">
										<option value="">Select Client</option>
                                        @foreach($clients as $client)
                                            <option  @if(!empty($data->client_id) &&  ($data->client_id == $client->id)) selected @endif value="{{$client->id}}">{{$client->name}}</option>
                                        
                                        @endforeach
									</select>									
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>

							<div class="col col-lg-4">
								<!--begin::Input group-->
								<div class="fv-row mb-7">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Start Date</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="start_date" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Start Date" value="@isset($data['start_date']){{date('d/m/Y', strtotime($data['start_date']))}}@endisset" />
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="col col-lg-4">
								<div class="fv-row mb-7">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Due Date</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="due_date" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Due Date" value="@isset($data['due_date']){{date('d/m/Y', strtotime($data['due_date']))}}@endisset" />									<!--end::Input-->
								</div>
							</div>
							<!--end::Col-->
						</div>


						<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
							<!--begin::Col-->
							<!--end::Col-->
							<!--begin::Col-->

							<div class="col col-lg-4">
								<!--begin::Input group-->
								<div class="fv-row mb-7">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Site</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<select name="site_id" id="site_id" aria-label="Select a Site" data-control="select2" data-placeholder="Select a Site" class="form-select form-select-solid form-select-lg">
										<option value="">Select Site</option>
                                        @foreach($sites as $site)
                                            <option  @if(!empty($data->site_id) &&  ($data->site_id == $site->id)) selected @endif value="{{$site->id}}">{{$site->site}}</option>
                                        
                                        @endforeach
									</select>									
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>


							<div class="col col-lg-8">
								<div class="fv-row mb-7">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Project Documents</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<input type="text" name="sheet_url" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Project Documents" value="{{$data['sheet_url'] ?? ''}}" />
									<!--end::Input-->
								</div>
							</div>
							<!--end::Col-->
						</div>


						<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
							<!--begin::Col-->
							<div class="col-xl-2">
								<h3>Links</h3>
							</div>
						</div>


					@if(!empty($data->links) && !empty($data->links->count()))

						@foreach($data->links as $key => $link)
							<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2 @if((count($data->links) - 1) == $key) primary-link @endif">

							<div class="col-xl-3">
								<div class="fv-row mb-4">
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Title</span>
									</label>
									<input type="text" name="title[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Title" value="{{$link['title']}}" />
								</div>
							</div>

							<div class="col-xl-8">
								<div class="fv-row mb-4">
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Link</span>
									</label>
									<input type="text" name="link[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Link" value="{{$link['link']}}" />
								</div>
							</div>


							<div class="col-xl-1">
								<div class="fv-row mb-4">
									<label class="fs-6 fw-semibold form-label mt-3">
									</label>

											<a onclick="removeLink(this);" href="javascript:void(0);"><i class="fa-solid fa-trash fs-1 text-danger" style="margin-top: 42px;"></i></a>
											@if($loop->last)
												<a onclick="addLink();" href="javascript:void(0);"><i class="fa-solid fa-circle-plus fs-1 text-info" style="margin-top: 42px;"></i></a>
											@endif
								</div>
							</div>
							</div>
						@endforeach
					@else


					
					@endif
					@if(!empty($data->links) && empty($data->links->count()))

						<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2 primary-link">

							<div class="col-xl-3">
								<div class="fv-row mb-4">
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Title</span>
									</label>
									<input type="text" name="title[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Title" value="" />
								</div>
							</div>

							<div class="col-xl-8">
								<div class="fv-row mb-4">
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Link</span>
									</label>
									<input type="text" name="link[]" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Link" value="" />
								</div>
							</div>


							<div class="col-xl-1">
								<div class="fv-row mb-4">
									<label class="fs-6 fw-semibold form-label mt-3">
									</label>
									<a onclick="addLink();" href="javascript:void(0);"><i class="fa-solid fa-circle-plus fs-1 text-info" style="margin-top: 42px;"></i></a>
								</div>
							</div>
						</div>
					@endif




						<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
							<!--begin::Col-->

							<!--end::Col-->
							<!--begin::Col-->
							<div class="col col-lg-12">
								<div class="fv-row mb-7">
									<!--begin::Label-->
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Brief</span>
									</label>
									<!--end::Label-->
									<!--begin::Input-->
									<textarea style="height: 140px;" class="form-control form-control-lg form-control-solid" name="brief">{{$data['brief'] ?? ''}}</textarea>
								</div>
							</div>
							<!--end::Col-->
						</div>


						<!--begin::Row-->
						<!--begin::Separator-->
						<div class="separator mb-6"></div>
						<!--end::Separator-->
						<!--begin::Action buttons-->
						<div class="d-flex justify-content-end">
							<!--begin::Button-->
							<a href="{{route('projects')}}" class="btn btn-light me-3">Cancel</a>
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
