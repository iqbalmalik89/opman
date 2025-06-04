	<div class="col-xl-12 pt-5 mb-5 mb-xl-12">
		<div style="margin-bottom: 10px;" class="card card-flush h-xl-100">
			<div class="card-body pt-2" style="padding: 0rem 2.25rem;">

				<div class="table-responsive">

					<table class="table manage-team-table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
						<!--begin::Thead-->
						<thead class="border-gray-200 fs-5 fw-semibold bg-lighten">
							<tr>
								<th class="min-w-150px">Team</th>
								<th class="min-w-150px">Project</th>
								<th class="min-w-300px">Task</th>
								<th class="min-w-100px">Start/End</th>
								<th class="min-w-100px">Operatives</th>
								<th class="min-w-100px text-end">Action</th>

							</tr>
						</thead>
						<!--end::Thead-->
						<!--begin::Tbody-->
						<tbody class="fw-6 fw-semibold text-gray-600">
							@foreach($teams as $team)
								@php
									$status = "Active";
									if($team->suboperatives->count())
									{
										foreach($team->suboperatives as $suboperative)
										{
											if(!empty($suboperative->document))
											{
												if($suboperative->document->status == 'Critical')
													$status = 'Critical';	
												else if($suboperative->document->status == 'Expiring')
													$status = 'Expiring';
											}
										}
									}

									$range = '';
									if(!empty($team->start_date))
									{
										$range = date('d/m/Y', strtotime($team->start_date));
									}

									if(!empty($team->end_date))
									{	
										if(!empty($range))
											$range .= ' - ';
										$range = $range . date('d/m/Y', strtotime($team->end_date));
									}


								@endphp
								<tr id="team-{{$team->id}}">
									<td>
										<a href="javascript:void(0);" class="text-hover-primary text-gray-600">{{$team->team}}</a>
									</td>
									<td>
										<select id="project-{{$team->id}}" class="form-select form-select-sm form-select-solid project" data-control="select2">
											<option value="0">Select Project</option>
											@foreach($projects as $project)
												<option @if(!empty($team->project_id) && $team->project_id == $project->id) selected @endif jobno="{{$project->job_no}}" value="{{$project->id}}">{{$project->job_no}} - {{$project->name}}</option>
											@endforeach
										</select>
									</td>
									<td>
										<input id="task-{{$team->id}}" style="padding:3px 3px 3px 3px; margin-left:5px;" type="text" value="{{$team->task}}" class="form-control">
									</td>

									<td>
										<input id="timeline-{{$team->id}}" type="text" class="range-picker form-control" style="padding:3px 3px 3px 3px; margin-left:5px; width: 190px;" value="{{$range}}">
									</td>

									<td style="padding-left:20px;"> 
										@if($team->suboperatives->count())
										<span style="width:20px; height: 20px; color:white; text-align: center;" class="status-{{$status}}">{{$team->suboperatives->count()}}</span>
										@endif
									</td>
									<td class="text-end">
										<i style="cursor: pointer; margin-right: 4px;" title="Save" onclick="updateTeam({{$team->id}})" class="fa-regular fa-floppy-disk fs-2 text-dark" title="Update"></i>
										<a style="margin-right: 4px;" href="{{route('subcontractor-search')}}?subcontractor_id={{$team->subcontractor_id}}"><i class="fas fa-pencil fs-4 text-dark" title="Edit"></i></a>
										<i onclick="deleteSubOperatives({{$team->id}})" class="fs-4 me-3 fas  text-danger fa-trash" title="Clear"></i>


									</td>
								</tr>
							@endforeach
						</tbody>
						<!--end::Tbody-->
					</table>

				</div>
			</div>
		</div>
	</div>







