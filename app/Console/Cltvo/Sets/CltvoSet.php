<?php

namespace App\Console\Cltvo\Sets;

use Illuminate\Console\Command;

abstract class CltvoSet
{
    /**
     * Etiqueta a desplegarse par ainformar final
     */
    protected $label = "";

    /**
     * return the item to set in db
     */
    abstract protected function CltvoGetItems() ;

    /**
     * class of the model to set
     */
    abstract protected function CltvoGetModelClass() ;

    /**
     * display name of this set to show in the endo of the set 
     */
    public function CltvoGetLabel()
    {
        $label = $this->label;
        if ( empty( $label )) {
            $class_name_parts = explode("\\", get_class( $this ) ) ;
            $label = end($class_name_parts);
        }
        return $label;
    }

    /**
     * corre el cicolara salvar cada uno de los valores en la base
     */
    public function CltvoSet(Command $comand){
        foreach ($this->CltvoGetItems() as $key => $model_args) {
            $this->ClvoSetUp($model_args,$comand);
        }
    }

    /**
     * metodo de introduccion de valores
     * @param array   $model_args argumentos que definiran el
     * @param Command $comand     comando actual
     */
    protected function ClvoSetUp(array $model_args, Command $comand, $label = "label"){

        $model_class = $this->CltvoGetModelClass();

        $model = $model_class::where($model_args)->get()->first();

        if(!$model){
            if ($model_class::create($model_args)) {
                $comand->info($model_args[$label]." successfully set.");
            }else{
                $comand->error($model_args[$label]." not successfully set.");
            }
        }else {
            $comand->comment($model_args[$label]." previously set.");
        }
    }

}
