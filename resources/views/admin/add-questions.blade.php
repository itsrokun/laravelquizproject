@extends('layouts.dashboard')

@section('title')
    <title>Dashboard</title>
@endsection

@section('main')
    <h1>Add Question for the Quiz: {{$quiz_list->title}}</h1>
    <div class="text-center">
        <div>
            <form method="post" action="{{route('store.question')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" placeholder="Question" name="question" required class="form-control">
                </div>
                <input type="hidden" name="quiz_id" value="{{$quiz_id}}" readonly required>
                
                <div class="form-group">
                    <input type="text" placeholder="Option A" name="option_a" required class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Option B" name="option_b" required class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Option C" name="option_c" required class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Option D" name="option_d" required class="form-control">
                </div>
                <div class="form-group">
                    <select class="form-control" name="correct_option" required>
                        <option selected disabled value>-- Select Correct Option --</option>
                        <option value="option_a">A</option>
                        <option value="option_b">B</option>
                        <option value="option_c">C</option>
                        <option value="option_d">D</option>
                    </select>
                </div>

                <!-- Diagram Upload Field -->
                <div class="form-group">
                    <label for="question_diagram">Upload Question Diagram (optional)</label>
                    <input type="file" name="question_diagram" class="form-control" id="question_diagram" accept=".jpeg,.png,.jpg,.pdf">
                </div>

                <div class="text-center">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="text-center">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Question</th>
                <th scope="col">A</th>
                <th scope="col">B</th>
                <th scope="col">C</th>
                <th scope="col">D</th>
                <th scope="col">Correct</th>
                <th scope="col">Diagram</th>
            </tr>
            </thead>
            <tbody>
            @php
                $sl=1;
            @endphp
            @foreach($questions as $question)
                <tr>
                    <th scope="row">{{$sl++}}</th>
                    <td>{{$question->question}}</td>
                    <td>{{$question->option_a}}</td>
                    <td>{{$question->option_b}}</td>
                    <td>{{$question->option_c}}</td>
                    <td>{{$question->option_d}}</td>
                    <td>{{$question->correct_option}}</td>
                    <td>
                        @if($question->question_diagram)
                            <a href="{{ asset('storage/' . $question->question_diagram) }}" target="_blank">View Diagram</a>
                        @else
                            No diagram uploaded
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // Optional: You can add any JavaScript for additional functionality.
    </script>
@endsection
