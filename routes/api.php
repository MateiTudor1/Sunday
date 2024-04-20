<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Upcomings tasks
//Sa afisezi toate taskurile upcoming
Route::get("/upcoming",function ()
{
    $upcoming=\App\Models\Upcoming::all();

    return \App\Http\Resources\UpcomingResource::collection($upcoming);

    return $upcoming;
});

//Sa se adauge un nou task
Route::post('/upcoming',function (Request $request)
{
    return \App\Models\Upcoming::create([
            'title'=>$request->title,
            'taskId'=>$request->taskId,
            'waitinh'=>$request->waiting
        ]
    );
});

//Sa se stearga un task
Route::delete('/upcoming/{taskId}',function ($taskId)
{
    DB::table('upcomings')->where('taskId',$taskId)->delete();

    return 204;
});

//Today task

Route::post('/today',function (Request $request)
{
    return \App\Models\Today::create([
        'id'=>$request->id,
        'title'=>$request->title,
        'taskId'=>$request->taskId
    ]);
});

Route::delete('/today/{taskId}',function ($taskId)
{

    DB::table('todays')->where('taskId',$taskId)->delete();

    return 204;
});
