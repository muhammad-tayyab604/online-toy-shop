<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class feedbackController extends Controller
{
    public function postFeedback(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        $feedback = new Feedback();
        $feedback->name = $request->name;
        $feedback->email = $request->email;
        $feedback->message = $request->message;
        $feedback->save();
        return redirect()->back()->with('successFeedback', 'Your Feedback has been submitted');
    }
}
