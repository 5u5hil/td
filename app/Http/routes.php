<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {

    get('/', ["as" => "adminLogin", "uses" => "LoginController@index"]);

    post('/check-user', ["as" => "check_admin_user", "uses" => "LoginController@chk_admin_user"]);
    get('/admin-logout', ["as" => "adminLogout", "uses" => "LoginController@admin_logout"]);

    Route::group(['middleware' => 'CheckUser'], function() {
        get('/dashboard', ["as" => "admin.dashboard", "uses" => "PagesController@index"]);

        Route::group(['prefix' => 'catalog'], function() {
            Route::group(['prefix' => 'category'], function() {
                get('/', ['as' => 'admin.category.view', 'test' => 'test', 'uses' => 'CategoryController@index']);
                get('/add', ['as' => 'admin.category.add', 'uses' => 'CategoryController@add']);
                post('/save', ['as' => 'admin.category.save', 'uses' => 'CategoryController@save']);
                get('/edit', ['as' => 'admin.category.edit', 'uses' => 'CategoryController@edit']);
                get('/delete', ['as' => 'admin.category.delete', 'uses' => 'CategoryController@delete']);
            });

            Route::group(['prefix' => 'attrSets'], function() {
                get('/', ['as' => 'admin.attribute.set.view', 'uses' => 'AttributeSetsController@index']);
                get('/add', ['as' => 'admin.attribute.set.add', 'uses' => 'AttributeSetsController@add']);
                post('/save', ['as' => 'admin.attribute.set.save', 'uses' => 'AttributeSetsController@save']);
                get('/edit', ['as' => 'admin.attribute.set.edit', 'uses' => 'AttributeSetsController@edit']);
                get('/delete', ['as' => 'admin.attribute.set.delete', 'uses' => 'AttributeSetsController@delete']);
            });

            Route::group(['prefix' => 'attrs'], function() {
                get('/', ['as' => 'admin.attributes.view', 'uses' => 'AttributesController@index']);
                get('/add', ['as' => 'admin.attributes.add', 'uses' => 'AttributesController@add']);
                post('/save', ['as' => 'admin.attributes.save', 'uses' => 'AttributesController@save']);
                get('/edit', ['as' => 'admin.attributes.edit', 'uses' => 'AttributesController@edit']);
                get('/delete', ['as' => 'admin.attributes.delete', 'uses' => 'AttributesController@delete']);
            });

            Route::group(['prefix' => 'products'], function() {
                get('/', ['as' => 'admin.products.view', 'uses' => 'ProductsController@index']);
                get('/add', ['as' => 'admin.products.add', 'uses' => 'ProductsController@add']);
                get('/delete', ['as' => 'admin.products.delete', 'uses' => 'ProductsController@delete']);
                post('/save', ['as' => 'admin.products.save', 'uses' => 'ProductsController@save']);
                get('/edit-Info', ['as' => 'admin.products.general.info', 'uses' => 'ProductsController@edit']);
                post('/update', array('as' => 'admin.products.update', 'uses' => 'ProductsController@update'));
                get('/edit-cat', ['as' => 'admin.products.edit.category', 'uses' => 'ProductsController@edit_category']);
                post('/update-edit-cat', array('as' => 'admin.products.update.category', 'uses' => 'ProductsController@update_edit_category'));
                get('/duplicate-prod', ['as' => 'admin.products.duplicate', 'uses' => 'ProductsController@duplicate_prod']);
                post('/update-combo', array('as' => 'admin.products.update.combo', 'uses' => 'ProductsController@update5'));
                post('/combo-attach', array('as' => 'admin.products.update.combo.attach', 'uses' => 'ProductsController@comboAttach'));
                post('/combo-detach', array('as' => 'admin.products.update.combo.detach', 'uses' => 'ProductsController@comboDetach'));
                get('/catalog-images', ['as' => 'admin.products.images', 'uses' => 'ProductsController@img']);
                post('/save-img', array('as' => 'admin.products.images.save', 'uses' => 'ProductsController@saveImg'));
                post('/del-img', array('as' => 'admin.products.images.delete', 'uses' => 'ProductsController@delImg'));
                get('/update-product-attr/{id}', array('as' => 'admin.products.attributes.update', 'uses' => 'ProductsController@prodAttrs'));
                get('/config-product-attrs/{id}', array('as' => 'admin.products.configurable.attributes', 'uses' => 'ProductsController@configProdAttrs'));
                post('/update-conf', array('as' => 'admin.products.configurable.update', 'uses' => 'ProductsController@update4'));
                post('/update-conf-without-stock', array('as' => 'admin.products.configurable.update.without.stock', 'uses' => 'ProductsController@updateWithoutStock'));



                get('/config-attrs-without-stock/{id}', array('as' => 'admin.products.configurable.without.stock.attributes', 'uses' => 'ProductsController@configProdAttrsWithoutStock'));



                Route::get('/comboProds/{id}', array('as' => 'admin.combo.products.view', 'uses' => 'ProductsController@comboProds'));


//edit update
                get('/update-product-variant', array('as' => 'admin.products.variant.update', 'uses' => 'ProductsController@updateProdVariant'));
                post('/update-attributes', array('as' => 'admin.products.attributes.update', 'uses' => 'ProductsController@update2'));
//            get('/update-config-product-attr/{id}', array('as' => 'admin.products.configurable.edit.update', 'uses' => 'ProductsController@configProdAttrs'));
//related prods
                post('/update-related-upsell', array('as' => 'admin.products.upsell', 'uses' => 'ProductsController@update3'));
                get('/update-related-upsell-products/{id}', array('as' => 'admin.products.upsell.related', 'uses' => 'ProductsController@updateRelatedUpsellProds'));
                post('/rel-attach', array('as' => 'admin.products.related.attach', 'uses' => 'ProductsController@relAttach'));
                post('/rel-detach', array('as' => 'admin.products.related.detach', 'uses' => 'ProductsController@relDetach'));
                post('/upsell-attach', array('as' => 'admin.products.upsell.attach', 'uses' => 'ProductsController@upsellAttach'));
                post('/upsell-detach', array('as' => 'admin.products.upsell.detach', 'uses' => 'ProductsController@upsellDetach'));
            });
        });




        Route::group(['prefix' => 'acl'], function() {
            Route::group(['prefix' => 'roles'], function() {
                get('/', ['as' => 'admin.roles.view', 'uses' => 'RolesController@index']);
                get('/add', ['as' => 'admin.roles.add', 'uses' => 'RolesController@add']);
                post('/save', ['as' => 'admin.roles.save', 'uses' => 'RolesController@save']);
                get('/edit', ['as' => 'admin.roles.edit', 'uses' => 'RolesController@edit']);
                get('/delete', ['as' => 'admin.roles.delete', 'uses' => 'RolesController@delete']);
            });

            Route::group(['prefix' => 'Miscellaneous'], function() {

                get('/', ['as' => 'admin.miscellaneous.view', 'uses' => 'MiscellaneousController@index']);
                get('/add', ['as' => 'admin.miscellaneous.add', 'uses' => 'MiscellaneousController@add']);
                get('/edit', ['as' => 'admin.miscellaneous.edit', 'uses' => 'MiscellaneousController@edit']);

                post('/save', ['as' => 'admin.miscellaneous.save', 'uses' => 'MiscellaneousController@save']);
                get('/delete', ['as' => 'admin.miscellaneous.delete', 'uses' => 'MiscellaneousController@delete']);
            });



            Route::group(['prefix' => 'systemusers'], function() {
                post('/chk_existing_username', ['as' => 'chk_existing_username', 'uses' => 'SystemUsersController@chk_existing_username']);

                get('/', ['as' => 'admin.systemusers.view', 'uses' => 'SystemUsersController@index']);
                get('/add', ['as' => 'admin.systemusers.add', 'uses' => 'SystemUsersController@add']);
                post('/save', ['as' => 'admin.systemusers.save', 'uses' => 'SystemUsersController@save']);
                get('/edit', ['as' => 'admin.systemusers.edit', 'uses' => 'SystemUsersController@edit']);
                post('/update', ['as' => 'admin.systemusers.update', 'uses' => 'SystemUsersController@update']);
                get('/delete', ['as' => 'admin.systemusers.delete', 'uses' => 'SystemUsersController@delete']);
            });
        });
    });
});


Route::group(['namespace' => 'Frontend'], function() {
    get('/', ["as" => "home", "uses" => "PagesController@index"]);
    get('/customize/{slug}', ["as" => "home", "uses" => "DesignController@index"]);
    get('/get-textures', ["as" => "gt", "uses" => "DesignController@getTextures"]);
    get('/construct', ["as" => "cs", "uses" => "DesignController@construct"]);

    get('login/{provider?}', 'UserController@login');

    Route::group(['middleware' => 'auth'], function() {
        Route::any('save-for-later', ["as" => "save-for-later", "uses" => 'UserController@saveLater']);
        Route::any('saved-list', ["as" => "saved-list", "uses" => 'UserController@savedList']);
        Route::any('checkout', ["as" => "checkout", "uses" => 'CheckoutController@index']);

        Route::get('/checkout-details', array('as' => 'checkout-details', 'uses' => 'CheckoutController@secure'));
        Route::any('/checkout-info', array('as' => 'checkout_info', 'uses' => 'CheckoutController@checkout_details'));

        Route::any('/add_address', ['as' => 'frontend.add_address', 'uses' => 'UserController@add_address']);

        Route::any('/thank-you', ['as' => 'frontend.thank-you', 'uses' => 'UserController@my_orders']);

//        Route::get('/my-orders', array('as' => 'my_orders', 'uses' => 'UserController@my_orders'));
        Route::get('/order-details/{id?}', array('as' => 'order_details', 'uses' => 'UserController@order_details'));
    });
});
