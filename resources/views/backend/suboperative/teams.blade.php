@if(Auth::user()->hasPermissionTo('view suboperatives of a subcontractor'))

	<div class="col-xl-10 pt-5 mb-5 mb-xl-10">
		<div style="margin-bottom: 10px;" class="card card-flush h-xl-100">
			<div class="card-body pt-2" style="padding: 0rem 2.25rem;">

				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr class="fw-bold fs-6 text-gray-800">
								<th>Name</th>
								<th>Team Assigned</th>
								<th>Select Certification</th>
								<th></th>
							</tr>
						</thead>
						<tbody>

						@foreach($teams as $team)
				
								@foreach($team->suboperatives()->get() as $operative)
										<?php
										$filesHtml = '';
										if(!empty($operative->document))
										{
											$files = explode(',', $operative->document->doc_path);
											foreach($files as $fileKey =>  $file)
											{
												$class = '';
												if($fileKey > 0)
													$class = 'd-none';


												$url = asset('suboperative-documents'.'/'.$operative->id.'/'.$file);

												if(count($files) > 1)
												{


													$filesHtml .= '<a class="lightboxed badge badge-dark fs-base '.$class.'" rel="'.$operative->document->id.$operative->document->batch.'-'.$operative->document->id.'"  data-link="'.$url.'" class="btn btn-primary view-btn">View</button></a>';

												}
												else
												{
							                        $filesHtml = '<a class="lightboxed badge badge-dark fs-base" rel="'.$operative->document->id.$operative->document->batch.'-'.$operative->document->id.'"  data-link="'.$url.'" class="btn btn-primary view-btn">View</button></a>';

												}
											}
										}
										?>
									<tr>
										<td><a href="{{route('update-suboperative', $operative->id)}}" class="text-gray-800 text-hover-primary">{{$operative->first_name}} {{$operative->last_name}}</a></td>
										<td>{{$team->team}}</td>
										<td>
											@if(!empty($operative->document))
											<div class="d-flex flex-stack">
					                            <span class="me-2 w-25px status-{{$operative->document->status}}"></span>
					                            <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
					                                
					                                <div class="d-flex align-items-center">
					                                    
					                                    
					                                    <div class="m-0">


					                                        {!!$filesHtml!!}
					                                    	
					                                    	
					                                    </div>

					                                    <div class="m-2">
					                                    	{{$operative->document->skill->certification ?? ''}}
					                                    	
					                                    </div>

					                                </div>
					                            </div>
					                        </div>

					                        @endif

										</td>
										<td class="text-end">
										@if(Auth::user()->hasPermissionTo('update suboperative'))
											<a href="{{route('update-suboperative', $operative->id)}}"><i style="font-size: 20px;" class="las la-edit text-primary"></i></a>
										@endif
										</td>


									</tr>
									
								@endforeach
						@endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

@endif


<?php /*
	<div class="col-xl-10 pt-5 mb-5 mb-xl-10">
		<!--begin::Tables widget 16-->

		@forelse($teams as $team)

			@if($team->suboperatives()->count())
				<div style="margin-bottom: 10px;" class="card card-flush h-xl-100">
					<!--begin::Card header-->
					<div class="card-header pt-2" style="min-height: 20px;">
						<!--begin::Title-->
						<h4 class="card-title align-items-start flex-column" style="padding:0px 0px 0px 0px;">
							<span class="card-label fs-5 fw-bold text-gray-800">{{$team->team}} </span>
						</h4>
						<!--end::Title-->
						<!--begin::Actions-->

						<!--end::Actions-->
					</div>
					<!--end::Card header-->
					<!--begin::Card body-->
					<div class="card-body pt-2" style="padding: 0rem 2.25rem;">
						<!--begin::Table-->
						<table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_4_table">
							<!--begin::Table head-->
							<thead>
								<!--begin::Table row-->
								<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
									<th class="min-w-100px">Operative</th>
									<th class="min-w-25px">Role</th>
									<th class="min-w-100px">Subcontractor</th>
									<th class="min-w-50px"></th>
								</tr>
								<!--end::Table row-->
							</thead>
							<!--end::Table head-->
							<!--begin::Table body-->
							<tbody class="fw-bold text-gray-600">
								<tr data-kt-table-widget-4="subtable_template" class="d-none">
									<td colspan="2">
										<div class="d-flex align-items-center gap-3">
											<a href="#" class="symbol symbol-50px bg-secondary bg-opacity-25 rounded">
												<img src="" data-kt-src-path="assets/media/stock/ecommerce/" alt="" data-kt-table-widget-4="template_image" />
											</a>
											<div class="d-flex flex-column text-muted">
												<a href="#" class="text-gray-800 text-hover-primary fw-bold" data-kt-table-widget-4="template_name">Product name</a>
												<div class="fs-7" data-kt-table-widget-4="template_description">Product description</div>
											</div>
										</div>
									</td>
									<td class="text-end">
										<div class="text-gray-800 fs-7">Cost</div>
										<div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_cost">1</div>
									</td>
									<td class="text-end">
										<div class="text-gray-800 fs-7">Qty</div>
										<div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_qty">1</div>
									</td>
									<td class="text-end">
										<div class="text-gray-800 fs-7">Total</div>
										<div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_total">name</div>
									</td>
									<td class="text-end">
										<div class="text-gray-800 fs-7 me-3">On hand</div>
										<div class="text-muted fs-7 fw-bold" data-kt-table-widget-4="template_stock">32</div>
									</td>
									<td></td>
								</tr>

								@foreach($team->suboperatives()->get() as $operative)
									@empty(!$operative->document)
									<?php

										$filesHtml = '';
										$files = explode(',', $operative->document->doc_path);
										foreach($files as $fileKey =>  $file)
										{
											$class = '';
											if($fileKey > 0)
												$class = 'd-none';


											$url = url('storage/suboperative-documents').'/'.$operative->id.'/'.$file;


											if(count($files) > 1)
											{


												$filesHtml .= '<a class="lightboxed badge badge-dark fs-base '.$class.'" rel="'.$operative->document->id.$operative->document->batch.'-'.$operative->document->id.'"  data-link="'.$url.'" class="btn btn-primary view-btn">View</button></a>';

											}
											else
											{
						                        $filesHtml = '<a class="lightboxed badge badge-dark fs-base" rel="'.$operative->document->id.$operative->document->batch.'-'.$operative->document->id.'"  data-link="'.$url.'" class="btn btn-primary view-btn">View</button></a>';

											}
										}
									
									<tr>
									<td>
										<a href="{{route('update-suboperative', $operative->id)}}" class="text-gray-800 text-hover-primary">{{$operative->first_name}} {{$operative->last_name}}</a>
									</td>
									<td>

										<div class="d-flex flex-stack">
				                            <span class="me-2 w-25px status-New"></span>
				                            <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
				                                
				                                <div class="d-flex align-items-center">
				                                    
				                                    
				                                    <div class="m-0">


				                                        {!!$filesHtml!!}
				                                    	
				                                    	
				                                    </div>

				                                    <div class="m-2">
				                                    	{{$operative->document->skill->certification}}
				                                    </div>

				                                </div>
				                            </div>
				                        </div>

                        			</td>
									<td>
										{{$operative->subcontractor->name}}

									</td>
									
									<td class="text-end">
										<a href="{{route('update-suboperative', $operative->id)}}"><i style="font-size: 20px;" class="las la-edit text-primary"></i></a>
										<!-- <a href=""><i style="font-size: 20px;" class="las la-trash text-danger"></i></a> -->
									</td>

									@endif
								@endforeach

							</tbody>
							<!--end::Table body-->
						</table>
						<!--end::Table-->
					</div>
					<!--end::Card body-->
				</div>
			@endif
		@empty
			<div style="margin-bottom: 10px; padding:20px 20px 20px 30px;" class="card text-gray-600 card-label fs-5 fw-bold card-flush h-xl-100">
				No teams under this subcontractor
			</div>
		@endforelse

		<!--end::Tables widget 16-->
	</div>
*/ ?>
