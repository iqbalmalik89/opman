<?php
$projectStatuses = \App\Library\Utility::getProjectStatuses();
?>


	<table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
		<!--begin::Table head-->
		<thead>
			<!--begin::Table row-->
			<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
				<th class=""></th>
				<th class="min-w-70px">Job No</th>
				<th class=" pe-3 min-w-100px">Project Name</th>
				<th class=" pe-3 min-w-70px">Start Date</th>
				<th class=" pe-3 min-w-70px">Due Date</th>
				<th class=" pe-3 min-w-80px">Folder</th>
				<th class=" pe-0 min-w-25px">Actions</th>
			</tr>
			<!--end::Table row-->
		</thead>
		<!--end::Table head-->
		<!--begin::Table body-->
		<tbody class="fw-bold text-gray-600">


@foreach($allprojects as $projectStatus => $projects)
	@if(!empty($projects))
	<!-- <span style="border-radius: 0px; margin-top: 20px;" class="badge py-3 px-4 fs-7 badge-{{\App\Library\Utility::getProjectStatuses($projectStatus)}}">{{$projectStatus}}</span> -->

			@foreach($projects as $project)
				<tr>
					<td>


							<button  class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="right-end" data-kt-menu-overflow="true">
								<!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
								<span class="svg-icon svg-icon-1 svg-icon-gray-300 me-n1">
									<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
									</svg>
								</span>

								<!--end::Svg Icon-->
							</button>

								<span style="border-radius: 0px; margin-left:10px; margin-top: 20px;" class="badge  badge-{{\App\Library\Utility::getProjectStatuses($projectStatus)}}">{{$projectStatus}}</span>



							<!--begin::Menu 2-->
							<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
								<!--begin::Menu item-->
								@foreach($projectStatuses as $statusKey => $status)
									<div class="menu-item px-3">
										<a href="javascript:void(0);" onclick="statusChange({{$project->id}}, '{{$statusKey}}');" class="menu-link px-3 @if($statusKey == $project->status) active @endif">{{$statusKey}}</a>
									</div>
								@endforeach
								<!--end::Menu item-->
								<!--begin::Menu item-->
								<!--end::Menu item-->
							</div>

						</td>
					<td>  
						<a onclick="viewProject({{$project->id}});" href="javascript:void(0);" class="text-dark text-hover-primary">{{$project->job_no}}</a>
					</td>
					<td>{{$project->name}}</td>
					<td>{{date('d/m/Y', strtotime($project->start_date))}}</td>
					<td>{{date('d/m/Y', strtotime($project->due_date))}}</td>
					<td><a href="{{$project->sheet_url}}" target="_blank"><i class="fa-solid fs-1 fa-folder text-warning"></i></a></td>

					<td>
							<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
							<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
							<span class="svg-icon svg-icon-5 m-0">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
								</svg>
							</span>
							<!--end::Svg Icon--></a>
							<!--begin::Menu-->
							<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true" style="">
								<!--begin::Menu item-->
							@if(Auth::user()->hasPermissionTo('view projects'))
								<div class="menu-item px-3">
									<a onclick="viewProject({{$project->id}});" href="javascript:void(0);" class="menu-link px-3">View</a>
								</div>
							@endif
							@if(Auth::user()->hasPermissionTo('update project'))

								<div class="menu-item px-3">
									<a href="{{route('update-project', $project->id)}}" class="menu-link px-3">Edit</a>
								</div>
							@endif
								<!--end::Menu item-->
								<!--begin::Menu item-->
							@if(Auth::user()->hasPermissionTo('add project'))
								<div class="menu-item px-3">
									<a href="javascript:void(0);" onclick="deleteProject({{$project->id}})" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Delete</a>
								</div>
							@endif
								<!--end::Menu item-->
							</div>
							<!--end::Menu-->

						
					</td>
				</tr>

			@endforeach


	@endif
@endforeach

		</tbody>
		<!--end::Table body-->
	</table>
