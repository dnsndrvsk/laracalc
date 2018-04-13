<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\WindowsRequest as StoreRequest;
use App\Http\Requests\WindowsRequest as UpdateRequest;
use Illuminate\Support\Facades\Config;


class WindowsCrudController extends CrudController
{
    /**
     * @throws \Exception
     */
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Windows');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/windows');
        $this->crud->setEntityNameStrings('windows', 'windows');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

//        $this->crud->setFromDb();

        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');
        $this->crud->addField([
            // MANDATORY
            'name' => 'title', // DB column name (will also be the name of the input)
            'label' => 'Заголовок', // the human-readable label for the input
            'type' => 'text', // the field type (text, number, select, checkbox, etc)
            'default' => null, // default value
            'hint' => null, // helpful text, show up after input
            'attributes' => [
                'placeholder' => 'Введите заголовок окна',
                'class' => 'form-control col-md-6'
            ], // extra HTML attributes and values your input might need
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            // MANDATORY
            'name' => 'count_camers', // DB column name (will also be the name of the input)
            'label' => "Количество камер",
            'type' => 'select_from_array',
            'options' => ['1' => 'Одна камера', '2' => 'Две камеры', '3' => 'Три камеры'],
            'allows_null' => false,
            'attributes' => [
                'class' => 'form-control col-md-6'
            ],
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            // MANDATORY
            'name' => 'wprofiles', // DB column name (will also be the name of the input)
            'label' => "Выбрать профиль",
            'type' => 'select',
            'entity' => 'category', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Wprofile", // foreign key model
            'attributes' => [
                'class' => 'form-control col-md-6'
            ],
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            // MANDATORY
            'name' => 'wtypes', // DB column name (will also be the name of the input)
            'label' => "Выбрать тип",
            'type' => 'select',
            'entity' => 'category', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Wtype", // foreign key model
            'attributes' => [
                'class' => 'form-control col-md-6'
            ],
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $range_min = Config::get('settings.range_min');
        $range_max = Config::get('settings.range_max');

//        $json = [];
//        $json['width'] = [$range_min, $range_max];
//        $json['height'] = [$range_min, $range_max];
        $this->crud->addField([
            'name' => 'range',
            'label' => 'Диапазон высоты окна для таблицы',
            'type' => 'win_table_range',
            'min' => $range_min,
            'max' => $range_max,
            'default' => "{\"height\":[$range_min,$range_max],\"width\":[$range_min,$range_max]}",
            'step' => 5,
            'color' => 'green',
            'attributes' => [
                'class' => 'slider form-control'
            ],
        ]);

        $this->crud->addField([
            'name' => 'table',
            'label' => "Данные таблицы",
            'default' => 0,
            'type' => 'win_table',
            'attributes' => [
                'class' => 'form-control col-md-12'
            ],
            'wrapperAttributes' => [
                'class' => 'form-group col-md-12 input_table_body'
            ]
        ]);


        // ------ REORDER

        // ------ CRUD COLUMNS
        //  $this->crud->addColumn(); // add a single column, at the end of the stack
        $this->crud->addColumns(['title'], 'wprofiles'); // add multiple columns, at the end of the stack
        $this->crud->removeColumn('table'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
//         $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
//         $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
