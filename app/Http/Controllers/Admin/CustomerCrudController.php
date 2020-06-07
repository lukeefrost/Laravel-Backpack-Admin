<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CustomerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Tag;
/**
 * Class CustomerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CustomerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Customer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/customer');
        CRUD::setEntityNameStrings('customer', 'customers');
        CRUD::enableExportButtons();
        CRUD::addButtonFromView('line', 'mailto', 'mailto', 'beginning');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // columns

        CRUD::addColumn(
          [
             // 1-n relationship
             'label'     => 'Tag', // Table column heading
             'type'      => 'select',
             'name'      => 'tag_id', // the column that contains the ID of that connected entity;
             'entity'    => 'tag', // the method that defines the relationship in your Model
             'attribute' => 'name', // foreign key attribute that is shown to user
             'model'     => "App\Models\Tag", // foreign key model
          ]);


        CRUD::addField([  // Select2
             'label'     => "Tag",
             'type'      => 'select2',
             'name'      => 'tag_id', // the db column for the foreign key
             'entity'    => 'tag', // the method that defines the relationship in your Model
             'attribute' => 'name', // foreign key attribute that is shown to user)
             'model'     => "App\Models\Tag", // foreign key model
           ]);

        // simple filter
        CRUD::addFilter([
            'type' => 'text',
            'name' => 'name',
            'label' => 'Name'
        ],
        false,
        function($value) { // if the filter is active
            CRUD::addClause('where', 'name', 'LIKE', "%$value%");
        });

        // simple filter
        CRUD::addFilter([
            'type' => 'text',
            'name' => 'email',
            'label' => 'Email'
        ],
        false,
        function($value) { // if the filter is active
            CRUD::addClause('where', 'name', 'LIKE', "%$value%");
        });

        // simple filter
        CRUD::addFilter([
            'type' => 'text',
            'name' => 'phone',
            'label' => 'Phone'
        ],
        false,
        function($value) { // if the filter is active
            CRUD::addClause('where', 'name', 'LIKE', "%$value%");
        });

        // select2 filter
        CRUD::addFilter([
          'name'  => 'tag',
          'type'  => 'select2',
          'label' => 'Tag'
        ], function () {
          return Tag::all()->keyBy('id')->pluck('name', 'id')->toArray();
        }, function ($value) { // if the filter is active
            CRUD::addClause('where', 'tag_id', $value);
        });

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CustomerRequest::class);

        CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
