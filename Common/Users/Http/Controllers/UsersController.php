<?php

namespace Common\Users\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Common\Users\Entities\BasicProfile;
use Common\Users\Entities\ProfessionalProfile;
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
        $req=request();
        if ($req->ajax()) {

            $strt   = $req->start;
            $length = $req->length;

            $users=User::query();

            if ($req->name != null) {
                $users->where('name','LIKE','%'.$req->name.'%');
              }
            if ($req->email != null) {
                $users->where('email', $req->email);
              }    
            if ($req->status != null) {
                $users->where('status', $req->status);
              }

            $total = $users->count();
            $users   = $users->offset($strt)->limit($length)->get();



           return DataTables::of($users)
                ->setOffset($strt)
                ->with([
                  "recordsTotal"    => $total,
                  "recordsFiltered" => $total,
                ])
           ->addColumn('action',function ($row){
               $action='';
                $action.='<a class="btn btn-info btn-sm m-1 text-white" href="'.url('users/show/'.$row->id).'"><i class="fas fa-eye"></i></a>';
               return $action;
           })

            ->editColumn('status',function ($row){
               $status='';
               if($row->status==1){
                   $status.='<a class="btn btn-success btn-sm m-1" href="'.url('users/status/'.$row->id).'">Active</a>';
                }else{
                   $status.='<a class="btn btn-danger btn-sm m-1" href="'.url('users/status/'.$row->id).'">Blocked</a>';
                }
               return $status;
           })
           ->rawColumns(['status', 'action'])
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
        $user=User::with('basicProfile')->find($id);
        $basic_profile=BasicProfile::where('user_id', $user->id)->first();
       $professional_profile=ProfessionalProfile::with('projects', 'publications', 'patents', 'conferences', 'articles' ,'experience', 'education', 'courses', 'certificates', 'volunteerings', 'awards', 'languages', 'breaks', 'compliances')->where('user_id', $user->id)->first();

        if($user==null){
            return redirect()->back()->with('error', 'User not found');
        }
        return view('users::show', compact('user', 'basic_profile', 'professional_profile'));
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

        if($users->status==0){
            $users->status=1;
        }
        else{
            $users->status=0;
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
    public function update(Request $req, $id)
    {
        DB::beginTransaction();
        try{
        $user=User::find($id);
        $user->update($req->except('_token'));
        DB::commit();
         return redirect()->back()->with('success','User verification & verification badge successfully updated');
         
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
       
    }
}
