<?php

namespace CMS\OurClient\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use CMS\OurClient\Entities\OurClient;
use Throwable;
use DataTables;
use Auth;
use DB;
class OurClientController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $ourclinet=OurClient::orderBy('id','ASC')->get();
           return DataTables::of($ourclinet)
           ->addColumn('action',function ($row){
               $action='';
               $action.='<a class="btn btn-danger btn-sm" href="'.url('our-client/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
               return $action;
           })
           ->addColumn('image', function ($row) {
                    return '<img src="'.StorageFile($row->image).'" height="50" width="50">';
                })
           ->addColumn('status',function ($row){
               $action='';
               if($row->status==1){
                   $action.='<a class="btn btn-success btn-xs btn-sm m-1" href="'.url('our-client/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-xs btn-sm m-1" href="'.url('our-client/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })
           ->rawColumns(['action','image','status'])
           ->make(true);
        }
        return view('ourclient::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('ourclient::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
          $req->validate([
            'images'=>'required',
            'images.*'=>'image|mimes:jpeg,png,jpg,gif,svg,|max:3048',
        ]);
        $path='cms/ourclient';
        DB::beginTransaction();
        try{
        if($req->images!=null){
             foreach ($req->images as $img) {
                OURClient::create([
                    'image'=>FileUpload($img,$path),
                ]);
             }
        }
        DB::commit();
         return redirect('our-client')->with('success','Client successfully created');
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
        return view('ourclient::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('ourclient::edit');
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
        $ourclient=OurClient::find($id);

        if($ourclient->status==0){
            $ourclient->status=1;
        }
        else{
            $ourclient->status=0;
        }
        $ourclient->save();
        DB::commit();
         return redirect('our-client')->with('success','Client Image status successfully updated');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
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
        DB::beginTransaction();
        try{
        OurClient::find($id)->delete();
        DB::commit();
         return redirect('our-client')->with('success','Client successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
