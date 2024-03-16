<?php

namespace App\Http\Controllers;

use App\Http\Requests\Analisis\CreateRequest;
use App\Http\Requests\Analisis\FilterRequest;
use App\Http\Requests\Analisis\UpdateRequest;
use App\Http\Resources\AnalisisResponse;
use App\Models\Analisis;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;
use Knuckles\Scribe\Attributes\Subgroup;
use Symfony\Component\HttpFoundation\Response;

#[Group('Analisis')]
#[Subgroup('Analisis')]
class AnalisisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[Endpoint('Filtrar Analisis')]
    #[ResponseFromApiResource(
        AnalisisResponse::class,
        Analisis::class,
        collection: true,
        simplePaginate: 10
    )]
    public function index(FilterRequest $request): AnonymousResourceCollection
    {
        $validated = $request->validated();

        return AnalisisResponse::collection(
            Analisis::query()
                ->when(
                    array_key_exists('paciente_id', $validated),
                    function (Builder $query) use ($validated) {
                        $query->where('paciente_id', $validated['paciente_id']);
                    }
                )->when(
                    array_key_exists('search', $validated),
                    function (Builder $query) use ($validated) {
                        $query->whereFullText(['nombre', 'descripcion'], $validated['search']);
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

    /**
     * Store a newly created resource in storage.
     */
    #[Endpoint('Guardar Analisis')]
    #[ResponseFromApiResource(
        AnalisisResponse::class,
        Analisis::class
    )]
    public function store(CreateRequest $request): AnalisisResponse
    {
        $validated = $request->validated();

        $analisis = Analisis::create($validated);

        return new AnalisisResponse($analisis);
    }

    /**
     * Display the specified resource.
     */
    #[Endpoint('Mostrar Analisis')]
    #[ResponseFromApiResource(
        AnalisisResponse::class,
        Analisis::class
    )]
    public function show(Analisis $analisis): AnalisisResponse
    {
        return new AnalisisResponse($analisis);
    }

    /**
     * Update the specified resource in storage.
     */
    #[Endpoint('Actualizar Analisis')]
    #[ResponseFromApiResource(
        AnalisisResponse::class,
        Analisis::class
    )]
    public function update(UpdateRequest $request, Analisis $analisis): AnalisisResponse
    {
        return new AnalisisResponse($analisis);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Analisis $analisis): JsonResponse
    {
        return $analisis->delete()
            ? response()->json(null, Response::HTTP_OK)
            : response()->json(null, Response::HTTP_BAD_REQUEST);
    }
}
