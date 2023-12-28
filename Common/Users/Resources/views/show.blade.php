@extends('layouts.template')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">
        
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Users</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('admins')}}">Users</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <a class="btn filter-btn" href="{{url('users')}}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header p-3 d-flex justify-content-between">
                        <h5 class="card-title">User Info</h5>
                        <form method="post" action="{{url('users/update', $user->id)}}" class="form-group d-flex mb-0">
                            @csrf
                            <select name="is_verified" id="is_verified" class="form-control me-1">
                                <option @if($user->is_verified==0) selected @endif value="0">Not Verified</option>
                                <option @if($user->is_verified==1) selected @endif value="1">Verified</option>
                            </select>
                            <select name="verified_badge" disabled id="verified_badge" class="form-control">
                                @foreach(VerifiedBadges() as $badge)
                                <option @if($user->verified_badge==$badge) selected @endif value="{{$badge}}">{{$badge}}</option> 
                                @endforeach                           
                            </select>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <img width="75" height="75" class="rounded-circle" src="{{$user->image}}" alt="">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-bold" for="">Name</label>
                                <p>{{$user->name}}</p>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold" for="">Email</label>
                                <p>{{$user->email}}</p>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold" for="">Email Verification</label>
                                <p>
                                    @if($user->email_verified_at==null)
                                    <span class="text-danger"><i class="fas fa-times"></i> Not Verified </span>
                                    @else
                                    <span class="text-success"><i class="fas fa-check-circle"></i> Verified </span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-2">
                                <label for="" class="form-label fw-bold">Registration Date</label>
                                <p>{{$user->created_at->format('Y-m-d')}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                <div class="card bg-white projects-card">                      
                     <div class="card-header m-3 p-1">
                            <h5 class="card-title">User Profiles</h5>
                     </div>
                    <div class="card-body pt-0">

                        <div class="reviews-menu-links">
                            <ul role="tablist" class="nav nav-pills card-header-pills nav-justified">
                                <li class="nav-item">
                                    <a href="#tab-4" data-bs-toggle="tab" class="nav-link active">Basic Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab-5" data-bs-toggle="tab" class="nav-link">Professional Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab-6" data-bs-toggle="tab" class="nav-link">Business Profile
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab-7" data-bs-toggle="tab" class="nav-link">Investor Profile</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content pt-0">
                            <div role="tabpanel" id="tab-4" class="tab-pane fade active show">
                                @if($user->basicProfile==null)
                                <p class="text-center">User basic profile not found</p>
                                @else
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Brief Bio</label>
                                        <p>{{$basic_profile->brief_bio}}</p>
                                        <hr>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Title Prefix</label>
                                        <p>{{$basic_profile->title_prefixe}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Job Title</label>
                                        <p>{{$basic_profile->job_title}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Website</label>
                                        <p class="text-truncate"><a target="_blank" href="{{$basic_profile->website}}"><i class="fas fa-external-link-alt"></i> {{$basic_profile->website}}</a></p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Language</label>
                                        <p class="text-truncate">{{$basic_profile->language_name}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Contact No</label>
                                        <p class="text-truncate">{{$basic_profile->contact_no}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Country</label>
                                        <p class="text-truncate">{{$basic_profile->country_name}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">City</label>
                                        <p class="text-truncate">{{$basic_profile->city_name}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Zip Code</label>
                                        <p class="text-truncate">{{$basic_profile->postal_code}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Address</label>
                                        <p class="text-truncate">{{$basic_profile->address}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Profile Tags</label>
                                        <p>
                                            @foreach($basic_profile->profile_tages as $tag)
                                            <span class="rounded bg-secondary ps-2 pe-2 text-white">{{$tag->value}}</span>
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Intrests</label>
                                        <p>
                                            @foreach($basic_profile->interests as $intrst)
                                            <span class="rounded bg-secondary ps-2 pe-2 text-white">{{$intrst->value}}</span>
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Social Links</label>
                                        <p>
                                            @foreach($basic_profile->social_links as $link)
                                            <span class="rounded bg-secondary ps-2 pe-2 text-white">{{$link}}</span>
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div role="tabpanel" id="tab-5" class="tab-pane fade">
                                @if($professional_profile==null)
                                   <p class="text-center">User professional profile not found</p>
                                @else
                            <div class="d-flex align-items-start">
                              <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <button class="nav-link text-truncate border mb-1 active" id="v-pills-skills-other-skills-tab" data-bs-toggle="pill" data-bs-target="#v-pills-skills-other-skills" type="button" role="tab" aria-controls="v-pills-skills-other-skills" aria-selected="true">Skills & Other Skills</button>
                                <button class="nav-link text-truncate border mb-1" id="v-pills-tools-other-tools-tab" data-bs-toggle="pill" data-bs-target="#v-pills-tools-other-tools" type="button" role="tab" aria-controls="v-pills-tools-other-tools" aria-selected="false">Tools & Other Tools</button>
                                <button class="nav-link text-truncate border mb-1" id="v-pills-projects-tab" data-bs-toggle="pill" data-bs-target="#v-pills-projects" type="button" role="tab" aria-controls="v-pills-projects" aria-selected="false">Projects</button>
                                <button class="nav-link text-truncate border mb-1" id="v-pills-publications-tab" data-bs-toggle="pill" data-bs-target="#v-pills-publications" type="button" role="tab" aria-controls="v-pills-publications" aria-selected="false">Journal Publications</button>
                                <button class="nav-link text-truncate border mb-1" id="v-pills-patents-tab" data-bs-toggle="pill" data-bs-target="#v-pills-patents" type="button" role="tab" aria-controls="v-pills-patents" aria-selected="false">Patents</button>
                                <button class="nav-link text-truncate border mb-1" id="v-pills-conference-tab" data-bs-toggle="pill" data-bs-target="#v-pills-conference" type="button" role="tab" aria-controls="v-pills-conference" aria-selected="false">Conference</button>
                                <button class="nav-link text-truncate border mb-1" id="v-pills-articles-tab" data-bs-toggle="pill" data-bs-target="#v-pills-articles" type="button" role="tab" aria-controls="v-pills-articles" aria-selected="false">Articles</button>
                                <button class="nav-link text-truncate border mb-1" id="v-pills-experience-tab" data-bs-toggle="pill" data-bs-target="#v-pills-experience" type="button" role="tab" aria-controls="v-pills-experience" aria-selected="false">Experience</button>
                                <button class="nav-link text-truncate border mb-1" id="v-pills-education-tab" data-bs-toggle="pill" data-bs-target="#v-pills-education" type="button" role="tab" aria-controls="v-pills-education" aria-selected="false">Education</button>
                                <button class="nav-link text-truncate border mb-1" id="v-pills-courses-tab" data-bs-toggle="pill" data-bs-target="#v-pills-courses" type="button" role="tab" aria-controls="v-pills-courses" aria-selected="false">Courses</button>
                                <button class="nav-link text-truncate border mb-1" id="v-pills-certifications-tab" data-bs-toggle="pill" data-bs-target="#v-pills-certifications" type="button" role="tab" aria-controls="v-pills-certifications" aria-selected="false">Certification & Licenses</button>
                                <button class="nav-link text-truncate border mb-1" id="v-pills-certifications-tab" data-bs-toggle="pill" data-bs-target="#v-pills-volunteering" type="button" role="tab" aria-controls="v-pills-volunteering" aria-selected="false">Volunteering</button>
                                <button class="nav-link text-truncate border mb-1" id="v-pills-certifications-tab" data-bs-toggle="pill" data-bs-target="#v-pills-honours" type="button" role="tab" aria-controls="v-pills-honours" aria-selected="false">Honours & Awards</button>
                                <button class="nav-link text-truncate border mb-1" id="v-pills-certifications-tab" data-bs-toggle="pill" data-bs-target="#v-pills-languages" type="button" role="tab" aria-controls="v-pills-languages" aria-selected="false">Languages</button>
                                <button class="nav-link text-truncate border mb-1" id="v-pills-certifications-tab" data-bs-toggle="pill" data-bs-target="#v-pills-career-break" type="button" role="tab" aria-controls="v-pills-career-break" aria-selected="false">Career Break</button>
                                <button class="nav-link text-truncate border mb-1" id="v-pills-certifications-tab" data-bs-toggle="pill" data-bs-target="#v-pills-compliance" type="button" role="tab" aria-controls="v-pills-compliance" aria-selected="false">Compliance</button>

                              </div>
                              <div class="tab-content w-100 pt-0" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-skills-other-skills" role="tabpanel" aria-labelledby="v-pills-skills-other-skills-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card rounded-0 mb-1">
                                                <div class="card-header p-2">
                                                    <h5 class="card-title">Skills</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        @if($professional_profile->skills==null || $professional_profile->skills->count()<1)
                                                        <div class="col-12">
                                                            <p>No Skill found against this profile</p>
                                                        </div>
                                                        @else
                                                            @foreach($professional_profile->skills as $skill)
                                                                <div class="col text-truncate">
                                                                    <span class="rounded bg-secondary ps-2 pe-2 text-white">{{$skill->title}}</span>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card rounded-0 mb-1">
                                                <div class="card-header p-2">
                                                    <h5 class="card-title">Other Skills</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        @if($professional_profile->other_skills==null || $professional_profile->other_skills->count()<1)
                                                        <div class="col-12">
                                                            <p>No Skill found against this profile</p>
                                                        </div>
                                                        @else
                                                            @foreach($professional_profile->other_skills as $oher_skill)
                                                                <div class="col text-truncate">
                                                                    <span class="rounded bg-secondary ps-2 pe-2 text-white">{{$oher_skill->title}}</span>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-tools-other-tools" role="tabpanel" aria-labelledby="v-pills-tools-other-tools-tab">

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card rounded-0 mb-1">
                                                <div class="card-header p-2">
                                                    <h5 class="card-title">Tools</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        @if($professional_profile->tools==null || $professional_profile->tools->count()<1)
                                                        <div class="col-12">
                                                            <p>No Tool found against this profile</p>
                                                        </div>
                                                        @else
                                                            @foreach($professional_profile->tools as $tool)
                                                                <div class="col text-truncate">
                                                                    <span class="rounded bg-secondary ps-2 pe-2 text-white">{{$tool->title}}</span>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="card rounded-0 mb-1">
                                                <div class="card-header p-2">
                                                    <h5 class="card-title">Other Tools</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        @if($professional_profile->other_tools==null || $professional_profile->other_tools->count()<1)
                                                        <div class="col-12">
                                                            <p>No Tool found against this profile</p>
                                                        </div>
                                                        @else
                                                            @foreach($professional_profile->other_tools as $oher_tool)
                                                                <div class="col text-truncate">
                                                                    <span class="rounded bg-secondary ps-2 pe-2 text-white">{{$oher_tool->title}}</span>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="v-pills-projects" role="tabpanel" aria-labelledby="v-pills-projects-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card rounded-0 mb-1">
                                                <div class="card-header p-2">
                                                    <h5 class="card-title">Projects</h5>
                                                </div>
                                                <div class="card-body">
                                                        @if($professional_profile->projects==null || $professional_profile->projects->count()<1)
                                                            <p class="text-center">No Project found against this profile</p>
                                                        @else
                                                            @foreach($professional_profile->projects as $project)
                                                                <div class="row mb-1 align-items-center">
                                                                    <div class="col-10 d-flex flex-wrap">
                                                                        <div class="w-100">
                                                                            <h5 class="text-capitalize text-center text-bold">{{$project->project_title}}</h5>
                                                                            <p>{{$project->project_description}}</p>
                                                                        </div>
                                                                        <div class="form-group me-3">
                                                                            <label class="fw-bold" for="">Project Title</label>
                                                                            <p >{{$project->project_title}}</p>
                                                                        </div>
                                                                        <div class="form-group me-3">
                                                                            <label class="fw-bold" for="">Project Tage Line</label>
                                                                            <p >{{$project->project_tage_line}}</p>
                                                                        </div>

                                                                        <div class="form-group me-3">
                                                                            <label class="fw-bold" for="">Project Link </label>
                                                                            <a class="nav-link" href="{{$project->project_link}}"><i class="fas fa-external-link-alt"></i> {{$project->project_link}}</a>
                                                                        </div>

                                                                        <div class="form-group me-3">
                                                                            <label class="fw-bold" for="">Workspace Name</label>
                                                                            <p >{{$project->workplace_name}}</p>
                                                                        </div>
                                                                        <div class="form-group me-3">
                                                                            <label class="fw-bold" for="">County Name</label>
                                                                            <p >{{$project->country_name}}</p>
                                                                        </div>
                                                                        <div class="form-group me-3">
                                                                            <label class="fw-bold" for="">City Name</label>
                                                                            <p >{{$project->city_name}}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-2">
                                                                        <img width="150px" height="150px" class="rounded border p-1 m-1" src="{{$project->project_cover_image}}" alt="">
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-publications" role="tabpanel" aria-labelledby="v-pills-publications-tab">...</div>
                                <div class="tab-pane fade" id="v-pills-patents" role="tabpanel" aria-labelledby="v-pills-patents-tab">...</div>
                                <div class="tab-pane fade" id="v-pills-conference" role="tabpanel" aria-labelledby="v-pills-conference-tab">...</div>
                                <div class="tab-pane fade" id="v-pills-articles" role="tabpanel" aria-labelledby="v-pills-articles-tab">...</div>
                                <div class="tab-pane fade" id="v-pills-experience" role="tabpanel" aria-labelledby="v-pills-experience-tab">...</div>
                                <div class="tab-pane fade" id="v-pills-education" role="tabpanel" aria-labelledby="v-pills-education-tab">...</div>
                                <div class="tab-pane fade" id="v-pills-courses" role="tabpanel" aria-labelledby="v-pills-courses-tab">...</div>
                                <div class="tab-pane fade" id="v-pills-certifications" role="tabpanel" aria-labelledby="v-pills-certifications-tab">...</div>
                                <div class="tab-pane fade" id="v-pills-volunteering" role="tabpanel" aria-labelledby="v-pills-volunteering-tab">...</div>
                                <div class="tab-pane fade" id="v-pills-honours" role="tabpanel" aria-labelledby="v-pills-honours-tab">...</div>
                                <div class="tab-pane fade" id="v-pills-languages" role="tabpanel" aria-labelledby="v-pills-languages-tab">...</div>
                                <div class="tab-pane fade" id="v-pills-career-break" role="tabpanel" aria-labelledby="v-pills-career-break-tab">...</div>
                                <div class="tab-pane fade" id="v-pills-compliance" role="tabpanel" aria-labelledby="v-pills-compliance-tab">...</div>
                              </div>
                            </div>
                                @endif
                            </div>
                            <div role="tabpanel" id="tab-6" class="tab-pane fade">
                                Business Profile
                            </div>
                            <div role="tabpanel" id="tab-7" class="tab-pane fade">
                                Investor Profile
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Wrapper -->
@endsection
@section('js')
<script type="text/javascript">
$(document).ready(function() {
    function is_verified() {
       if($("#is_verified").val()==0){
            $("#verified_badge").attr('disabled', true);
       }else{
            $("#verified_badge").attr('disabled', false);
       }
    }
    is_verified();

$(document).on('change', '#is_verified', function(e) {

        var vlu=$(this).val();
        var old_value=0;
        if(vlu==0){
            old_value=1;
        }

      Swal.fire({
        title: 'Are you sure you want to update the verification status of the user',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        icon: 'question',
      }).then((result) => {
        if(result.isConfirmed){
            is_verified();
            $(this).parent().submit();
        }else{
           $(this).val(old_value);
        }
    });

});

$(document).on('change', '#verified_badge', function() {
      Swal.fire({
        title: 'Are you sure you want to update the verification badge of the user',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        icon: 'question',
      }).then((result) => {
        if(result.isConfirmed){
            $(this).parent().submit();
        }else{
            location.reload();
        }
    });
  });

});
</script>
@endsection