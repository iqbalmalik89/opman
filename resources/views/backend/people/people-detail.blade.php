<div class="card card-flush h-xl-100">
	<!--begin::Header-->
<!-- 	<div class="card-header pt-7">
		<h3 class="card-title align-items-start flex-column">
		</h3>
		<div class="card-toolbar">
			<button class="btn btn-primary">Edit Profile</button>
			<button class="btn mx-2 btn-danger">Delete</button>
		</div>
	</div>
 -->	<!--end::Header-->
	<!--begin::Body-->
	<div class=" row card-body pt-5">

		<input type="hidden" id="id" name="id" value="{{$people->id}}">


		<!-- <div class="row g-5 g-xl-10"> -->
			<div class="col-xl-6">
				<!--begin::List widget 11-->
				<div class="card card-flush h-xl-100">
					<!--begin::Header-->
					<div class="card-header  mb-3">
						<div class="col text-center mb-9">
							<!--begin::Photo-->
							<!-- <div class="octagon mx-auto mb-2 d-flex w-150px h-150px bgi-no-repeat bgi-size-contain bgi-position-center" style="background-image:url('{{url('storage/misc_docs')}}/{{$people->photo_path}}')"></div> -->


							@php
								if(empty($people->photo_path))
									$photo = global_asset('assets/media/svg/avatars/blank.svg');
								else
									$photo = \Storage::url('people-photos/' . $people->photo_path);
							@endphp

							<img src="{{$photo}}" style="width:100px;border-radius: 5px" alt="image">

							<!--end::Photo-->
							<!--begin::Person-->
							<div class="mb-0">
								<!--begin::Name-->
								<span class="text-dark fw-bold fs-3">{{$people->first_name ?? ''}} {{$people->last_name ?? ''}}</span>
								<!--end::Name-->
								<!--begin::Position-->
								<div class="text-muted fs-6 fw-semibold">
									{{$people->email ?? ''}}
								</div>

								<div class="text-muted fs-6 fw-semibold pt-3">

								@if(Auth::user()->hasPermissionTo('update people'))
									<a href="{{url('admin/people/edit/').'/'.$people->id}}" class="btn btn-icon btn-primary profile-btn"><i class="bi bi-pencil-square fs-4"></i></a>
								@endif

								@if(Auth::user()->hasPermissionTo('delete people'))
									<a href="javascript:void(0);" onclick="deletePeople({{$people->id}});" class="btn btn-icon btn-danger profile-btn"><i class="bi bi-trash-fill fs-4"></i></a>
								@endif

								<a href="{{route('download-people', $people->id)}}" class="btn btn-icon btn-secondary profile-btn"><i class="fa-solid fa-download text-dark"></i></a>

								@if(Auth::user()->hasPermissionTo('delete people'))
									@if($people->status == 'Banned')
										<a href="javascript:void(0);" onclick="changePeopleStatus({{$people->id}}, 'Inactive', '{{$people->status}}');" class="btn btn-icon btn-danger profile-btn"><i class="fa-solid fa-ban" title="Unban"></i></a>
									@elseif($people->status != 'Banned')
										<a href="javascript:void(0);" onclick="changePeopleStatus({{$people->id}}, 'Banned', '{{$people->status}}');" class="btn btn-icon btn-info profile-btn"><i class="fa-solid fa-ban"  title="Ban Person"></i></a>
									@endif

									@if($people->status == 'Deactivated')
										<a href="javascript:void(0);" onclick="changePeopleStatus({{$people->id}}, 'Inactive', '{{$people->status}}');" class="btn btn-icon btn-danger profile-btn"><i class="fa-solid fa-user-xmark" title="Activate"></i></a>
									@elseif($people->status != 'Deactivated')
										<a href="javascript:void(0);" onclick="changePeopleStatus({{$people->id}}, 'Deactivated', '{{$people->status}}');" class="btn btn-icon btn-success profile-btn"><i class="fa-solid fa-user-check" title="Deactivate"></i></a>
									@endif
								@endif






								</div>
								<!--begin::Position-->
							</div>
							<!--end::Person-->
						</div>
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="card-body" style="padding-left: 0px; padding-top: 0px;">


						<div class="mw-300px">
							<div class="d-flex flex-stack mb-3">
								<div class="fw-semibold pe-10 text-gray-600 fs-7">Postcode:</div>
								<div class="text-end fw-bold fs-6 text-gray-800">{{$people->postcode ?? ''}}</div>
							</div>
						</div>

						<div class="mw-300px">
							<div class="d-flex flex-stack mb-3">
								<div class="fw-semibold pe-10 text-gray-600 fs-7">Mobile#:</div>
								<div class="text-end fw-bold fs-6 text-gray-800">{{$people->mobile ?? ''}}</div>
							</div>
						</div>

						<div class="mw-300px">
							<div class="d-flex flex-stack mb-3">
								<div class="fw-semibold pe-10 text-gray-600 fs-7">Next of KIN:</div>
								<div class="text-end fw-bold fs-6 text-gray-800">{{$people->nok ?? ''}}</div>
							</div>
						</div>

						<div class="mw-300px">
							<div class="d-flex flex-stack mb-3">
								<div class="fw-semibold pe-10 text-gray-600 fs-7">NOK Contact#:</div>
								<div class="text-end fw-bold fs-6 text-gray-800">{{$people->nok_contact ?? ''}}</div>
							</div>
						</div>


						@foreach($people->assignments as $assignment)
							<!--begin::Card header-->
							<!--end:: Card header-->
							<!--begin:: Card body-->
						@if(!empty($assignment->project))
							<div id="assignment-{{$assignment->id}}" style="border: solid 1px #faf8ff; margin-bottom:10px; padding:8px; border-radius:5px; background-color:#faf8ff">

								<div class="text-gray-600 fw-semibold fs-7 mb-1">{{$assignment->project->job_no}} - {{$assignment->project->name}}</div>

								@if($assignment->doc && in_array($assignment->doc->status, ['Expired']))
								<i title="Expired" class="fa-solid text-danger fa-triangle-exclamation"></i>
								@endif
								@if($assignment->doc)
									{{$assignment->doc->skill->certification}}
								@endif
								<div class="fw-semibold  text-gray-800 fs-8">{{date('M j, Y', strtotime($assignment->start_date))}} - {{date('M j, Y', strtotime($assignment->end_date))}}</div>


								<!--end::Name-->
								<!--begin::Description-->
								<!--end::Description-->
								<!--begin::Info-->

							</div>
							<!--end:: Card body-->
						@endif
						
						@endforeach




<!-- 						<div class="mw-300px">
							<div class="d-flex flex-stack mb-3">
								<div class="fw-semibold pe-10 text-gray-600 fs-7">NI Number#:</div>
								<div class="text-end fw-bold fs-6 text-gray-800">{{$people->ni_number ?? ''}}</div>
							</div>
						</div>						

						<div class="mw-300px">
							<div class="d-flex flex-stack mb-3">
								<div class="fw-semibold pe-10 text-gray-600 fs-7">CPCS Number:</div>
								<div class="text-end fw-bold fs-6 text-gray-800">{{$people->cpcs_number ?? ''}}</div>
							</div>
						</div>						
 -->



					</div>
					<!--end::Body-->
				</div>
				<!--end::List widget 11-->
			</div>

			<div class="col-xxl-6 mb-5 mb-xl-0">
				<!--begin::List widget 8-->
				<div class="card card-flush h-lg-100" style="background-color: #31596b12; border-radius: 10px;">
					<!--begin::Header-->
					<div class="card-header pt-7 mb-5">
						<!--begin::Title-->
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label fw-bold text-gray-800">Documents Display</span>
							<!-- <span class="text-gray-400 mt-1 fw-semibold fs-6">20 countries share 97% visits</span> -->
						</h3>
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
