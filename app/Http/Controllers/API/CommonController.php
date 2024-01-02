<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Common\Countries\Entities\Countries;
use Common\States\Entities\States;
use Common\Cities\Entities\Cities;
use CMS\MainMenu\Entities\MainMenu;
use CMS\FooterMenu\Entities\FooterMenuHeadings;
use CMS\BlogCategories\Entities\BlogCategories;
use CMS\InwentLegal\Entities\InwentLegal;
use CMS\KnowledgeBase\Entities\KnowledgeBase;
use CMS\KnowledgeBaseCategories\Entities\KnowledgeBaseCategories;
use CMS\Pages\Entities\Pages;
use CMS\Blog\Entities\Blog;
use Auth;
use DB;
use Throwable;
use Storage;
class CommonController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function geo()
    {


        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {   

            $countries=Countries::get('id', 'name');       
            $states=States::get('id', 'country_id', 'name');
            $data=[               
                'countries'=>$countries, 
                'states'=>$states,
            ];

            $res=['success'=>true,'message'=>'Geo successfully fetched','errors'=>[],'data'=>$data];
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
    public function setup()
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {   

            $setup=Settings();
            $main_menu=MainMenu::where('status', 1)->get();
            $footer_menu=FooterMenuHeadings::where('status', 1)->get();

            if($setup==null){
                $res=['success'=>false,'message'=>'setup not successfully fetched','errors'=>[],'data'=>null];
                return response()->json($res);   
            }
            $data=[               
                'setup'=>$setup,
                'main_menu'=>$main_menu,
                'footer_menu'=>$footer_menu,
            ];

            $res=['success'=>true,'message'=>'setup successfully fetched','errors'=>[],'data'=>$data];
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
    public function page($slug)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {   

            $page=Pages::where('slug','LIKE','%'.$slug.'%')->first();

            $data=[               
                'page'=>$page,
            ];
            if($page!=null){
                $res=['success'=>true,'message'=>'page successfully fetched','errors'=>[],'data'=>$data];
            }else{
                $res=['success'=>false,'message'=>'page not found','errors'=>[],'data'=>null];
            }  

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
    public function blogs()
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {   

            $blogs=Blog::where('status', 1)->orderBy('id', 'DESC')->get();
            $blogs_categories=BlogCategories::where('status', 1)->orderBy('id', 'DESC')->get();
            $data=[               
                'blogs'=>$blogs,
                'blogs_categories'=>$blogs_categories
            ];

                $res=['success'=>true,'message'=>'blogs & blogs categories successfully fetched','errors'=>[],'data'=>$data]; 

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
    public function blogsByCategory($slug)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {   

            $cate=BlogCategories::where('slug','LIKE','%'.$slug.'%')->first();

            if($cate!=null){
                $blogs=Blog::where('category_id', $cate->id)->where('status', 1)->orderBy('id', 'DESC')->get();
            }else{
                $blogs=Blog::where('status', 1)->orderBy('id', 'DESC')->get();
            }

            $blogs_categories=BlogCategories::where('status', 1)->orderBy('id', 'DESC')->get();
            $data=[               
                'blogs'=>$blogs,
                'blogs_categories'=>$blogs_categories
            ];

                $res=['success'=>true,'message'=>'blogs & blogs categories successfully fetched','errors'=>[],'data'=>$data]; 

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
    public function blogDetail($slug)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {   

            $blogs=Blog::where('status', 1)->orderBy('id', 'DESC')->limit(5)->get();
            $blog=Blog::where('slug','LIKE','%'.$slug.'%')->first();
            $blogs_categories=BlogCategories::where('status', 1)->orderBy('id', 'DESC')->get();

            $data=[ 
                'blogs'=>$blogs,           
                'blog'=>$blog,           
                'blogs_categories'=>$blogs_categories,
            ];

            if($blog!=null){
                $res=['success'=>true,'message'=>'Blog successfully fetched','errors'=>[],'data'=>$data];
            }else{
                $res=['success'=>false,'message'=>'page not found','errors'=>[],'data'=>null];
            }  

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
    public function legal()
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {   

            $legals=InwentLegal::where('status', 1)->get();

            $data=[               
                'legals'=>$legals,
            ];

            $res=['success'=>true,'message'=>'Legal successfully fetched','errors'=>[],'data'=>$data]; 

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
    public function knowledgeBaseCategories()
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {   

            $categories=KnowledgeBaseCategories::where('status', 1)->get();

            $data=[               
                'categories'=>$categories,
            ];

            $res=['success'=>true,'message'=>'Knowledge Base Categories successfully fetched','errors'=>[],'data'=>$data]; 

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
    public function knowledgeBaseByCategory($slug)
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {   


            $category=KnowledgeBaseCategories::where(['status'=>1])->where('slug', 'LIKE', '%'.$slug.'%')->first();

            if($category==null){
                $res=['success'=>false,'message'=>'Knowledge Base category not found','errors'=>[],'data'=>null]; 
                 return response()->json($res);
            }

            $articles=KnowledgeBase::where(['status'=>1,'knowledge_base_category_id'=>$category->id])->get();

            $data=[               
                'articles'=>$articles,
                'category'=>$category
            ];

            $res=['success'=>true,'message'=>'Knowledge Base Articles successfully fetched','errors'=>[],'data'=>$data]; 

             return response()->json($res);
            
        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        } 
    }



    public function getNotifications()
    {
        $res=['success'=>true,'message'=>'', 'errors'=>[],'data'=>null];
        try {   
           $user_id=InwntDecrypt(Auth::id()); 

            $data=GetUserNotifications($user_id);

            $res=['success'=>true,'message'=>'notifications successfully fetched','errors'=>[],'data'=>$data]; 

             return response()->json($res);
            
        } catch (Exception $e) {
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);

        } catch(Throwable $e){
                $res=['success'=>false,'message'=>'Something went wrong with this error: '.$e->getMessage(),'errors'=>[],'data'=>null];
                return response()->json($res);
        } 
    }





}
