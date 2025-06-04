

	<div class="card card-flush h-xl-100">
		<!--begin::Body-->

		<div class=" card-body pt-5">


			<h3 class="card-title fw-bold text-gray-800 fs-2qx">{{$data->name}}</h3>

			<!-- <div class="row g-5 g-xl-10"> -->

			<div class="row">
				<div class="col-xl-4">

					<!--begin::List widget 11-->
					<div class="card card-flush h-xl-100">
						<!--begin::Header-->
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body" style="padding-left: 0px; padding-top: 0px;">
							

							<div class="" style="padding:5px; background-color: #f1faff; margin-top: 10px; border-radius: 5px; margin-bottom: 5px;">
								<div class="">
									<div class="fw-semibold pe-10 text-gray-600 fs-5">Information<a style="float: right;" href="{{route('update-subcontractor', $data->id)}}" class="badge badge-dark">Edit</a></div>
								</div>
							</div>		

							@if(!empty($data->address1))
								<div class="mb-6">
									<div class="fw-semibold text-gray-600 fs-7">Address:</div>
									<div class="fw-bold text-gray-800 fs-6">{{$data->address1}}</div>
								</div>
							@endif

							@if(!empty($data->address2))
								<div class="mb-6">
									<div class="fw-semibold text-gray-600 fs-7">Address 2:</div>
									<div class="fw-bold text-gray-800 fs-6">{{$data->address2}}</div>
								</div>
							@endif

							@if(!empty($data->postcode))
								<div class="mb-6">
									<div class="fw-semibold text-gray-600 fs-7">Postcode: <span style="float:right;" class="fw-bold text-gray-800 fs-6">{{$data->postcode}}</span></div>
								</div>
							@endif

							<div class="mb-6">
								<div class="fw-semibold text-gray-600 fs-7">Gross Status: <span class="fw-bold text-gray-800 fs-6" style="float:right;"><a href="{{url('storage/gross-status')}}/{{ltrim($data->gross_status_path, ',')}}" target="_blank">View</a></span></div>
								
							</div>

							<div class="mb-6">
								<div class="fw-semibold text-gray-600 fs-7">Status: <span style="float:right;" class="fw-bold text-gray-800 fs-6">Active</span></div>
							</div>

						</div>
						<!--end::Body-->
					</div>
					<!--end::List widget 11-->
				</div>

				<div class="col-xl-8">
					<!--begin::List widget 11-->
					<div class="card card-flush h-xl-100">
						<!--begin::Header-->
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body" style="padding-left: 0px; padding-top: 0px;">

							@if(!empty($contacts->count()))

								<div class="" style="padding:5px; background-color: #f1faff; margin-top: 10px; border-radius: 5px; margin-bottom: 5px;">
									<div class="">
										<div class="fw-semibold pe-10 text-gray-600 fs-5">Contacts</div>
									</div>
								</div>		



								<div class="">
									<div class="">
										<div class="table-responsive">
											<table class="table">
												<tr class="fw-bold fs-6 text-gray-800">
													<th>Name</th>
													<th>Email</th>
													<th>Contact</th>
													<th>Position</th>
												</tr>
												<tbody>
													@foreach($contacts as $contact)

														<tr>
															<td>{{$contact->name}}</td>
															<td>{{$contact->email}}</td>
															<td>{{$contact->mobile}}</td>
															<td>{{$contact->position}}</td>

														</tr>

													@endforeach

												</tbody>
											</table>
										</div>
									</div>
								</div>

							@endif							


						</div>
						<!--end::Body-->
					</div>
					<!--end::List widget 11-->
				</div>


			</div>

			<div class="row">

				<div class="col-xl-12">
					<table class="table">
						<thead style="padding:5px; background-color: #f1faff; margin-top: 10px; border-radius: 5px; margin-bottom: 5px;">
							<td><div class="fw-semibold pe-10 text-gray-600 fs-5">Active Suboperatives</div></td>
							<td><div class="fw-semibold pe-10 text-gray-600 fs-5">Project</div></td>
							<td><div class="fw-semibold pe-10 text-gray-600 fs-5">Team</div></td>
						</thead>

						<tbody>
								@if($data->tasks->count())
									@foreach($data->tasks as $task)
										@foreach($task->suboperatives as $suboperative)

										<tr>
												<td><a href="{{route('update-suboperative', $suboperative->suboperative->id)}}">{{$suboperative->suboperative->first_name .' '.$suboperative->suboperative->last_name}}</a></td>
												<td>{{$task->project->name}}</td>
												<td>{{$task->team->team}}</td>
										</tr>
										@endforeach									
									@endforeach
								@endif
						</tbody>
					</table>
				</div>

				<?php /*
				<div class="col-xl-5">

					<!--begin::List widget 11-->
					<div class="card card-flush h-xl-100">
						<!--begin::Header-->
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body" style="padding-left: 0px; padding-top: 0px;">
							

							<div class="" style="padding:5px; background-color: #f1faff; margin-top: 10px; border-radius: 5px; margin-bottom: 5px;">
								<div class="">
									<div class="fw-semibold pe-10 text-gray-600 fs-5">Sub-Operatives</div>
								</div>
							</div>		
							<div class="table-responsive">

								<table class="table">
									<thead>
										<tr class="fw-bold fs-6 text-gray-800">
											<th>Name</th>
											<th>Assigned</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
									@foreach($suboperatives as $suboperative)
										<tr>
											<td><a href="{{route('update-suboperative', $suboperative->id)}}">{{$suboperative->first_name}} {{$suboperative->last_name}}</a></td>
											<td>{{$suboperative->team->team ?? 'Unassigned'}}</td>
											<td><span style="width:20px; height: 20px;" class="status-{{$suboperative->document->status ?? ''}}"></span></td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>

						</div>
						<!--end::Body-->
					</div>
					<!--end::List widget 11-->
				</div>

				<div class="col-xl-7">

					<!--begin::List widget 11-->
					<div class="card card-flush h-xl-100">
						<!--begin::Header-->
						<!--end::Header-->
						<!--begin::Body-->
						<div class="card-body" style="padding-left: 0px; padding-top: 0px;">
							

							<div class="" style="padding:5px; background-color: #f1faff; margin-top: 10px; border-radius: 5px; margin-bottom: 5px;">
								<div class="">
									<div class="fw-semibold pe-10 text-gray-600 fs-5">Tasks</div>
								</div>
							</div>		
							<div class="table-responsive">

								<table class="table">
									<thead>
										<tr class="fw-bold fs-6 text-gray-800">
											<th>Teams</th>
											<th>Assigned To</th>
											<th>Task</th>
										</tr>
									</thead>
									<tbody>
									@foreach($teams as $team)
										@if(!empty($team->project))
										<tr>
											<td>{{$team->team}}</td>
											<td>{{$team->project->job_no ?? ''}} - {{$team->project->name ?? ''}}</td>
											<td>{{$team->task ?? ''}}</td>

										</tr>
										@endif
									@endforeach
									</tbody>
								</table>
							</div>

						</div>
						<!--end::Body-->
					</div>
					<!--end::List widget 11-->
				</div>
				*/ ?>

			</div>



<!-- 								<div class="col-xxl-6 mb-5 mb-xl-0">
					<div class="card card-flush h-lg-100" style="background-color: #31596b12; border-radius: 10px;">
						<div class="card-header mb-5">
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bold text-gray-800">Documents Display </span>

							</h3>
							<span>

							<button type="button" onclick="showUpload();" class="btn btn-primary" style="padding:3px 10px 3px 10px;margin-top:22px;">Upload</button></span>
						</div>
						<div class="card-body pt-0" id="documents" style="padding-left:10px; padding-right: 10px;">
						</div>
					</div>
				</div> -->


			<!-- <div> -->




		</div>
		<!--end::Body-->
	</div>
