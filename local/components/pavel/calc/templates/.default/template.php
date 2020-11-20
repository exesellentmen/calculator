<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */
\Bitrix\Main\UI\Extension::load("ui.vue");
?>

<div id="components-vue">
    <calculator :data-from-php='<?= json_encode($arResult['DATA']) ?>'></calculator>
</div>

<template id="calculator-template">
    <div id="calculator">
        <div>
            <div>
                <span>Обменять</span><br>
                <input v-model="val" placeholder="0" @keypress="onlyNumber">
            </div>
            <div>
                <div style="display: inline-block;">
                    <br><span>Из</span><br>
                    <select v-model="fromcurrency">
                        <option v-for="currency in currencies" v-bind:value="currency">{{currency.TITLE}}</option>
                    </select>
                </div>
                <div style="display: inline-block;">
                    <span>-></span><br>
                </div>
                <div style="display: inline-block;">
                    <br><span>В</span><br>
                    <select v-model="tocurrency">
                        <option v-for="currency in currencies" v-bind:value="currency">{{currency.TITLE}} (≈
                            {{RatioOfCurrency(fromcurrency.VALUE, currency.VALUE)}})
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <div>
            <br><span>Вы получите</span><br>
            <span>≈ {{ resultval }} {{tocurrency.TITLE}}</span>
        </div>
    </div>
</template>

<script>
    BX.Vue.component('calculator', {

        props: ['dataFromPhp'],

        data() {

            return {
                fromcurrency: this.dataFromPhp.FROMCURRENCY,
                tocurrency: this.dataFromPhp.TOCURRENCY,
                currencies: this.dataFromPhp.CURRENCY,
                val: 0,
                errors: [],
            }

        },

        methods: {
            //Отношение одной переменной к другой
            RatioOfCurrency(fromCurrency, toCurrency) {
                return (toCurrency / fromCurrency).toFixed(2)
            },

            //Проверка ввода
            onlyNumber($event) {
                if (!(/^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/
                    .test(this.val + $event.key)))
                    $event.preventDefault();
            },
        },

        computed: {
            resultval() {
                return (this.val * this.fromcurrency.VALUE / this.tocurrency.VALUE).toFixed(2)
            },
        },

        template: '#calculator-template',

    });

    BX.Vue.create({el: '#components-vue'})
</script>