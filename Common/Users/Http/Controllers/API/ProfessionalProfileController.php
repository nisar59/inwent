<?php

namespace Common\Users\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Common\Countries\Entities\Countries;
use Common\Users\Entities\BasicProfile;
use Common\Users\Entities\BusinessProfile;
use Common\Users\Entities\ProfessionalProfile;
use Common\Users\Entities\ProfessionalProfileAwards;
use Common\Users\Entities\ProfessionalProfileArticles;
use Common\Users\Entities\ProfessionalProfileCareerBreak;
use Common\Users\Entities\ProfessionalProfileCertifications;
use Common\Users\Entities\ProfessionalProfileCourses;
use Common\Users\Entities\ProfessionalProfileEducation;
use Common\Users\Entities\ProfessionalProfileLanguages;
use Common\Users\Entities\ProfessionalProfileVolunteering;
use Common\Users\Entities\ProfessionalProfileWorkExperiences;
use Common\Users\Entities\ProfessionalProfileConferences;
use Common\Users\Entities\ProfessionalProfilePatentDetails;
use Common\Users\Entities\ProfessionalProfileProjects;
use Common\Users\Entities\ProfessionalProfilePublications;
use Common\Users\Entities\ProfessionalProfileCompliance;
use Common\ProfessionalSkills\Entities\ProfessionalSkills;
use Common\ProfessionalTools\Entities\ProfessionalTools;
use Common\Languages\Entities\Languages;
use Common\Draft\Entities\Draft;
use App\Models\User;
use Throwable;
use Auth;
use DB;
class ProfessionalProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        
    }



    public function professionalProfile()
    {

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $professional_profile=ProfessionalProfile::with('projects', 'publications', 'patents', 'conferences', 'articles' ,'experience', 'education', 'courses', 'certificates', 'volunteerings', 'awards', 'languages', 'breaks', 'compliances')->where(['user_id'=>$user_id])->first();

            $countries=Countries::all();
            $skills=ProfessionalSkills::where(['status'=>1, 'type'=>0])->get();
            $other_skills=ProfessionalSkills::where(['status'=>1, 'type'=>1])->get();

            $tools=ProfessionalTools::where(['status'=>1,'type'=>0])->get();
            $other_tools=ProfessionalTools::where(['status'=>1,'type'=>1])->get();
            $languages=Languages::all();

            $data=[
                'skills'=>$skills,
                'other_skills'=>$other_skills,

                'tools'=>$tools,
                'other_tools'=>$other_tools,

                'countries'=>$countries,
                'languages'=>$languages,

                'user'=>Auth::user(),
                'professional_profile'=>$professional_profile
            ];

            $res=['success'=>true,'message'=>'Professional profile successfully fetched','errors'=>[],'data'=>$data];
             return response()->json($res);
        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }       
    }



    public function professionalProfileBySlug($slug)
    {

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          
            $user=User::where('slug', $slug)->first(); 

            if($user==null){
            $res=['success'=>true,'message'=>'User not found','errors'=>[],'data'=>null];

            }else{
                $basic_profile=BasicProfile::where(['user_id'=>$user->id])->first();
                $professional_profile=ProfessionalProfile::with('projects', 'publications', 'patents', 'conferences', 'articles' ,'experience', 'education', 'courses', 'certificates', 'volunteerings', 'awards', 'languages', 'breaks', 'compliances')->where(['user_id'=>$user_id])->first();  
                              
                $data=[
                    'user'=>$user,
                    'basic_profile'=>$basic_profile,
                    'professional_profile'=>$professional_profile,
                ];

                $res=['success'=>true,'message'=>'Basic profile successfully fetched','errors'=>[],'data'=>$data];
            }

             return response()->json($res);
        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        }       
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('users::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('users::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function professionalProfileUpdate(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $professional_profile=ProfessionalProfile::firstOrNew(['user_id'=>$user_id]);

            $inputs=$req->except('skills_tags', 'skills_other_tags', 'tools_tags', 'tools_other_tags');
            if($req->has('skills_tags')){
                $inputs['skills_tags']=json_encode($req->skills_tags);
            }
            if($req->has('skills_other_tags')){
                $inputs['skills_other_tags']=json_encode($req->skills_other_tags);
            }
            if($req->has('tools_tags')){
                $inputs['tools_tags']=json_encode($req->tools_tags);
            }
            if($req->has('tools_other_tags')){
                $inputs['tools_other_tags']=json_encode($req->tools_other_tags);
            }


            $professional_profile->fill($inputs);
            $professional_profile->save();
            $data=[
                'user'=>Auth::user(),
                'professional_profile'=>$professional_profile
            ];

            $res=['success'=>true,'message'=>'Professional profile successfully updated','errors'=>[],'data'=>$data];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        } 
    }




    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function professionalProfileAwardsUpdate(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id());

            $pp=ProfessionalProfile::where('user_id', $user_id)->first();

            if($pp==null){
                $res=['success'=>false,'message'=>'Something went wrong, please refresh and try again','errors'=>[],'data'=>null];
                return response()->json($res);
            }
            /*Need to be changed start*/

            $ppa=ProfessionalProfileAwards::where('user_id', $user_id)->where('professional_profile_id', $pp->id);
            if($ppa->count()>0){
                $ppa->delete();
            }

            foreach($req->awardsDetails as $key => $award){
                $award['user_id']=$user_id;
                $award['professional_profile_id']=$pp->id;
                ProfessionalProfileAwards::create($award);
            }

            /*Need to be changed end*/

            $professional_profile=ProfessionalProfile::where('user_id',$user_id)->first();
            $data=[
                'user'=>Auth::user(),
                'professional_profile'=>$professional_profile
            ];

            $res=['success'=>true,'message'=>'Professional profile successfully updated','errors'=>[],'data'=>$data];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        } 
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */

    /*Professional Profile Articles*/
    public function professionalProfileArticlesUpdate(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id());

            $pp=ProfessionalProfile::where('user_id', $user_id)->first();

            if($pp==null){
                $res=['success'=>false,'message'=>'Something went wrong, please refresh and try again','errors'=>[],'data'=>null];
                return response()->json($res);
            }

            /*Need to be changed start*/

            $ppa=ProfessionalProfileArticles::where('user_id', $user_id)->where('professional_profile_id', $pp->id);
            if($ppa->count()>0){
                $ppa->delete();
            }

            foreach($req->articlesDetails as $key => $article){
                $article['user_id']=$user_id;
                $article['professional_profile_id']=$pp->id;
                ProfessionalProfileArticles::create($article);
            }

            /*Need to be changed end*/

            $professional_profile_art=ProfessionalProfileArticles::where('user_id',$user_id)->first();
            $data=[
                'user'=>Auth::user(),
                'professional_profile_art'=>$professional_profile_art
            ];

            $res=['success'=>true,'message'=>'Professional profile successfully updated','errors'=>[],'data'=>$data];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        } 
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    /*Professional ProfileCareer Break*/
    public function professionalProfileCareerBreakUpdate(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id());

            $pp=ProfessionalProfile::where('user_id', $user_id)->first();

            if($pp==null){
                $res=['success'=>false,'message'=>'Something went wrong, please refresh and try again','errors'=>[],'data'=>null];
                return response()->json($res);
            }

            /*Need to be changed start*/
            $ppa=ProfessionalProfileCareerBreak::where('user_id', $user_id)->where('professional_profile_id', $pp->id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->breaksDetails as $key => $brk){
                $brk['user_id']=$user_id;
                $brk['professional_profile_id']=$pp->id;
                ProfessionalProfileCareerBreak::create($brk);
            }
            /*Need to be changed end*/

            $professional_profile_art=ProfessionalProfileArticles::where('user_id',$user_id)->first();
            $data=[
                'user'=>Auth::user(),
                'professional_profile_art'=>$professional_profile_art
            ];

            $res=['success'=>true,'message'=>'Professional profile successfully updated','errors'=>[],'data'=>$data];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        } 
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    /*Professional compliance*/
    public function professionalProfileComplianceUpdate(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id());

            $pp=ProfessionalProfile::where('user_id', $user_id)->first();

            if($pp==null){
                $res=['success'=>false,'message'=>'Something went wrong, please refresh and try again','errors'=>[],'data'=>null];
                return response()->json($res);
            }

            /*Need to be changed start*/
            $ppa=ProfessionalProfileCompliance::where('user_id', $user_id)->where('professional_profile_id', $pp->id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->complianceDetails as $key => $brk){
                $brk['user_id']=$user_id;
                $brk['professional_profile_id']=$pp->id;
                ProfessionalProfileCompliance::create($brk);
            }
            /*Need to be changed end*/

            $professional_profile_art=ProfessionalProfileArticles::where('user_id',$user_id)->first();
            $data=[
                'user'=>Auth::user(),
                'professional_profile_art'=>$professional_profile_art
            ];

            $res=['success'=>true,'message'=>'Professional profile successfully updated','errors'=>[],'data'=>$data];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        } 
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function professionalProfileCertificationsUpdate(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id());
            
            $pp=ProfessionalProfile::where('user_id', $user_id)->first();

            if($pp==null){
                $res=['success'=>false,'message'=>'Something went wrong, please refresh and try again','errors'=>[],'data'=>null];
                return response()->json($res);
            }

            /*Need to be changed start*/
            $ppa=ProfessionalProfileCertifications::where('user_id', $user_id)->where('professional_profile_id', $pp->id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->certificatesDetails as $key => $cert){
                $cert['user_id']=$user_id;
                $cert['professional_profile_id']=$pp->id;
                ProfessionalProfileCertifications::create($cert);
            }
            /*Need to be changed end*/

            $professional_profile_art=ProfessionalProfileCertifications::where('user_id',$user_id)->first();
            $data=[
                'user'=>Auth::user(),
                'professional_profile_art'=>$professional_profile_art
            ];

            $res=['success'=>true,'message'=>'Professional profile successfully updated','errors'=>[],'data'=>$data];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        } 
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function professionalProfileCoursesUpdate(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id());
            
            $pp=ProfessionalProfile::where('user_id', $user_id)->first();

            if($pp==null){
                $res=['success'=>false,'message'=>'Something went wrong, please refresh and try again','errors'=>[],'data'=>null];
                return response()->json($res);
            }

            /*Need to be changed start*/
            $ppa=ProfessionalProfileCourses::where('user_id', $user_id)->where('professional_profile_id', $pp->id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->courseDetails as $key => $course){
                $course['user_id']=$user_id;
                $course['professional_profile_id']=$pp->id;
                ProfessionalProfileCourses::create($course);
            }
            /*Need to be changed end*/

            $professional_profile_cor=ProfessionalProfileCourses::where('user_id',$user_id)->first();
            $data=[
                'user'=>Auth::user(),
                'professional_profile_cor'=>$professional_profile_cor
            ];

            $res=['success'=>true,'message'=>'Professional profile successfully updated','errors'=>[],'data'=>$data];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        } 
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function professionalProfileEducationUpdate(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id());

            $pp=ProfessionalProfile::where('user_id', $user_id)->first();

            if($pp==null){
                $res=['success'=>false,'message'=>'Something went wrong, please refresh and try again','errors'=>[],'data'=>null];
                return response()->json($res);
            }

            /*Need to be changed start*/
            $ppa=ProfessionalProfileEducation::where('user_id', $user_id)->where('professional_profile_id', $pp->id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->educationDetails as $key => $edu){
                $edu['user_id']=$user_id;
                $edu['professional_profile_id']=$pp->id;
                ProfessionalProfileEducation::create($edu);
            }
            /*Need to be changed end*/

            $professional_profile_edu=ProfessionalProfileEducation::where('user_id',$user_id)->first();
            $data=[
                'user'=>Auth::user(),
                'professional_profile_edu'=>$professional_profile_edu
            ];

            $res=['success'=>true,'message'=>'Professional profile successfully updated','errors'=>[],'data'=>$data];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        } 
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function professionalProfileLanguagesUpdate(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id());

            $pp=ProfessionalProfile::where('user_id', $user_id)->first();

            if($pp==null){
                $res=['success'=>false,'message'=>'Something went wrong, please refresh and try again','errors'=>[],'data'=>null];
                return response()->json($res);
            }
            /*Need to be changed start*/
            $ppa=ProfessionalProfileLanguages::where('user_id', $user_id)->where('professional_profile_id', $pp->id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->languagesDetails as $key => $lng){
                $lng['user_id']=$user_id;
                $lng['professional_profile_id']=$pp->id;
                ProfessionalProfileLanguages::create($lng);
            }
            /*Need to be changed end*/

            $professional_profile_lag=ProfessionalProfileLanguages::where('user_id',$user_id)->first();
            $data=[
                'user'=>Auth::user(),
                'professional_profile_lag'=>$professional_profile_lag
            ];

            $res=['success'=>true,'message'=>'Professional profile successfully updated','errors'=>[],'data'=>$data];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        } 
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function professionalProfileVolunteeringUpdate(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id());

            $pp=ProfessionalProfile::where('user_id', $user_id)->first();

            if($pp==null){
                $res=['success'=>false,'message'=>'Something went wrong, please refresh and try again','errors'=>[],'data'=>null];
                return response()->json($res);
            }
            /*Need to be changed start*/
            $ppa=ProfessionalProfileVolunteering::where('user_id', $user_id)->where('professional_profile_id', $pp->id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->volunteeringsDetails as $key => $vltr){
                $vltr['user_id']=$user_id;
                $vltr['professional_profile_id']=$pp->id;
                ProfessionalProfileVolunteering::create($vltr);
            }
            /*Need to be changed end*/

            $professional_profile_vol=ProfessionalProfileVolunteering::where('user_id',$user_id)->first();
            $data=[
                'user'=>Auth::user(),
                'professional_profile_vol'=>$professional_profile_vol
            ];

            $res=['success'=>true,'message'=>'Professional profile successfully updated','errors'=>[],'data'=>$data];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        } 
    }
     /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
     public function professionalProfileWorkExperiencesUpdate(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id());

            $pp=ProfessionalProfile::where('user_id', $user_id)->first();

            if($pp==null){
                $res=['success'=>false,'message'=>'Something went wrong, please refresh and try again','errors'=>[],'data'=>null];
                return response()->json($res);
            }
            /*Need to be changed start*/
            $ppa=ProfessionalProfileWorkExperiences::where('user_id', $user_id)->where('professional_profile_id', $pp->id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->experienceDetails as $key => $exp){
                $exp['user_id']=$user_id;
                $exp['professional_profile_id']=$pp->id;

                if($exp['remote_work']){
                    $exp['skills']=json_encode($exp['skills']);
                    $exp['tools']=json_encode($exp['tools']);
                }else{
                    $exp['skills']='';
                    $exp['tools']='';

                    $exp['primary_role']='';
                    $exp['job_duties']='';
                    $exp['project_description']='';
                    $exp['workplace_name']='';
                }

                ProfessionalProfileWorkExperiences::create($exp);
            }
            /*Need to be changed end*/

            $professional_profile_work=ProfessionalProfileWorkExperiences::where('user_id',$user_id)->first();
            $data=[
                'user'=>Auth::user(),
                'professional_profile_work'=>$professional_profile_work
            ];

            $res=['success'=>true,'message'=>'Professional profile successfully updated','errors'=>[],'data'=>$data];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        } 
    }
     /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    
      public function professionalProfileConferencesUpdate(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id());
            
            $pp=ProfessionalProfile::where('user_id', $user_id)->first();

            if($pp==null){
                $res=['success'=>false,'message'=>'Something went wrong, please refresh and try again','errors'=>[],'data'=>null];
                return response()->json($res);
            }

            /*Need to be changed start*/
            $ppa=ProfessionalProfileConferences::where('user_id', $user_id)->where('professional_profile_id', $pp->id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->conferenceDetails as $key => $conference){
                $conference['user_id']=$user_id;
                $conference['professional_profile_id']=$pp->id;

                ProfessionalProfileConferences::create($conference);
            }
            /*Need to be changed end*/

            $professional_profile_con=ProfessionalProfileConferences::where('user_id',$user_id)->first();
            $data=[
                'user'=>Auth::user(),
                'professional_profile_con'=>$professional_profile_con
            ];

            $res=['success'=>true,'message'=>'Professional profile successfully updated','errors'=>[],'data'=>$data];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        } 
    }
     /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
       public function professionalProfilePatentDetailsUpdate(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id());

            $pp=ProfessionalProfile::where('user_id', $user_id)->first();

            if($pp==null){
                $res=['success'=>false,'message'=>'Something went wrong, please refresh and try again','errors'=>[],'data'=>null];
                return response()->json($res);
            }

            /*Need to be changed start*/
            $ppa=ProfessionalProfilePatentDetails::where('user_id', $user_id)->where('professional_profile_id', $pp->id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->patentDetails as $key => $award){
                $award['user_id']=$user_id;
                $award['professional_profile_id']=$pp->id;
                ProfessionalProfilePatentDetails::create($award);
            }
            /*Need to be changed end*/

            $professional_profile_parent=ProfessionalProfilePatentDetails::where('user_id',$user_id)->first();
            $data=[
                'user'=>Auth::user(),
                'professional_profile_parent'=>$professional_profile_parent
            ];

            $res=['success'=>true,'message'=>'Professional profile successfully updated','errors'=>[],'data'=>$data];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        } 
    }
     /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
     public function professionalProfileProjectsUpdate(Request $req)
    {

        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id());

            $pp=ProfessionalProfile::where('user_id', $user_id)->first();

            if($pp==null){
                $res=['success'=>false,'message'=>'Something went wrong, please refresh and try again','errors'=>[],'data'=>null];
                return response()->json($res);
            }

            /*Need to be changed start*/
            $ppa=ProfessionalProfileProjects::where('user_id', $user_id)->where('professional_profile_id', $pp->id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            
            foreach($req->projectDetails as $key => $project){
                $project['user_id']=$user_id;
                $project['professional_profile_id']=$pp->id;
                ProfessionalProfileProjects::create($project);

                $draft=Draft::where('media_file', $project['project_cover_image']);
                if($draft->count()>0){
                    $draft->delete();
                }
            }
            /*Need to be changed end*/

            $professional_profile_pro=ProfessionalProfileProjects::where('user_id',$user_id)->first();
            $data=[
                'user'=>Auth::user(),
                'professional_profile_pro'=>$professional_profile_pro
            ];

            $res=['success'=>true,'message'=>'Professional profile successfully updated','errors'=>[],'data'=>$data];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        } 
    }
      /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
     public function professionalProfilePublicationsUpdate(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id());
            $pp=ProfessionalProfile::where('user_id', $user_id)->first();

            if($pp==null){
                $res=['success'=>false,'message'=>'Something went wrong, please refresh and try again','errors'=>[],'data'=>null];
                return response()->json($res);
            }

            /*Need to be changed start*/
            $ppp=ProfessionalProfilePublications::where('user_id', $user_id)->where('professional_profile_id', $pp->id);
            if($ppp->count()>0){
                $ppp->delete();
            }
            
            foreach($req->publications as $publication){
                $publication['user_id']=$user_id;
                $publication['professional_profile_id']=$pp->id;
                ProfessionalProfilePublications::create($publication);
            }
            /*Need to be changed end*/

            $professional_profile_pro=ProfessionalProfilePublications::where('user_id',$user_id)->first();
            $data=[
                'user'=>Auth::user(),
                'professional_profile_pro'=>$professional_profile_pro
            ];

            $res=['success'=>true,'message'=>'Professional profile successfully updated','errors'=>[],'data'=>$data];
            DB::commit();
             return response()->json($res);
        } catch (Exception $e) {
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                DB::rollback();
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        } 
    }
}
