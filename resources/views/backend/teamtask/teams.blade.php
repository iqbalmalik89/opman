@extends('backend.layouts.auth')
@section('title', App\Library\ModuleConfig::getAction($data) .' '.App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name'])
@section('content')

<!-- <form id="suboperative_form"> -->


<div class="d-flex flex-column flex-column-fluid module" data-module="{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}">
	<!--begin::Toolbar-->
	<div id="kt_app_toolbar" class="app-toolbar py- py-lg-2" >
		<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
			<div style="margin-top:10px; margin-bottom: 10px;" class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
				<h1  class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
					Sub-Teams Search
				</h1>
			</div>


		</div>
	</div>


	
	<!--end::Toolbar-->
	<!--begin::Content-->
	<div id="kt_app_content" class="app-content flex-column-fluid">





		<!--begin::Content container-->
		<div id="kt_app_content_container" class="app-container container-xxl">


			<!-- <form action="#"> -->
				<!--begin::Card-->
				<div class="card mb-7">
					<!--begin::Card body-->
					<div class="card-body">
						<!--begin::Compact form-->
						<!--end::Compact form-->
						<!--begin::Advance form-->
						<div class="collapse show" id="kt_advanced_search_form">
							<!--begin::Separator-->
							<!--end::Separator-->
							<!--begin::Row-->
							<!--begin::Row-->
							<div class="row g-8">
								<!--begin::Col-->
								<div class="col-xxl-12">
									<!--begin::Row-->
									<div class="row g-8">

										<div class="col-lg-4 manage-subcontractor">
											<!--begin::Label-->
											<label class="fs-6 form-label fw-bold text-dark">
												<span>Subcontractors</span>
											</label>
											<!--end::Label-->
											<!--begin::Input-->

	                                        <select onchange="subcontractorTeams(this.value);" class="form-select" data-control="select2" data-placeholder="Select Subcontractor" id="subcontractor_id" name="subcontractor_id" style="padding:0px;">
	                                            <option value="">Select Subcontractor</option>
	                                            @if(!empty($subcontractors))
		                                            @foreach($subcontractors as $code => $subcontractor)
		                                                <option @if(!empty($subcontractor_id) && $subcontractor_id == $subcontractor->id) selected @endif value="{{$subcontractor->id}}">{{$subcontractor->name}}</option>
		                                            @endforeach
		                                        @endif
	                                        </select>

											<!--end::Input-->
										</div>



										<!--end::Col-->
									</div>
									<!--end::Row-->
								</div>
								<!--end::Col-->
								<!--begin::Col-->
								<!--end::Col-->
							</div>
							<!--end::Row-->
						</div>
						<!--end::Advance form-->
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			<!-- </form> -->


			<!--begin::Basic info-->


			<div id="subcontractor_teams" class="d-none">


				<div class="row">
					<div class="col-lg-2">
						<ul class="nav nav-tabs nav-pills flex-row border-0 flex-md-column me-5 mb-3 mb-md-0 fs-6 min-w-lg-200px team-list">
						    
						</ul>
					</div>

					<div class="col-lg-10">
						<div class="tab-content" id="myTabContent">
						    <div class="tab-pane fade show active" id="team_tab" role="tabpanel">



						    	<div class="row">
						    		<div class="col-lg-12">

										<div class="card card-bordered">
										    <div class="card-header">
										        <h3 class="card-title">Team</h3>
										        <div class="card-toolbar">
										            <button onclick="getTask(0);" type="button" class="btn addtaskbtn btn-sm btn-danger">
										                Add Task
										            </button>
										        </div>
										    </div>
										    <div class="card-body">


<!-- 												<table id="task_listing" class="table align-middle table-row-dashed fs-6 gy-5">
												    <thead>
												    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
												        <th>Project</th>
												        <th>Task</th>
												        <th>Start/End</th>
												        <th>Operatives</th>
												        <th class="text-end min-w-100px">Actions</th>
												    </tr>
												    </thead>
												    <tbody class="text-gray-600 fw-semibold">
												    </tbody>
												</table>
 -->

												<table id="{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}_listing" class="table align-middle table-row-dashed fs-6 gy-5">
												    <thead>
												    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
												        <th width="20%">Project</th>
												        <th width="30%">Task</th>
												        <th width="20%">Timeline</th>
												        <th width="20%">Subops</th>
												        <th width="12%" class="text-end min-w-100px">Actions</th>
												    </tr>
												    </thead>
												    <tbody class="text-gray-600 fw-semibold">
												    </tbody>
												</table>
										    </div>
										</div>

						    		</div>
						    	</div>

						    </div>
						</div>
					</div>

				</div>








				
			</div>


			<!--end::Basic info-->
			<!--begin::Sign-in Method-->

			<!--end::Sign-in Method-->


		</div>
		<!--end::Content container-->
	</div>
	<!--end::Content-->




</div>
<!-- </form> -->


<div class="modal fade" tabindex="-1" id="task_subops">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Suboperatives</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                	<i class="fa-solid fa-xmark"></i>
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
            	<table class="table subop_listing">
            		<thead>
					    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
	            			<th>Suboperative</th>
	            			<th>Skill</th>
	            			<th>Actions</th>
 						</tr>
 	           		</thead>
            		<tbody></tbody>
            	</table>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="task_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Task</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            	<form id="{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}-form" class="form">
            		<input type="hidden" name="team_id">
		            <div class="modal-body">



		            </div>

		            <div class="modal-footer">
		                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" id="{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}-form-btn">Save Changes</button>
		            </div>

            	</form>


        </div>
    </div>
</div>

@endsection
