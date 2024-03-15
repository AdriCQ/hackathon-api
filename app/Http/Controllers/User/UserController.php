<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\FilterRequest;
use App\Http\Resources\UserResponse;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;

/**
 * User Controller
 */
#[Group('Usuarios')]
#[Authenticated]
class UserController extends Controller
{
    /**
     * Filtrar Usuarios
     */
    #[Endpoint('Filtrar Usuarios')]
    #[ResponseFromApiResource(
        UserResponse::class,
        User::class,
        collection: true,
        simplePaginate: 10
    )]
    public function filter(FilterRequest $request): AnonymousResourceCollection
    {
        $validated = $request->validated();

        return UserResponse::collection(
            User::query()
                ->when(
                    array_key_exists('name', $validated),
                    function (Builder $query) use ($validated) {
                        $query->where('name', 'like', '%'.$validated['name'].'$');
                    }
                )
                ->when(
                    array_key_exists('phone', $validated),
                    function (Builder $query) use ($validated) {
                        $query->where('phone', $validated['phone']);
                    }
                )
                ->orderBy(
                    array_key_exists('order_by', $validated)
                        ? $validated['order_by']
                        : 'id'
                )
                ->simplePaginate(
                    array_key_exists('paginate', $validated)
                        ? $validated['paginate']
                        : 10
                )
        );
    }
}
