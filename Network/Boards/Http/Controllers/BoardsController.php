<?php

namespace Network\Boards\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Network\Boards\Entities\Boards;
use Throwable;
use DataTables;
use Auth;
use DB;
use Str;
class BoardsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

         if (request()->ajax()) {
        $boards=Boards::orderBy('id','ASC')->get();
           return DataTables::of($boards)
           ->addColumn('action',function ($row){
               $action='';

            if(Auth::user()->can('boards.delete')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('network/boards/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>'; 
           }
            
            return $action;
           }) ->addColumn('status',function ($row){
               $action='';
               if($row->status==1){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('network/boards/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('network/boards/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })
           ->rawColumns(['action','status'])
           ->make(true);
        }


        return view('boards::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('boards::create');
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
        return view('boards::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('boards::edit');
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
     * Update status.
     * @param int $id
     * @return Renderable
     */
    public function status($id)
    {
        DB::beginTransaction();
        try{
        $board=Boards::find($id);

        if($board->status==0){
            $board->status=1;
        }
        else{
            $board->status=0;
        }
        $board->save();
        DB::commit();
         return redirect('network/boards')->with('success','Board status successfully updated');
         
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
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
        Boards::find($id)->delete();
        DB::commit();
         return redirect('network/boards')->with('success','Board successfully deleted');
         } catch(Exception $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }catch(Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error','Something went wrong with this error: '.$e->getMessage());
         }
    }
}
