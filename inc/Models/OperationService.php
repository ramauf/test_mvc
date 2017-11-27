<?php
namespace Models;
use Core\DB;
class OperationService{
    const OPERATION_GET_BALANCE = '-- OPERATION_GET_BALANCE
SELECT SUM(`amount`) AS `amount`, `type`
FROM `operations`
WHERE TRUE
{if user_id}AND `user_id` = {{ i(user_id) }} {/if}
GROUP BY `type`';

    public function selectBalance( $data ){
        return DB::query( self::OPERATION_GET_BALANCE, $data );
    }

}