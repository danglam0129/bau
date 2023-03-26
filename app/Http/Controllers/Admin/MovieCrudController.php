<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MovieRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MovieCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MovieCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Movie::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/movie');
        CRUD::setEntityNameStrings('movie', 'movies');
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
        CRUD::column('detail');
        CRUD::column('slug');
        CRUD::column('year');
        CRUD::column('time');
        CRUD::column('poster');
        CRUD::column('backdrop');
        CRUD::column('revenue');
        CRUD::column('rate');
        CRUD::column('tagline');
        CRUD::column('tmdb');
        CRUD::column('trailer');
        CRUD::column('director');
        CRUD::column('converted_video_url');
        CRUD::column('video_url');
        CRUD::column('overview');
        CRUD::column('subtitle_url');

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
        CRUD::field('detail');
        $this->crud->addfield([
            'name'  => 'slug',
            'target'  => 'name',
            'label' => "Slug",
            'type'  => 'slug',
        ]);
        CRUD::field('year');
        CRUD::field('time');
        CRUD::field('poster');
        CRUD::field('backdrop');
        CRUD::field('revenue');
        CRUD::field('rate');
        CRUD::field('tagline');
        CRUD::field('tmdb');
        CRUD::field('trailer');
        CRUD::field('director');
        CRUD::field('converted_video_url');
        CRUD::field('video_url');
        $this->crud->addfield([
            'name'  => 'overview',
            'label' => 'overview',
            'type'  => 'easymde',
        ]);
        CRUD::field('subtitle_url');
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
