@if(Auth::user()->hasPermissionTo('view projects'))

									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::isRoute('projects')}} {{Nav::isRoute('update-project')}}" href="{{route('projects')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												
												<i class="fa-solid fa-screwdriver-wrench text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">Projects</span>
										</a>
										<!--end:Menu link-->
									</div>
@endif