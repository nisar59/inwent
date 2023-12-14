@php
$prefix=request()->route()->getPrefix();
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


				<li class="submenu @if($prefix=='/roles' OR $prefix=='/admins' OR $prefix=='/settings'OR $prefix=='/professional-skills'OR $prefix=='/professional-tools' OR $prefix=='/') active @endif">
					<a href="javascript:void(0)"><i class="fas fa-user-shield"></i> <span> Common</span> <span class="menu-arrow"></span></a>
					<ul>
						<li><a class="@if($prefix=='/roles') active @endif" href="{{url('roles')}}">Roles & Permissions</a></li>
						<li><a class="@if($prefix=='/admins') active @endif" href="{{url('admins')}}">Admins</a></li>
						<li><a class="@if($prefix=='/settings') active @endif" href="{{url('settings')}}">Settings</a></li>
						<li><a class="@if($prefix=='/professional-skills') active @endif" href="{{url('professional-skills')}}">Professional Skills</a></li>
						<li><a class="@if($prefix=='/professional-tools') active @endif" href="{{url('professional-tools')}}">Professional Tools</a></li>
						<li><a class="@if($prefix=='/users') active @endif" href="{{url('users')}}">Users</a></li>
					</ul>
				</li>

				<li class="submenu @if($prefix=='/pages' OR $prefix=='/main-menu' OR $prefix=='/footer-menu-headings' OR $prefix=='/footer-menu' OR $prefix=='/sliders' OR $prefix=='/banner' OR $prefix=='/action-banner' OR $prefix=='/our-client'OR $prefix=='/categories' OR $prefix=='/user-reviews' OR $prefix=='/inwent-legal' OR $prefix=='/blog' OR $prefix=='/knowledge-base-categories') active @endif">
					<a href="javascript:void(0)"><i class="fa fa-database"></i> <span>CMS</span> <span class="menu-arrow"></span></a>
					<ul>
						<li><a class="@if($prefix=='/pages') active @endif" href="{{url('pages')}}">Pages</a></li>
						<li><a class="@if($prefix=='/main-menu') active @endif" href="{{url('main-menu')}}">Main Menu</a></li>
						<li><a class="@if($prefix=='/footer-menu-headings' OR $prefix=='/footer-menu') active @endif" href="{{url('footer-menu-headings')}}">Footer Menu</a></li>
						<li><a class="@if($prefix=='/sliders') active @endif" href="{{url('sliders')}}">Sliders</a></li>
						<li><a class="@if($prefix=='/banner') active @endif" href="{{url('banner')}}">Banner</a></li>
						<li><a class="@if($prefix=='/action-banner') active @endif" href="{{url('action-banner')}}">Action Banner</a></li>
						<li><a class="@if($prefix=='/our-client') active @endif" href="{{url('our-client')}}">Our Client</a></li>
						<li><a class="@if($prefix=='/categories') active @endif" href="{{url('categories')}}">Categories</a></li>
						<li><a class="@if($prefix=='/user-reviews') active @endif" href="{{url('user-reviews')}}">User Reviews</a></li>
						<li><a class="@if($prefix=='/inwent-legal') active @endif" href="{{url('inwent-legal')}}">Inwent Legal</a></li>
						<li><a class="@if($prefix=='/blog') active @endif" href="{{url('blog')}}">Blog</a></li>
						<li><a class="@if($prefix=='/knowledge-base-categories') active @endif" href="{{url('knowledge-base-categories')}}">Knowledge Base Categories</a></li>
						<li><a class="@if($prefix=='/knowledge-base') active @endif" href="{{url('knowledge-base')}}">Knowledge Base</a></li>
					</ul>
				</li>

				<li class="submenu @if($prefix=='/freelancing/project-config') active @endif">
					<a href="javascript:void(0)"><i class="fa fa-user"></i><span>Freelancing</span> <span class="menu-arrow"></span></a>
					<ul>
						<li><a class="@if($prefix=='/freelancing/project-config') active @endif" href="{{url('project-config')}}">Project Configuration</a></li>
					</ul>
				</li>


				<li>
					<a href="categories.html"><i data-feather="copy"></i> <span>Categories</span></a>
				</li>
				<li>
					<a href="projects.html"><i data-feather="database"></i> <span>Projects</span></a>
				</li>
				<li>
					<a href="users.html"><i data-feather="users"></i> <span>Freelancer</span></a>
				</li>
				<li>
					<a href="deposit.html"><i data-feather="user-check"></i> <span>Deposit</span></a>
				</li>
				<li>
					<a href="withdrawn.html"><i data-feather="user-check"></i> <span>Withdrawn</span></a>
				</li>
				<li>
					<a href="transaction.html"><i data-feather="clipboard"></i> <span>Transaction</span></a>
				</li>
				<li>
					<a href="providers.html"><i data-feather="user-check"></i> <span>Providers</span></a>
				</li>
				<li>
					<a href="subscription.html"><i data-feather="user-check"></i> <span>Subscription</span></a>
				</li>
				<li>
					<a href="reports.html"><i data-feather="pie-chart"></i> <span>Reports</span></a>
				</li>
				<li>
					<a href="roles.html"><i data-feather="clipboard"></i> <span>Roles</span></a>
				</li>
				<li>
					<a href="skills.html"><i data-feather="award"></i> <span>Skills</span></a>
				</li>
				<li>
					<a href="verify-identity.html"><i data-feather="user-check"></i> <span>Verify Identity</span></a>
				</li>
				<li>
					<a href="settings.html"><i data-feather="settings"></i> <span>Settings</span></a>
				</li>
				<li class="menu-title"><span>UI Interface</span></li>
				<li>
					<a href="components.html"><i data-feather="pocket"></i> <span>Components</span></a>
				</li>
				<li class="submenu">
					<a href="#"><i data-feather="file-minus"></i> <span> Forms</span> <span class="menu-arrow"></span></a>
					<ul>
						<li><a href="form-basic-inputs.html">Basic Inputs</a></li>
						<li><a href="form-input-groups.html">Input Groups</a></li>
						<li><a href="form-horizontal.html">Horizontal Form</a></li>
						<li><a href="form-vertical.html">Vertical Form</a></li>
						<li><a href="form-mask.html">Form Mask</a></li>
						<li><a href="form-validation.html">Form Validation</a></li>
					</ul>
				</li>
				<li class="submenu">
					<a href="#"><i data-feather="align-justify"></i> <span> Tables</span> <span class="menu-arrow"></span></a>
					<ul>
						<li><a href="tables-basic.html">Basic Tables</a></li>
						<li><a href="data-tables.html">Data Table</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
<!-- /Sidebar -->