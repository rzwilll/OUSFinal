<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdviseeController;
use App\Http\Controllers\OUSController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Auth\Request;


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

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

Route::group(['middleware' => ['auth']], function() { 

Route::get('/home', [App\Http\Controllers\AdviseeController:: class, 'index'])->name('home');

Route::get('/advisee/index', [App\Http\Controllers\AdviseeController:: class, 'index'])->name('advisee.index');
// Route::get('/advisee/view', [App\Http\Controllers\AdviseeController:: class, 'show'])->name('advisee.view');
// Route::get('advisee/view/{id}/{year_id}/{sem_id}/{year_level}', [App\Http\Controllers\AdviseeController::class, 'show']);
Route::get('advisee/view/{ids}',[App\Http\Controllers\AdviseeController::class,'show'])->name('advisee.show');
Route::get('/advisee/get_advisee_list', [App\Http\Controllers\AdviseeController:: class, 'get_advisee_list']);


Route::get('/ous/index', [App\Http\Controllers\OUSController:: class, 'index'])->name('ous.index');
Route::get('/ous/view', [App\Http\Controllers\OUSController:: class, 'show'])->name('ous.view');
Route::get('/ous/add', [App\Http\Controllers\OUSController::class, 'create'])-> name('ous.add');
Route::get('/ous/edit', [App\Http\Controllers\OUSController::class, 'edit'])-> name('ous.edit');
Route::post('/ous/generate_report', [App\Http\Controllers\OUSController::class, 'gen_report'])-> name('ous.gen_report');
Route::get('/ous/get_reports', [App\Http\Controllers\OUSController::class, 'edit'])-> name('ous.edit');
Route::get('/ous/modal_report', [App\Http\Controllers\OUSController::class, 'load_modal_report']);


Route::get('/ous/details/{id}', [App\Http\Controllers\OUSController::class, 'get_ous_details']);
Route::get('/ous/details/{id}',[OUSController::class,'get_ous_details'])->name('ous.get_ous_details');

Route::get('/ous/pdf/{id}', [App\Http\Controllers\OUSController::class, 'get_pdf_details']);
Route::get('/ous/pdf/{id}',[OUSController::class,'get_pdf_details'])->name('ous.get_pdf_details');

Route::get('/ous/copy/{id}', [App\Http\Controllers\OUSController::class, 'get_pdf_copy']);
Route::get('/ous/copy/{id}',[OUSController::class,'get_pdf_copy'])->name('ous.get_pdf_copy');

Route::get('/ous/details', [App\Http\Controllers\OUSController::class, 'get_advisee_info']);

//engagement_activities
Route::get('/ous/update_program_engagement_activities', [App\Http\Controllers\OUSController::class, 'update_program_activities']);
Route::get('/ous/add_program_engagement_activities', [App\Http\Controllers\OUSController::class, 'add_program_activities']);
Route::get('/ous/remove_program_engagement_activities', [App\Http\Controllers\OUSController::class, 'remove_program_activities']);

//output_deliverables
Route::get('/ous/update_program_output_deliverables', [App\Http\Controllers\OUSController::class, 'update_program_output_deliverables']);
Route::get('/ous/add_program_output_deliverables', [App\Http\Controllers\OUSController::class, 'add_program_output_deliverables']);
Route::get('/ous/remove_program_output_deliverables', [App\Http\Controllers\OUSController::class, 'remove_program_output_deliverables']);

//consultation Advising
Route::get('/ous/update_program_consultation_advising', [App\Http\Controllers\OUSController::class, 'update_program_consultation_advising']);
Route::get('/ous/add_program_consultation_advising', [App\Http\Controllers\OUSController::class, 'add_program_consultation_advising']);
Route::get('/ous/remove_program_consultation', [App\Http\Controllers\OUSController::class, 'remove_program_consultation']);

//program risk challenges
Route::get('/ous/update_program_risk_challenges', [App\Http\Controllers\OUSController::class, 'update_program_risk_challenges']);
Route::get('/ous/add_program_risk_challenges', [App\Http\Controllers\OUSController::class, 'add_program_risk_challenges']);
Route::get('/ous/remove_program_risk', [App\Http\Controllers\OUSController::class, 'remove_program_risk']);


// problems_recommendation
Route::get('/ous/update_program_recommendations ', [App\Http\Controllers\OUSController::class, 'update_program_recommendations']);
Route::get('/ous/add_program_recommendations', [App\Http\Controllers\OUSController::class, 'add_program_recommendations']);
Route::get('/ous/remove_program_recommendations', [App\Http\Controllers\OUSController::class, 'remove_program_recommendations']);

//problem encountered
Route::get('/ous/update_program_problems_ecountered ', [App\Http\Controllers\OUSController::class, 'update_program_problems_ecountered']);
// Route::get('/ous/add_program_problems', [App\Http\Controllers\OUSController::class, ' add_program_problems']);
Route::get('/ous/add_program_problem', [App\Http\Controllers\OUSController::class, 'add_program_problems']);
Route::get('/ous/remove_program_problems', [App\Http\Controllers\OUSController::class, 'remove_program_problems']);


// program plans
Route::get('/ous/update_program_plans', [App\Http\Controllers\OUSController::class, 'update_program_plans']);
Route::get('/ous/add_program_plans', [App\Http\Controllers\OUSController::class, 'add_program_plans']);
Route::get('/ous/remove_program_plans', [App\Http\Controllers\OUSController::class, 'remove_program_plans']);

//collaboration and linkages
Route::get('/ous/update_program_collaboration_linkages', [App\Http\Controllers\OUSController::class, 'update_program_collaboration_linkages']);
Route::get('/ous/add_pogram_collaborations_linkages', [App\Http\Controllers\OUSController::class, 'add_pogram_collaborations_linkages']);
Route::get('/ous/remove_program_collaborations', [App\Http\Controllers\OUSController::class, 'remove_program_collaborations']);
// Route::get('/modal_report', [OUSController::class, 'load_modal_report'])->name('ous.gen_report');

Route::get('/ous/submit_ous_report', [App\Http\Controllers\OUSController::class, 'submit_ous_report']);



Route::get('admin/home', [OUSController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Route::get('/admin/report/{id}', [App\Http\Controllers\OUSController::class, 'admin_view_report'])->middleware('is_admin');
Route::get('/admin/report/{id}',[OUSController::class,'admin_view_report'])->name('admin_view_report')->middleware('is_admin');

Route::get('/admin/resubmit/{id}', [App\Http\Controllers\OUSController::class, 'request_resubmit'])->middleware('is_admin');
Route::get('/admin/resubmit/{id}',[OUSController::class,'request_resubmit'])->name('request_resubmit')->middleware('is_admin');

});