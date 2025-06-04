@if(Auth::user()->hasPermissionTo('add suboperative'))

									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::isRoute('add-suboperative')}}" href="{{route('add-suboperative')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												<i class="fa-solid fa-people-arrows text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">Add Suboperative</span>
										</a>
										<!--end:Menu link-->
									</div>
@endif