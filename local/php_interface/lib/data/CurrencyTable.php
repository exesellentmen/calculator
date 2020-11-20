<?php

namespace DataCurrency;


class CurrencyTable extends \Bitrix\Main\ORM\Data\DataManager
{
    /**
     * Returns DB table name for entity
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'exchangerate';
    }

    /**
     * Returns entity map definition.
     * To get initialized fields @see \Bitrix\Main\ORM\Entity::getFields() and \Bitrix\Main\ORM\Entity::getField()
     */
    public static function getMap()
    {
        return [
            'ID' => [
                'data_type' => 'integer',
                'primary' => true,
            ],
            'UF_CURRENCY' => [
                'data_type' => 'string',
            ],
            'UF_VALUE' => [
                'data_type' => 'float',
            ],
            'UF_TITLE' => [
                'data_type' => 'string',
            ],
        ];
    }
}