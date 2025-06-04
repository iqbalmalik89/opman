@extends('backend.layouts.auth')
@section('title', App\Library\ModuleConfig::getAction($data) .' '.App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name'])
@section('content')

<form id="suboperative_form">



	@if(!empty($subcontractor_id))
		<input type="hidden" id="subcontractor_id" name="subcontractor_id" value="{{$subcontractor_id ?? ''}}">
	@endif

	<input type="hidden" id="id" name="id" value="{{$data->id ?? ''}}">
	<input type="hidden" id="rid" name="rid" value="@if(!isset($data['id'])) {{time()}} @endif">

<div class="d-flex flex-column flex-column-fluid">
	<!--begin::Toolbar-->

	@if(!empty(session('msg')))
		<div style="margin-top:10px;margin-left: 4%;width: 90%;" class="alert alert-success d-flex align-items-center p-5 mb-10">
	        <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>                    <div class="d-flex flex-column">
				<h4 class="mb-1 text-success">{{session('msg')}}</h4>	
	        </div>
	    </div>
	@endif

	<div id="kt_app_toolbar" class="app-toolbar py- py-lg-2" >

		<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
			<div style="margin-top:10px; margin-bottom: 10px;" class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
				<h1  class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
				@if(!empty($data->id))
					{{$data->first_name}} {{$data->last_name}}
				@else				
					Add Suboperative
				@endif
				</h1>
			</div>


			<div class="d-flex align-items-center gap-2 gap-lg-3">
				<button onclick="history.back()" type="button" class="btn btn-sm fw-bold btn-secondary">Back
				</button>

			@if(Auth::user()->hasPermissionTo('update suboperative'))

				<button type="submit" id="suboperative_form-btn" class="btn btn-sm fw-bold btn-primary">
					<span class="indicator-label">Save Changes</span>
					<span class="indicator-progress">Please wait...
					<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
				</button>

			@endif

			</div>


		</div>
	</div>


	
	<!--end::Toolbar-->
	<!--begin::Content-->
	<div id="kt_app_content" class="app-content flex-column-fluid">





		<!--begin::Content container-->
		<div id="kt_app_content_container" class="app-container container-xxl">


			<!--begin::Basic info-->
			<div class="d-flex flex-column flex-lg-row">
				<!--begin::Sidebar-->
				<div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
					<!--begin::Contacts-->
					<div class="card card-flush">
						<!--begin::Card header-->
						<!--end::Card header-->
						<!--begin::Card body-->
						<div class="card-body pt-5 personal-info" style="padding:10px" id="kt_chat_contacts_body">
							<!--begin::List-->
							<div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto">
								<!--begin::User-->
								<!--begin::User-->


								<div class="d-flex flex-stack" style="padding-top: 20px;padding-bottom: 20px; text-align: center; margin: auto 0; margin-left: 120px;">

									@php
										if(empty($data->photo_path))
											$url = global_asset('assets/media/svg/avatars/blank.svg');
										else
											$url = \Storage::url('suboperative-pics').'/'.$data->photo_path;

									@endphp
									 <div class="image-input image-input-empty" data-kt-image-input="true" style="background-image: url({{$url}})">

									     <!--begin::Image preview wrapper-->
									     <div class="image-input-wrapper w-125px h-125px"></div>
									     <!--end::Image preview wrapper-->

									     <!--begin::Edit button-->
									     <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
									        data-kt-image-input-action="change"
									        data-bs-toggle="tooltip"
									        data-bs-dismiss="click"
									        title="Change avatar">
									         <i style="margin-left: 21px;" class="bi bi-pencil-fill fs-7"></i>

									         <!--begin::Inputs-->
									         <input type="file" name="photo" accept=".png, .jpg, .jpeg" />
									         <input type="" id="photo_path" name="photo_path" value="{{$data['photo_path'] ?? ''}}">
									         <input type="hidden" name="avatar_remove" />
									         <!--end::Inputs-->
									     </label>
									     <!--end::Edit button-->

									     <!--begin::Cancel button-->
									     <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
									        data-kt-image-input-action="cancel"
									        data-bs-toggle="tooltip"
									        data-bs-dismiss="click"
									        title="Cancel avatar">
									         <i class="bi bi-x fs-2"></i>
									     </span>
									     <!--end::Cancel button-->

									     <!--begin::Remove button-->
									     <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
									        data-kt-image-input-action="remove"
									        data-bs-toggle="tooltip"
									        data-bs-dismiss="click"
									        title="Remove avatar">
									         <i class="bi bi-x fs-2"></i>
									     </span>
									     <!--end::Remove button-->
									 </div>

	                            </div>

	                        @if(empty($subcontractor_id))
								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">Subcontractor</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">

                                        <select onchange="getTeams(this.value);" class="form-select" data-control="select2" data-placeholder="Select Subcontractor" id="subcontractor_id" name="subcontractor_id" style="padding:0px;">
                                            <option value="">Select Subcontractor</option>
                                            @if(!empty($subcontractors))
	                                            @foreach($subcontractors as $code => $subcontractor)
	                                                <option @if(!empty($data['subcontractor_id']) && $data['subcontractor_id'] == $subcontractor->id) selected @endif value="{{$subcontractor->id}}">{{$subcontractor->name}}</option>
	                                            @endforeach
	                                        @endif
                                        </select>
	                                </div>
	                            </div>
	                        @endif


								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">First Name</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="first_name" value="{{$data['first_name'] ?? ''}}">
	                                </div>
	                            </div>


								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">Last Name</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="last_name" value="{{$data['last_name'] ?? ''}}">
	                                </div>
	                            </div>

								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">Mobile</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="mobile" value="{{$data['mobile'] ?? ''}}">
	                                </div>
	                            </div>

								<div class="d-flex flex-stack">
	                                <div class="d-flex align-items-center">
	                                    <div class="ms-5">
	                                        <label class="fs-7 fw-bold text-gray-700 mb-2">Email</label>
	                                    </div>
	                                </div>
	                                <div class="d-flex flex-column align-items-end ms-2" style="padding-top: 6px;">
	                                    <input type="text" class="form-control form-control form-control-solid" name="email" value="{{$data['email'] ?? ''}}">
	                                </div>
	                            </div>


							


 
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



				<div class="col-xl-8 flex-lg-row-fluid ms-lg-7 ms-xl-10" id="people-detail">
					<!--begin::Chart widget 17-->



					<div class="card card-flush h-xl-100">
						<!--begin::Body-->
						<div class=" row card-body pt-5">



							<!-- <div class="row g-5 g-xl-10"> -->

								<div class="col-xxl-12 mb-5 mb-xl-0">
									<!--begin::List widget 8-->
									<div class="card card-flush h-lg-100" style="background-color: #31596b12; border-radius: 10px;">
										<!--begin::Header-->
										<div class="card-header mb-5">
											<!--begin::Title-->
											<h3 class="card-title align-items-start flex-column">
												<span class="card-label fw-bold text-gray-800">Documents Display </span>

											</h3>
											<span>
							
										@if(Auth::user()->hasPermissionTo('update suboperative'))

											<button type="button" onclick="showUpload();" class="btn btn-primary" style="padding:3px 10px 3px 10px;margin-top:22px;">Edit/Upload</button></span>

										@endif
											<!--end::Title-->
											<!--begin::Toolbar-->
											<!-- <div class="card-toolbar">
												<a href="../../demo1/dist/apps/ecommerce/sales/listing.html" class="btn btn-sm btn-light">View All</a>
											</div> -->
											<!--end::Toolbar-->
										</div>
										<!--end::Header-->
										<!--begin::Body-->
										<div class="card-body pt-0" id="documents" style="padding-left:10px; padding-right: 10px;">
											<!--begin::Item-->
											
											
											
										</div>
										<!--end::Body-->
									</div>
									<!--end::LIst widget 8-->
								</div>


							<!-- <div> -->




						</div>
						<!--end::Body-->
					</div>







					<!--end::Chart widget 17-->
				</div>



					<!--end::Messenger-->
				<!-- </div> -->



				<!--end::Content-->
			</div>

			<div id="subcontractor_teams"></div>


			<!--end::Basic info-->
			<!--begin::Sign-in Method-->

			<!--end::Sign-in Method-->


		</div>
		<!--end::Content container-->
	</div>
	<!--end::Content-->




</div>
</form>

@endsection
