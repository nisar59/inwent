<?php

namespace Common\Admins\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use App\Models\Admin;
use Throwable;
use DataTables;
use Auth;
use DB;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $req)
    {
        if($req->ajax()){
            $admins=Admin::all();
            return DataTables::of($admins)
                ->addColumn('action',function($row){
                    $action='';

                    $action.=$row->hasRole('super-admin') && Auth::user()->hasRole('super-admin') ? '<a href="'.url('admins/edit/'.$row->id).'" class="btn btn-sm btn-success m-1"><i class="far fa-edit"></i></a>' : '';

                    $action.=!$row->hasRole('super-admin') && Auth::user()->can('admins.edit') ? '<a href="'.url('admins/edit/'.$row->id).'" class="btn btn-sm btn-success m-1"><i class="far fa-edit"></i></a>' : '';


                    $action.=!$row->hasRole('super-admin') && Auth::user()->can('admins.edit') ? '<a href="javascript:void(0);" class="btn btn-sm btn-danger m-1 verify-prompt" data-href="'.url('admins/destroy/'.$row->id).'" data-prompt-msg="Are you sure you want to delete this admin?"><i class="far fa-trash-alt"></i></a>' : '';
                    return $action;

                })
                ->editColumn('name', function($row){
                    return $row->name;
                })
                ->editColumn('email', function($row){
                    return $row->email;
                })
                ->addColumn('role', function($row){
                    if($row->roles->count()){
                        return $row->roles->first()->name;
                    }
                })
                ->editColumn('status', function($row){                    
                    $status='';

                    if($row->hasRole('super-admin')){
                        $status='<a href="javascript:void(0);"class="btn btn-sm btn-success m-1">Active</a>';
                    }
                    elseif($row->status==1){
                        $status='<a href="javascript:void(0);" data-href="'.url('admins/status/'.$row->id).'" class="btn btn-sm btn-success m-1 verify-prompt" data-prompt-msg="Are you sure you want to block this admin?">Active</a>';
                    }else{
                        $status='<a href="javascript:void(0);" class="btn btn-sm btn-danger m-1 verify-prompt" data-href="'.url('admins/status/'.$row->id).'" data-prompt-msg="Are you sure you want to active this admin?" >Blocked</a>';
                    }


                    return $status;

                })

                ->rawColumns(['role','status','action'])
                ->make('true');
        }


        return view('admins::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $roles=Role::all();
        return view('admins::create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
       $req->validate([
        'name'=>'required',
        'email'=>['required', 'unique:admins'],
        'password'=>'required',
       ]);

       DB::beginTransaction();
       try {
            $inputs=$req->except('_token');
              $admin=Admin::create($inputs);
              if($req->role!=null){
                $admin->syncRoles([$req->role]);
              }
              DB::commit();
            return redirect('admins')->with('success', 'Admin successfully created');
        } catch (Exception $e) {
                DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        } catch(Throwable $e){
                DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('admins::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $roles=Role::all();
        $admin=Admin::find($id);
        return view('admins::edit', compact('roles', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $req, $id)
    {
       $req->validate([
        'name'=>'required',
        'email'=>['required', 'unique:admins,email,'.$id],
       ]);

       DB::beginTransaction();
       try {
              $inputs=$req->except('_token', 'password');
              $admin=Admin::find($id);
              $admin_copy=clone $admin;
              $admin_copy->update($inputs);

              if(!$admin_copy->hasRole('super-admin') && $admin_copy && $req->role!=null){
                $admin->syncRoles([$req->role]);
              }

              DB::commit();
            return redirect('admins')->with('success', 'Admin successfully updated');
        } catch (Exception $e) {
                DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        } catch(Throwable $e){
                DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        }    
    }


    /**
     * Update the Status of specified resource.
     * @param int $id
     * @return Renderable
     */
    public function status($id)
    {

       DB::beginTransaction();
       try {
              $admin=Admin::find($id);

              if($admin->hasRole('super-admin')){
                return redirect('home')->with('warning', 'Unauthorised Access');
              }

              if($admin->status==1){
                $admin->status=0;
              }else{
                $admin->status=1;
              }
              $admin->save();
              DB::commit();
            return redirect('admins')->with('success', 'Admin successfully deleted');
        } catch (Exception $e) {
                DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        } catch(Throwable $e){
                DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong with this error: '.$e->getMessage());
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
       try {
              $admin=Admin::find($id);
              if($admin->hasRole('super-admin')){
                return redirect('home')->with('warning', 'Unauthorised Access');
              }
              $admin->syncRoles([]);
              $admin->delete();
              DB::commit();
            return redirect('admins')->with('success', 'Admin successfully deleted');
        } catch (Exception $e) {
                DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        } catch(Throwable $e){
                DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        }  
    }
}
