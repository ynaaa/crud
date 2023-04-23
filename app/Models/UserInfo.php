<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
	use HasFactory;
	protected $table = 'user';
	public $timestamps = false;
	protected $fillable = array(
		'id',
		'email',
		'name',
		'telephone',
	);

	public function deleteInfos($request) {

        if( UserInfo::destroy($request->d_delete) ) {
            return true;
        }else{
            return false;
        }
        
    }

    public function createInfo($request) {

        $data = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'telephone' => $request->input('telephone'),
        );

        if ( UserInfo::create($data) ) {
            return true;
        }else {
            return false;
        } 
        
    }

    public function editInfos($request){

        $update = UserInfo::find($request->input('hiddenid'));
        $update->name = $request->input('edit_name');
        $update->email = $request->input('edit_email');
        $update->telephone = $request->input('edit_telephone');
 

        if ($update->save()) {
            return true;
        }else {
            return false;
        } 

    }

}
