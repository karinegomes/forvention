<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyMedia;
use App\Http\Requests\MediaRequest;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class CompanyMediaController extends Controller {

    public function __construct() {
        $this->middleware('manage_companies.edit', ['only' => ['create', 'store']]);
        $this->middleware('manage_companies.view', ['only' => ['index']]);
        $this->middleware('manage_companies.show', ['only' => ['show']]);
    }

    public function index(Company $company) {

        $medias = $company->medias;

        return view('company_media.index')->with('medias', $medias)->with('company', $company);

    }

    public function create(Company $company) {
        return view('company_media.create')->with('company', $company);
    }

    public function store(MediaRequest $request, Company $company) {

        $data = $request->except(['_token', 'edit', 'file']);
        $data['company_id'] = $company->id;

        try {
            $folder = 'companies/' . $company->id;
            $fileName = $data['file_name'] . '.' . $request['file']->getClientOriginalExtension();
            $path = $request->file('file')->storeAs($folder, $fileName);
            $data['path'] = $path;

            CompanyMedia::create($data);
        }
        catch(Exception $e) {
            $error = Config::get('constants.ERROR_MESSAGE');
            //$error = $e->getMessage();

            return back()->withInput($request->except('_token'))->with('error', $error);
        }

        $message = 'The file is successfully uploaded.';

        return redirect('companies/' . $company->id . '/medias')->with('message', $message);

    }

    public function show(Company $company, CompanyMedia $media) {
        return view('company_media.show')->with('company', $company)->with('media', $media);
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $id) {
        //
    }

    public function destroy($id) {
        //
    }
}
