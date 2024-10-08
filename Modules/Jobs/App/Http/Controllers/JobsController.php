<?php

namespace Modules\Jobs\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('AuthAdmin');
        $this->middleware('permission:job-index', ['only' => ['index']]);
        $this->middleware('permission:job-create', ['only' => ['create']]);
        $this->middleware('permission:job-update', ['only' => ['update']]);
        $this->middleware('permission:job-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        return view('jobs::jobs');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('jobs::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('jobs::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
