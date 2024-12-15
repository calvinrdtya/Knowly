<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AssignmentSubmissionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\QuizController;
use App\Models\AssignmentSubmission;
use App\User;

Auth::routes();

//Route::get('/test', 'TestController@index')->name('test');
Route::get('/privacy-policy', 'HomeController@privacy_policy')->name('privacy_policy');
Route::get('/terms-of-use', 'HomeController@terms_of_use')->name('terms_of_use');


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'HomeController@dashboard')->name('home');
    Route::get('/home', 'HomeController@dashboard')->name('home');
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

    Route::group(['prefix' => 'my_account'], function() {
        Route::get('/', 'MyAccountController@edit_profile')->name('my_account');
        Route::put('/', 'MyAccountController@update_profile')->name('my_account.update');
        Route::put('/change_password', 'MyAccountController@change_pass')->name('my_account.change_pass');
    });

    /*************** Support Team *****************/
    Route::group(['namespace' => 'SupportTeam',], function(){

        /*************** Students *****************/
        Route::group(['prefix' => 'students'], function(){
            Route::get('reset_pass/{st_id}', 'StudentRecordController@reset_pass')->name('st.reset_pass');
            Route::get('graduated', 'StudentRecordController@graduated')->name('students.graduated');
            Route::put('not_graduated/{id}', 'StudentRecordController@not_graduated')->name('st.not_graduated');
            Route::get('list/{class_id}', 'StudentRecordController@listByClass')->name('students.list')->middleware('teamSAT');

            /* Promotions */
            Route::post('promote_selector', 'PromotionController@selector')->name('students.promote_selector');
            Route::get('promotion/manage', 'PromotionController@manage')->name('students.promotion_manage');
            Route::delete('promotion/reset/{pid}', 'PromotionController@reset')->name('students.promotion_reset');
            Route::delete('promotion/reset_all', 'PromotionController@reset_all')->name('students.promotion_reset_all');
            Route::get('promotion/{fc?}/{fs?}/{tc?}/{ts?}', 'PromotionController@promotion')->name('students.promotion');
            Route::post('promote/{fc}/{fs}/{tc}/{ts}', 'PromotionController@promote')->name('students.promote');

        });

        /*************** Users *****************/
        Route::group(['prefix' => 'users'], function(){
            Route::get('reset_pass/{id}', 'UserController@reset_pass')->name('users.reset_pass');
        });

        /*************** TimeTables *****************/
        Route::group(['prefix' => 'timetables'], function(){
            Route::get('/', 'TimeTableController@index')->name('tt.index');

            Route::group(['middleware' => 'teamSA'], function() {
                Route::post('/', 'TimeTableController@store')->name('tt.store');
                Route::put('/{tt}', 'TimeTableController@update')->name('tt.update');
                Route::delete('/{tt}', 'TimeTableController@delete')->name('tt.delete');
            });

            /*************** TimeTable Records *****************/
            Route::group(['prefix' => 'records'], function(){

                Route::group(['middleware' => 'teamSA'], function(){
                    Route::get('manage/{ttr}', 'TimeTableController@manage')->name('ttr.manage');
                    Route::post('/', 'TimeTableController@store_record')->name('ttr.store');
                    Route::get('edit/{ttr}', 'TimeTableController@edit_record')->name('ttr.edit');
                    Route::put('/{ttr}', 'TimeTableController@update_record')->name('ttr.update');
                });

                Route::get('show/{ttr}', 'TimeTableController@show_record')->name('ttr.show');
                Route::get('print/{ttr}', 'TimeTableController@print_record')->name('ttr.print');
                Route::delete('/{ttr}', 'TimeTableController@delete_record')->name('ttr.destroy');

            });

            /*************** Time Slots *****************/
            Route::group(['prefix' => 'time_slots', 'middleware' => 'teamSA'], function(){
                Route::post('/', 'TimeTableController@store_time_slot')->name('ts.store');
                Route::post('/use/{ttr}', 'TimeTableController@use_time_slot')->name('ts.use');
                Route::get('edit/{ts}', 'TimeTableController@edit_time_slot')->name('ts.edit');
                Route::delete('/{ts}', 'TimeTableController@delete_time_slot')->name('ts.destroy');
                Route::put('/{ts}', 'TimeTableController@update_time_slot')->name('ts.update');
            });

        });

        /*************** Payments *****************/
        Route::group(['prefix' => 'payments'], function(){

            Route::get('manage/{class_id?}', 'PaymentController@manage')->name('payments.manage');
            Route::get('invoice/{id}/{year?}', 'PaymentController@invoice')->name('payments.invoice');
            Route::get('receipts/{id}', 'PaymentController@receipts')->name('payments.receipts');
            Route::get('pdf_receipts/{id}', 'PaymentController@pdf_receipts')->name('payments.pdf_receipts');
            Route::post('select_year', 'PaymentController@select_year')->name('payments.select_year');
            Route::post('select_class', 'PaymentController@select_class')->name('payments.select_class');
            Route::delete('reset_record/{id}', 'PaymentController@reset_record')->name('payments.reset_record');
            Route::post('pay_now/{id}', 'PaymentController@pay_now')->name('payments.pay_now');
        });

        /*************** Pins *****************/
        Route::group(['prefix' => 'pins'], function(){
            Route::get('create', 'PinController@create')->name('pins.create');
            Route::get('/', 'PinController@index')->name('pins.index');
            Route::post('/', 'PinController@store')->name('pins.store');
            Route::get('enter/{id}', 'PinController@enter_pin')->name('pins.enter');
            Route::post('verify/{id}', 'PinController@verify')->name('pins.verify');
            Route::delete('/', 'PinController@destroy')->name('pins.destroy');
        });

        /*************** Marks *****************/
        Route::group(['prefix' => 'marks'], function(){

           // FOR teamSA
            Route::group(['middleware' => 'teamSA'], function(){
                Route::get('batch_fix', 'MarkController@batch_fix')->name('marks.batch_fix');
                Route::put('batch_update', 'MarkController@batch_update')->name('marks.batch_update');
                Route::get('tabulation/{exam?}/{class?}/{sec_id?}', 'MarkController@tabulation')->name('marks.tabulation');
                Route::post('tabulation', 'MarkController@tabulation_select')->name('marks.tabulation_select');
                Route::get('tabulation/print/{exam}/{class}/{sec_id}', 'MarkController@print_tabulation')->name('marks.print_tabulation');
            });

            // FOR teamSAT
            Route::group(['middleware' => 'teamSAT'], function(){
                Route::get('/', 'MarkController@index')->name('marks.index');
                Route::get('manage/{exam}/{class}/{section}/{subject}', 'MarkController@manage')->name('marks.manage');
                Route::put('update/{exam}/{class}/{section}/{subject}', 'MarkController@update')->name('marks.update');
                Route::put('comment_update/{exr_id}', 'MarkController@comment_update')->name('marks.comment_update');
                Route::put('skills_update/{skill}/{exr_id}', 'MarkController@skills_update')->name('marks.skills_update');
                Route::post('selector', 'MarkController@selector')->name('marks.selector');
                Route::get('bulk/{class?}/{section?}', 'MarkController@bulk')->name('marks.bulk');
                Route::post('bulk', 'MarkController@bulk_select')->name('marks.bulk_select');
            });

            Route::get('select_year/{id}', 'MarkController@year_selector')->name('marks.year_selector');
            Route::post('select_year/{id}', 'MarkController@year_selected')->name('marks.year_select');
            Route::get('show/{id}/{year}', 'MarkController@show')->name('marks.show');
            Route::get('print/{id}/{exam_id}/{year}', 'MarkController@print_view')->name('marks.print');

        });

        Route::resource('students', 'StudentRecordController');
        Route::resource('users', 'UserController');
        Route::resource('classes', 'MyClassController');
        Route::resource('sections', 'SectionController');
        Route::resource('subjects', 'SubjectController');
        Route::resource('grades', 'GradeController');
        Route::resource('exams', 'ExamController');
        Route::resource('dorms', 'DormController');
        Route::resource('payments', 'PaymentController');

    });

    /************************ AJAX ****************************/
    Route::group(['prefix' => 'ajax'], function() {
        Route::get('get_lga/{state_id}', 'AjaxController@get_lga')->name('get_lga');
        Route::get('get_class_sections/{class_id}', 'AjaxController@get_class_sections')->name('get_class_sections');
        Route::get('get_class_subjects/{class_id}', 'AjaxController@get_class_subjects')->name('get_class_subjects');
    });

});

/************************ SUPER ADMIN ****************************/
Route::group(['namespace' => 'SuperAdmin','middleware' => 'super_admin', 'prefix' => 'super_admin'], function(){

    Route::get('/settings', 'SettingController@index')->name('settings');
    Route::put('/settings', 'SettingController@update')->name('settings.update');

});

/************************ PARENT ****************************/
Route::group(['namespace' => 'MyParent','middleware' => 'my_parent',], function(){

    Route::get('/my_children', 'MyController@children')->name('my_children');

});


Route::group(['middleware' => 'auth'], function(){
    
    Route::get('student/subjects', 'AttendanceController@index')->name('students.subjects');
    Route::get('student/subjects/{slug}', 'AttendanceController@accessSubject')->name('student.subject.access');
    
    Route::get('subject', 'AttendanceController@subjects')->name('teacher.subjects');
    Route::get('subject/{slug}', 'AttendanceController@openAttendanceView')->name('teacher.subject.access');
    
    Route::get('/attendance/open/{subject_id}', [AttendanceController::class, 'openAttendanceView'])->name('attendance.open.view');
    Route::post('/attendance/open/{subject_id}', [AttendanceController::class, 'openAttendance'])->name('attendance.open');
    Route::post('/attendance/mark/{subject_id}', [AttendanceController::class, 'markAttendance'])->name('attendance.mark');
    Route::get('/attendance/mark/{subject_id}', [AttendanceController::class, 'markAttendanceView'])->name('attendance.mark.view');
    
    Route::post('/attendance/close/{attendance_id}', [AttendanceController::class, 'closeAttendance'])->name('attendance.close');
    
    Route::get('meeting/{host}', [MeetingController::class, 'index'])->name('meeting.index');
    Route::post('meeting/start', [MeetingController::class, 'startMeeting'])->name('meeting.start');
    
    Route::get('meeting/start/{id}', [MeetingController::class, 'start'])->name('meeting.start');
    Route::post('meeting/summary', [MeetingController::class, 'generateSummary'])->name('meeting.summary');
    
    Route::post('meeting/signal', [MeetingController::class, 'signal']);
    
    
    
    Route::post('/meeting/join/{id}', [MeetingController::class, 'joinMeeting'])->name('meeting.join');
    Route::post('/meeting/leave/{id}', [MeetingController::class, 'leaveMeeting'])->name('meeting.leave');
    Route::post('/meeting/end/{id}', [MeetingController::class, 'endMeeting'])->name('meeting.end');


Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
Route::get('/quiz/create', [QuizController::class, 'create'])->name('quiz.create');
Route::post('/quiz/store', [QuizController::class, 'store'])->name('quiz.store');
});

Route::get('assignments', [AssignmentController::class, 'index'])->name('assignments.index');
Route::post('assignments', [AssignmentController::class, 'store'])->name('assignments.store');

Route::get('assignments/show/{assignment}', [AssignmentController::class, 'show'])->name('assignments.show');
Route::get('assignments/submissions/{assignment}', [AssignmentController::class, 'submissions'])->name('assignments.submissions');


Route::get('/get-subjects-by-class', [AssignmentController::class, 'getSubjectsByClass']);
Route::put('assignments/{assignment}/update', [AssignmentController::class, 'update'])->name('assignments.update');
Route::delete('assignments/{assignment}', [AssignmentController::class, 'destroy'])->name('assignments.destroy');
Route::get('assignments/create', [AssignmentController::class, 'create'])->name('assignments.create');
Route::post('assignments/{assignment}/submit', [AssignmentController::class, 'submit'])->name('assignments.submit');

Route::get('assignments/{assignment}/edit', [AssignmentController::class, 'edit'])->name('assignments.edit');

Route::get('student/assignments', [AssignmentSubmissionController::class, 'index'])->name('student.assignments.index');
Route::get('student/assignments/{assignment}', [AssignmentSubmissionController::class, 'show'])->name('student.assignments.show');
Route::post('student/assignments/{assignment}/submit', [AssignmentSubmissionController::class, 'submit'])->name('student.assignments.submit');

Route::get('student/assignments/{assignment}/edit', [AssignmentSubmissionController::class, 'edit'])->name('student.assignments.edit');
Route::put('student/assignments/{assignment}/update', [AssignmentSubmissionController::class, 'update'])->name('student.assignments.update');


// jadwal admin

Route::get('schedules', [JadwalController::class, 'index'])->name('jadwal.index');
Route::get('schedules/create', [JadwalController::class, 'create'])->name('jadwal.create');
Route::get('schedules/{jadwal}', [JadwalController::class, 'show'])->name('jadwal.show');
Route::post('schedules', [JadwalController::class, 'store'])->name('jadwal.store');
Route::get('schedules/{jadwal}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
Route::put('schedules/{jadwal}', [JadwalController::class, 'update'])->name('jadwal.update');
Route::delete('schedules/{jadwal}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');
Route::get('get-subjects/{class_id}', [JadwalController::class, 'getSubjectsByClass']);
Route::get('get-teacher/{subject_id}', [JadwalController::class, 'getTeachersBySubject']);


//jadwal siswa
Route::get('student/schedules', [JadwalController::class, 'studentSchedules'])->name('student.schedules.index');
Route::get('student/schedules/{jadwal}', [JadwalController::class, 'studentShow'])->name('student.schedules.show');

//jadwal guru
Route::get('teacher/schedules', [JadwalController::class, 'teacherSchedules'])->name('teacher.schedules.index');
Route::get('teacher/schedules/{jadwal}', [JadwalController::class, 'teacherShow'])->name('teacher.schedules.show');