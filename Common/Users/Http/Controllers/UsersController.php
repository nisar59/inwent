<?php

namespace Common\Users\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Throwable;
use DataTables;
use Auth;
use DB;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (request()->ajax()) {
        $users=User::all();
           return DataTables::of($users)
           ->addColumn('action',function ($row){
               $action='';
            if(Auth::user()->can('users')){
               $action.='<a class="btn btn-primary btn-sm m-1" href="'.url('users/edit/'.$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
           }
           if(Auth::user()->can('users')){
               $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('users/destroy/'.$row->id).'"><i class="fas fa-trash-alt"></i></a>';
           }

               return $action;
           }) ->addColumn('status',function ($row){
               $action='';
               if($row->status==0){
                   $action.='<a class="btn btn-success btn-sm m-1" href="'.url('users/status/'.$row->id).'">Active</a>';
                }else{
                   $action.='<a class="btn btn-danger btn-sm m-1" href="'.url('users/status/'.$row->id).'">Deactive</a>';
                }
               return $action;
           })
           ->rawColumns(['action','status'])
           ->make(true);
        }
        return view('users::index');
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
     * Update status.
     * @param int $id
     * @return Renderable
     */
    public function status($id)
    {
        DB::beginTransaction();
        try{
        $users=User::find($id);

        if($users->status==1){
            $users->status=0;
        }
        else{
            $users->status=1;
        }
        $users->save();
        DB::commit();
         return redirect('users')->with('success','User status successfully updated');
         
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
        return view('users::edit');
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
}
