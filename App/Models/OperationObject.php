<?php
namespace App\Models;

use App\Core\Models\AbstractField;
use App\Core\Models\AbstractObject;

class OperationObject extends AbstractObject
{
    protected $table = 'operations';

    public function init()
    {
        $this
            ->addField('id', AbstractField::FIELD_INTEGER)
            ->setPrimary('id')
            ->addField('user_id', AbstractField::FIELD_INTEGER)
            ->addField('amount', AbstractField::FIELD_STRING)
            ->addField('type', AbstractField::FIELD_STRING)
            ->addField('address', AbstractField::FIELD_STRING)
            ->addField('date', AbstractField::FIELD_INTEGER)
        ;
    }

    public function getCreateFields()
    {
        return ['user_id', 'amount', 'type', 'address', 'date'];
    }
}
