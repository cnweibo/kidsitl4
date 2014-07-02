<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('mm', function(){
    $yinbiaotemp = Yinbiao::first();
    $yinbiaotemp->relatedwords()->detach(3);
    dd($yinbiaotemp->relatedwords);
    dd(($yinbiaotemp->relatedwords()->attach(3)));
});
/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */
// yinbiao routes
Route::resource('yinbiao','YinbiaoController');
// yinbiao category routes
Route::resource('yinbiaocategory','YinbiaocategoryController');
// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset');
//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit');

//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');

//:: Application Routes ::

# Filter for detect language
//Route::when('contact-us','detectLang');
Route::get('lang',function(){
    echo trans('admin/users/messages.already_exists');
});
# Contact Us Static Page
Route::get('contact-us', function()
{
    // Return about us page
    return View::make('site/contact-us');
});

Route::get("/bs3test/snippets/{page?}", function($page = 'index'){
    //return $page;
    $page = "snippets".".".$page;
    return View::make('bs3test.detail')->with('page',$page);
});

Route::get("/bs3test/{page?}", function($page = 'index'){
    if ($page == 'index') {
        //populate the bs3test lists in the page.
        $bs3fileslist = (File::files(app_path().'/views/bs3test'));
        $i=0;
        foreach ($bs3fileslist as $file) {
            preg_match('/\/([^\/]*)\.blade\.php/', $file,$bs3shortname);
            $bs3view[$i++] = $bs3shortname[1];
    }
    //list the snippets directory 
        $bs3snippetslist = (File::files(app_path().'/views/bs3test/snippets'));
        foreach ($bs3snippetslist as $file) {
            preg_match('/\/([^\/]*)\.blade\.php/', $file,$bs3shortname);
            $bs3view[$i++] = "snippets/".$bs3shortname[1];
        }
        return View::make('bs3test.index',['bs3view' => $bs3view]);
    }
    else{
        // View::share('page',$page);
        $filecontent = File::get(app_path().'/views/bs3test/'.$page.'.blade.php');
        return View::make('bs3test.detail',['page'=>$page, 'filecontent' =>$filecontent]);       
    }

});

// API access for the bsShell requesting the bishun file
Route::get('/getBishun/{filename}',array('uses' => 'BishunController@getBishun'));

// API access for the yinbiao mp3 audio file
Route::get('/getmp3/{filename}', 'Mp3Controller@getMp3');

// kidsit slugs
Route::get('/bishun', array('uses' => 'BishunController@getIndex'));
Route::post('/bishun', array('uses' => 'BishunController@postSearch'));
Route::get('/exercise',array('uses' => 'BlogController@getIndex'));
Route::get('/game',array('uses' => 'GameController@getIndex'));
Route::get('/pinyin',array('uses' => 'BlogController@getIndex'));
#Route::get('/yinbiao',array('uses' => 'YinbiaoController@getIndex'));
Route::get('/kidsinternet',array('uses' => 'BlogController@getIndex'));

// facades url to see all the laravel facades and its class
Route::get('admin/facades/{name}',function($name){
        dd(get_class($name::getFacadeRoot()));
    });
Route::get('admin/getform',function(){
        return View::make('sandstudy.getform');
    });
Route::post('admin/getform',function(){
    if (Input::hasFile('filename')){
        $file= Input::file('filename');
        // dd(app_path().'/storage/uploaded/','uploaded.xxx');
        $destfile = time().'_'.rand(1,10).'.'.$file->getClientOriginalExtension();
        $destabsolutefile = app_path().'/storage/uploaded/';
        $file->move($destabsolutefile,$destfile);
        $bishun = new Bishun;
        $bishun->hanzi = Input::get('hanzi');
        $bishun->filename = $destfile;
        $bishun->relatedwords = Input::get('relatedwords');
        $bishun->save();    
        // return [
        //     'path'=> $file->getRealPath(),
        //     'size'=> $file->getSize(),
        //     'mime'=> $file->getMimeType(),
        //     'name'=> $file->getClientOriginalName(),
        //     'extension'=> $file->getClientOriginalExtension()
        // ];
        return View::make('sandstudy.uploaddone');
    }});
Route::get('clockwork',function(){
    Clockwork::startEvent('queryProfiler','single query timing');
    $user = User::first();
    Clockwork::info($user->email);
    Clockwork::endEvent('queryProfiler');
    });
Route::get('request',function(){
   //APP::make('request')->xxxx;
    });

Route::matched(function($route, $request)
{
    // dd("route matched event hit for $request");
});

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('post', 'Post');
Route::model('role', 'Role');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('comment', '[0-9]+');
Route::pattern('post', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{

    # Comment Management
    Route::get('comments/{comment}/edit', 'AdminCommentsController@getEdit');
    Route::post('comments/{comment}/edit', 'AdminCommentsController@postEdit');
    Route::get('comments/{comment}/delete', 'AdminCommentsController@getDelete');
    Route::post('comments/{comment}/delete', 'AdminCommentsController@postDelete');
    Route::controller('comments', 'AdminCommentsController');

    # Blog Management
    Route::get('blogs/{post}/show', 'AdminBlogsController@getShow');
    Route::get('blogs/{post}/edit', 'AdminBlogsController@getEdit');
    Route::post('blogs/{post}/edit', 'AdminBlogsController@postEdit');
    Route::get('blogs/{post}/delete', 'AdminBlogsController@getDelete');
    Route::post('blogs/{post}/delete', 'AdminBlogsController@postDelete');
    Route::controller('blogs', 'AdminBlogsController');

    # User Management
    Route::get('users/{user}/show', 'AdminUsersController@getShow');
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete');
    Route::controller('users', 'AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete');
    Route::controller('roles', 'AdminRolesController');

    # Bishun Management
    Route::get('bishuns', 'AdminBishunsController@getIndex');
    Route::get('bishuns/data', 'AdminBishunsController@getData');
    Route::get('bishuns/create', 'AdminBishunsController@getCreate');        
    // Route::get('bishuns/{bishun}/show', 'AdminBishunsController@getShow');
    Route::get('bishuns/{bishun}/edit', 'AdminBishunsController@getEdit');
    Route::post('bishuns/{bishun}/edit', 'AdminBishunsController@postEdit');
    Route::get('bishuns/{bishun}/delete', 'AdminBishunsController@getDelete');
    Route::post('bishuns/{bishun}/delete', 'AdminBishunsController@postDelete');
    Route::controller('bishuns', 'AdminBishunsController');

    # Yinbiao Management
    Route::get('yinbiaos', 'AdminYinbiaosController@getIndex');
    Route::get('yinbiaos/data', 'AdminYinbiaosController@getData'); 
    Route::get('yinbiaos/create', 'AdminYinbiaosController@getCreate');     
    // Route::get('yinbiaos/{yinbiao}/show', 'AdminYinbiaosController@getShow');
    Route::get('yinbiaos/{yinbiao}/edit', 'AdminYinbiaosController@getEdit');
    Route::post('yinbiaos/{yinbiao}/edit', 'AdminYinbiaosController@postEdit');
    Route::get('yinbiaos/{yinbiao}/delete', 'AdminYinbiaosController@getDelete');
    Route::post('yinbiaos/{yinbiao}/delete', array('as'=>'postyinbiaodelete', 'uses' => 'AdminYinbiaosController@postDelete'));
    Route::controller('yinbiaos', 'AdminYinbiaosController');
    
    # Yinbiao category Management
    Route::get('yinbiaocategory', 'AdminYinbiaocategoryController@getIndex');
    Route::get('yinbiaocategory/data', 'AdminYinbiaocategoryController@getData'); 
    Route::get('yinbiaocategory/create', 'AdminYinbiaocategoryController@getCreate');     
    // Route::get('yinbiaocategory/{yinbiaocat}/show', 'AdminYinbiaocategoryController@getShow');
    Route::get('yinbiaocategory/{yinbiaocat}/edit', 'AdminYinbiaocategoryController@getEdit');
    Route::post('yinbiaocategory/{yinbiaocat}/edit', 'AdminYinbiaocategoryController@postEdit');
    Route::get('yinbiaocategory/{yinbiaocat}/delete', 'AdminYinbiaocategoryController@getDelete');
    Route::post('yinbiaocategory/{yinbiaocat}/delete', array('as'=>'postyinbiaocatdelete', 'uses' => 'AdminYinbiaocategoryController@postDelete'));
    Route::controller('yinbiaocategory', 'AdminYinbiaocategoryController');

    # Yinbiao relatedword Management
    Route::get('yinbiaorelatedwords', 'AdminYinbiaorelatedwordsController@getIndex');
    Route::get('yinbiaorelatedwords/data', 'AdminYinbiaorelatedwordsController@getData'); 
    Route::get('yinbiaorelatedwords/create', 'AdminYinbiaorelatedwordsController@getCreate');     
    // Route::get('yinbiaorelatedwords/{relatedword}/show', 'AdminYinbiaorelatedwordsController@getShow');
    Route::get('yinbiaorelatedwords/{relatedword}/edit', 'AdminYinbiaorelatedwordsController@getEdit');
    Route::post('yinbiaorelatedwords/{relatedword}/edit', 'AdminYinbiaorelatedwordsController@postEdit');
    Route::get('yinbiaorelatedwords/{relatedword}/delete', 'AdminYinbiaorelatedwordsController@getDelete');
    Route::post('yinbiaorelatedwords/{relatedword}/delete', array('as'=>'postyinbiaorelatedworddelete', 'uses' => 'AdminYinbiaorelatedwordsController@postDelete'));
    Route::controller('yinbiaorelatedwords', 'AdminYinbiaorelatedwordsController');

    # Admin Dashboard
    Route::controller('/', 'AdminDashboardController');
});

# Posts - Second to last set, match slug
Route::get('{postSlug}', 'BlogController@getView');
Route::post('{postSlug}', 'BlogController@postView');
// Route::get('/',function(){
//     dd(File::getfffff());

// });
# Index Page - Last route, no matches
// detectLang in the get '/' 
Route::get('/', array('uses' => 'BlogController@getIndex'));

