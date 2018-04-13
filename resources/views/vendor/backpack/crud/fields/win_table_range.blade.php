<!-- field_type_name -->
<div @include('crud::inc.field_wrapper_attributes') >
    <div class="box-group" id="accordion">
        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
        <div class="panel box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false"
                       class="collapsed">
                        Создать новую таблицу
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                <div class="box-body">


                    <div class="col-md-6">
                        <label>Диапазон высоты таблицы</label>
                        <input id="range_slider"
                               type="text"
                               data-slider-min="{{ $field['min'] }}"
                               data-slider-max="{{ $field['max'] }}"
                               data-slider-step="{{ $field['step'] }}"
                               data-slider-id="{{ $field['color'] }}"
                               data-slider-value="[{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}]"
                               data-slider-tooltip="show"
                               data-slider-selection="before"
                               value=""
                                @include('crud::inc.field_attributes')
                        >
                    </div>
                    <div class="col-md-6">
                        <label>Диапазон ширины таблицы</label>
                        <input id="range_slider2"
                               type="text"
                               data-slider-min="{{ $field['min'] }}"
                               data-slider-max="{{ $field['max'] }}"
                               data-slider-step="{{ $field['step'] }}"
                               data-slider-id="{{ $field['color'] }}"
                               data-slider-value="[{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}]"
                               data-slider-tooltip="show"
                               data-slider-selection="before"
                               value=""
                                @include('crud::inc.field_attributes')
                        >
                    </div>
                    <div class="col-md-12">
                        <p>
                            <a href="#" class="btn btn-success" id="createNewTable">Создать новую таблицу</a>
                        </p>
                    </div>
                    <input type="hidden" name="{{ $field['name'] }}"
                           value="{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}"/>
                    {{--<input  data-slider-orientation="horizontal" data-slider-selection="before" data-slider-tooltip="show" data-slider-id="green">--}}


                    {{-- HINT --}}
                    @if (isset($field['hint']))
                        <p class="help-block">{!! $field['hint'] !!}</p>
                    @endif


                </div>
            </div>
        </div>

    </div>

</div>


@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
    {{-- FIELD EXTRA CSS  --}}
    {{-- push things in the after_styles section --}}

    @push('crud_fields_styles')
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/bootstrap-slider/slider.css">
    @endpush


    {{-- FIELD EXTRA JS --}}
    {{-- push things in the after_scripts section --}}

    @push('crud_fields_scripts')
        <script src="{{ asset('vendor/adminlte') }}/plugins/bootstrap-slider/bootstrap-slider.js"></script>
        <script>
            // Создание таблицы
            function createtable() {
                var jsonParams = JSON.parse($('input[name=range]').val());
                var html = '<table class="table table-bordered">';
                var widthRowsCount = (jsonParams.width[1] - jsonParams.width[0]) / 5;

                // html += '<tr>';
                html += '<colgroup></colgroup>';
                for (var i = jsonParams.width[0]; i <= jsonParams.width[1]; i += 5) {
                    html += '<colgroup></colgroup>';
                }
                // html += '</tr>';


                html += '<tr>';
                html += '<td>1</td>';
                for (var i = jsonParams.width[0]; i <= jsonParams.width[1]; i += 5) {
                    html += '<td>' + i + '</td>';
                }
                html += '</tr>';


                for (var i = jsonParams.height[0]; i <= jsonParams.height[1]; i += 5) {
                    html += '<tr>';
                    html += '<td>' + i + '</td>';
                    for (var k = 0; k <= widthRowsCount; k++) {
                        html += '<td contenteditable="true"></td>';
                    }
                    html += '</tr>';
                }

                html += '</table>';

                $TABLE.html(html);

            }


            $(function () {
                /* BOOTSTRAP SLIDER */

                var $arr = JSON.parse($("input[name={{ $field['name'] }}]").val());

                var val = $('#range_slider').slider({
                    value: $arr.height
                });
                var val2 = $('#range_slider2').slider({
                    value: $arr.width,
                });
                var $TABLE = $('#table_json');

                val.change(function () {
                    $arr.height = val.slider('getValue');
                    $("input[name={{ $field['name'] }}]").val(JSON.stringify($arr));
                });

                val2.change(function () {
                    $arr.width = val2.slider('getValue');
                    $("input[name={{ $field['name'] }}]").val(JSON.stringify($arr));
                });

                $('#createNewTable').click(function (e) {
                    e.preventDefault();
                    createtable();
                })
            });
        </script>
    @endpush
@endif

