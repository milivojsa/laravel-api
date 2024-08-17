<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitRequest;
use App\Jobs\ProcessSubmit;

class SubmitController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SubmitRequest $request)
    {
        ProcessSubmit::dispatch(
            $request->validated('name'),
            $request->validated('email'),
            $request->validated('message'),
        );

        return response()->json([
            'message' => 'Thanks for your submission!',
        ]);
    }
}
