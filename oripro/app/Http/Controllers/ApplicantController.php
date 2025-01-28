<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    public function index()
    {
        $applicants = Applicant::all();
        return view('applicants.index', compact('applicants'));
    }

    public function create()
    {
        return view('applicants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_ID' => 'required|exists:users,user_ID',
            'request_ID' => 'required|exists:requests,request_ID',
        ]);

        Applicant::create($request->all());
        return redirect()->route('applicants.index');
    }

    public function show(Applicant $applicant)
    {
        return view('applicants.show', compact('applicant'));
    }

    public function edit(Applicant $applicant)
    {
        return view('applicants.edit', compact('applicant'));
    }

    public function update(Request $request, Applicant $applicant)
    {
        $request->validate([
            'user_ID' => 'required|exists:users,user_ID',
            'request_ID' => 'required|exists:requests,request_ID',
        ]);

        $applicant->update($request->all());
        return redirect()->route('applicants.index');
    }

    public function destroy(Applicant $applicant)
    {
        $applicant->delete();
        return redirect()->route('applicants.index');
    }
}