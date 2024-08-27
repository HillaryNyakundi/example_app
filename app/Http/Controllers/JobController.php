<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(3);

        return view("jobs.index", [
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job)
    {
        return view("jobs.show", ['job' => $job]);
    }

    public function store()
    {

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
    }

    public function edit(Job $job)
    {
        return view("jobs.edit", ['job' => $job]);
    }

    public function update(Job $job)
    {

        //authorize(on hold ...)
        //validate
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);
        //update the job
        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);
        //and persist
        //redirect to the job page
        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {

        //authorize
        //delete the job
        $job->delete();
        //redirect
        return redirect('/jobs');
    }
}
