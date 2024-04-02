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
use Knuckles\Scribe\Attributes\Subgroup;

/**
 * User Controller
 */
#[Group('Usuarios')]
#[Subgroup('Usuarios')]
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
                    array_key_exists('search', $validated),
                    function (Builder $query) use ($validated) {
                        $query->where('nombre', 'like', '%'.$validated['search'].'%')
                            ->orWhere('apellido_materno', 'like', '%'.$validated['search'].'%')
                            ->orWhere('apellido_paterno', 'like', '%'.$validated['search'].'%');
                    }
                )
                ->when(
                    array_key_exists('telefono', $validated),
                    function (Builder $query) use ($validated) {
                        $query->where('telefono', $validated['telefono']);
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
