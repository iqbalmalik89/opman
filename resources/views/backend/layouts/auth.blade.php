<!DOCTYPE html>
@php 
	$settings = \App\Services\SettingService::getSetting(); 
	$projectService = new \App\Services\ProjectService();
	if(tenant())
	{
		$storageUrl = \Illuminate\Support\Facades\Storage::url('');
	}
@endphp
<html lang="en">
	<!--begin::Head-->
        @include('backend.partials.head')
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getItem("data-theme") !== null ) { themeMode = localStorage.getItem("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Header-->
		        @include('backend.partials.header')
				<!--end::Header-->
				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<!--begin::Sidebar-->
			        @include('backend.partials.sidebar')
					<!--end::Sidebar-->
					<!--begin::Main-->
					<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
						<!--begin::Content wrapper-->
					            @yield('content')
					    <!--end::Content wrapper-->
						<!--begin::Footer-->
<!-- 						<div id="kt_app_footer" class="app-footer">
							<div class="app-container container-fluid d-flex flex-column flex-md-row flex-center flex-md-stack py-3">
								<div class="text-dark order-2 order-md-1">
									<span class="text-muted fw-semibold me-1">{{date('Y')}}&copy;</span>
									<a href="https://codekernal.com" target="_blank" class="text-gray-800 text-hover-primary">Developed by CodeKernal</a>
								</div>
							</div>
						</div> -->
					</div>
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::App-->
		<!--begin::Drawers-->
		<!--begin::Activities drawer-->
		<div id="kt_activities" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="activities" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'lg': '900px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_activities_toggle" data-kt-drawer-close="#kt_activities_close">
			<div class="card shadow-none border-0 rounded-0">
				<!--begin::Header-->
				<div class="card-header" id="kt_activities_header">
					<h3 class="card-title fw-bold text-dark">Activity Logs</h3>
					<div class="card-toolbar">
						<button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n5" id="kt_activities_close">
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
							<span class="svg-icon svg-icon-1">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
									<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</button>
					</div>
				</div>
				<!--end::Header-->
				<!--begin::Body-->
			
				<!--end::Body-->
				<!--begin::Footer-->
				<div class="card-footer py-5 text-center" id="kt_activities_footer">
					<a href="../../demo1/dist/pages/user-profile/activity.html" class="btn btn-bg-body text-primary">View All Activities
					<!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
					<span class="svg-icon svg-icon-3 svg-icon-primary">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor" />
							<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor" />
						</svg>
					</span>
					<!--end::Svg Icon--></a>
				</div>
				<!--end::Footer-->
			</div>
		</div>
		<!--end::Activities drawer-->
		<!--begin::Chat drawer-->
	
		<!--end::Chat drawer-->
		<!--end::Drawers-->
		<!--begin::Engage drawers-->
		<!--begin::Demos drawer-->
	
		
		<!--end::Help drawer-->
		<!--end::Engage drawers-->
		<!--begin::Engage toolbar-->
		{{--
		<div class="engage-toolbar d-flex position-fixed px-5 fw-bold zindex-2 top-50 end-0 transform-90 mt-5 mt-lg-20 gap-2">
			<!--begin::Demos drawer toggle-->
			<button id="kt_engage_demos_toggle" class="engage-demos-toggle engage-btn btn shadow-sm fs-6 px-4 rounded-top-0" title="Check out 24 more demos" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-dismiss="click" data-bs-trigger="hover">
				<span id="kt_engage_demos_label">Demos</span>
			</button>
			<!--end::Demos drawer toggle-->
			<!--begin::Help drawer toggle-->
			<button id="kt_help_toggle" class="engage-help-toggle btn engage-btn shadow-sm px-5 rounded-top-0" title="Learn & Get Inspired" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-dismiss="click" data-bs-trigger="hover">Help</button>
			<!--end::Help drawer toggle-->
		</div>

		--}}

		<!--end::Engage toolbar-->
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
			<span class="svg-icon">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
				</svg>
			</span>
			<!--end::Svg Icon-->
		</div>
		<!--end::Scrolltop-->
		<!--begin::Modals-->
		<!--begin::Modal - Upgrade plan-->
		

		<div class="modal fade" tabindex="-1" id="edit_doc_modal">
		    <div class="modal-dialog">
				<form id="doc_form">

			        <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title">Update Document</h3>

			                <!--begin::Close-->
			                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			                    <span class="svg-icon svg-icon-1"></span>
			                </div>
			                <!--end::Close-->
			            </div>

			            <div class="modal-body">


							<div class="mb-10">
								<label class="form-label">Expiry</label>
								<input type="date" class="form-control" placeholder="" readonly value="" id="replace_expire_at" name="replace_expire_at" />
							</div>

				            <div class="dropzone dropzone-queue mb-2" id="replace_doc">
				                <!--begin::Controls-->
                                <input type="hidden" style="width:1000px;" id="replace_doc_path" name="replace_doc_path" value="">
                                <input type="hidden" style="width:1000px;" id="doc_id" name="doc_id">

				                <div class="dropzone-panel mb-lg-0 mb-2">
				                    <a class="dropzone-select btn btn-sm btn-primary me-2">Attach files</a>
				                    <a class="dropzone-remove-all btn btn-sm btn-light-primary">Remove All</a>
				                </div>
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


			            </div>

			            <div class="modal-footer">
			                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Close</button>

							<button type="submit" id="doc_form-btn" class="btn btn-sm fw-bold btn-primary">
								<span class="indicator-label">Save</span>
								<span class="indicator-progress">Please wait...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>

			            </div>
			        </div>
			    </form>
		    </div>
		</div>




		<div class="modal fade" tabindex="-1" id="document_upload">
			<form id="doc_add_form">
			    <div class="modal-dialog modal-lg">
			        <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title">Upload Document</h3>

			                <!--begin::Close-->
			                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			                    <span class="svg-icon svg-icon-1"></span>
			                </div>
			                <!--end::Close-->
			            </div>

			            <div class="modal-body">


			            	<div class="row">
			            		<div class="col-xl-4">
									<div class="mb-10 fv-plugins-icon-container">
										<label class="required fs-5 fw-semibold mb-2">Select Category</label>
										<select onchange="getDocClasses(this);" name="cat_id[]" class="form-select" data-control="select2" data-placeholder="Select an option">
											<option value="">Select Category</option>
											@if(!empty($categories))
												@foreach($categories as $category)
													<option value="{{$category->id}}">{{$category->category}}</option>
												@endforeach
											@endif
										</select>
									</div>
								</div>


			            		<div class="col-xl-5">
									<div class="mb-10 fv-plugins-icon-container">
										<label class="required fs-5 fw-semibold mb-2">Select Certification</label>
										<select name="doc_class[]" class="form-select" data-control="select2" data-placeholder="Select Certification">
											<option value="">Select Certification</option>
										</select>
									</div>
								</div>


			            		<div class="col-xl-2">
									<div class="mb-10 fv-plugins-icon-container">
										<label class="required fs-5 fw-semibold mb-2">Expiry</label>
										<input type="text" class="form-control form-control-lg form-control-solid" style="padding: 7px;" name="expire_at[]" placeholder="">
									</div>
								</div>


			            		<div class="col-xl-1">
									<div class="mb-10 fv-plugins-icon-container">
										<label class="fs-5 fw-semibold mb-2"></label>

											<a onclick="addMoreDoc();" href="javascript:void(0);"><i class="fa-solid fa-circle-plus fs-1 text-info" style="margin-top: 42px;"></i></a>									


									</div>
								</div>



							</div>

							<div class="extended-docs">
							</div>


			            	<div class="row">
			            		<div class="col-xl-12">
									<div class="mb-10 fv-plugins-icon-container">
										<label class="required fs-5 fw-semibold mb-2">Upload</label>

							            <div class="dropzone dropzone-queue mb-2" id="docfiles">
							                <!--begin::Controls-->
			                                <input type="hidden" style="width:1000px;" id="docfiles_path" name="docfiles_path" value="">
			                                <!-- <input type="" style="width:1000px;" id="doc_id" name="doc_id"> -->

							                <div class="dropzone-panel mb-lg-0 mb-2">
							                    <a class="dropzone-select btn btn-sm btn-primary me-2">Attach files</a>
							                    <a class="dropzone-remove-all btn btn-sm btn-light-primary">Remove All</a>
							                </div>
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




									</div>
								</div>





							</div>



			            </div>

			            <div class="modal-footer">
			                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
							<button type="submit" id="doc_add_form-btn" class="btn btn-sm fw-bold btn-primary">
								<span class="indicator-label">Save Profile</span>
								<span class="indicator-progress">Please wait...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>
			            </div>
			        </div>
			    </div>
			</form>
		</div>

	@if(Auth::user()->getRoleNames()[0] != 'owner')
		<div class="modal fade" tabindex="-1" id="assign_modal">
			<form id="assign_form">
				<input type="hidden" id="assign_id" name="assign_id">
			    <div class="modal-dialog">
			        <div class="modal-content">
			            <div class="modal-header">
			                <h3 class="modal-title">Assign Project</h3>

			                <!--begin::Close-->
			                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
			                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
			                </div>
			                <!--end::Close-->
			            </div>

			            <div class="modal-body">

								<div class="row g-9 mb-8">
									<!--begin::Col-->
									<div class="col-md-12 fv-row">
										<label class="required fs-6 fw-semibold mb-2">Project</label>
										<select onchange="getProjectDates()" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select a Project" name="project_id">
											<option value="">Select Project</option>
											@foreach($projectService->getAllProjects() as $project)
	                                            <option start-date="{{date('d/m/Y', strtotime($project->start_date))}}" due-date="{{date('d/m/Y', strtotime($project->due_date))}}" value="{{$project->id}}">{{$project->name}}</option>
											@endforeach
										</select>
									</div>
									<!--end::Col-->
								</div>

								<div class="row g-9 mb-8">
									<!--begin::Col-->
									<div class="col-md-12 fv-row">
										<label class="required fs-6 fw-semibold mb-2">Skill</label>
										<select onchange="checkExpiredSkill(this);" class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select a Skill" name="assign_doc_id" id="assign_doc_id">
										</select>
									</div>
									<!--end::Col-->
								</div>

								<div class="row g-9 mb-8">
									<!--begin::Col-->
									<div class="col-md-6 fv-row">
										<label class="required fs-6 fw-semibold mb-2">Start Date</label>
										<!--begin::Input-->
										<div class="position-relative d-flex align-items-center">
											<!--begin::Icon-->
											<!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
											<span class="svg-icon svg-icon-2 position-absolute mx-4">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="currentColor" />
													<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="currentColor" />
													<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="currentColor" />
												</svg>
											</span>
											<!--end::Svg Icon-->
											<!--end::Icon-->
											<!--begin::Datepicker-->
											<input class="form-control form-control-solid ps-12" placeholder="Select a date" name="assign_start_date" />
											<!--end::Datepicker-->
										</div>
										<!--end::Input-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-6 fv-row">
										<label class="required fs-6 fw-semibold mb-2">End Date</label>
										<!--begin::Input-->
										<div class="position-relative d-flex align-items-center">
											<!--begin::Icon-->
											<!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
											<span class="svg-icon svg-icon-2 position-absolute mx-4">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="currentColor" />
													<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="currentColor" />
													<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="currentColor" />
												</svg>
											</span>
											<!--end::Svg Icon-->
											<!--end::Icon-->
											<!--begin::Datepicker-->
											<input class="form-control form-control-solid ps-12" placeholder="Select a date" name="assign_end_date" />
											<!--end::Datepicker-->
										</div>
										<!--end::Input-->
									</div>
									<!--end::Col-->
								</div>
			            </div>

			            <div class="modal-footer">
			                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
							<button type="submit" id="assign_form-btn" class="btn btn-sm fw-bold btn-primary">
								<span class="indicator-label">Save</span>
								<span class="indicator-progress">Please wait...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>
			            </div>
			        </div>
			    </div>
			</form>
		</div>


	@endif

        @include('backend.partials.permission')

        @include('backend.partials.js', ['storage_url' => $storageUrl ?? ''])
	</body>
	<!--end::Body-->
</html>