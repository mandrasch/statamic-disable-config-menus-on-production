<?php

namespace Mandrasch\DisableConfigMenusOnProduction\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Statamic\Exceptions\UnauthorizedHttpException;

class CheckIfLocal
{

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     * @throws UnauthorizedHttpException
     */
    public function handle(Request $request, Closure $next)
    {

        // output for debug
        // TODO: move to log
        // echo $request->route()->getActionName();

        // these routes are forbidden on production, they should only be handled locally with git
        $forbidden_route_action_names = [

            // Collections
            'Statamic\Http\Controllers\CP\Collections\CollectionsController@create',
            'Statamic\Http\Controllers\CP\Collections\CollectionsController@edit',
            'Statamic\Http\Controllers\CP\Collections\CollectionsController@destroy',

            // Collecitons -> Blueprints
            'Statamic\Http\Controllers\CP\Collections\CollectionBlueprintsController@index',

            // Collections -> Scaffold views
            'Statamic\Http\Controllers\CP\Collections\ScaffoldCollectionController@index',

            // Navigation -> Blueprints
            'Statamic\Http\Controllers\CP\Navigation\NavigationController@create',
            'Statamic\Http\Controllers\CP\Navigation\NavigationBlueprintController@edit',
            'Statamic\Http\Controllers\CP\Navigation\NavigationController@destroy',

            // Taxonomies
            'Statamic\Http\Controllers\CP\Taxonomies\TaxonomiesController@create',
            'Statamic\Http\Controllers\CP\Taxonomies\TaxonomiesController@edit',
            'Statamic\Http\Controllers\CP\Taxonomies\TaxonomiesController@destroy',

            // Taxonomies -> Blueprints
            'Statamic\Http\Controllers\CP\Taxonomies\TaxonomyBlueprintsController@index',
            'Statamic\Http\Controllers\CP\Taxonomies\TaxonomyBlueprintsController@create',
            'Statamic\Http\Controllers\CP\Taxonomies\TaxonomyBlueprintsController@edit',
            'Statamic\Http\Controllers\CP\Taxonomies\TaxonomyBlueprintsController@destroy',


            // Forms
            'Statamic\Http\Controllers\CP\Forms\FormsController@create',
            'Statamic\Http\Controllers\CP\Forms\FormsController@edit',
            'Statamic\Http\Controllers\CP\Forms\FormsController@destroy',
        ];
        if (!strpos(env('APP_URL'), '.ddev.site')) {

            // Check if admin wants to visit a forbidden route
            if (in_array($request->route()->getActionName(), $forbidden_route_action_names)) {
                // TODO: use better error message, subtitle is not shown
                /*throw new UnauthorizedHttpException(
                    401,
                    'You can\'t edit this on production. Sorry, ask your humble devs please. :-)'
                );*/
                die('Sorry, this function can\'t be used on the live server. Please use your local dev server and commit these changes via git');
            }
        }

        return $next($request);
    }
}
