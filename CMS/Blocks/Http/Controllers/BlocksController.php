<?php

namespace CMS\Blocks\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use CMS\Blocks\Entities\Blocks;
use CMS\Pages\Entities\Pages;
use Throwable;
use DataTables;
use Auth;
use DB;
class BlocksController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index($id)
    {
        $page=Pages::with('blocks')->find($id);
        return view('blocks::index')->withPage($page);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($id, $key)
    {
            $res=[
            'success'=>false,
            'html'=>'',
            'data'=>''
        ];
        try{
        $blocks=Blocks()->$key;

        request()->merge(['file_name'=>$blocks['name']]);
        request()->merge(['block_name'=>$key]);

        foreach($blocks['data'] as $block){
            $block_name=$block['name'];
            request()->merge([$block_name=>null]);
        }

        $save_res=$this->store(request(), $id);

        if($save_res==false OR $save_res==null){
        return response()->json($res);
        }

        $res['success']= true;
        $res['html']= view('blocks::edit')->withBlock($blocks)->withData($save_res)->render();
        $res['data']= $save_res->id;

        return response()->json($res);

        } catch(Exception $e){
        return response()->json($res);

        } catch(Throwable $e){
        return response()->json($res);
        }

        return view('blocks::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $req, $id)
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
        return view('blocks::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
           $res=[
            'success'=>false,
            'html'=>'',
            'data'=>''
        ];
        try{
        $get_block=Blocks::find($id);
        $key=$get_block->block_name;
        $blocks=Blocks()->$key;
        $res['success']= true;
        $res['html']= view('blocks::edit')->withBlock($blocks)->withData($get_block)->render();
        return response()->json($res);

        } catch(Exception $e){
        return response()->json($res);

        } catch(Throwable $e){
        return response()->json($res);
        }
        return view('blocks::edit');
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
