<template>
    <div class="container">
        <div class="row">
            <div class="calc__area row">
                <div class="calc__loader" :style="{display : loader}">
                    <div class="calc__loader_wrapp">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <div class="calc__header">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="calc__headerfooter-list">
                                <ul>
                                    <li class="calc__headerfooter-list-arrows first">Выберите свое окно</li>
                                    <li class="calc__headerfooter-list-arrows second">Выберите свой размер</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="calc__choose_window">
                                <div v-for="n in 4" :class="['types type' + n ]">
                                    <div v-for="t in wtypes" v-if="t.sash === n">
                                        <label :class="[t.id == wtype_changed ? 'active' : '']">
                                            <input style="display: none" type="radio" v-model="wtype_changed"
                                                   v-bind:value="t.id" :checked="t.id == wtype_changed"/>
                                            <img :src="t.image" :alt="t.name"/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="calc__body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="left__slider center-md">
                                <vue-slider
                                        v-model="height"
                                        v-bind="{
                                interval: 5 ,
                                dotSize:13,
                                value:height,
                                min:min_height,
                                max:max_height,
                                direction:'vertical',
                                eventType:'auto',
                                height:'100%',
                                width:8,
                                piecewise: true,
                                piecewiseLabel: true,
                                piecewiseStyle: {
                                    'backgroundColor': '#ccc',
                                    'visibility': 'visible',
                                    'width': '14px',
                                    'height': '14px'
                                },
                                piecewiseActiveStyle: {
                                    'backgroundColor': '#03C1D7'
                                },
                                labelActiveStyle: {
                                    'color': '#03C1D7'
                                },
                                style: {
                                    'display': 'inline-block',
                                },
                                tooltipStyle:{
                                    'font-size': '20px'
                                }
                            }"
                                ></vue-slider>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="center_slider center-md">
                                <h2>
                                    {{height}}x{{width}}
                                </h2>
                                <div class="image_center">
                                    <img :src="wtype_image"/>
                                </div>

                                <!--:step="5" :value="width" :min="min_width" :max="max_width"-->
                                <vue-slider
                                        v-bind="{
                                            interval: 5,
                                            height:8,
                                            dotSize:13,
                                            value:width,
                                            min:min_width,
                                            max:max_width,
                                            direction: 'horizontal',
                                            piecewise: true,
                                            piecewiseLabel: true,
                                            piecewiseLabelDir: 'left',
                                            piecewiseStyle: {
                                                'backgroundColor': '#ccc',
                                                'visibility': 'visible',
                                                'width': '14px',
                                                'height': '14px'
                                            },
                                            piecewiseActiveStyle: {
                                                'backgroundColor': '#03C1D7'
                                            },
                                            labelActiveStyle: {
                                                'color': '#03C1D7'
                                            },
                                            tooltipStyle:{
                                                'font-size': '20px'
                                            }
                                        }"
                                        v-model="width"
                                ></vue-slider>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="right__slider">
                                <div class="right__slider-radios">
                                    <div class="right__slider-radios_radio">
                                        <div>Подоконник, отлив:</div>
                                        <div class="right__slider-radios_radio-choose">
                                            <div>
                                                <input id="sill-no" type="radio" v-model="sill" value="0"/>
                                                <label for="sill-no">Нет</label>
                                            </div>
                                            <div>
                                                <input id="sill-yes" type="radio" v-model="sill"
                                                       v-bind:value="options.window_sill"/>
                                                <label for="sill-yes">Да</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="basechek__line"></div>
                                    <div class="right__slider-radios_radio">
                                        <div>Монтажные работы:</div>
                                        <div class="right__slider-radios_radio-choose">
                                            <div>
                                                <input id="install_work-no" type="radio" v-model="install_work"
                                                       value="0"/>
                                                <label for="install_work-no">Нет</label>
                                            </div>
                                            <div>
                                                <input id="install_work-yes" type="radio" v-model="install_work"
                                                       v-bind:value="options.window_montage_price"/>
                                                <label for="install_work-yes">Да</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="right__slider-total">
                                    <div class="right__slider-total_head">Цена по акции</div>
                                    <div class="right__slider-total_body">{{summMinusSale}}</div>
                                </div>
                                <div class="right__slider-btn">
                                    <a href="#">Хочу дешевле</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="calc__footer">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="calc__headerfooter-list">
                                <ul>
                                    <li class="calc__headerfooter-list-arrows third">Узнайте выгоду</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="calc__footer-card">
                                <div class="calc__footer-card-title">
                                    Средняя стоимость такого окна: <span>{{summ}}</span>
                                </div>
                                <div class="card">
                                    ВАША ЭКОНОМИЯ = <span>{{sale}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="calc__footer-pay">
                                <div>Это окно в рассрочку</div>
                                <span>всего за {{payofmonth}} в месяц</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import vueSlider from 'vue-slider-component';

    export default {
        data: function () {
            return {
                loader: 'flex', // Позиция слайдера
                wtypes: '', // Список типов из ajax
                wprofiles: '', // Список профилей из ajax
                wtype_changed: 3, // Выбраный тип
                wtype_image: '', // Изображение выбранного типа
                width: 0, // Значение ширины слайдера
                min_width: 0,
                max_width: 0,
                height: 0,// Значение высоты слайдера
                min_height: 0,
                max_height: 0,
                total_price: 0, // Цена полученная по таблице
                sill: 0, // Цена подоконника
                install_work: 0, // Цена монтажа
                options: '', // Опции, полученные по апи


                summ: 0, // Общая сумма
                sale: 0,
                summMinusSale: 0,
                payofmonth: 0,
                api_result: '', // Полученная инфа из AJAX по запросу Windows
            }
        },
        props: ["min"],
        mounted() {
            axios.get("//laracalc.loc/api/wtypes").then(response => {
                this.wtypes = response.data.data;
                this.get_result_from_api(this.wtype_changed);
                this.get_image_from_wtypes(this.wtype_changed);
                this.get_summ();
            }),
                // axios.get("/api/wprofiles").then(response => {
                //     this.wprofiles = response.data.data
                // }),
                axios.get("//laracalc.loc/api/calc_options").then(response => {
                    this.options = response.data
                });

        },
        methods: {
            loader_hide() { // Спрятать загрузчик
                this.loader = "none";
            },
            loader_show() {// Показать загрузчик
                this.loader = "flex";
            },
            get_result_from_api(wtype) { // Получить данные по фильтру
                this.loader_show();
                axios.get("//laracalc.loc/api/windows?wtype=" + wtype).then(response => {
                    this.api_result = response.data.data;
                    this.loader_hide();
                });

            },
            get_price() { // Получить цену по таблице
                if (this.api_result.table) {
                    var price_result = 0;
                    var json_reform = JSON.parse(this.api_result.table);

                    for (var i = 0; i < json_reform.length; i++) {
                        if (json_reform[i][1] == this.height) {
                            price_result = json_reform[i][this.width];
                        }
                    }
                    this.total_price = price_result;
                }

            },
            get_summ() { // Общая сумма
                this.summ = parseInt(this.total_price) + parseInt(this.sill) + parseInt(this.install_work);
                this.sale = (this.summ * 0.1).toFixed(1);
                this.summMinusSale = this.summ - this.sale;
                this.payofmonth = (this.summMinusSale / 6).toFixed(1)
            },
            get_image_from_wtypes($wtype_id) { // Получить изображение по id типа
                var img = '';
                var $wtypes = this.wtypes;
                $wtypes.forEach(function (item, i, arr) {
                    if ($wtype_id == item.id) {
                        img = item.image;
                    }
                });

                this.wtype_image = img;
            }
        },
        // created: function () {
        //
        // },
        watch: {
            // Если изменяется ширина и высота
            width: function () {
                this.get_price();
            },
            height: function () {
                this.get_price();
            },
            // 
            total_price: function () {
                this.get_summ();
            },
            sill: function () {
                this.get_summ();
            },
            install_work: function () {
                this.get_summ();
            },
            wtype_changed: function (val) {
                this.get_result_from_api(val);
                this.get_image_from_wtypes(val);
            },
            api_result: function () {
                var $range = JSON.parse(this.api_result.range);
                this.width = $range.width[1] - 20;
                this.height = $range.height[1] - 20;
                this.min_width = parseInt($range.width[0]);
                this.max_width = parseInt($range.width[1]);
                this.min_height = parseInt($range.height[0]);
                this.max_height = parseInt($range.height[1]);
                this.get_price(this.width, this.height, this.api_result.table);
            }
        },
        components: {
            vueSlider // Дополнительный компонент слайдера
        }
    }
</script>

<style lang="less">
    @color-elements: #03C1D7;
    @array-svg-image: 'data:image/svg+xml,%3C%3Fxml%20version%3D%271.0%27%20encoding%3D%27utf-8%27%3F%3E%0A%3C%21DOCTYPE%20svg%20PUBLIC%20%27-//W3C//DTD%20SVG%201.1//EN%27%20%27http%3A//www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd%27%3E%0A%3Csvg%20width%3D%2264%22%20version%3D%221.1%22%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20height%3D%2264%22%20viewBox%3D%220%200%2064%2064%22%20xmlns%3Axlink%3D%22http%3A//www.w3.org/1999/xlink%22%20enable-background%3D%22new%200%200%2064%2064%22%3E%0A%20%20%3Cg%3E%0A%20%20%20%20%3Cpath%20fill%3D%22%231D1D1B%22%20d%3D%22m63.386%2C16.193l.002-.002c0.002-0.003%200.004-0.006%200.006-0.01%200.172-0.195%200.298-0.43%200.399-0.678%200.032-0.076%200.053-0.148%200.076-0.225%200.058-0.191%200.094-0.389%200.106-0.596%200.006-0.076%200.018-0.148%200.016-0.226%200-0.04%200.01-0.076%200.008-0.115-0.014-0.239-0.062-0.47-0.136-0.687-0.006-0.023-0.022-0.041-0.03-0.064-0.088-0.239-0.214-0.451-0.363-0.645-0.021-0.027-0.028-0.063-0.05-0.09l-10.311-12.146c-0.789-0.93-2.084-0.948-2.894-0.037-0.808%2C0.91-0.823%2C2.402-0.032%2C3.334l5.558%2C6.549c-8.121-1.076-16.104%2C0.633-16.481%2C0.717-24.646%2C4.467-42.087%2C27.227-38.88%2C50.736%200.159%2C1.164%201.028%2C1.992%202.019%2C1.992%200.106%2C0%200.212-0.009%200.32-0.027%201.116-0.203%201.878-1.409%201.704-2.696-2.857-20.94%2013.056-41.282%2035.537-45.358%200.103-0.024%208.351-1.794%2016.117-0.574l-8.577%2C5.093c-1.005%2C0.598-1.398%2C2.02-0.881%2C3.177%200.516%2C1.159%201.748%2C1.608%202.756%2C1.017l13.52-8.028c0.183-0.111%200.347-0.25%200.491-0.411z%22/%3E%0A%20%20%3C/g%3E%0A%3C/svg%3E%0A';

    @keyframes grow {
        0%, 100% {
            -webkit-transform: scaleY(1);
            -ms-transform: scaleY(1);
            -o-transform: scaleY(1);
            transform: scaleY(1);
        }

        50% {
            -webkit-transform: scaleY(1.8);
            -ms-transform: scaleY(1.8);
            -o-transform: scaleY(1.8);
            transform: scaleY(1.8);
        }
    }

    body {
        font-family: Verdana, Arial, Helvetica, sans-serif;
    }

    .calc__area {
        width: 100%;
        position: relative;

        .calc__loader {
            width: 100%;
            height: 100%;
            position: absolute;
            display: flex;
            z-index: 999;
            justify-content: center;
            align-items: center;
            background: rgba(255, 255, 255, 0.6);
            background-blend-mode: hard-light;

            .calc__loader_wrapp {
                width: 50px;
                height: 30px;
                border-radius: 100%;
                position: relative;
                margin: 0 auto;
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;

                span {
                    display: inline-block;
                    width: 5px;
                    height: 20px;
                    background-color: #3498db;

                    &:nth-child(1) {
                        animation: grow 1s ease-in-out infinite;
                    }

                    &:nth-child(2) {
                        animation: grow 1s ease-in-out 0.15s infinite;
                    }

                    &:nth-child(3) {
                        animation: grow 1s ease-in-out 0.30s infinite;
                    }
                    &:nth-child(4) {
                        animation: grow 1s ease-in-out 0.45s infinite;
                    }
                }
            }
        }
        /**
     HEADER
      */
        .calc__header, .calc__footer {
            .calc__headerfooter-list {
                ul {
                    list-style-type: none;
                    li {
                        margin-bottom: 0.5rem;
                        position: relative;
                        &:before {
                            padding: 0.2rem 0.4rem;
                            border-radius: 50%;
                            color: #fff;
                            background: @color-elements;
                            font-size: 0.8rem;
                            margin-right: 0.5rem;
                        }
                        &.calc__headerfooter-list-arrows {

                            &:after {
                                content: '';
                                background-image: url(@array-svg-image);
                                width: 45px;
                                height: 45px;
                                display: block;
                                background-size: cover;
                                position: absolute;
                            }
                            &.first {
                                &:after {
                                    right: -12px;
                                    top: -19px;
                                    transform: rotate(40deg);
                                }
                                &:before {
                                    content: '1';
                                }
                            }
                            &.second {
                                &:after {
                                    top: 45px;
                                    left: 31px;
                                    transform: scale(-1, 1) rotate(158deg);
                                }
                                &:before {
                                    content: '2';
                                }
                            }
                            &.third {
                                &:after {
                                    top: 29px;
                                    right: 104px;
                                    transform: scale(-1, 1) rotate(186deg);
                                }
                                &:before {
                                    content: '3';
                                }
                            }
                        }
                    }
                }
            }
            .calc__choose_window {
                display: flex;
                height: 100px;
                position: relative;

                .types {
                    position: relative;
                    > div {
                        display: none;
                        background: #fff;

                        &:first-child {
                            display: flex;
                        }
                    }
                    &:hover {
                        > div {
                            border: 0.1rem solid #cecece;
                            display: flex;
                            padding: 0.7rem;
                            padding-top: 0.3rem;
                            transform: scale(1.15);
                            z-index: 1;

                            &:first-child {
                                border-bottom: none;
                                border-top-left-radius: 0.5rem;
                                border-top-right-radius: 0.5rem;
                            }
                            &:last-child {
                                border-top: none;
                                border-bottom-left-radius: 0.5rem;
                                border-bottom-right-radius: 0.5rem;
                            }
                            &:nth-child(n):not(:last-child):not(:first-child) {
                                border-bottom: none;
                                border-top: none
                            }
                        }
                        &:hover {
                            height: auto;
                            display: flex;
                            flex-direction: column;
                            > div {
                                display: block;

                            }
                        }
                    }
                    label {
                        filter: grayscale(100%);
                        cursor: pointer;

                        .active, &:hover {
                            filter: none;
                        }
                    }
                }
                img {
                    width: 100%;
                }
            }
        }
        /**
     BODY
      */
        .calc__body, .calc__header {
            width: 100%;
        }
        .calc__body {
            padding: 30px 0;

            .left__slider {
                width: 100%;
                height: 100%;
                display: block;
                position: relative;
            }
            .right__slider-radios, .right__slider-total {
                border: 0.1rem solid #cecece;
                padding: 0.5rem 1rem;
                border-radius: 0.5rem;
                background: #f5f5f5;
                box-shadow: 1px 1px 6px #d4d4d4;
                margin-bottom: 1rem;
            }
            .right__slider-radios {
                [type="radio"] {
                    &:checked, &:not(:checked) {
                        position: absolute;
                        left: -9999px;
                        & + label {
                            position: relative;
                            padding-left: 2rem;
                            cursor: pointer;
                            line-height: 20px;
                            display: inline-block;
                            color: #666;
                        }
                        & + label:before {
                            content: '';
                            position: absolute;
                            left: 0;
                            top: 0;
                            width: 18px;
                            height: 18px;
                            border: 1px solid #ddd;
                            border-radius: 100%;
                            background: #fff;
                        }
                        & + label:after {
                            content: '';
                            width: 12px;
                            height: 12px;
                            background: @color-elements;
                            position: absolute;
                            top: 4px;
                            left: 4px;
                            border-radius: 100%;
                            -webkit-transition: all 0.2s ease;
                            transition: all 0.2s ease;
                        }
                    }
                    &:not(:checked) {
                        & + label:after {
                            opacity: 0;
                            -webkit-transform: scale(0);
                            transform: scale(0);
                        }
                    }
                    &:checked {
                        & + label:after {
                            opacity: 1;
                            -webkit-transform: scale(1);
                            transform: scale(1);
                        }
                    }
                }
                .basechek__line {
                    border-bottom: 1px solid #b8c3c9;
                    margin: 0.5rem 1rem;
                }
                .right__slider-radios_radio {
                    font-size: 1.5rem;

                    > div {
                        margin-bottom: 1rem;
                    }

                    .right__slider-radios_radio-choose {
                        display: flex;
                        justify-content: space-around;
                    }
                }
            }
            .right__slider-total {
                background: #fde800;
                border-color: #000;

                &:before, &:after {
                    content: '';
                }
                &:before {

                }
                div {
                    &.right__slider-total_body {
                        color: #f72727;
                        font-size: 5rem;
                        text-shadow: -3px -3px 0 #fff, 3px -3px 0 #fff, -3px 3px 0 #fff, 3px 3px 0 #fff, 0.02em 0.03em 0.18em rgba(0, 0, 0, 0.8);
                        font-weight: bold;
                        line-height: 1;
                        text-align: center;
                        width: 100%;
                        display: inline-block;
                    }
                    &.right__slider-total_head {
                        width: 100%;
                        display: inline-block;
                        text-align: center;
                        font-size: 1.5rem;
                        font-weight: bold;
                    }
                }
            }
            .right__slider-btn {
                a {
                    display: block;
                    position: relative;
                    background: #f72727;
                    color: #fff;
                    text-decoration: none;
                    padding: 0.5rem 1rem;
                    text-align: center;
                    border-radius: 0.5rem;
                    top: 0px;
                    box-shadow: 0px 5px 0px 0px #c50000, 0px 0px 10px 0px #bbb;
                    transition-property: top, box-shadow;
                    transition-duration: .1s;

                    &:active {
                        top: 3px;
                        box-shadow: 0px 2px 0px 0px #c50000, 0px 0px 4px 0px #bbb;
                    }
                }
            }
        }

        /**
        FOOTER
         */
        .calc__footer {
            width: 100%;
            .calc__footer-card {
                font-weight: bold;
                .calc__footer-card-title {
                    text-transform: uppercase;
                    text-align: center;
                    font-weight: normal;
                    font-size: 1.3rem;
                    span {
                        font-size: 1.7rem;
                    }
                }
                .card {
                    background: #01D2E9;
                    text-align: center;
                    font-size: 2rem;
                    padding: 2rem;
                    border-radius: 0.5rem;
                    color: #fff;

                    span {
                        font-size: 3rem;
                    }
                }
            }
            .calc__footer-pay {
                font-size: 1.3rem;
                display: flex;
                flex-direction: column;
                align-items: center;
                height: 100%;
                justify-content: center;

                span {
                    color: red;
                }
            }
        }
    }

    .vue-slider-component {
        .vue-slider-process {
            background-color: @color-elements;
        }
        .vue-slider-tooltip {
            border-color: @color-elements;
            background-color: @color-elements;
        }
    }


</style>
