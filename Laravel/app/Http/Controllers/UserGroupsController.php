<?php 
namespace App\Http\Controllers;

use App\Models\Groups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserGroupsController extends Controller
{
    public function index()
    {
    	$this->data['groups'] = Groups::all();

    	return view('admin.groups.groups', $this->data);
    }


    public function create()
    {
    	return view('admin.groups.create');    	
    }

    public function store( Request $request )
    {
    	$formData = $request->all();
    	if( Groups::create($formData) ) {
    		Session::flash('message', 'Group Created Successfully');
    	}
    	
    	return redirect()->to('groups');
    }

    public function destroy($id)
    {
    	if( Groups::find($id)->delete() ) {
    		Session::flash('message', 'Group Deleted Successfully');
    	}
    	
    	return redirect()->to('groups');
    }
}