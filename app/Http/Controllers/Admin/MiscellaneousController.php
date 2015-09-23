<?php

namespace App\Http\Controllers\Admin;

use Input;
use App\Models\Role;
use App\Models\Miscellaneous;
use Hash;
use Auth;
use Session;
use App\Http\Controllers\Controller;

class MiscellaneousController extends Controller {

    public function index() {
        $settings = Miscellaneous::paginate(Config('constants.paginateNo'));

        return view(Config('constants.adminMiscellaneousView') . '.index', compact('settings'));
    }

    public function add() {
        $miscellaneous = new Miscellaneous();
        $action = route("admin.miscellaneous.save");
        return view(Config('constants.adminMiscellaneousView') . '.addEdit', compact('miscellaneous', 'action'));
    }

    public function save() {
        $saveMiscellaneous = Miscellaneous::findOrNew(Input::get('id'));
        $saveMiscellaneous->name = Input::get('name');
        $saveMiscellaneous->value = Input::get('value'); 
        $saveMiscellaneous->save();
        return redirect()->route('admin.miscellaneous.view');
    }

    public function edit() {
        $setting = Miscellaneous::find(Input::get('id'));
        $action = route("admin.miscellaneous.save");
        return view(Config('constants.adminMiscellaneousView') . '.addEdit', compact('setting', 'action'));
    }

    public function delete() {
        $id = Input::get('id');
        $settings = Miscellaneous::find($id);
        $settings->delete();

        return redirect()->back()->with("message", "Deleted Successfully");
    }

}
