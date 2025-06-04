@if(Auth::user()->hasPermissionTo('people listing'))

									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link {{Nav::isRoute('active-people')}} {{Nav::isRoute('edit-people')}}" href="{{route('active-people')}}">
											<span class="menu-icon">
												<!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
												
												<i class="fa-solid fa-list text-white"></i>
												<!--end::Svg Icon-->
											</span>
											<span class="menu-title">Active People</span>
										</a>
										<!--end:Menu link-->
									</div>
@endif