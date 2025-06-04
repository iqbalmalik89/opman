@extends('backend.layouts.auth')
@section('title', App\Library\ModuleConfig::getAction($data) .' '.App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name'])
@section('content')

<form id="suboperative_form">


<div class="d-flex flex-column flex-column-fluid">
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


			<form action="#">
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

										<div class="col-lg-4">
											<!--begin::Label-->
											<label class="fs-6 form-label fw-bold text-dark">
												<span>Subcontractors</span>
											</label>
											<!--end::Label-->
											<!--begin::Input-->

	                                        <select onchange="getTeams(this.value);" class="form-select" data-control="select2" data-placeholder="Select Subcontractor" id="subcontractor_id" name="subcontractor_id" style="padding:0px;">
	                                            <option value="">Select Subcontractor</option>
	                                            @if(!empty($subcontractors))
		                                            @foreach($subcontractors as $code => $subcontractor)
		                                                <option @if(!empty($data['subcontractor_id']) && $data['subcontractor_id'] == $subcontractor->id) selected @endif value="{{$subcontractor->id}}">{{$subcontractor->name}}</option>
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
			</form>


			<!--begin::Basic info-->


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
