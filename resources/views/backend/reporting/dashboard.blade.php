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
				<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Dashboard</h1>
			</div>
			<!--end::Page title-->
			<!--begin::Actions-->
<!-- 			<div class="d-flex align-items-center gap-2 gap-lg-3">
				<div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left" class="btn btn-sm fw-bold bg-body btn-color-gray-700 btn-active-color-primary d-flex align-items-center px-4" data-kt-initialized="1">
					<div class="text-gray-600 fw-bold">28 Nov 2022 - 27 Dec 2022</div>
					<span class="svg-icon svg-icon-1 ms-2 me-0">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="currentColor"></path>
							<path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="currentColor"></path>
							<path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="currentColor"></path>
						</svg>
					</span>
				</div>
				<a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target">Add Target</a>
			</div> -->
		</div>
		<!--end::Toolbar container-->
	</div>
	<!--end::Toolbar-->
	<!--begin::Content-->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!--begin::Content container-->
		<div id="kt_app_content_container" class="app-container container-xxl">
			<!--begin::Row-->
			
			
			<div class="row gx-5 gx-xl-10">
				<!--begin::Col-->
<!-- 				<div class="col-xl-1 ">
				</div> -->

				<div class="col-xl-2 ">
					<div class="card card-flush flex-row-fluid  mw-100">
						<!--begin::Body-->
						<div class="card-body" style="padding: 5px; ">
							<!--begin::Food img-->

							<label class="form-label">People</label>

							<canvas id="people_chart" style="width:100%;max-width:400px;max-height:400px"></canvas>


							<!--end::Food img-->
							<!--begin::Info-->
							<!--end::Info-->
						</div>
						<!--end::Body-->
					</div>
				</div>	

<!--  				<div class="col-xl-2 ">
					<div class="card card-flush flex-row-fluid  mw-100">
						<div class="card-body" style="padding: 5px; ">
							<label class="form-label">Suboperatives</label>
							<canvas id="suboperative_chart" style="width:100%;max-width:400px;max-height:400px"></canvas>
						</div>
					</div>
				</div>	
 -->

				<div class="col-xl-2 ">
					<div class="card card-flush flex-row-fluid  mw-100">
						<!--begin::Body-->
						<div class="card-body" style="padding: 5px; ">
							<!--begin::Food img-->

							<label class="form-label">Competencies</label>

							<canvas id="skills_chart" style="width:100%;max-width:400px;max-height:400px"></canvas>


							<!--end::Food img-->
							<!--begin::Info-->
							<!--end::Info-->
						</div>
						<!--end::Body-->
					</div>
				</div>	

				<div class="col-xl-2 ">
					<div class="card card-flush flex-row-fluid  mw-100">
						<!--begin::Body-->
						<div class="card-body" style="padding: 5px; ">
							<!--begin::Food img-->

							<label class="form-label">Expired</label>

							<canvas id="expired_skills_chart" style="width:100%;max-width:400px;max-height:400px"></canvas>


							<!--end::Food img-->
							<!--begin::Info-->
							<!--end::Info-->
						</div>
						<!--end::Body-->
					</div>
				</div>	

				<div class="col-xl-2 ">
					<div class="card card-flush flex-row-fluid  mw-100">
						<!--begin::Body-->
						<div class="card-body" style="padding: 5px; ">
							<!--begin::Food img-->

							<label class="form-label">Training</label>

							<canvas id="training_chart" style="width:100%;max-width:400px;max-height:400px"></canvas>


							<!--end::Food img-->
							<!--begin::Info-->
							<!--end::Info-->
						</div>
						<!--end::Body-->
					</div>
				</div>	

				<div class="col-xl-2 ">
					<div class="card card-flush flex-row-fluid  mw-100">
						<!--begin::Body-->
						<div class="card-body" style="padding: 5px; ">
							<!--begin::Food img-->

							<label class="form-label">Projects</label>

							<canvas id="project_chart" style="width:100%;max-width:400px;max-height:400px"></canvas>


							<!--end::Food img-->
							<!--begin::Info-->
							<!--end::Info-->
						</div>
						<!--end::Body-->
					</div>
				</div>	

				<div class="col-xl-2 ">
					<div class="card card-flush flex-row-fluid  mw-100">
						<!--begin::Body-->
						<div class="card-body" style="padding: 5px; ">
							<!--begin::Food img-->

							<label class="form-label">Subcontractors</label>

							<canvas id="subcontractor_chart" style="width:100%;max-width:400px;max-height:400px"></canvas>


							<!--end::Food img-->
							<!--begin::Info-->
							<!--end::Info-->
						</div>
						<!--end::Body-->
					</div>
				</div>	

			@if(Auth::user()->hasPermissionTo('site search'))
			<!-- 	<div class="col-xl-2 ">
					<div class="card card-flush flex-row-fluid  mw-100">
						<div class="card-body" style="text-align: left;">
							<img src="{{global_asset('assets/media/site/sites.png')}}" class="rounded-3 mb-4 w-100px h-100px w-xxl-100px h-xxl-100px" alt="">
							<div class="mb-2">
								<div class="text-center">
									<span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-7 ">Manage Sites</span>
								</div>
							</div>
						</div>
					</div>
				</div>	 -->
			@endif

		


			<?php /*
				<div class="col-xl-2 ">
					<div class="card card-flush flex-row-fluid  mw-100">
						<!--begin::Body-->
						<div class="card-body"  style="text-align: left;">
							<!--begin::Food img-->
							<img src="{{global_asset('assets/media/site/vehicle icon.png')}}" class="rounded-3 mb-4 w-100px h-100px w-xxl-100px h-xxl-100px" alt="">
							<!--end::Food img-->
							<!--begin::Info-->
							<div class="mb-2">
								<!--begin::Title-->
								<div class="text-center">
									<span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-7 ">Vehicles</span>
								</div>
								<!--end::Title-->
							</div>
							<!--end::Info-->
						</div>
						<!--end::Body-->
					</div>
				</div>	
			*/ ?>

			</div>			
			
			<br>
			
			<!--end::Row-->
			<!--begin::Row-->
			<div class="row gx-5 gx-xl-10">

				<div class="col-xl-4 mb-5 mb-xl-0">
					<!--begin::List widget 12-->
					<div class="card card-flush h-xl-50">
						<!--begin::Header-->
						<div class="card-header pt-7">
							<!--begin::Title-->
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bold text-gray-800">Holidays</span>
							</h3>
							<!--end::Title-->
						</div>
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body scroll h-100px px-5" style="">
							<!--begin::Wrapper-->

							@foreach($holidays as $holiday)
								@if(!empty($holiday->people) && !in_array($holiday->people->status, ['Deactivated', 'Banned']))
									@if($holiday->to < date('Y-m-d'))
										@continue;
									@endif
		 							<div class="w-70">
										<div class="d-flex align-items-center">
											<div class="d-flex align-items-center flex-stack flex-wrap d-grid gap-1 flex-row-fluid">
												<div class="me-5">
													<a href="{{route('edit-people', $holiday->people->id)}}" class="text-gray-800 fw-bold text-hover-primary fs-7">{{$holiday->people->first_name}} {{$holiday->people->last_name}}</a>
												</div>
												<div class="d-flex align-items-center">
													<span class="text-gray-800  fs-7 me-3">
													{{date('d/m/Y', strtotime($holiday->from))}}
													@if($holiday->from != $holiday->to)
														{{' - '.date('d/m/Y', strtotime($holiday->to))}}
													@endif
													</span>
												</div>
											</div>
										</div>
										<div class="separator separator-dashed my-3"></div>
									</div> 

								@endif
							@endforeach
							<!--end::Wrapper-->
						</div>
						<!--end::Body-->
					</div>
					<br>
					<div class="card card-flush h-xl-50">
						<!--begin::Header-->
						<div class="pt-1 mt-5 mx-5">
							<!--begin::Title-->
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bold text-gray-800">Training</span>
							</h3>
							<!--end::Title-->
						</div>
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body scroll h-100px px-5" style="">
							<!--begin::Wrapper-->
							<table class="table">
								<tr class="fw-bold fs-7 text-gray-800">
									<td>Name</td>
									<td>Comp</td>
									<td>Date</td>
								</tr>
								<tbody>
									@foreach($trainings as $training)
										<tr class="fs-8">
											<td>
												@if(!empty($training->people))
													<a href="{{route('edit-people', $training->people_id)}}" class="text-gray-800 fw-bold text-hover-primary fs-7">{{$training->people->first_name}} {{$training->people->last_name}}</a>
												@endif
											</td>
											<td>
												@if(!empty($training->skill))
													{{$training->skill->certification}}
												@endif
											</td>
											<td>{{date('d/m/Y', strtotime($training->course_date))}}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							<!--end::Wrapper-->
						</div>
						<!--end::Body-->
					</div>

					<!--end::List widget 12-->
				</div>

				<div class="col-xl-8 mb-5 mb-xl-0">
					<!--begin::List widget 12-->
					<div class="card card-flush h-xl-100">
						<!--begin::Header-->
						<div class="card-header pt-7">
							<!--begin::Title-->
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bold text-gray-800">People Alerts</span>
							</h3>
							<!--end::Title-->
						</div>
						<!--end::Header-->
						<!-- d-flex align-items-end -->
						<div class="card-body scroll h-500px px-5" style="padding-top: 1px !important;">

							<div class="table-responsive">
							 <table class="table">
							   <thead >
							   <tr class="fw-bold fs-6 text-gray-800" style="background-color: #eaf7ff;">
							    <th></th>
							    <th>People</th>
							    <th>Project</th>
							    <th>Competency</th>
							    <th>Expiry</th>
							   </tr>
							  </thead>
							  <tbody>
								@foreach($documents as $document)						         
									@if(!empty($document->people) && !in_array($document->people->status, ['Deactivated', 'Banned']))

									   <tr>
									    <td width="10px"><span style="width:20px; height: 20px;" class="status-{{$document->status}}@if(!empty($document->training())){{'Training'}}@endif"></span></td>
									    <td><a href="{{route('edit-people', $document->people->id)}}">{{$document->people->first_name}} {{$document->people->last_name}}</a></td>
									    <td>
									    	@php
												$project = $document->project($document->people->id);
									    	@endphp

									    	@if(!empty($project))
										    	<a href="{{route('projects')}}?project_id={{$project->id}}">
										    	{{$project->job_no}}
											    </a>
											@endif
									    </td>
									    <td>{{$document->skill->certification ?? ''}}</td>
									    <td>{{date('d/m/Y', strtotime($document->expire_at))}}</td>
									   </tr>
									@endif
								@endforeach
							  </tbody>
							 </table>
							</div>


						</div>
						<!--end::Body-->
					</div>
					<!--end::List widget 12-->
				</div>


			</div>


			<div class="row gx-5 gx-xl-10 mt-10">

				<div class="col-xl-4 mb-5 mb-xl-0">
				</div>

				<div class="col-xl-8 mb-5 mb-xl-0">
					<!--begin::List widget 12-->
					<div class="card card-flush h-xl-100">
						<!--begin::Header-->
						<div class="card-header pt-7">
							<!--begin::Title-->
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bold text-gray-800">Suboperative Alerts</span>
							</h3>
							<!--end::Title-->
						</div>
						<!--end::Header-->
						<!-- d-flex align-items-end -->
						<div class="card-body scroll h-500px px-5" style="padding-top: 1px !important;">

							<div class="table-responsive">
							 <table class="table">
							   <thead >
							   <tr class="fw-bold fs-6 text-gray-800" style="background-color: #eaf7ff;">
							    <th></th>
							    <th>Suboperative</th>
							    <th>Competency</th>
							    <th>Expiry</th>
							   </tr>
							  </thead>
							  <tbody>

								@foreach($subop_documents as $document)						         
									@if(!empty($document->suboperative))
									   <tr>
									    <td width="10px"><span style="width:20px; height: 20px;" class="status-{{$document->status}}"></span></td>
									    <td><a href="{{route('update-suboperative', $document->suboperative->id)}}">{{$document->suboperative->first_name}} {{$document->suboperative->last_name}}</a></td>
									    <td>{{$document->document->skill->certification}}</td>
									    <td>{{date('d/m/Y', strtotime($document->document->expire_at))}}</td>
									   </tr>
									@endif
								@endforeach
							  </tbody>
							 </table>
							</div>


						</div>
						<!--end::Body-->
					</div>
					<!--end::List widget 12-->
				</div>


			</div>



			<!--end::Row-->
		</div>
		<!--end::Content container-->
	</div>
	<!--end::Content-->
</div>

@endsection
