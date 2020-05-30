<?php

declare(strict_types=1);

namespace App\Routing;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

class NotesApi
{
    /**
     * @param App $app
     */
    public static function register(App $app): void
    {
        $app->group('/api/v1', function (RouteCollectorProxy $group) {
            $group->group('/notes', function (RouteCollectorProxy $group) {
                $group->get('/{id:\d+}[/]', \App\Controllers\GetNote::class);
                $group->post('[/]', \App\Controllers\PostNote::class);
            });
        });
    }
}
