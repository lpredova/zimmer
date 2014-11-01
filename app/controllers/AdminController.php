<?php

class AdminController extends \BaseController {


    /**
     * Admin panel index page
     */
    public function indexAdmin()
    {
        return View::make('admin.admin_index');
    }


















	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexRole()
	{
		$roles = Role::all();
        return View::make('admin.roles.index',compact('roles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function createRole()
	{
        return View::make('admin.roles.create');
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeRole()
	{
		$role = new Role();
        $role->name = Input::get('name');
        $role->save();

        return Redirect::to('/admin/roles/');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showRole($id)
	{
        $role = Role::find($id);
        return View::make('admin.roles.show',compact('role'));
    }


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editRole($id)
	{
        $role = Role::find($id);
        return View::make('admin.roles.edit',compact('role'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateRole($id)
	{
        $rules = array('name' => 'required');
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/admin/roles/show/'.$id)->withErrors($validator);
        }
        else {
            $role = Role::find($id);
            $role->name = Input::get('name');
            $role->save();

            Session::flash('message', 'Successfully updated role!');
            return Redirect::to('/admin/roles/show/'.$id);
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroyRole($id)
	{
        // delete
        $role = Role::find($id);
        $role->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the role!');
        return Redirect::to('/admin/roles/');
	}


}
