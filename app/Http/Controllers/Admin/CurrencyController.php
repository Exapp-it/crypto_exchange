<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Services\FileUploadService;
use Illuminate\Contracts\Support\MessageProvider;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class CurrencyController extends Controller
{
    function index()
    {
        return view('admin.currency.index', [
            'currencies' => Currency::query()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.currency.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            [
                'name' => $request->post('name'),
                'symbol' => $request->post('symbol'),
                'icon' => $request->file('icon'),
            ],
            [
                'name' => ['required', 'string'],
                'symbol' => ['required', 'string'],
                'icon' => ['required', 'file', 'image'],
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $fileUpload = new FileUploadService($request->file('icon'), 'currency');
        $fileUpload->upload();

        Currency::create([
            'name' => $request->post('name'),
            'symbol' => $request->post('symbol'),
            'icon' => $fileUpload->getFileName(),
        ]);

        return Redirect::route('admin.currencies')->with('message', [
            'status' => 'success',
            'text' => __('Currency successfully added'),
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
