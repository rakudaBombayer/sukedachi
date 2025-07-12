<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


        $already = Applicant::where('request_ID', $request->request_ID)
        ->where('user_ID', Auth::id())
        ->exists();


        //  dd('step 3: already = ' . ($already ? 'yes' : 'no'));


    //     if ($already) {
    //     return back()->with('error', 'すでに応募済みです');
    // }

        if ($already) {
            return redirect()->route('chat_rooms.goto.get', ['request' => $request->request_ID])
            ->with('info', 'すでに応募済みのためチャットに移動しました');
        }


        // Applicant::create($request->all());

        Applicant::create([
        'request_ID' => $request->request_ID,
        'user_ID' => Auth::id(),
        ]);
        // return redirect()->route('applicants.index');
        // return back()->with('success', '応募が完了しました！');
        // ⭐ ChatRoom に遷移
        // return redirect()->route('chat_rooms.goto', ['request' => $request->request_ID]);

        // dd('step 4: created. now redirecting');

        return redirect()->route('chat_rooms.goto.get', ['request' => $request->request_ID]);
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
