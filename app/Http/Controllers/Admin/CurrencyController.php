<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\User;
use App\Services\FileUploadService;
use Illuminate\Contracts\Support\MessageProvider;
use Illuminate\Http\Request;
use Redirect;
use Validator;
use Wallet;

class CurrencyController extends Controller
{
    function index()
    {
        $currencies = Currency::query()->paginate(10);

        return view('admin.currency.index', [
            'currencies' => $currencies,
        ]);
    }

    public function create()
    {
        return view('admin.currency.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make(
            [
                'name' => $request->post('name'),
                'symbol' => $request->post('symbol'),
                'type' => $request->post('type'),
                'icon' => $request->file('icon'),
            ],
            [
                'name' => ['required', 'string'],
                'symbol' => ['required', 'string'],
                'type' => ['required', 'in:' . implode(',', array_keys(config('wallet.types')))],
                'icon' => ['required', 'file', 'image'],
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $fileUpload = new FileUploadService($request->file('icon'), 'currency');
        $fileUpload->upload();

        Currency::create([
            'symbol' => $request->post('symbol'),
            'name' => $request->post('name'),
            'type' => $request->post('type'),
            'icon' => $fileUpload->getFileName(),
        ]);

        $users = User::all();
        foreach ($users as $user) {
            Wallet::create($user);
        }

        return Redirect::route('admin.currencies')->with('message', [
            'status' => 'success',
            'text' => __('Currency successfully added'),
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $currencies = Currency::where(function ($queryBuilder) use ($query) {
            $queryBuilder->whereRaw("LOWER(CONCAT(name, ' ', symbol)) LIKE ?", ['%' . strtolower($query) . '%'])
                ->orWhere('symbol', 'like', '%' . $query . '%');
        })->paginate(10);

        return view('admin.currency.index', [
            'currencies' => $currencies,
        ]);
    }



    function changeStatus($id)
    {
        $currency = Currency::findOrFail($id);

        $currency->status = !$currency->status;
        $currency->save();

        $statusText = $currency->status ? __('active') : __('inactive');

        return back()->with('message', [
            'status' => 'success',
            'text' => __('Status has been successfully changed to ' . $statusText),
        ]);
    }

    function destroy($id)
    {
        $currency = Currency::findOrFail($id);
        $currency->delete();

        return back()->with('message', [
            'status' => 'success',
            'text' => __('Currency successfully deleted'),
        ]);
    }
}
