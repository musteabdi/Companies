<?php

namespace LaravelEnso\Companies\app\Http\Controllers\Person;

use Illuminate\Routing\Controller;
use LaravelEnso\Companies\app\Http\Requests\ValidatePersonStore;
use LaravelEnso\Companies\app\Models\Company;

class Store extends Controller
{
    public function __invoke(ValidatePersonStore $request)
    {
        Company::find($request->get('company_id'))
            ->attachPerson($request->get('id'), $request->get('position'));

        return ['message' => __('The person was successfully assigned')];
    }
}
