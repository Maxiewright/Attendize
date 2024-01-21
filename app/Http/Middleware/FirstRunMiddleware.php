<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Models\Organiser;
use Closure;

class FirstRunMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        /*
         * If there are no organisers then redirect the user to create one
         * else - if there's only one organiser bring the user straight there.
         */
        $organizerCount = Organiser::scope()->count();
        if ($organizerCount === 0 && ! ($request->route()->getName() === 'showCreateOrganiser') && ! ($request->route()->getName() === 'postCreateOrganiser')) {
            return redirect(route('showCreateOrganiser', [
                'first_run' => '1',
            ]));
        } elseif ($organizerCount === 1 && ($request->route()->getName() === 'showSelectOrganiser')) {
            return redirect(route('showOrganiserDashboard', [
                'organiser_id' => Organiser::scope()->first()->id,
            ]));
        }

        return $next($request);
    }
}
