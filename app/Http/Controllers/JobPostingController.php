<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPosting;
use App\Http\Requests\JobPostingRequest;

class JobPostingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posting = JobPosting::all();
        return view('job_posting.index', compact('posting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobPostingRequest $jobPostingRequest, JobPosting $jobPosting)
    {
        $posting = $jobPosting::create($jobPostingRequest->all());
        return response()->json(['message' => 'Job Posting has been successfully saved',
            'data' => $posting]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobPosting  $jobPosting
     * @return \Illuminate\Http\Response
     */
    public function show(JobPosting $jobPosting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobPosting  $jobPosting
     * @return \Illuminate\Http\Response
     */
    public function edit(JobPosting $jobPosting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobPosting  $jobPosting
     * @return \Illuminate\Http\Response
     */
    public function update(JobPostingRequest $jobPostingRequest, JobPosting $jobPosting)
    {
        $posting = $jobPosting->update($jobPostingRequest->all());
        return response()->json(['message' => 'Job Posting has been successfully saved',
            'data' => $posting]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobPosting  $jobPosting
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobPosting $jobPosting)
    {
        $jobPosting->delete();
        return response()->json(['message' => 'Job posting has been successfully deleted']);
    }
}
