@extends('backend.layouts.auth')
@section('title', App\Library\ModuleConfig::getAction($data) .' '.App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name'])
@section('content')

<div class="d-flex flex-column flex-column-fluid">
	<!--begin::Toolbar-->
	<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
		<!--begin::Toolbar container-->
		<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
			<!--begin::Page title-->
			<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
				<!--begin::Title-->
				<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module_title']}}</h1>
				<!--end::Title-->
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

			<div class="row">
				<div class="col-3">
					<div class="card card-flush h-lg-100" id="kt_contacts_main">
						<!--begin::Card header-->
						<div class="card-header pt-7" id="kt_chat_contacts_header">
							<!--begin::Card title-->
							<div class="card-title">
								<!--begin::Svg Icon | path: icons/duotune/communication/com005.svg-->

								<!--end::Svg Icon-->
								<h2>{{App\Library\ModuleConfig::getAction($data)}} {{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module_name']}}</h2>
							</div>
							<!--end::Card title-->
						</div>
						<!--end::Card header-->
						<!--begin::Card body-->
						<div class="card-body pt-5">
							<!--begin::Form-->
							<div id="{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}-form-msg"></div>

							<form id="{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}-form" class="form">

								<input type="hidden" name="module_id" id="module_id" value="{{$data['id'] ?? ''}}" />
								<input type="hidden" name="customer_id" id="customer_id" value="{{$customer_id ?? ''}}" />

								<!--begin::Input group-->

								<!--end::Input group-->
								<!--begin::Input group-->

								<!--end::Input group-->

								<!--begin::Row-->

								<div class="row row-cols-1 row-cols-sm-1 rol-cols-md-1 row-cols-lg-1">
									<!--begin::Col-->
									<div class="col">
										<!--begin::Input group-->
										<div class="fv-row mb-7">
											<!--begin::Label-->
											<label class="fs-6 fw-semibold form-label mt-3">
												<span>Subcontractor</span>
											</label>
											<!--end::Label-->
											<!--begin::Input-->

											<select name="subcontractor_id" id="subcontractor_id" aria-label="Select a Category" data-control="select2" data-placeholder="Select a Vehicle" class="form-select form-select-solid form-select-lg">
		                                        @foreach($subcontractors as $subcontractor)
		                                            <option @if(!empty($subcontractor_id) && $subcontractor_id == $subcontractor->id) selected @endif     @if(!empty($data->subcontractor_id) &&  ($data->subcontractor_id == $subcontractor->id)) selected @endif value="{{$subcontractor->id}}">{{$subcontractor->name}}</option>
		                                        
		                                        @endforeach
											</select>									

											<!--end::Input-->
										</div>
										<!--end::Input group-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col">
										<div class="fv-row mb-7">
											<!--begin::Label-->
											<label class="fs-6 fw-semibold form-label mt-3">
												<span>Team</span>
											</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input name="team" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" value="{{$data['team'] ?? ''}}" />


											<!--end::Input-->
										</div>


									</div>
									<!--end::Col-->
								</div>




								<!--begin::Row-->
								<!--begin::Separator-->
								<div class="separator mb-6"></div>
								<!--end::Separator-->
								<!--begin::Action buttons-->
								<div class="d-flex justify-content-end">
									<!--begin::Button-->
									<button type="reset" data-kt-contacts-type="cancel" class="btn btn-light me-3">Cancel</button>
									<!--end::Button-->
									<!--begin::Button-->
									<button type="submit" class="btn btn-primary" id="{{App\Library\ModuleConfig::getModuleConfig($GLOBALS['module'])['module']}}-form-btn">Save</button>

									<!--end::Button-->
								</div>
								<!--end::Action buttons-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Card body-->
					</div>
				</div>
				<?php /*
				<div class="col-9">
					<div class="card card-flush h-xl-100">
						<!--begin::Card header-->
						<div class="card-header pt-7">
							<!--begin::Title-->
							<h3 class="card-title align-items-start flex-column">
								<span class="card-label fw-bold text-gray-800">Suboperatives in </span>
							</h3>
							<!--end::Title-->
							<!--begin::Actions-->

							<!--end::Actions-->
						</div>
						<!--end::Card header-->
						<!--begin::Card body-->
						<div class="card-body pt-2">
							<!--begin::Table-->
							<table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_4_table">
								<!--begin::Table head-->
								<thead>
									<!--begin::Table row-->
									<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
										<th class="min-w-100px">Operative</th>
										<th class="min-w-100px">Certification</th>
										<th class="min-w-125px">Company</th>
										<th class="min-w-125px"></th>
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
									<tr>
										<td>
											<a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary">#XGY-346</a>
										</td>
										<td>7 min ago</td>
										<td>
											<a href="#" class="text-gray-600 text-hover-primary">Albert Flores</a>
										</td>
										
										<td class="text-end">
											<a href=""><i style="font-size: 20px;" class="las la-trash text-primary"></i></a>
										</td>
								</tbody>
								<!--end::Table body-->
							</table>
							<!--end::Table-->
						</div>
						<!--end::Card body-->
					</div>
				</div>
				*/ ?>
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
