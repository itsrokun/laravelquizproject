<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function addQuestion($id)
    {
        return view('admin.add-questions')
            ->with('quiz_list', Quiz::where('id', $id)->first())
            ->with('questions', Question::where('quiz_id', $id)->get())
            ->with('quiz_id', $id);
    }

    public function storeQuestion(Request $request)
    {
        // Validate the request
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|string',
            'question_diagram' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048', // Validate file types and size
        ]);

        // Handle file upload if a diagram is uploaded
        if ($request->hasFile('question_diagram')) {
            // Store the uploaded diagram file in the 'public/question_diagrams' folder
            $path = $request->file('question_diagram')->store('question_diagrams', 'public');
        } else {
            // No diagram provided
            $path = null;
        }

        // Create the question
        $question = Question::create([
            'quiz_id' => $request->quiz_id,
            'question' => $request->question,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'correct_option' => $request->correct_option,
            'question_diagram' => $path, // Save the diagram path (if any)
        ]);

        if ($question) {
            return redirect()->back()->with('success', 'Question added successfully!');
        }

        return redirect()->back()->with('error', 'Something went wrong!');
    }
}
