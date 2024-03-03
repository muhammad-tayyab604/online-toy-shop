<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class usersFeedbackController extends Controller
{
    public function usersFeedback()
    {
        $feedbacks = Feedback::paginate(10);
        return view("admin.userFeedback.feedback", compact('feedbacks'));
    }
}
