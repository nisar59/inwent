<?php

namespace Freelancing\Projects\Http\Controllers\API;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Freelancing\ProjectConfig\Entities\ProjectConfig;
use Freelancing\Projects\Entities\Projects;
use Freelancing\Projects\Entities\ProjectProposals;
use Freelancing\Projects\Entities\ProjectMilestones;
use Freelancing\Projects\Entities\FavoriteProjects;
use Throwable;
use Auth;
use DB;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $projects=Projects::where('user_id', $user_id)->get();

            $data=[
                'projects'=>$projects
            ];

            $res=['success'=>true,'message'=>'Projects successfully fetched','errors'=>[],'data'=>$data];
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
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $pc=ProjectConfig::where('status', 1)->get()->groupBy('type');

            $data=[
                'config'=>$pc
            ];

            $res=['success'=>true,'message'=>'Project Config successfully fetched','errors'=>[],'data'=>$data];
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
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $inputs=$req->except('deliverables', 'skills', 'area_experties', 'sub_area_experties', 'certifications', 'licenses_permits','additional_information_files', 'web_links', 'invited_freelancers');
            
            $inputs['deliverables']=json_encode($req->deliverables);
            $inputs['skills']=json_encode($req->skills);
            $inputs['area_experties']=json_encode($req->area_experties);
            $inputs['sub_area_experties']=json_encode($req->sub_area_experties);
            $inputs['certifications']=json_encode($req->certifications);
            $inputs['licenses_permits']=json_encode($req->licenses_permits);
            $inputs['additional_information_files']=json_encode($req->additional_information_files);
            $inputs['web_links']=json_encode($req->web_links);
            $inputs['invited_freelancers']=json_encode($req->invited_freelancers);
            
            $inputs['user_id']=$user_id;
            $project=Projects::create($inputs);

            $data=[
                'user'=>Auth::user(),
                'projects'=>$project
            ];

            $res=['success'=>true,'message'=>'Project successfully created','errors'=>[],'data'=>$data];
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
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          

            $project=Projects::find($id);

            if($project==null){
            $res=['success'=>false,'message'=>'Project not found','errors'=>[],'data'=>null];
             return response()->json($res);

            }

            $data=[
                'project'=>$project
            ];

            $res=['success'=>true,'message'=>'Project detail successfully fetched','errors'=>[],'data'=>$data];
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
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function search(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          
            $user_id=InwntDecrypt(Auth::id());
            $projects=Projects::whereNot('user_id', $user_id)->get();

            $data=[
                'projects'=>$projects
            ];

            $res=['success'=>true,'message'=>'Projects successfully fetched','errors'=>[],'data'=>$data];
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
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function proposalStore(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $inputs=$req->except('attachments');
            
            $inputs['attachments']=json_encode($req->attachments);
            
            $inputs['user_id']=$user_id;
            $proposal=ProjectProposals::create($inputs);

            $data=[
                'user'=>Auth::user(),
                'proposal'=>$proposal
            ];

            $res=['success'=>true,'message'=>'Proposal successfully sent','errors'=>[],'data'=>$data];
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
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function createMilestone(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $milestone=ProjectMilestones::create([
                'project_id'=>$req->project_id,
                'user_from'=>$user_id,
                'user_to'=>$req->user_to,
                'milstone_price'=>$req->milstone_price,
                'expected_closing_date'=>$req->expected_closing_date,
                'name'=>$req->name,
                'description'=>$req->description,
                'agree_to_terms'=>$req->agree_to_terms,
            ]);
            $project=Projects::find($req->project_id);

            $hired_freelancer=$project->hired_freelancer;

            $hired_freelancer[]=$req->user_to;
            $project->hired_freelancer=$hired_freelancer;
            $project->status=1;
            
            $project->save();
            
            $data=[
                'user'=>Auth::user(),
                'milestone'=>$milestone
            ];

            $res=['success'=>true,'message'=>'Milestone successfully created and offer sent','errors'=>[],'data'=>$data];
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function favorites()
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $fvrts=FavoriteProjects::where('user_id', $user_id)->get('project_id')->toArray();

            $projects=Projects::whereIn('id', $fvrts)->get();

            $data=[
                'projects'=>$projects
            ];

            $res=['success'=>true,'message'=>'Favorites Projects successfully fetched','errors'=>[],'data'=>$data];
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
     * Display a listing of the resource.
     * @return Renderable
     */
    public function favoritesStore(Request $req)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        DB::beginTransaction();
        try {          
            $user_id=InwntDecrypt(Auth::id()); 

            $inputs=$req->all();

            FavoriteProjects::create($inputs);

            $res=['success'=>true,'message'=>'Project successfully added to favorites','errors'=>[],'data'=>null];
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
