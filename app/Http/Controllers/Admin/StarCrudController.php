<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StarRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StarCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StarCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Star::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/star');
        CRUD::setEntityNameStrings('star', 'stars');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('tmdb');
        CRUD::column('poster');
        CRUD::column('gender');
        CRUD::column('slug');
        CRUD::column('birthday');
        CRUD::column('job');
        CRUD::column('place');
        CRUD::column('bio');

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
        CRUD::field('name');
        CRUD::field('tmdb');
        CRUD::field('poster');
        CRUD::field('gender');
        $this->crud->addfield([
            'name'  => 'slug',
            'target'  => 'name',
            'label' => "Slug",
            'type'  => 'slug',
        ]);
        CRUD::field('birthday');
        CRUD::field('job');
        CRUD::field('place');
        CRUD::field('bio');
        $this->crud->addField([
            'label'     => "Tags",
            'type'      => 'select2_multiple',
            'name'      => 'tags',
            'entity'    => 'tags',
            'pivot'     => true,
        ]);

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
