@extends('backend.layouts.auth')
@section('title', 'Schedule')
@section('content')

<div class="d-flex flex-column flex-column-fluid">
	<!--begin::Toolbar-->
	<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
		<!--begin::Toolbar container-->
		<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
			<!--begin::Page title-->
			<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
				<!--begin::Title-->
				<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Schedule</h1>
				<!--end::Title-->
			</div>


			<div class="d-flex align-items-center gap-2 gap-lg-3">
				<!--begin::Primary button-->
				<a href="javascript:void(0);" class="btn btn-sm fw-bold btn-primary" onclick="showSchedulePopup();">Add Engineer</a>
				<!--end::Primary button-->
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

			<div class="col-xl-12" >
				<!--begin::Table widget 14-->
				<div class="card card-flush h-md-100">
					<!--begin::Header-->
					<div class="card-header pt-7">
						<!--begin::Title-->
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label fw-bold text-gray-800">{{$project->title}}</span>
						<!--<span class="text-gray-400 mt-1 fw-semibold fs-6">Updated 37 minutes ago</span> -->
						</h3>
						<!--end::Title-->
						<!--begin::Toolbar-->
						<div class="card-toolbar">
							<a href="" class="btn btn-sm btn-dark">Back</a>
						</div>
						<!--end::Toolbar-->
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="card-body pt-6">
						<!--begin::Table container-->


						<div class="tab-content mb-2 px-9">
							<!--begin::Tap pane-->
							<div class="tab-pane fade show active" id="kt_timeline_widget_3_tab_content_4">
								<!--begin::Wrapper-->
								@foreach($project->schedule as $key => $schedule)
									<div class="d-flex align-items-center mb-6">
										<!--begin::Bullet-->
										<span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-{{App\Library\Utility::getColor($key)}}"></span>
										<!--end::Bullet-->
										<!--begin::Info-->
										<div class="flex-grow-1 me-5">
											<!--begin::Time-->
											<div class="text-gray-800 fw-semibold fs-2">{{date('d M Y', strtotime($schedule->start_date))}} - {{date('d M Y', strtotime($schedule->end_date))}}
											<!--<span class="text-gray-400 fw-semibold fs-7">AM</span> -->
											</div>
											<!--end::Time-->
											<!--begin::Description-->
											<div class="text-gray-700 fw-semibold fs-6">{{$schedule->notes}}</div>
											<!--end::Description-->
											<!--begin::Link-->
											<div class="text-gray-400 fw-semibold fs-7">Lead by
											<!--begin::Name-->
											<a href="#" class="text-primary opacity-75-hover fw-semibold">{{$schedule->user->first_name}} {{$schedule->user->last_name}}</a>
											<!--end::Name--></div>
											<!--end::Link-->
										</div>
										<!--end::Info-->
										<!--begin::Action-->
										<a href="#" onclick="getSchedule({{$schedule->id}});" class="btn  btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project"><i class="fa-solid fa-pencil text-dark"></i></a>

										<a href="#" onclick="deleteSchedule({{$schedule->id}});" class="btn  btn-light" style="margin-left: 10px;" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project"><i class="fa-solid fa-trash text-danger"></i></a>

										<!--end::Action-->
									</div>
								@endforeach
								<!--end::Wrapper-->
							</div>
							<!--end::Tap pane-->
						</div>




						<!--end::Table-->
					</div>
					<!--end: Card Body-->
				</div>
				<!--end::Table widget 14-->
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
