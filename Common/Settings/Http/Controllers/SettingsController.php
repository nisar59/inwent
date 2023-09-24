<?php

namespace Common\Settings\Http\Controllers;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Common\Settings\Entities\Settings;
use Throwable;
use Storage;
use Auth;
use DB;
class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $settings=Settings::first();

        return view('settings::index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('settings::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req)
    {
        DB::beginTransaction();
        try {
            $settings=Settings::first();
            $inputs=$req->except('_token','website_logo','website_logo_small','website_favicon','portal_logo','portal_logo_small','portal_favicon');

            $website_logo=FileUpload($req->website_logo, 'settings');
            $website_logo_small=FileUpload($req->website_logo_small, 'settings');
            $website_favicon=FileUpload($req->website_favicon, 'settings');
            $portal_logo=FileUpload($req->portal_logo, 'settings');
            $portal_logo_small=FileUpload($req->portal_logo_small, 'settings');
            $portal_favicon=FileUpload($req->portal_favicon, 'settings');


            if($website_logo!=null){
                $inputs['website_logo']=$website_logo;
            }
            if($website_logo_small!=null){
                $inputs['website_logo_small']=$website_logo_small;
            }

            if($website_favicon!=null){
                $inputs['website_favicon']=$website_favicon;
            }
            if($portal_logo!=null){
                $inputs['portal_logo']=$portal_logo;
            }
            if($portal_logo_small!=null){
                $inputs['portal_logo_small']=$portal_logo_small;
            }
            if($portal_favicon!=null){
                $inputs['portal_favicon']=$portal_favicon;
            }


            if($settings!=null){
                $settings->update($inputs);
            }else{
                Settings::create($inputs);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Settings successfully updated');
        } catch (Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()->back()->with('error', 'Something went wrong with this error: '.$e->getMessage());
        } catch (Throwable $e) {
            DB::rollback();
            dd($e);
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
        return view('settings::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('settings::edit');
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
