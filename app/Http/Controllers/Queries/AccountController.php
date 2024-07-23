<?php

namespace App\Http\Controllers\Queries;

use Illuminate\Http\Request;
use App\Models\Queries\Account;
use App\Http\Controllers\Controller;
use App\Http\Requests\Queries\AccountRequest;
use App\Http\Resources\Queries\AccountResource;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        return AccountResource::collection($accounts);
    }

    public function store(AccountRequest $request)
    {
        $account = Account::create($request->all());
        return [
            "msg" => "Add Successfully",
            "data" => new AccountResource($account),
        ];
    }
}
