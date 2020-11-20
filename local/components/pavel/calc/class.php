<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use DataCurrency\CurrencyTable;

class CalculatorComponentClass extends CBitrixComponent
{
    function CollectDataCalculator()
    {
        $arResult['DATA']['CURRENCY'] = [];
        $res = CurrencyTable::getList();
        foreach ($res as $item) {
            $currentItem = [
                "NAME" => $item["UF_CURRENCY"],
                "VALUE" => $item["UF_VALUE"],
                "TITLE" => $item["UF_TITLE"],
            ];
            array_push($arResult['DATA']['CURRENCY'], $currentItem);

        }
        $arResult['DATA']['FROMCURRENCY'] = $arResult['DATA']['CURRENCY'][0];
        $arResult['DATA']['TOCURRENCY'] = $arResult['DATA']['CURRENCY'][1];
        return $arResult;
    }

    public function executeComponent()
    {
        $this->arResult = array_merge($this->arResult, $this->CollectDataCalculator());
        $this->includeComponentTemplate();
    }

}