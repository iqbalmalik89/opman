@if(Auth::user()->hasPermissionTo('view training'))

									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::isRoute('trainings')}}" href="{{route('trainings')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												<i class="fa-solid fa-t fa-people-arrows text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">Training</span>
										</a>
										<!--end:Menu link-->
									</div>
@endif