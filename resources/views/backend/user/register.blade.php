@extends('backend.layouts.noauth')
@section('content')

							<form class="form w-100" id="register-form">
								<!--begin::Heading-->



								<div class="text-center mb-11">
									<!--begin::Title-->
									<h1 class="text-dark fw-bolder mb-3">Create An Account</h1>
									<!--end::Title-->
									<!--begin::Subtitle-->
									<!-- <div class="text-gray-500 fw-semibold fs-6">Your Social Campaigns</div> -->
									<!--end::Subtitle=-->
								</div>
								<!--begin::Heading-->
								<!--begin::Login options-->
								
								{{--
								<div class="row g-3 mb-9">
									<!--begin::Col-->
									<div class="col-md-6">
										<!--begin::Google link=-->
										<a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
										<img alt="Logo" src="{{global_asset('assets/media/svg/brand-logos/google-icon.svg')}}" class="h-15px me-3" />Sign in with Google</a>
										<!--end::Google link=-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col-md-6">
										<!--begin::Google link=-->
										<a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
										<img alt="Logo" src="{{global_asset('assets/media/svg/brand-logos/apple-black.svg')}}" class="theme-light-show h-15px me-3" />
										<img alt="Logo" src="{{global_asset('assets/media/svg/brand-logos/apple-black-dark.svg')}}" class="theme-dark-show h-15px me-3" />Sign in with Apple</a>
										<!--end::Google link=-->
									</div>
									<!--end::Col-->
								</div>
								<!--end::Login options-->
								<!--begin::Separator-->
								<div class="separator separator-content my-14">
									<span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
								</div>
								--}}

								<!--end::Separator-->
								<!--begin::Input group=-->


								<div class="row row-cols-1 row-cols-sm-1 rol-cols-md-1 row-cols-lg-1">
									<!--begin::Col-->
									<div class="col">
										<!--begin::Input group-->
										<div class="fv-row mb-7 fv-plugins-icon-container">
											<!--begin::Label-->
											<label class="fs-6 fw-semibold form-label mt-3">
												<span>Company</span>
											</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input type="text" class="form-control form-control-solid" name="company" value="">
											<!--end::Input-->
										</div>
										<!--end::Input group-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<!--end::Col-->
								</div>

								<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
									<!--begin::Col-->
									<div class="col">
										<!--begin::Input group-->
										<div class="fv-row mb-2 fv-plugins-icon-container">
											<!--begin::Label-->
											<label class="fs-6 fw-semibold form-label mt-3">
												<span>First Name</span>
											</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input type="text" class="form-control form-control-solid" name="first_name" value="">
											<!--end::Input-->
										</div>
										<!--end::Input group-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col">
										<!--begin::Input group-->
										<div class="fv-row mb-2">
											<!--begin::Label-->
											<label class="fs-6 fw-semibold form-label mt-3">
												<span>Last Name</span>
											</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input type="text" class="form-control form-control-solid" name="last_name" value="">
											<!--end::Input-->
										</div>
										<!--end::Input group-->
									</div>
									<!--end::Col-->
								</div>

								<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
									<!--begin::Col-->
									<div class="col">
										<!--begin::Input group-->
										<div class="fv-row mb-2 fv-plugins-icon-container">
											<!--begin::Label-->
											<label class="fs-6 fw-semibold form-label mt-3">
												<span>Phone</span>
											</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input type="text" class="form-control form-control-solid" name="phone" id="phone">
											<input type="hidden" name="phone_full">
											<!--end::Input-->
										</div>
										<!--end::Input group-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col">
									</div>
									<!--end::Col-->
								</div>

								<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
									<!--begin::Col-->
									<div class="col">
										<!--begin::Input group-->
										<div class="fv-row mb-7 fv-plugins-icon-container">
											<!--begin::Label-->
											<label class="fs-6 fw-semibold form-label mt-3">
												<span>Email</span>
											</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input type="email" class="form-control form-control-solid" name="email" value="">
											<!--end::Input-->
										</div>
										<!--end::Input group-->
									</div>
									<!--end::Col-->
									<!--begin::Col-->
									<div class="col">
										<!--begin::Input group-->
										<div class="fv-row mb-7">
											<!--begin::Label-->
											<label class="fs-6 fw-semibold form-label mt-3">
												<span>Password</span>
											</label>
											<!--end::Label-->
											<!--begin::Input-->
											<input type="password" class="form-control form-control-solid" name="password" value="">
											<!--end::Input-->
										</div>
										<!--end::Input group-->
									</div>
									<!--end::Col-->
								</div>

								<!--end::Input group=-->
								<!--begin::Wrapper-->
								<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
									<div>
										Already have an account?
										<a href="{{route('login')}}" class="link-primary">Login Now</a>									
									</div>
									<!--begin::Link-->
									
									<!--end::Link-->
								</div>
								<!--end::Wrapper-->
								<!--begin::Submit button-->
								<div class="d-grid mb-10">
									<button type="submit" id="register-form-btn" class="btn btn-primary">
										<!--begin::Indicator label-->
										<span class="indicator-label">Register</span>
										<!--end::Indicator label-->
										<!--begin::Indicator progress-->
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										<!--end::Indicator progress-->
									</button>
								</div>

								<div id="login_msg"></div>

								<!--end::Submit button-->
								<!--begin::Sign up-->
<!-- 								<div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
								<a href="../../demo1/dist/authentication/layouts/corporate/sign-up.html" class="link-primary">Sign up</a></div> -->
								<!--end::Sign up-->
							</form>
@endsection
