<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('logs', 'HomeController@showLogs')->name('logs')->middleware('auth','permission:All|View Logs');


// Route::get('forget-password', 'ForgotPasswordController@showForgetPasswordForm')->name('forget.password.request');
Route::post('forgetpassword', 'Auth\ForgotPasswordController@submitForgetPasswordForm')->name('forget.password.email'); 
// Route::get('reset-password/{token}', 'Auth\ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');
Route::post('reset-password', 'Auth\ForgotPasswordController@submitResetPassword')->name('reset.password');

// Knowladge Hub
Route::get('knowledgehub', 'KnowladgeHubController@index')->name('knowledgehub')->middleware('permission:All|Add / Edit / Delete Data|View Data');

Route::get('knowledgehubHome', 'KnowladgeHubController@knowledgehubHome')->name('knowledgehubHome')->middleware('permission:All|Add / Edit / Delete Data|View Data');


Route::post('getdashboardcounts', 'DashboardController@getdashboardcounts')->name('getdashboardcounts');


Route::get('knowledgehubdetail/{id}',[
    'uses'=>'KnowladgeHubController@knowledgeHubDetail',
    'as'=>'knowledgehubdetail'
    ])->middleware('permission:All|Add / Edit / Delete Data|View Data');

Route::get('articledetail/{id}',[
    'uses'=>'KnowladgeHubController@getArticleDetail',
    'as'=>'articledetail'
    ])->middleware('permission:All|Add / Edit / Delete Data|Download Data');

    Route::get('lawdetail/{id}',[
        'uses'=>'KnowladgeHubController@getlawDetail',
        'as'=>'lawdetail'
        ])->middleware('permission:All|Add / Edit / Delete Data|Download Data');


            Route::get('datadetail/{id}',[
                'uses'=>'KnowladgeHubController@getdataDetail',
                'as'=>'datadetail'
                ])->middleware('permission:All|Add / Edit / Delete Data|Download Data');


                Route::get('infodetail/{id}',[
                    'uses'=>'KnowladgeHubController@getinfoDetail',
                    'as'=>'infodetail'
                    ])->middleware('permission:All|Add / Edit / Delete Data|Download Data');


                    Route::get('otherdetail/{id}',[
                        'uses'=>'KnowladgeHubController@getotherDetail',
                        'as'=>'otherdetail'
                        ])->middleware('permission:All|Add / Edit / Delete Data|Download Data');

Route::match(['get', 'post'],'commitknowladge',[
    'uses'  =>  "KnowladgeHubController@storeKnowladgeHub",
    'as'    =>  "store.knowladge",
    ])->middleware('permission:All|Add / Edit / Delete Data');

Route::match(['get', 'post'],'knowladgeupdate',[
    'uses'  =>  "KnowladgeHubController@updateKnowladgeHub",
    'as'    =>  "update.knowladge",
    ])->middleware('permission:All|Add / Edit / Delete Data');

Route::get('removeknowledgehub/{id}', 'KnowladgeHubController@removeKnowledgeHub')->name('removeknowledgehub')->middleware('permission:All|Add / Edit / Delete Data');

Route::match(['get', 'post'],'commitarticle',[
    'uses'  =>  "KnowladgeHubController@storeArticle",
    'as'    =>  "store.article",
    ])->middleware('permission:All|Add / Edit / Delete Data');

Route::match(['get', 'post'],'articleupdate',[
    'uses'  =>  "KnowladgeHubController@updateArticle",
    'as'    =>  "update.article",
    ])->middleware('permission:All|Add / Edit / Delete Data');

Route::get('removearticle/{id}', 'KnowladgeHubController@removeArticle')->name('removearticle')->middleware('permission:All|Add / Edit / Delete Data');

Route::match(['get', 'post'],'commitotherknowledge',[
    'uses'  =>  "KnowladgeHubController@storeOtherKnowledge",
    'as'    =>  "store.otherknowledge",
    ])->middleware('permission:All|Add / Edit / Delete Data');

Route::match(['get', 'post'],'otherknowledgeupdate',[
    'uses'  =>  "KnowladgeHubController@updateOtherKnowledge",
    'as'    =>  "update.otherknowledge",
    ])->middleware('permission:All|Add / Edit / Delete Data');

Route::get('removeotherknowledge/{id}', 'KnowladgeHubController@removeOtherKnowledge')->name('removeotherknowledge')->middleware('permission:All|Add / Edit / Delete Data');

Route::match(['get', 'post'],'commitdataset',[
    'uses'  =>  "KnowladgeHubController@storeDataSet",
    'as'    =>  "store.data_set",
    ])->middleware('permission:All|Add / Edit / Delete Data');

Route::match(['get', 'post'],'datasetupdate',[
    'uses'  =>  "KnowladgeHubController@updateDataSet",
    'as'    =>  "update.data_set",
    ])->middleware('permission:All|Add / Edit / Delete Data');

Route::get('removedataset/{id}', 'KnowladgeHubController@removeDataSet')->name('removedataset')->middleware('permission:All|Add / Edit / Delete Data');

Route::match(['get', 'post'],'commitlawregulations',[
    'uses'  =>  "KnowladgeHubController@storeLawAndRegulation",
    'as'    =>  "store.law_regulation",
    ])->middleware('permission:All|Add / Edit / Delete Data');

Route::match(['get', 'post'],'lawregulationsupdate',[
    'uses'  =>  "KnowladgeHubController@updateLawAndRegulation",
    'as'    =>  "update.law_regulation",
    ])->middleware('permission:All|Add / Edit / Delete Data');

Route::get('removelawregulations/{id}', 'KnowladgeHubController@removeLawAndRegulation')->name('removelawregulations')->middleware('permission:All|Add / Edit / Delete Data');


Route::match(['get', 'post'],'commitinfographic',[
    'uses'  =>  "KnowladgeHubController@storeInfographic",
    'as'    =>  "store.infographic",
    ])->middleware('permission:All|Add / Edit / Delete Data');

Route::match(['get', 'post'],'updateinfographic',[
    'uses'  =>  "KnowladgeHubController@updateInfographic",
    'as'    =>  "update.infographic",
    ])->middleware('permission:All|Add / Edit / Delete Data');

Route::get('removeinfographic/{id}', 'KnowladgeHubController@removeInfographic')->name('removeinfographic')->middleware('permission:All|Add / Edit / Delete Data');


Route::match(['post'],'searchknowladge',[
    'uses'  =>  "KnowladgeHubController@searchKnowladgeHub",
    'as'    =>  "searchknowladge",
    ]);

Route::match(['post'],'resetknowladge',[
    'uses'  =>  "KnowladgeHubController@resetKnowladgeHub",
    'as'    =>  "resetknowladge",
    ]);




// Knowladge Hub



// Route::get('knowledgehub', function () {
//     return view('knowledge_hub.index');
// })->name('knowledgehub');

// Route::get('knowledgehubdetail', function () {
//     return view('knowledge_hub.knowledge_hub_detail');
// })->name('knowledgehubdetail');

Route::get('/', 'WebController@index')->name('index');
Route::get('/welcome', 'WebController@home')->name('welcome');
Route::get('/launch', 'WebController@launch')->name('launch');



Auth::routes();


Route::post('/getcustomgraphoptionreq', 'DashboardController@getcustomgraphoptionreq')->name('getcustomgraphoptionreq');
Route::post('/getcustomgraphoption2', 'DashboardController@getcustomgraphoption2')->name('getcustomgraphoption2');
Route::post('/getcustomgraphoption3', 'DashboardController@getcustomgraphoption3')->name('getcustomgraphoption3');

Route::get('/home/{id?}', 'DashboardController@home')->name('home');

Route::get('/genderStatistics', 'DashboardController@genderStatistics')->name('genderStatistics');


Route::post('/filterindicators', 'DashboardController@filterindicators')->name('filterindicators');
Route::post('/myfiltercheck', 'DashboardController@myfiltercheck')->name('myfiltercheck');
Route::post('/myfilterchecksecond', 'DashboardController@myfilterchecksecond')->name('myfilterchecksecond');
Route::post('/myfiltercheckthird', 'DashboardController@myfiltercheckthird')->name('myfiltercheckthird');
Route::post('/filterindicatorsresi', 'DashboardController@filterindicatorsresi')->name('filterindicatorsresi');
Route::post('/filterindicatorsspecific1', 'DashboardController@filterindicatorsspecific1')->name('filterindicatorsspecific1');
Route::post('/filterindicatorsspecific2', 'DashboardController@filterindicatorsspecific2')->name('filterindicatorsspecific2');
Route::post('/filterindicatorsspecific3', 'DashboardController@filterindicatorsspecific3')->name('filterindicatorsspecific3');
Route::post('/filterindicatorsadva', 'DashboardController@filterindicatorsadva')->name('filterindicatorsadva');

Route::post('/filterindicatorsspecificadva', 'DashboardController@filterindicatorsspecificadva')->name('filterindicatorsspecificadva');
Route::post('/filterindicatorsspecific2table', 'DashboardController@filterindicatorsspecific2table')->name('filterindicatorsspecific2table');
Route::post('/filterindicatorsspecific3table', 'DashboardController@filterindicatorsspecific3table')->name('filterindicatorsspecific3table');

Route::post('/filterindicatorsadvaall', 'DashboardController@filterindicatorsadvaall')->name('filterindicatorsadvaall');
Route::post('/filterindicatorsresiadva', 'DashboardController@filterindicatorsresiadva')->name('filterindicatorsresiadva');
Route::post('/filterindicatorsage', 'DashboardController@filterindicatorsage')->name('filterindicatorsage');
Route::post('/getsurveyyear', 'DashboardController@getsurveyyear')->name('getsurveyyear');
Route::post('/getsurveyarea', 'DashboardController@getsurveyarea')->name('getsurveyarea');
Route::post('/filterindicatorssearch', 'DashboardController@filterindicatorssearch')->name('filterindicatorssearch');
Route::post('/filterindicatorschild', 'DashboardController@filterindicatorschild')->name('filterindicatorschild');
Route::post('/filterindicatorschildsearch', 'DashboardController@filterindicatorschildsearch')->name('filterindicatorschildsearch');
Route::get('/map', 'DashboardController@map')->name('map');
Route::get('/gismap', 'DashboardController@gismap')->name('gismap');




Route::post('/submitInfo', 'IndicatorController@submitInfo')->name('submitInfo');

Route::post('/indicatorinfocommit', 'MainIndicatorController@storeIndicatorInfo')->name('indicatorinfo.store');

Route::get('/indicators/{id}', 'IndicatorController@indicators')->name('indicators');

Route::post('/editInfoheadline', 'IndicatorController@editInfoheadline')->name('editInfoheadline');
Route::post('/editInfochild', 'IndicatorController@editInfochild')->name('editInfochild');
Route::post('/getinfoheadline', 'IndicatorController@getinfoheadline')->name('getinfoheadline');
Route::post('/getinfosubchild', 'IndicatorController@getinfosubchild')->name('getinfosubchild');
Route::post('/submitInfochild', 'IndicatorController@submitInfochild')->name('submitInfochild');
Route::post('/editinfo', 'IndicatorController@editinfo')->name('editinfo');
Route::post('/deleteheadinfo', 'IndicatorController@deleteheadinfo')->name('deleteheadinfo');
Route::post('/deletesubinfo', 'IndicatorController@deletesubinfo')->name('deletesubinfo');
Route::post('/editindicator', 'IndicatorController@editindicator')->name('editindicator');
Route::post('/deleteIndicator', 'IndicatorController@deleteIndicator')->name('deleteIndicator');
// Route::post('/filterIndicator', 'IndicatorController@filterIndicator')->name('filterIndicator');

Route::post('/search_indicator', 'DashboardController@search_indicator')->name('search_indicator');
Route::post('/gettargets', 'DashboardController@gettargets')->name('gettargets');
Route::post('/getdivisions', 'DashboardController@getdivisions')->name('getdivisions');
Route::post('/getdistricts', 'DashboardController@getdistricts')->name('getdistricts');
Route::post('/getindicatorsnew', 'DashboardController@getindicatorsnew')->name('getindicatorsnew');
Route::post('/gettargetsnew', 'DashboardController@gettargetsnew')->name('gettargetsnew');
Route::post('/editPolicy', 'IndicatorController@editPolicy')->name('editPolicy');
Route::post('/getlevel', 'DashboardController@getlevel')->name('getlevel');


// THEME ROUTES
Route::get('/themes', 'ThemeController@index')->name('themes')->middleware('auth');

Route::get('/themesubtheme/{id}', 'ThemeController@getThemeBySubTheme')->name('themesubtheme');


Route::get('/legaldelete/{id}', 'IndicatorController@legaldelete')->name('legaldelete');
Route::get('/policydelete/{id}', 'IndicatorController@policydelete')->name('policydelete');
Route::get('/deleteinfo/{id}', 'IndicatorController@deleteinfo')->name('deleteinfo');




Route::post('themecommit',[
	'uses'=>'ThemeController@storeTheme',
	'as'=>'theme.store'
	])->middleware('auth');

Route::post('themeupdate',[
	'uses'=>'ThemeController@updateTheme',
	'as'=>'theme.update'
	])->middleware('auth');



Route::post('/themetrash','ThemeController@removeTheme')->name('theme.delete')->middleware('auth');
// END THEME ROUTES


// SUBTHEME ROUTES
Route::post('subthemecommit',[
    'uses'=>'SubThemeController@storeSubTheme',
    'as'=>'subtheme.store'
    ])->middleware('auth');

Route::post('subthemeupdate',[
    'uses'=>'SubThemeController@updateSubTheme',
    'as'=>'subtheme.update'
    ])->middleware('auth');

Route::post('/subthemetrash','SubThemeController@removeSubTheme')->name('subthemetrash')->middleware('auth');
;

// END SUBTHEME ROUTES


// SUBTHEME ROUTES

    Route::post('indicatorcommit',[
        'uses'=>'IndicatorController@storeIndicator',
        'as'=>'indicator.store'
        ])->middleware('auth');

    Route::post('qualitativecommit',[
        'uses'=>'IndicatorController@storeQualitative',
        'as'=>'qualitative.store'
        ])->middleware('auth');

Route::post('requirementupdate',[
    'uses'=>'IndicatorController@updateRequirement',
    'as'=>'requirement.update'
    ])->middleware('auth');

Route::get('/requirementtrash/{id}','SubThemeController@removeIndicator')->name('requirementtrash')->middleware('auth');
;

// END SUBTHEME ROUTES


// USER ROUTES
Route::get('/users', 'UserController@index')->name('users')->middleware('auth');


Route::post('usercommit',[
	'uses'=>'UserController@storeUser',
	'as'=>'user.store'
	])->middleware('auth');

Route::post('userupdate',[
	'uses'=>'UserController@updateUser',
	'as'=>'user.update'
	])->middleware('auth');

Route::get('/usertrash/{id}','UserController@removeUser')->name('usertrash')->middleware('auth');
Route::get('/createuser', 'UserController@createuser')->name('createuser');
Route::get('/registeruser', 'UserController@registeruser')->name('registeruser');
Route::get('/userlist', 'UserController@userlist')->name('userlist');
Route::post('/loginAjax', 'UserController@loginAjax')->name('loginAjax');
Route::post('/reguser', 'UserController@reguser')->name('reguser');
Route::post('/approveuser', 'UserController@approveuser')->name('approveuser');
Route::post('/changerole', 'UserController@changerole')->name('changerole')->middleware('auth','permission:All|Change Roles');
Route::get('/userdetails/{id}', 'UserController@userdetails')->name('userdetails');
Route::post('/rejectuser', 'UserController@rejectuser')->name('rejectuser');
Route::get('/registerlist', 'UserController@registerlist')->name('registerlist');
// END USER ROUTES

// ROLES AND PERMISSION ROUTES
Route::get('/roles', 'RoleController@index')->name('roles')->middleware('auth','permission:All|Add Roles|Update Roles');

Route::match(['get', 'post'],'commitrole',[
    'uses'  =>  "RoleController@storeRole",
    'as'    =>  "store.role",
    ])->middleware('auth','permission:All|Add Roles');


Route::match(['get', 'post'],'commitroleupdate',[
    'uses'  =>  "RoleController@updateRole",
    'as'    =>  "update.role",
    ])->middleware('auth','permission:All|Update Roles');

Route::get('assignroles/{id}', 'RoleController@getRoleList')->name('assignroles')->middleware('auth');

Route::post('coomitverifyroles',[
    'uses'  =>  "RoleController@verifyRoleByUser",
    'as'    =>  "verifyusers.role",
    ])->middleware('auth');

Route::get('/removerole/{id}', 'RoleController@removeRole')->middleware('auth');


Route::get('/assignpermission/{id}', 'RoleController@getPermissionList')->name('assignpermission')->middleware('auth','permission:All|Add Roles');

Route::post('comitverifypermission',[
    'uses'  =>  "RoleController@verifyPermissionByRole",
    'as'    =>  "verifypermission.role",
    ])->middleware('auth','permission:All|Add Roles');

Route::post('/searchknowledgetheme', 'KnowladgeHubController@searchKnowladgeTheme')->name('searchknowledgetheme');

Route::get('/filetoupload', 'ApisController@filetoupload')->name('filetoupload')->middleware('auth');
Route::post('/uploadmyfileqit', 'ApisController@uploadmyfileqit')->name('uploadmyfileqit')->middleware('auth');
//  END ROLES AND PERMISSION ROUTES

Route::post('/showmultiplethemedata', 'KnowladgeHubController@showMultipleThemeData')->name('show.multiplethemedata');

Route::post('indicatorgraphview',[
    'uses'  =>  "IndicatorController@getIndividualIndicatorGraph",
    'as'    =>  "indicatorgraphview",
    ])->middleware('auth','permission:All|Add Roles');

Route::post('indicatormapview',[
    'uses'  =>  "IndicatorController@getIndividualIndicatorMap",
    'as'    =>  "indicatormapview",
    ])->middleware('auth','permission:All|Add Roles');

Route::get('/viewtheme/{id?}', 'DashboardController@viewTheme')->name('viewtheme');

Route::get('/gismapdetails', 'DashboardController@gismapDetails')->name('gismapdetails');

Route::post('filterprovince',[
    'uses'  =>  "DashboardController@getInfoByProvinceId",
    'as'    =>  "filterprovince",
    ])->middleware('auth');


Route::match(['post','get'],'changepassword',[
    'uses'  =>  "UserController@changeUserPassword",
    'as'    =>  "change.password",
    ])->middleware('auth');
    