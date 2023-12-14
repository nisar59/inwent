@php
$prefix=request()->route()->getPrefix();

$module=session('module');
if($module==null){
$module='inwent';
}

$current_app=APPS()[$module];

@endphp

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
	<div class="sidebar-inner slimscroll">
		<div id="sidebar-menu" class="sidebar-menu">
			<ul>

				<li class="menu-title"><span>Main</span></li>
				<li class="@if($prefix=='') active @endif">
					<a href="{{url('home')}}"><i data-feather="home"></i> <span>Dashboard</span></a>
				</li>

				<li class="menu-title"><span>{{$current_app['title']}}</span></li>
				@foreach($current_app['menu'] as $menu)
					<li class="@if($prefix==$menu['prefix']) active @endif">
						<a href="{{url($menu['url'])}}"><i class="{{$menu['icon']}}"></i> <span>{{$menu['title']}}</span></a>
					</li>
				@endforeach

			</ul>
		</div>
	</div>
</div>
<!-- /Sidebar -->