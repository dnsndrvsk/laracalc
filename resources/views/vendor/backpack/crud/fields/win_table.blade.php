<!-- field_type_name -->
<div @include('crud::inc.field_wrapper_attributes') >
    <label>{!! $field['label'] !!}</label>
    <input id="table_json_val"
           type="text"
           name="{{ $field['name'] }}"
           value="{{ old($field['name']) ? old($field['name']) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )) }}"
            @include('crud::inc.field_attributes')
    >

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif

</div>

<div class="col-md-12">
    <div id="table_json"></div>
</div>



@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
    {{-- FIELD EXTRA CSS  --}}
    {{-- push things in the after_styles section --}}

    @push('crud_fields_styles')
        <!-- no styles -->
        <style>
            #table_json{
                overflow: auto;
            }
            #table_json table.table tr:first-child > th,
            #table_json table.table tr:first-child > td,
            #table_json table.table tr > td:first-child {
                background: yellow;
                font-weight: bold;
            }

            #table_json table.table tr:first-child td:first-child {
                background: none;
                opacity: 0;
            }

            #table_json colgroup.hover,
            #table_json tr.hover {
                background-color: rgba(204, 231, 231, 0.2);

            }
        </style>
    @endpush


    {{-- FIELD EXTRA JS --}}
    {{-- push things in the after_scripts section --}}

    @push('crud_fields_scripts')
        <script type="text/javascript">
            var $TABLE = $('#table_json'),
                $inputSaved = $('#table_json_val');

            jQuery.fn.pop = [].pop;
            jQuery.fn.shift = [].shift;

            // Генерация таблицы
            function buildHtmlTableFromJson() {
                var inputSavedVal = $inputSaved.val();
                var data = JSON.parse(inputSavedVal);

                if (inputSavedVal == "") return false;

                var html = '<table class="table table-bordered">';

                $.each(data[0], function (index, value) {
                    html += '<colgroup></colgroup>';
                });

                html += '<tr>';

                $.each(data[0], function (index, value) {
                    if (index == 0) html += '<td>1</td>';
                    html += '<td>' + index + '</td>';
                });

                html += '</tr>';

                $.each(data, function (index, value) {
                    var iu = false;

                    html += '<tr class="tr">';
                    $.each(value, function (index2, value2) {

                        editable = (iu) ? ' contenteditable="true"' : '',
                            html += '<td' + editable + '>' + value2 + '</td>',
                            iu = 1;

                    });
                    html += '</tr>';

                });
                html += '</table>';
                $TABLE.html(html);
            }

            function saveTableToJson($TABLE) {
                var $rows = $TABLE.find('tr');
                var headers = [];
                var data = [];

                // Get the headers (add special header logic here)
                $($rows.shift()).find('td').each(function () {
                    headers.push($(this).text());
                });

                $rows.each(function () {
                    var $td = $(this).find('td');
                    var h = {};

                    // Use the headers from earlier to name our hash keystable_json_val
                    headers.forEach(function (header, i) {
                        h[header] = $td.eq(i).text();
                    });

                    data.push(h);
                });

                $inputSaved.val(JSON.stringify(data));
            }



            $TABLE.keydown(function (e) {
                if (
                    !(e.which >= 48 && e.which <= 57) &&
                    !(e.which >= 97 && e.which <= 105)
                ) {
                    e.preventDefault(); // Only numbers
                }
                // saveTableToJson($TABLE);
            });

            $('input[type=submit]').click(function () {
                saveTableToJson($TABLE);
            });

            $TABLE.mouseleave(function(){
                saveTableToJson($TABLE);
            });

            jQuery(document).ready(function ($) {
                buildHtmlTableFromJson();
            });

            // Подсветка столбцов
            $(function () {
                $("#table_json table").delegate('td', 'mouseover mouseleave', function (e) {
                    if (e.type == 'mouseover') {
                        $(this).parent().addClass("hover");
                        $("colgroup").eq($(this).index()).addClass("hover");
                    } else {
                        $(this).parent().removeClass("hover");
                        $("colgroup").eq($(this).index()).removeClass("hover");
                    }
                });

            });
        </script>
    @endpush
@endif

{{-- Note: most of the times you'll want to use @if ($crud->checkIfFieldIsFirstOfItsType($field, $fields)) to only load CSS/JS once, even though there are multiple instances of it. --}}