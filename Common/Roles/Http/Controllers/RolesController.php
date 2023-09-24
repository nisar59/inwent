<?php

namespace Common\Roles\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Throwable;
use DataTables;
use Auth;
use DB;
class RolesController extends Controller
{
    private $permissions_array=[];

    function __construct()
    {
        $permissions=AllPermissions();
           foreach ($permissions as $module=> $submodules) {
               foreach($submodules as $submodule=> $permissions){
                foreach ($permissions as $key => $permission) {
                   $this->permissions_array[$module][]=$submodule.'.'.$permission;
                }
               }
           }

           $this->_deleteRemovedPermissions();
           $this->__createPermissionIfNotExists();
        
            Role::firstOrCreate(['name'=>'super-admin', 'guard_name'=>'admin']);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $req)
    {
        if($req->ajax()){
            $roles=Role::all();
            return DataTables::of($roles)
                ->addColumn('action',function($row){
                    $action='';

                    $action.= $row->name!='super-admin' && Auth::user()->can('admins.edit') ? '<a href="'.url('roles/permissions/'.$row->id).'" class="btn btn-sm btn-primary m-1"><i class="fas fa-user-shield"></i></a>' : '';

                    $action.=Auth::user()->can('admins.edit') ? '<a href="javascript:void(0);" data-href="'.url('roles/edit/'.$row->id).'" class="btn btn-sm btn-success m-1 edit-role"><i class="far fa-edit"></i></a>' : '';

                    $action.=$row->name!='super-admin' && Auth::user()->can('admins.delete') ? '<a href="javascript:void(0);" class="btn btn-sm btn-danger m-1 verify-prompt" data-href="'.url('roles/destroy/'.$row->id).'" data-prompt-msg="Are you sure you want to delete this role?"><i class="far fa-trash-alt"></i></a>' : '';

                    return $action;
                })
                ->editColumn('name', function($row){
                    return $row->name;
                })
                ->rawColumns(['action'])
                ->make('true');
        }

        return view('roles::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('roles::create');
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
       ]);

       DB::beginTransaction();
       try {
            $inputs=$req->except('_token');
            $inputs['guard_name']='admin';
              Role::create($inputs);
              DB::commit();
            return redirect()->back()->with('success', 'Role successfully created');
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
        return view('roles::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        try {
            $role=Role::find($id);
            $html=view('roles::edit', compact('role'))->render();
            $resp=['success'=>true, 'message'=>'Role successfully Fetched', 'data'=>$html];
            return response()->json($resp);
        } catch (Exception $e) {
            $resp=['success'=>false, 'message'=>'Something went wrong with this error :'.$e->getMessage(), 'data'=>null];
            return response()->json($resp);

        } catch (Exception $e){
            $resp=['success'=>false, 'message'=>'Something went wrong with this error :'.$e->getMessage(), 'data'=>null];
            return response()->json($resp);            
        }

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
       ]);

       DB::beginTransaction();
       try {
            $inputs=$req->except('_token');
            $inputs['guard_name']='admin';
              Role::find($id)->update($inputs);
              DB::commit();
            return redirect()->back()->with('success', 'Role successfully updated');
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
              $role=Role::find($id);
              $role->syncPermissions([]);
              $role->delete();
              DB::commit();
            return redirect()->back()->with('success', 'Role successfully deleted');
        } catch (Exception $e) {
                DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        } catch(Throwable $e){
                DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        }

    }



    public function permissions($id)
    {
        $role=Role::find($id);
            if($role->name=="super-admin"){
                return redirect('home')->with('warning', 'Unauthorised Access');
            }
        return view('roles::permissions', compact('role'));
    }


    public function permissionsstore (Request $req, $id)
    {
        try {
            $role=Role::find($id);
                if($role->name=="super-admin"){
                    return redirect('home')->with('warning', 'Unauthorised Access');
                }
            $role->syncPermissions($req->permissions);
            return redirect()->back()->with('success', 'Permissions successfully Sync to Role');
        } catch (Exception $e) {
        return redirect()->back()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        }catch(Throwable $e){
        return redirect()->back()->with('error', 'Something went wrong with this error: '.$e->getMessage());

        }    
    }




    private function _deleteRemovedPermissions()
    {
        DB::beginTransaction();
        try {
            foreach ($this->permissions_array as $module => $permissions) {
                $permissions=Permission::where('module', $module)->whereNotIn('name', $permissions);

                if($permissions->count()>0){
                    $permissions->delete();
                }
            }
        DB::commit();
        } catch (Exception $e) {
                DB::rollback();
        return redirect()->back()->with('error', 'Something went wrong with this error: '.$e->getMessage());       

        }catch(Throwable $e){
                DB::rollback();
        return redirect()->back()->with('error', 'Something went wrong with this error: '.$e->getMessage());

        }

    }



    private function __createPermissionIfNotExists()
    {

        DB::beginTransaction();
        try {
                
                $create_permissions=[];

                foreach ($this->permissions_array as $module => $permissions) {

                    $non_existing_permissions=[];

                    $existing_permissions = Permission::where('module', $module)->whereIn('name', $permissions)
                                            ->pluck('name')
                                            ->toArray();
                    $non_existing_permissions = array_diff($permissions, $existing_permissions);

                    if(!empty($non_existing_permissions) && count($non_existing_permissions)>0 ){

                        foreach ($non_existing_permissions as $new_permission) {
                           $create_permissions[]=[
                                'name' => $new_permission,
                                'guard_name' => 'admin',
                                'module'=>$module,
                                'created_at'=>now(),
                                'updated_at'=>now()
                            ];
                        }
                    }

                }
            Permission::insert($create_permissions);
            DB::commit();

            } catch (Exception $e) {
                DB::rollback();      
                return redirect()->back()->with('error', 'Something went wrong with this error: '.$e->getMessage());       
            } catch (Throwable $e){
                DB::rollback();
                return redirect()->back()->with('error', 'Something went wrong with this error: '.$e->getMessage());       
            }




    }





}
