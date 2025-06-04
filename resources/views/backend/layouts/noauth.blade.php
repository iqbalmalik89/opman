<!DOCTYPE html>
@php 
$settings = \App\Services\SettingService::getSetting(); 
if(!empty($settings->splash_bg_img_path))
{
	if(tenant())
		$bg = \Storage::url('site/' . $settings->splash_bg_img_path);
	else	
		$bg = global_asset('storage/site/' . $settings->splash_bg_img_path);				

}
else
{
	$bg = global_asset('assets/media/site') . '/noauthbg.png';
}

if(tenant())
{
	$storageUrl = \Illuminate\Support\Facades\Storage::url('');
}
@endphp

<html lang="en">
	<!--begin::Head-->
        @include('backend.partials.head')
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank app-blank">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-theme-mode")) { themeMode = document.documentElement.getAttribute("data-theme-mode"); } else { if ( localStorage.getItem("data-theme") !== null ) { themeMode = localStorage.getItem("data-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
					<!--begin::Form-->
					<div class="d-flex flex-center flex-column flex-lg-row-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-600px p-10">
							<!--begin::Form-->
				            @yield('content')
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Form-->
					<!--begin::Footer-->
<!-- 					<div class="d-flex flex-center flex-wrap px-5">
						<div class="d-flex fw-semibold text-primary fs-base">
							<a href="../../demo1/dist/pages/team.html" class="px-5" target="_blank">Terms</a>
							<a href="../../demo1/dist/pages/pricing/column.html" class="px-5" target="_blank">Plans</a>
							<a href="../../demo1/dist/pages/contact.html" class="px-5" target="_blank">Contact Us</a>
						</div>
					</div>
 -->					<!--end::Footer-->
				</div>
				<!--end::Body-->
				<!--begin::Aside-->
				<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{$bg}})">
					<!--begin::Content-->
					<div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
						<!--begin::Logo-->

						@if(!empty($settings->logo_img_path))

							@php
								if(tenant())
									$url = \Storage::url('site/' . $settings->logo_img_path);
								else	
									$url = global_asset('storage/site/' . $settings->logo_img_path);				
							@endphp

						<a href="" class="mb-0 mb-lg-12">
							<img alt="Logo" src="{{$url}}" class="h-60px h-lg-75px" />
						</a>
						@endif

						<!--end::Logo-->
						<!--begin::Image-->
						@if(!empty($settings->splash_img_path))
							@php
								if(tenant())
									$url = asset('site/' . $settings->splash_img_path);
								else	
									$url = global_asset('storage/site/' . $settings->splash_img_path);				
							@endphp

							<img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="{{$url}}" alt="" />
						@endif
						<!--end::Image-->
						<!--begin::Title-->
						<h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">{{$settings->splash_heading}}</h1>
						<!--end::Title-->
						<!--begin::Text-->
						<div class="d-none d-lg-block text-white fs-base text-center">{{$settings->splash_small_text}}</div>
						<!--end::Text-->
					</div>
					<!--end::Content-->
				</div>
				<!--end::Aside-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>


        <div class="modal fade " tabindex="-1" id="two_fact_modal">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content">
                    <div class="modal-header pb-0 border-0 justify-content-end">
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>                  
                    </div> 
                    <div class="modal-body text-center">
                        <h1>Two Factor Authentication</h1>
                        <p id="two_fact_msg"></p>
                        <form id="two_fact_form" class="form" action="#"> 
                            <div class="row mb-2 text-center px-0 px-sm-12">
                                <div class="col-2  text-center p-1 p-sm-4"> 
                                    <input type="text" name="code_1" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control px-0 text-center fs-1 fw-bold text-gray-800"/>
                                </div>
                               <div class="col-2 text-center p-1 p-sm-4"> 
                                      <input type="text" name="code_2" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control px-0 text-center fs-1 fw-bold text-gray-800 "/> 
                                </div>
                               <div class="col-2 text-center p-1 p-sm-4"> 
                                      <input type="text" name="code_3" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control px-0 text-center fs-1 fw-bold text-gray-800"/> 
                                </div>
                               <div class=" col-2 text-center p-1 p-sm-4"> 
                                      <input type="text" name="code_4" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control px-0 text-center fs-1 fw-bold text-gray-800"/> 
                                </div>
                               <div class="col-2 text-center p-1 p-sm-4"> 
                                     <input type="text" name="code_5" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control px-0 text-center fs-1 fw-bold text-gray-800"/> 
                                </div>
                               <div class="col-2 text-center p-1 p-sm-4"> 
                                   <input type="text" name="code_6" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control px-0 text-center fs-1 fw-bold text-gray-800" data-kt-dialer-control="input" />
                                </div> 

							<div id="two_fact_form_msg"></div>

                            </div>


                            <div class="text-center	">
                                <button type="submit" id="two_fact_form_btn" class="btn btn-primary">Verify</button>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div> 
                        </form>
                    </div>                  
                </div>               
            </div>
        </div>


        @include('backend.partials.js')

		<!--end::Root-->

	</body>
	<!--end::Body-->
</html>