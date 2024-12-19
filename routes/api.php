<?php

use Illuminate\Http\Request;
use App\Events\WebRTCSignaling;
use App\Http\Controllers\MeetingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/signal', function (Request $request) {
    broadcast(new WebRTCSignaling($request->type, $request->data));
    return response()->json(['success' => true]);
});
Route::get('meeting/start/{id}', [MeetingController::class, 'start'])->name('meeting.start');
Route::post('meeting/summary', [MeetingController::class, 'generateSummary'])->name('meeting.summary');

Route::post('meeting/signal', [MeetingController::class, 'signal']);



Route::post('/meeting/join/{id}', [MeetingController::class, 'joinMeeting'])->name('meeting.join');
Route::post('/meeting/leave/{id}', [MeetingController::class, 'leaveMeeting'])->name('meeting.leave');
Route::post('/meeting/end/{id}', [MeetingController::class, 'endMeeting'])->name('meeting.end');