<?php

namespace App\Console\Cltvo\Sets;

use App\Console\Cltvo\Sets\CltvoSet;
use Illuminate\Console\Command;

use App\User;

use App\Role;

class FirstUserSet extends CltvoSet
{
    /**
     * Etiqueta a desplegarse par ainformar final
     */
    protected $label =  "Super User";

    /**
     * nombre de la clase a ser sembrada
     */
    protected function CltvoGetModelClass(){
        return "";
    }

    /**
     * valores a ser introducidos en la base
     */
    protected function CltvoGetItems(){
        return [
            [
            'name'              => env("CLTVO_USER_NAME"),
            'first_name'        => env("CLTVO_USER_FIRST_NAME"),
            'last_name'         => env("CLTVO_USER_LAST_NAME"),
            'email'             => env("CLTVO_USER_EMAIL"),
            'password'          => env("CLTVO_USER_PASS"),
            'active'            => true
            ]
        ];
    }

    /**
     * metodo de introduccion de valores
     * @param array   $model_args argumentos que definiran el
     * @param Command $comand     comando actual
     */
    protected function ClvoSetUp(array $model_args, Command $comand, $label = "name"){

        $user = User::where(["name" => $model_args["name"]  ])->orWhere(["email" => $model_args["email"]  ])->get()->first();

        if(!$user){
            $user = User::CltvoCreate($model_args);
            if ($user) {
                $comand->info($this->label." successfully set.");
            }else{
                $comand->error($this->label." not successfully set.");
                return;
            }
        }else {
            $comand->comment($this->label." previously set.");
        }

        $super_admin = Role::getSuperAdmin();

        if ($super_admin) {
            if (!$user->roles()->get()->find($super_admin) ) {
                if ($user->roles()->save($super_admin)) {
                    $comand->info($super_admin->label." successfully associated with ".$this->label.".");
                }else{
                    $comand->error($super_admin->label." not successfully associated with ".$this->label.".");
                }
            }else {
                $comand->comment($super_admin->label." role previously associate with ".$this->label.".");
            }

        }else{
            $comand->error("Role not exist.");
        }

    }

}
