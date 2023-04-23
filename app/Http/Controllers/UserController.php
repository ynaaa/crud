<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInfo;
use Rakit\Validation\Validator;

class UserController extends Controller
{
	public function __construct(UserInfo $UserInfo)
	{
		$this->UserInfo = $UserInfo;
		$this->middleware('guest');
	}

	public function deleteInfo(Request $request)
	{
		if ($request->has('b-delete')) {

			if ($this->UserInfo->deleteInfos($request)) {
				return redirect()->back()
					->with('notificationsuccess', 'Succesfully Deleted Sales Tax');
			} else {

				return redirect()->back()
					->with('globalerror', 'Please Try Again');
			}
		}
	}

	public function getInfo(Request $request)
	{
		$id = $request->id;

		$infos = UserInfo::where('id', $id)->first();

		return response()->json($infos);
	}

	public function editInfo(Request $request)
	{
		if ($request->has('b-edit')) {
			$validator = new Validator;

			$validation = $validator->validate($request->all(), [
				'edit_name'             => 'required',
				'edit_telephone'        => 'required',
				'edit_email'            => 'required',
			]);

			$validation->setAliases([
				'edit_name'      => 'name',
				'edit_telephone' => 'telephone',
				'edit_email'     => 'email'
			]);

			$validation->validate();

			$errors = $validation->errors()->toArray();

			if ($validation->fails()) {
				return redirect('/')
					->withErrors($errors, 'error2')
					->withInput();
			} else {
				if ($this->UserInfo->editInfos($request)) {
					return redirect()->back()
						->with('notificationsuccess', 'Succesfully Created');
				} else {
					return redirect()->back()
						->with('globalerror', 'Please Try Again');
				}
			}
		}
	}

	public function insertInfo(Request $request)
	{
		if ($request->has('b-insert')) {
			$validator = new Validator;
			$validation =  $validator->make($request->all(), [
				'name'      => 'required',
				'telephone' => 'required',
				'email'     => 'required',
			]);

			$validation->validate();

			$errors = $validation->errors()->toArray();

			if ($validation->fails()) {
				return redirect('/')
					->withErrors($errors, 'error1')
					->withInput();
			} else {
				if ($this->UserInfo->createInfo($request)) {
					return redirect()->back()
						->with('notificationsuccess', 'Succesfully Created');
				} else {
					return redirect()->back()
						->with('globalerror', 'Please Try Again');
				}
			}
		}
	}
}
