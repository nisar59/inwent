<?php

namespace Common\Users\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
        $req->validate([
            'profile_status'=>'required',
            'regulatory_compliance'=>'required',
            'agree_to_terms'=>'required',
            'agree_to_get_offers'=>'required'
        ]);
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=Decrypt(Auth::id()); 

            $professional_profile=ProfessionalProfile::firstOrNew(['user_id'=>$user_id]);

            $inputs=$req->except('skills_tags', 'skills_other_tags', 'tools_tags', 'tools_other_tags');

            $inputs['skills_tags']=json_encode($req->skills_tags);
            $inputs['skills_other_tags']=json_encode($req->skills_other_tags);
            $inputs['tools_tags']=json_encode($req->tools_tags);
            $inputs['tools_other_tags']=json_encode($req->tools_other_tags);



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
    public function professionalProfileAwardsUpdate(Request $req, $id)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=Decrypt(Auth::id());

            /*Need to be changed start*/

            $ppa=ProfessionalProfileAwards::where('user_id', $user_id)->where('professional_profile_id', $id);
            if($ppa->count()>0){
                $ppa->delete();
            }

            foreach($req->title as $key => $award){
                ProfessionalProfileAwards::create([
                    'user_id'=>$user_id,
                    'professional_profile_id'=>$id,
                    'title'=>$award,
                    'awarded_by'=>$req->awarded_by[$key],
                    'type'=>$req->type[$key],
                    'awarded_year'=>$req->awarded_year[$key],
                ]);
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
    public function professionalProfileArticlesUpdate(Request $req, $id)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=Decrypt(Auth::id());

            /*Need to be changed start*/

            $ppa=ProfessionalProfileArticles::where('user_id', $user_id)->where('professional_profile_id', $id);
            if($ppa->count()>0){
                $ppa->delete();
            }

            foreach($req->article_title as $key => $award){
                ProfessionalProfileArticles::create([
                    'user_id'=>$user_id,
                    'professional_profile_id'=>$id,
                    'article_title'=>$award,
                    'event_organizer'=>$req->event_organizer[$key],
                    'article_abstract'=>$req->article_abstract[$key],
                    'article_cover_image'=>$req->article_cover_image[$key],
                    'article_link'=>$req->article_link[$key],
                    'article_tags'=>$req->article_tags[$key],
                    'article_tag_line'=>$req->article_tag_line[$key],
                    'workplace_name'=>$req->workplace_name[$key],
                    'country_id'=>$req->country_id[$key],
                    'city_id'=>$req->city_id[$key],
                ]);
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
    public function professionalProfileCareerBreakUpdate(Request $req, $id)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=Decrypt(Auth::id());
            /*Need to be changed start*/
            $ppa=ProfessionalProfileCareerBreak::where('user_id', $user_id)->where('professional_profile_id', $id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->reason as $key => $award){
                ProfessionalProfileCareerBreak::create([
                    'user_id'=>$user_id,
                    'professional_profile_id'=>$id,
                    'reason'=>$award,
                    'start_date'=>$req->start_date[$key],
                    'end_date'=>$req->end_date[$key],
                    'currently_on_break'=>$req->currently_on_break[$key],
                ]);
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
    public function professionalProfileCertificationsUpdate(Request $req, $id)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=Decrypt(Auth::id());
            /*Need to be changed start*/
            $ppa=ProfessionalProfileCertifications::where('user_id', $user_id)->where('professional_profile_id', $id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->certificate_title as $key => $award){
                ProfessionalProfileCertifications::create([
                    'user_id'=>$user_id,
                    'professional_profile_id'=>$id,
                    'certificate_title'=>$award,
                    'others'=>$req->others[$key],
                    'certificate_name'=>$req->certificate_name[$key],
                    'issued_by'=>$req->issued_by[$key],
                    'certificate_number'=>$req->certificate_number[$key],
                    'validity_start_date'=>$req->validity_start_date[$key],
                    'validity_end_date'=>$req->validity_end_date[$key],
                    'no_expiry'=>$req->no_expiry[$key],
                ]);
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
    public function professionalProfileCoursesUpdate(Request $req, $id)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=Decrypt(Auth::id());
            /*Need to be changed start*/
            $ppa=ProfessionalProfileCourses::where('user_id', $user_id)->where('professional_profile_id', $id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->course_title as $key => $award){
                ProfessionalProfileCourses::create([
                    'user_id'=>$user_id,
                    'professional_profile_id'=>$id,
                    'course_title'=>$award,
                    'issued_by'=>$req->issued_by[$key],
                    'course_description'=>$req->course_description[$key],
                    'start_date'=>$req->start_date[$key],
                    'end_date'=>$req->end_date[$key],
                    'currently_enrolled'=>$req->currently_enrolled[$key],
                ]);
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
    public function professionalProfileEducationUpdate(Request $req, $id)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=Decrypt(Auth::id());
            /*Need to be changed start*/
            $ppa=ProfessionalProfileEducation::where('user_id', $user_id)->where('professional_profile_id', $id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->institute_name as $key => $award){
                ProfessionalProfileEducation::create([
                    'user_id'=>$user_id,
                    'professional_profile_id'=>$id,
                    'institute_name'=>$award,
                    'others'=>$req->others[$key],
                    'degree_cert_diploma_title'=>$req->degree_cert_diploma_title[$key],
                    'degree_cert_diploma_type'=>$req->degree_cert_diploma_type[$key],
                    'field_of_study'=>$req->field_of_study[$key],
                    'start_date'=>$req->start_date[$key],
                    'end_date'=>$req->end_date[$key],
                    'currently_enrolled'=>$req->currently_enrolled[$key],
                    'workplace_name'=>$req->workplace_name[$key],
                    'country_id'=>$req->country_id[$key],
                    'state_id'=>$req->state_id[$key],
                    'city_id'=>$req->city_id[$key],
                ]);
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
    public function professionalProfileLanguagesUpdate(Request $req, $id)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=Decrypt(Auth::id());
            /*Need to be changed start*/
            $ppa=ProfessionalProfileLanguages::where('user_id', $user_id)->where('professional_profile_id', $id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->language as $key => $award){
                ProfessionalProfileLanguages::create([
                    'user_id'=>$user_id,
                    'professional_profile_id'=>$id,
                    'language'=>$award,
                    'language_level'=>$req->language_level[$key],
                    'description'=>$req->description[$key],
                ]);
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
    public function professionalProfileVolunteeringUpdate(Request $req, $id)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=Decrypt(Auth::id());
            /*Need to be changed start*/
            $ppa=ProfessionalProfileVolunteering::where('user_id', $user_id)->where('professional_profile_id', $id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->role as $key => $award){
                ProfessionalProfileVolunteering::create([
                    'user_id'=>$user_id,
                    'professional_profile_id'=>$id,
                    'role'=>$award,
                    'others'=>$req->others[$key],
                    'organization'=>$req->organization[$key],
                    'description'=>$req->description[$key],
                    'validity_start_date'=>$req->validity_start_date[$key],
                    'validity_end_date'=>$req->validity_end_date[$key],
                    'no_expiry'=>$req->no_expiry[$key],
                ]);
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
     public function professionalProfileWorkExperiencesUpdate(Request $req, $id)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=Decrypt(Auth::id());
            /*Need to be changed start*/
            $ppa=ProfessionalProfileWorkExperiences::where('user_id', $user_id)->where('professional_profile_id', $id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->job_title as $key => $award){
                ProfessionalProfileWorkExperiences::create([
                    'user_id'=>$user_id,
                    'professional_profile_id'=>$id,
                    'job_title'=>$award,
                    'company_name'=>$req->company_name[$key],
                    'company_website'=>$req->company_website[$key],
                    'start_date'=>$req->start_date[$key],
                    'end_date'=>$req->end_date[$key],
                    'work_email'=>$req->work_email[$key],
                    'work_type'=>$req->work_type[$key],
                    'country_id'=>$req->country_id[$key],
                    'state_id'=>$req->state_id[$key],
                    'city_id'=>$req->city_id[$key],
                    'primary_role'=>$req->primary_role[$key],
                    'job_duties'=>$req->job_duties[$key],
                    'project_description'=>$req->project_description[$key],
                    'workplace_name'=>$req->workplace_name[$key],
                    'remote_work'=>$req->remote_work[$key],
                    'skills'=>$req->skills[$key],
                    'tools'=>$req->tools[$key],
                ]);
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
    
      public function professionalProfileConferencesUpdate(Request $req, $id)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=Decrypt(Auth::id());
            /*Need to be changed start*/
            $ppa=ProfessionalProfileConferences::where('user_id', $user_id)->where('professional_profile_id', $id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->presentation_title as $key => $award){
                ProfessionalProfileConferences::create([
                    'user_id'=>$user_id,
                    'professional_profile_id'=>$id,
                    'presentation_title'=>$award,
                    'status'=>$req->status[$key],
                    'event_organizer'=>$req->event_organizer[$key],
                    'presentation_abstract'=>$req->presentation_abstract[$key],
                    'presentation_cover_image'=>$req->presentation_cover_image[$key],
                    'presentation_link'=>$req->presentation_link[$key],
                    'presentation_tags'=>$req->presentation_tags[$key],
                    'presentation_tag_line'=>$req->presentation_tag_line[$key],
                    'workplace_name'=>$req->workplace_name[$key],
                    'country_id'=>$req->country_id[$key],
                    'city_id'=>$req->city_id[$key],
                ]);
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
       public function professionalProfilePatentDetailsUpdate(Request $req, $id)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=Decrypt(Auth::id());
            /*Need to be changed start*/
            $ppa=ProfessionalProfilePatentDetails::where('user_id', $user_id)->where('professional_profile_id', $id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->patent_title as $key => $award){
                ProfessionalProfilePatentDetails::create([
                    'user_id'=>$user_id,
                    'professional_profile_id'=>$id,
                    'patent_title'=>$award,
                    'status'=>$req->status[$key],
                    'patent_number'=>$req->patent_number[$key],
                    'patent_abstract'=>$req->patent_abstract[$key],
                    'patent_cover_image'=>$req->patent_cover_image[$key],
                    'patent_link'=>$req->patent_link[$key],
                    'patent_tags'=>$req->patent_tags[$key],
                    'patent_tag_line'=>$req->patent_tag_line[$key],
                    'workplace_name'=>$req->workplace_name[$key],
                    'country_id'=>$req->country_id[$key],
                    'city_id'=>$req->city_id[$key],
                ]);
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
     public function professionalProfileProjectsUpdate(Request $req, $id)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=Decrypt(Auth::id());
            /*Need to be changed start*/
            $ppa=ProfessionalProfileProjects::where('user_id', $user_id)->where('professional_profile_id', $id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->project_title as $key => $award){
                ProfessionalProfileProjects::create([
                    'user_id'=>$user_id,
                    'professional_profile_id'=>$id,
                    'project_title'=>$award,
                    'project_tage_line'=>$req->project_tage_line[$key],
                    'project_cover_image'=>$req->project_cover_image[$key],
                    'project_link'=>$req->project_link[$key],
                    'project_tags'=>$req->project_tags[$key],
                    'project_description'=>$req->project_description[$key],
                    'workplace_name'=>$req->workplace_name[$key],
                    'country_id'=>$req->country_id[$key],
                    'city_id'=>$req->city_id[$key],
                ]);
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
     public function professionalProfilePublicationsUpdate(Request $req, $id)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=Decrypt(Auth::id());
            /*Need to be changed start*/
            $ppa=ProfessionalProfilePublications::where('user_id', $user_id)->where('professional_profile_id', $id);
            if($ppa->count()>0){
                $ppa->delete();
            }
            foreach($req->publication_title as $key => $award){
                ProfessionalProfilePublications::create([
                    'user_id'=>$user_id,
                    'professional_profile_id'=>$id,
                    'publication_title'=>$award,
                    'publication_abstract'=>$req->publication_abstract[$key],
                    'publication_cover_image'=>$req->publication_cover_image[$key],
                    'publication_link'=>$req->publication_link[$key],
                    'publication_tags'=>$req->publication_tags[$key],
                    'publication_description'=>$req->publication_description[$key],
                    'workplace_name'=>$req->workplace_name[$key],
                    'country_id'=>$req->country_id[$key],
                    'city_id'=>$req->city_id[$key],
                ]);
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
