<?php


use Illuminate\Support\Facades\Route;
use App\Models\job;

Route::get('/home', function () {
    return view('home');
});

//index, displays all the jobs
Route::get('/jobs', function () {

    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view("jobs.index", [
        'jobs' => $jobs
    ]);
});

//create
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

//show
Route::get('/jobs/{id}', function ($id) {

    $job = job::find($id);

    return view("jobs.show", ['job' => $job]);
});

//store or persists a new job in the database
Route::post('/jobs', function () {
    //validation
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => '1',
    ]);

    return redirect('/jobs');
});

//edit
Route::get('/jobs/{id}/edit', function ($id) {

    $job = job::find($id);

    return view("jobs.edit", ['job' => $job]);
});

//update
Route::patch('/jobs/{id}', function ($id) {
    //validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required'],
    ]);
    //authorize(on hold ...)
    //update the job
    $job = Job::findOrFail($id);
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);
    //and persist
    //redirect to the job page
    return redirect('/jobs/' . $job->id);
});

//Destroy
Route::delete('/jobs/{id}', function ($id) {
    //authorize
    //delete the job
    Job::findOrFail($id)->delete();
    //redirect
    return redirect('/jobs');
});

Route::get("/contact", function () {
    return view("contact");
});
