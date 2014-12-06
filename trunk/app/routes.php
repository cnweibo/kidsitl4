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
// change the blade template delimiter since conflict with angular
Blade::setEscapedContentTags('[[', ']]');
Blade::setContentTags('[[[', ']]]');

Route::group(array('prefix' => 'math'), function(){
    Route::get('exams/create', 'MathexamsController@create' );  
    Route::get('sum4', 'Mathsum4Controller@exercise4' );
    Route::get('exams/submitanswer','MathexamsController@submitAnswer');
    Route::get('exams/{examid}', 'MathexamsController@show' ); 
    Route::get('exams', 'MathexamsController@index' );    


    Route::get('mathsum4populate', 'Mathsum4Controller@index4');
    Route::get('mathsum31populate', 'Mathsum4Controller@index31');
    Route::get('mathsum32populate', 'Mathsum4Controller@index32');
    Route::get('mathsum21populate', 'Mathsum4Controller@index21');
    Route::get('mathsum22populate', 'Mathsum4Controller@index22');
    Route::get('mathsum11populate', 'Mathsum4Controller@index11');
    Route::get('mathsum12populate', 'Mathsum4Controller@index12');
    Route::get('mathsum2_12populate', 'Mathsum4Controller@index2_12');
    Route::get('mathsum2_21populate', 'Mathsum4Controller@index2_21');
    Route::get('mathsum2_22populate', 'Mathsum4Controller@index2_22');   
    Route::get('mathsum1_11populate', 'Mathsum4Controller@index1_11');     

    Route::get('mathmulti2_12populate','Mathmultiply2Controller@index2_12');
    Route::get('mathmulti2_21populate','Mathmultiply2Controller@index2_21');
    Route::get('mathmulti2_22populate','Mathmultiply2Controller@index2_22');
});
Route::get('givetojs', function(){
    Give::javascript(['kidsit'=>'give to javascript']);
    return View::make('hello');
});
Route::get('ybcat', function(){
    dd(Yinbiaocategory::first()->yinbiao);
});
Route::get('guizeword', function(){
    dd(Fayinguize::first()->relatedwords);
});
Route::get('wordguize', function(){
    dd(Relatedword::find(2)->fayinguize[1]);
});
Route::get('yg', function(){
    dd(Yinbiao::find(14)->fayinguizes);
});
Route::get('gy', function(){
    dd(Fayinguize::find(1)->yinbiao);
});
Route::get('relatedwords',function(){
    $fayinguize = Fayinguize::find(3);
    // dd($fayinguize);
    dd($fayinguize->relatedwords);
});
Route::get('gz',function(){
    $relatedwords = Relatedword::find(8);
    dd($relatedwords->fayinguize);
});
Route::get('mm', function(){
// relation between yinbiao and relative words removed
    // $yinbiaotemp = Yinbiao::first();
    // $yinbiaotemp->relatedwords()->detach(3);
    // dd($yinbiaotemp->relatedwords);
    // dd(($yinbiaotemp->relatedwords()->attach(3)));
});
/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */
Route::get('todo','TodoController@indexhtml');
Route::group(array('prefix'=>'api/todo'), function(){
    Route::get('/','TodoController@index');
    Route::get('/{id}','TodoController@show');
    Route::post('/', 'TodoController@store');
});

Route::get('getjs', 'JSController@index');
// guest added english words
Route::resource('guestaddedword','GuestaddedwordsController');
// yinbiao routes
Route::get('yinbiao/wordlist', 'YinbiaoController@getWordlist');
Route::resource('yinbiao','YinbiaoController');
// yinbiao category routes
Route::resource('yinbiaocategory','YinbiaocategoryController');
// 音标发音规则
Route::resource('fayinguize', 'FayinguizeController');
// 音标相关单词
Route::resource('relatedword', 'RelatedwordController');

// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset');
//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit');

//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');
Route::post('user/loginx', 'UserController@postLoginX');

# User RESTful Routes (Login, Logout, Register, etc)
Route::post('user/logoutx','UserController@postLogoutX');
Route::get('user/loginstatusx','UserController@getLoginStatusX');

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
    Route::get('yinbiaorelatedwords/guizesearch', array('as'=>'postyinbiaoguizesearch', 'uses' => 'AdminYinbiaorelatedwordsController@getGuizeSearch')); 
    Route::controller('yinbiaorelatedwords', 'AdminYinbiaorelatedwordsController');

    # word related sentence Management
    Route::get('relatedsentences', 'AdminRelatedsentenceController@getIndex');
    Route::get('relatedsentences/data', 'AdminRelatedsentenceController@getData'); 
    Route::get('relatedsentences/create', 'AdminRelatedsentenceController@getCreate');     
    // Route::get('relatedsentences/{relatedsentence}/show', 'AdminRelatedsentenceController@getShow');
    Route::get('relatedsentences/{relatedsentence}/edit', 'AdminRelatedsentenceController@getEdit');
    Route::post('relatedsentences/{relatedsentence}/edit', 'AdminRelatedsentenceController@postEdit');
    Route::get('relatedsentences/{relatedsentence}/delete', 'AdminRelatedsentenceController@getDelete');
    Route::post('relatedsentences/{relatedsentence}/delete', array('as'=>'postrelatedsentencedelete', 'uses' => 'AdminRelatedsentenceController@postDelete'));
    Route::get('relatedsentences/wordsearch', array('as'=>'postwordsearch', 'uses' => 'AdminRelatedsentenceController@getWordSearch')); 
    Route::controller('relatedsentences', 'AdminRelatedsentenceController');

    # Yinbiao Fayinguize Management
    Route::get('fayinguizes', 'AdminFayinguizeController@getIndex');
    Route::get('fayinguizes/data', 'AdminFayinguizeController@getData'); 
    Route::get('fayinguizes/create', 'AdminFayinguizeController@getCreate');     
    // Route::get('fayinguizes/{fayinguize}/show', 'AdminFayinguizeController@getShow');
    Route::get('fayinguizes/{fayinguize}/edit', 'AdminFayinguizeController@getEdit');
    Route::post('fayinguizes/{fayinguize}/edit', 'AdminFayinguizeController@postEdit');
    Route::get('fayinguizes/{fayinguize}/delete', 'AdminFayinguizeController@getDelete');
    Route::post('fayinguizes/{fayinguize}/delete', array('as'=>'postfayinguizedelete', 'uses' => 'AdminFayinguizeController@postDelete'));
    Route::controller('fayinguizes', 'AdminFayinguizeController');

    # Guest added words Management
    Route::get('guestaddedwords', 'AdminGuestaddedwordsController@getIndex');
    Route::get('guestaddedwords/data', 'AdminGuestaddedwordsController@getData'); 
    Route::get('guestaddedwords/create', 'AdminGuestaddedwordsController@getCreate');     
    // Route::get('guestaddedwords/{fayinguize}/show', 'AdminGuestaddedwordsController@getShow');
    Route::get('guestaddedwords/{fayinguize}/disable', 'AdminGuestaddedwordsController@getDisable');
    Route::get('guestaddedwords/{fayinguize}/enable', 'AdminGuestaddedwordsController@getEnable');
    Route::get('guestaddedwords/{fayinguize}/delete', 'AdminGuestaddedwordsController@getDelete');
    Route::get('guestaddedwords/{fayinguize}/accept', 'AdminGuestaddedwordsController@getAccept');
    Route::post('guestaddedwords/{fayinguize}/delete', array('as'=>'guestaddedwordsdelete', 'uses' => 'AdminGuestaddedwordsController@postDelete'));
    Route::controller('guestaddedwords', 'AdminGuestaddedwordsController');

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

