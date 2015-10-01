<?php 
// app/classes/myrules.php
class Myvalidationrules
{
    // note this is a static method
    public static function _validation_unique($val, $options)
    {
        list($table, $field) = explode('.', $options);

        $result = DB::select("$field")
        ->where($field, '=', Str::lower($val))
        ->from($table)->execute();

        Validation::active()->set_message('unique', ':value est déjà enregistré.');

        return ! ($result->count() > 0);
    }

    // note this is a non-static method
    public function _validation_is_upper($val)
    {
        return $val === strtoupper($val);
    }

}
