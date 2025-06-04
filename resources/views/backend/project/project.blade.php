<!--begin::Col-->
<div class="col-xxl-12">
	<!--begin::Card widget 18-->
	<div class="card card-flush h-xl-100">
		<!--begin::Body-->
		<div class="card-body py-9">
			<!--begin::Row-->
			<div class="row gx-9 h-100">
				<!--begin::Col-->
				<!--end::Col-->
				<!--begin::Col-->
				<div class="col-sm-8">
					
					<a href="{{route('update-project', $project->id)}}" style="float:right; margin-left: 10px;" class="mt-4"><i class=" fa-solid fs-3 fa-pencil"></i></a>

					<a href="{{route('project-download', $project->id)}}" style="float:right; margin-left: 10px;" class="mt-4"><i class=" fa-solid fs-3 fa-download"></i></a>

					<!--begin::Wrapper-->
					<div class="d-flex flex-column h-100">
						<!--begin::Header-->
						<div class="mb-7">
							<!--begin::Headin-->
							<div class="d-flex flex-stack">
								<!--begin::Title-->
								<div class="flex-shrink-0 me-5">
									<span class="text-gray-400 fs-7 fw-bold me-2 d-block lh-1 pb-1">Job no {{$project->job_no}}
									</span>


									<span class="text-gray-800 fs-1 fw-bold">{{$project->name}}</span>

								</div>
								<!--end::Title-->
								<span style="border-radius:0px;" class="badge badge-{{\App\Library\Utility::getProjectStatuses($project->status)}} flex-shrink-0 align-self-center py-3 px-4 fs-7">{{$project->status}}</span>



							</div>



							<!--end::Heading-->
							<!--begin::Items-->

						</div>
						<!--end::Header-->
						<!--begin::Body-->

						<div class="mb-6">
							<!--begin::Text-->
							<!--end::Text-->
							<!--begin::Stats-->

							<div class="d-flex">
								<!--begin::Stat-->
								<div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6 mb-3">
									<!--begin::Date-->
									<span class="fs-6 text-gray-700 fw-bold">{{$project->client->name ?? ''}}</span>
									<!--end::Date-->
									<!--begin::Label-->
									<div class="fw-semibold text-gray-400">Client</div>
									<!--end::Label-->
								</div>


								<div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6 mb-3">
									<!--begin::Date-->
									<span class="fs-6 text-gray-700 fw-bold">{{date('F j Y', strtotime($project->start_date))}}</span>
									<!--end::Date-->
									<!--begin::Label-->
									<div class="fw-semibold text-gray-400">Start Date</div>
									<!--end::Label-->
								</div>
								<!--end::Stat-->
								<!--begin::Stat-->
								<div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 mb-3">
									<!--begin::Number-->
									<span class="fs-6 text-gray-700 fw-bold">{{date('F j Y', strtotime($project->due_date))}}</span>
									<!--end::Number-->
									<!--begin::Label-->
									<div class="fw-semibold text-gray-400">Due Date</div>
									<!--end::Label-->
								</div>
								<!--end::Stat-->
							</div>

							@if(!empty($project->sheet_url))
								<div>
									<span class="fs-4 fw-bold text-gray-800 me-2">Project documents</span> <a href="{{$project->sheet_url}}" class="fs-4" target="_blank"><i class="fs-1 fa-solid fa-folder"></i></a>
								</div>
							@endif 


							<div>
								<span class="fs-4 fw-bold text-gray-800 me-2">Project Links</span>
							</div>

							<table class="table align-middle gs-0 gy-1 my-0">
								<!--begin::Table head-->
								<thead>
									<tr class="fs-7 fw-bold text-gray-500">
										<th class="p-0 w-50px d-block pt-3">Title</th>
										<th class="w-140px pt-3">Link</th>
									</tr>
								</thead>
								<!--end::Table head-->
								<!--begin::Table body-->
								<tbody>
									@foreach($project->links as $link)
									<tr>
										<td>
											{{$link->title}}
										</td>
										<td class="">
											<a target="_blank" href="{{$link->link}}"><i class="fa-solid fa-arrow-up-right-from-square"></i> {{substr($link->link, 0, 50)}}...</a>
										</td>
									</tr>
									@endforeach
								</tbody>
								<!--end::Table body-->
							</table>




														
														
							@if(!empty($project->brief))
								<h4 class="text-gray-800" style="margin-top:10px;">Description</h1>
								<span class="fw-semibold text-gray-600 fs-6 mb-8 d-block">{{$project->brief}}</span>
							@endif

							<!--end::Stats-->
						</div>
						<!--end::Body-->
						<!--begin::Footer-->

						<!--end::Footer-->
					</div>
					<!--end::Wrapper-->
				</div>

				<div class="col-sm-4">
					<div class="card mb-5 mb-xl-8">
						<!--begin::Card body-->
						<div class="card-body pt-0 py-0">
							<!--begin::Summary-->
							<!--end::Summary-->
							<!--begin::Details toggle-->
							<div class="d-flex flex-stack fs-4 ">
								<div class="fw-bold rotate " href="#kt_customer_view_details" role="button" aria-expanded="true" aria-controls="kt_customer_view_details">Site</div>
							</div>
							<!--end::Details toggle-->
							<div class="separator separator-dashed my-3"></div>
							<!--begin::Details content-->
							<div id="kt_customer_view_details" class="collapse show" style="">
								<div class="py-5 fs-6">
									<!--begin::Details item-->
									<div class="fw-bold ">Site</div>
									<div class="text-gray-600">{{$project->site->site}}</div>
									<!--begin::Details item-->
									<!--begin::Details item-->
									<div class="fw-bold mt-5">Address</div>
									<div class="text-gray-600">
										{{$project->site->address}}, 
										{{$project->site->postcode}}
									</div>
									<!--begin::Details item-->
									<!--begin::Details item-->
									<div class="fw-bold mt-5">3Words</div>
									<div class="text-gray-600">								{{$project->site->location}}</div>
									<!--begin::Details item-->
								</div>
							</div>
							<!--end::Details content-->
						</div>
						<!--end::Card body-->
					</div>
				</div>
				<!--end::Col-->
			</div>
			<!--end::Row-->
		</div>
						<?php
							$active = [];
							$inactive = [];
							$futureJobs = [];
						  	foreach($project->assignments as $assignment)
						  	{
						  		if($assignment->start_date <= date('Y-m-d') && $assignment->end_date >= date('Y-m-d'))
						  		{
						  			$active[] = $assignment;
						  		}
								else if($assignment->end_date < date('Y-m-d'))
								{
						  			$inactive[] = $assignment;
								}
								else if($assignment->start_date > date('Y-m-d'))
								{
						  			$futureJobs[] = $assignment;
								}
						  	}


					  	?>


		<div class="card-body py-9">
			<!--begin::Row-->
			<div class="row gx-9">
				<!--begin::Col-->
				<!--end::Col-->
				<!--begin::Col-->
				<div class="col-sm-7">
				  	@if(!empty($active))
							<!--begin::Wrapper-->
							<div class="d-flex flex-column">
								<!--begin::Header-->

								<div class="table-responsive project-subops">
								<h3>Active</h1>
								 <table class="table">
								   <thead>
								   <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
								    <th width="30%">People</th>
								    <th>Certification</th>
								    <th width="30%">Start - End</th>
								   </tr>
								  </thead>
								  <tbody>
								  	@foreach($active as $assignment)
								  		@if($assignment->start_date <= date('Y-m-d') && $assignment->end_date >= date('Y-m-d'))
										   <tr>
											    <td><a target="_blank" href="{{route('edit-people', $assignment->people_id)}}">{{$assignment->people->first_name}} {{$assignment->people->last_name}}</a></td>

											    <td>
											    	@if(!empty($assignment->doc))
												    	{{$assignment->doc->skill->certification}}
												    @endif
											    </td>
													<td  style="font-size: 12px;">
											    	@if(!empty($assignment->doc))														
														<span style="width:20px; height: 20px;" class="status-{{$assignment->doc->status}}"></span> {{date('d/m/Y', strtotime($assignment->start_date))}} - {{date('d/m/Y', strtotime($assignment->end_date))}}
													@endif
											 </td>
											 </tr>
									   @endif
									@endforeach
								  </tbody>
								 </table>
								</div>

								<!--end::Body-->
								<!--begin::Footer-->

								<!--end::Footer-->
							</div>
							<!--end::Wrapper-->
					@endif
					@if(!empty($futureJobs))
						
							<!--begin::Wrapper-->
							<div class="d-flex flex-column">
								<!--begin::Header-->

								<div class="table-responsive project-subops">
								<h3>Future Jobs</h1>
								 <table class="table">
								   <thead>
								   <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
								    <th width="30%">People</th>
								    <th>Certification</th>
								    <th width="30%">Start - End</th>
								   </tr>
								  </thead>
								  <tbody>
								  	@foreach($futureJobs as $assignment)
								  		@if($assignment->start_date > date('Y-m-d'))
										   <tr>
											    <td><a target="_blank" href="{{route('edit-people', $assignment->people_id)}}">{{$assignment->people->first_name}} {{$assignment->people->last_name}}</a></td>
											    
											    <td>
													@if(!empty($assignment->doc))
											    		{{$assignment->doc->skill->certification}}
											    	@endif
											    </td>
											    <td style="font-size: 12px;">
										    	@if(!empty($assignment->doc))														

											    	<span style="width:20px; height: 20px;" class="status-{{$assignment->doc->status}}"></span> {{date('d/m/Y', strtotime($assignment->start_date))}} - 
											     {{date('d/m/Y', strtotime($assignment->end_date))}}
											     @endif
											 </td>
										   </tr>
									   @endif
									@endforeach
								  </tbody>
								 </table>
								</div>

								<!--end::Body-->
								<!--begin::Footer-->

								<!--end::Footer-->
							</div>
							<!--end::Wrapper-->
						
					@endif

					@if(!empty($inactive))
						
							<!--begin::Wrapper-->
							<div class="d-flex flex-column">
								<!--begin::Header-->

								<div class="table-responsive project-subops">
								<h3>History</h1>
								 <table class="table">
								   <thead>
								   <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
								    <th width="30%">People</th>
								    <th>Certification</th>
								    <th width="30%">Start - End</th>
								   </tr>
								  </thead>
								  <tbody>
								  	@foreach($inactive as $assignment)
								  		@if($assignment->end_date < date('Y-m-d'))
										   <tr>
											    <td><a target="_blank" href="{{route('edit-people', $assignment->people_id)}}">{{$assignment->people->first_name}} {{$assignment->people->last_name}}</a></td>
											    
											    <td>
													@if(!empty($assignment->doc))
											    		{{$assignment->doc->skill->certification}}
											    	@endif
											    </td>
											    <td style="font-size: 12px;">
										    	@if(!empty($assignment->doc))														

											    	<span style="width:20px; height: 20px;" class="status-{{$assignment->doc->status}}"></span> {{date('d/m/Y', strtotime($assignment->start_date))}} - 
											     {{date('d/m/Y', strtotime($assignment->end_date))}}
											     @endif
											 </td>
										   </tr>
									   @endif
									@endforeach
								  </tbody>
								 </table>
								</div>

								<!--end::Body-->
								<!--begin::Footer-->

								<!--end::Footer-->
							</div>
							<!--end::Wrapper-->
						
					@endif


				</div>




				<div class="col-sm-5">

					<div class="card mb-5 mb-xl-8">
						<!--begin::Card body-->
						<div class="card-body pt-0 py-0" style="padding-left:0px;">
							<!--begin::Summary-->
							<!--end::Summary-->
							<!--begin::Details toggle-->
							<div class="d-flex flex-stack fs-4 ">
								<div class="fw-bold rotate " href="#kt_customer_view_details" role="button" aria-expanded="true" aria-controls="kt_customer_view_details">Subcontractors <a href="{{route('subop-download', $project->id)}}"><i class="fa-solid fa-download" style="margin-left: 10px;"></i></a></div>

							</div>
							<!--end::Details toggle-->
							<div class="separator separator-dashed my-3"></div>
							<!--begin::Details content-->
						

								<div class="accordion" id="kt_accordion_1">
									@foreach($subcontractors as $subKey => $subcontractor)
										@if(!empty($subcontractor))
										    <div class="accordion-item">
										        <h2 class="accordion-header" id="kt_accordion_1_header_2{{$subKey}}">
										            <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_2{{$subKey}}" aria-expanded="false" aria-controls="kt_accordion_1_body_2">
										            {{$subcontractor->name}}
										            </button>
										        </h2>
										        <div id="kt_accordion_1_body_2{{$subKey}}" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_2{{$subKey}}" data-bs-parent="#kt_accordion_1">
										        	@foreach($subcontractor->teams as $team)
										        		@if($team->tasks->count() > 0)
															<div class="card card-flush h-lg-100">
																<div class="card-header mt-1" style="min-height: 30px;">
																	<div class="card-title">
																		<h3 class="fw-bold mb-1">{{$team->team}}</h3>
																	</div>
																</div>
																@foreach($team->tasks as $task)

																	<div class="card-body d-flex flex-column p-1 pt-3">
																		<div class="d-flex align-items-center position-relative">
																			<div class="position-absolute top-0 start-0 rounded h-100 bg-primary w-4px"></div>
																			<div class="form-check form-check-custom form-check-solid ms-6 me-4">
																			</div>
																			<div class="fw-semibold">
																				<div class="fs-5">
																					<span class="fs-7 text-gray-600 text-uppercase">{{date('d M Y', strtotime($task->start_date))}} - {{date('d M Y', strtotime($task->end_date))}}</span>
																				</div>
																				<a href="javascript:void(0);" class="fs-6 fw-bold text-gray-900 text-hover-primary">{{$task->task}}</a>
																				@if($task->suboperatives->count())
																					<table class="table align-middle fs-6 gy-5 mb-0">
																						<thead style="background-color: #fff7f7;">
																							<th style="text-align: center;" colspan="2">Task Suboperatives</th>
																						</thead>
																						<tbody class="fw-semibold text-gray-600">	
																							@foreach($task->suboperatives as $suboperative)
																								<tr>
																									<td style="width:150px">
																										<div class="fs-7 text-gray-800"><a href="{{route('update-suboperative', $suboperative->suboperative->id)}}">{{$suboperative->suboperative->first_name}} {{$suboperative->suboperative->last_name}}</a></div>
																									</td>
																									<td style="width:250px">
																										<span class="bullet bullet-dot status-{{$suboperative->document->status}} h-10px w-10px"></span>

																										<span class="fs-7 text-gray-800">{{$suboperative->document->skill->certification}}</span>
																									</td>
																								</tr>
																							@endforeach
																						</tbody>
																					</table>
																				@endif
																			</div>
																		</div>
																	</div>
																	<div class="separator separator-dashed my-3"></div>
																@endforeach
																<!--end::Card body-->
															</div>
														@endif
										        	@endforeach
										        	
										        </div>
										    </div>
									    @endif
									   @endforeach
								</div>



							<!--end::Details content-->
						</div>
						<!--end::Card body-->
					</div>

				</div>


				<!--end::Col-->
			</div>

			<!--end::Row-->
		</div>





		<!--end::Body-->
	</div>
	<!--end::Card widget 18-->
</div>
<!--end::Col-->
<!--begin::Col-->
<!--end::Col-->
