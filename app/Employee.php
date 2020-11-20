<?php

namespace App;

use ErrorException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Employee extends Model
{

    protected $fillable = [
        'user_id', 'department_id','salary'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    /**
     * @return array
     */

    public static function preparingData()
    {
        $data['users'] = Arr::pluck(User::doesntHave('employee')->select('id','name')->get()->toArray(),'name','id');
        $data['departments'] = Arr::pluck(Department::all(['id','name'])->toArray() ,'name','id');

        return $data;
    }

    /**
     * @param String $salary
     * @param String $department_id
     * @param String $userName
     * @throws ErrorException
     */
    public function saveData(String $salary, String $department_id, String $userName ){

        try{
            $this->salary =$salary;
            $this->department_id =$department_id;
            $this->save();

            $this->user->name = $userName;
            $this->user->save();
        }catch (ErrorException $e){
            throw new ErrorException($e->getMessage());
        }


    }
}
