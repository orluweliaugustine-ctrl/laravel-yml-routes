<?php

namespace Broswilli\LaravelYmlRoutes\Http\Controllers;

use Illuminate\Http\Request;

class InvokableController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return 'Invokable Controller Response response';
    }
}
