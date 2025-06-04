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

					<form id="{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}-form" class="form">

						<input type="hidden" name="module_id" id="module_id" value="{{$data['id'] ?? ''}}" />


						<!--begin::Input group-->

						<!--end::Input group-->
						<!--begin::Input group-->

						<!--end::Input group-->

						<!--begin::Row-->

								<div class="d-flex flex-stack" style="padding-top: 20px;padding-bottom: 20px; text-align: center; margin: auto 0; margin-left: 120px;">

									@php
										if(empty($data->photo_path))
											$url = global_asset('assets/media/svg/avatars/blank.svg');
										else
											$url = \Storage::url('user-photos/'.$data->photo_path);


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
									<input type="text" name="first_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="First name" value="{{$data['first_name'] ?? ''}}" />
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
									<input type="text" name="last_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Last name" value="{{$data['last_name'] ?? ''}}" />
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
									<input type="text" name="email" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Email" value="{{$data['email'] ?? ''}}" />
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
										<span>Password</span>
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

						<!--end::Row-->


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
									<!--begin::Input--><br>
									<input type="text" name="phone" id="phone" class="form-control form-control-lg form-control-solid" placeholder="Phone" value="{{$data['phone'] ?? ''}}" />
									<input type="hidden" name="phone_full">
									<!--end::Input-->
								</div>
								<!--end::Input group-->
							</div>

							<div class="col">
								<!--begin::Input group-->

								<div class="fv-row mb-7">
									<label class="fs-6 fw-semibold form-label mt-3">
										<span>Role</span>
										<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Select apprepriate role."></i>
									</label>
									<select name="role" aria-label="Select a Role" data-control="select2" data-placeholder="Select a Role" class="form-select form-select-solid form-select-lg">
										<option value="">Select a Role</option>
										@foreach($roles as $role)
											<option @if(!empty($data) && $role->id == $data->roles->pluck('id')[0]) selected @endif value="{{$role->id}}">{{ucfirst($role->name)}}</option>
										@endforeach
									</select>
								</div>


							</div>
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
