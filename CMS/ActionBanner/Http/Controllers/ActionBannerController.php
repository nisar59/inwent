<?php

namespace CMS\ActionBanner\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use CMS\ActionBanner\Entities\ActionBanner;
use Throwable;
use DataTables;
use Auth;
use DB;
class ActionBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $banner=ActionBanner::select('*')->orderBy('id','ASC')->get();
           return DataTables::of($banner)
           ->addColumn('action',function ($row){
               $action='';
               $action.='<a class="btn btn-danger btn-sm" href="'.url('action-banner/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
               return $action;
           })
           ->addColumn('image', function ($row) {
                    return '<img src="'.StorageFile($row->image).'" height="50" width="50">';
                })
           ->addColumn('status',function ($row){
               $action='';
               if($row->status==0){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('action-banner/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('action-banner/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })
           ->rawColumns(['action','image','status'])
           ->make(true);
        }
        return view('actionbanner::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('actionbanner::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
         $req->validate([
            'title'=>'required',
            'sub_title'=>'required',
            'image'=>'required',
            'description'=>'required',
            'text'=>'required',
            'stats'=>'required',
        ]);
          DB::beginTransaction();
         try{
            $path='cms/actionbanner';
            $inputs=$req->except('_token');
            $inputs['image']=FileUpload($req->image,$path);
            $inputs['text_actions']=json_encode($req->text_actions);
            $inputs['stats_actions']=json_encode($req->stats_actions);
            ActionBanner::create($inputs);
            DB::commit();
            return redirect('action-banner')->with('success','Action Banner sccessfully created');
         }catch(Exception $ex){
            DB::rollback();
         return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());
        }catch(Throwable $ex){
            DB::rollback();
        return redirect()->back()->with('error','Something went wrong with this error: '.$ex->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('actionbanner::show');
    }
     /**
     * Update status.
     * @param int $id
     * @return Renderable
     */
    public function status($id)
    {
        DB::beginTransaction();
        try{
        $act_banner=ActionBanner::find($id);

        if($act_banner->status==1){
            $act_banner->status=0;
        }
        else{
            $act_banner->status=1;
        }
        $act_banner->save();
        DB::commit();
         return redirect('action-banner')->with('success','Action Banner status successfully updated');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('actionbanner::edit');
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
        DB::beginTransaction();
        try{
        ActionBanner::find($id)->delete();
        DB::commit();
         return redirect('action-banner')->with('success','Action Banner successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
