<?php

namespace App\Http\Controllers;

use App\Enums\MediaEnum;
use App\Http\Requests\Ultrasonido\CreateRequest;
use App\Http\Requests\Ultrasonido\CreateWithMedia;
use App\Http\Requests\Ultrasonido\FilterRequest;
use App\Http\Requests\Ultrasonido\ShowRequest;
use App\Http\Requests\Ultrasonido\UpdateRequest;
use App\Http\Resources\UltrasonidoResponse;
use App\Models\Media;
use App\Models\Ultrasonido;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;
use Knuckles\Scribe\Attributes\Subgroup;
use Symfony\Component\HttpFoundation\Response;

#[Group('Analisis')]
#[Subgroup('Ultrasonidos')]
class UltrasonidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[Endpoint('Filtrar Ultrasonidos')]
    #[ResponseFromApiResource(
        UltrasonidoResponse::class,
        Ultrasonido::class,
        collection: true,
        simplePaginate: 10
    )]
    public function index(FilterRequest $request): AnonymousResourceCollection
    {
        $validated = $request->validated();

        return UltrasonidoResponse::collection(
            Ultrasonido::query()
                ->when(
                    array_key_exists('telefono_paciente', $validated),
                    function (Builder $query) use ($validated) {
                        $query->whereHas(
                            'paciente',
                            function (Builder $query) use ($validated) {
                                $query->where('telefono', $validated['telefono_paciente']);
                            }
                        );
                    }
                )->when(
                    array_key_exists('search', $validated),
                    function (Builder $query) use ($validated) {
                        $query->whereFullText(['titulo', 'descripcion'], $validated['search']);
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
    #[Endpoint('Guardar Ultrasonido')]
    #[ResponseFromApiResource(
        UltrasonidoResponse::class,
        Ultrasonido::class
    )]
    public function storeOne(CreateRequest $request): UltrasonidoResponse
    {
        $validated = $request->validated();

        $paciente = User::query()->where('telefono', $validated['telefono_paciente'])->first();

        if (! $paciente) {
            abort(Response::HTTP_BAD_REQUEST, 'El teléfono no está asociado a ningún paciente');
        }
        unset($validated['telefono_paciente']);
        $validated['paciente_id'] = $paciente->id;

        $ultrasonido = Ultrasonido::create($validated);

        return new UltrasonidoResponse($ultrasonido);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[Endpoint('Guardar Ultrasonido con Multimedia')]
    #[ResponseFromApiResource(
        UltrasonidoResponse::class,
        Ultrasonido::class
    )]
    public function store(CreateWithMedia $request): UltrasonidoResponse|JsonResponse
    {
        $validated = $request->validated();

        $paciente = User::query()->where('telefono', $validated['telefono_paciente'])->first();

        if (! $paciente) {
            abort(Response::HTTP_BAD_REQUEST, 'El teléfono no está asociado a ningún paciente');
        }
        unset($validated['telefono_paciente']);
        $validated['paciente_id'] = $paciente->id;

        $ultrasonido = Ultrasonido::create($validated);
        $medias = [];

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $file) {
                // Upload File
                $url = Storage::putFile('videos', $file);
                $medias[] = new Media([
                    'tipo' => MediaEnum::VIDEO->name,
                    'titulo' => $ultrasonido->titulo,
                    'descripcion' => $ultrasonido->descripcion,
                    'url' => $url,
                    'disk' => config('filesystems.default'),
                ]);
            }
        }
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {

                // Upload File
                $url = Storage::putFile('images', $file);
                $medias[] = new Media([
                    'tipo' => MediaEnum::IMAGE->name,
                    'titulo' => $ultrasonido->titulo,
                    'descripcion' => $ultrasonido->descripcion,
                    'url' => $url,
                    'disk' => config('filesystems.default'),
                ]);
            }
        }

        if (count($medias)) {
            $ultrasonido->multimedias()->saveMany($medias);
            $ultrasonido->multimedias;
        }

        return new UltrasonidoResponse($ultrasonido);
    }

    /**
     * Display the specified resource.
     */
    #[Endpoint('Mostrar Ultrasonido')]
    #[ResponseFromApiResource(
        UltrasonidoResponse::class,
        Ultrasonido::class
    )]
    public function show(ShowRequest $request, Ultrasonido $ultrasonido): UltrasonidoResponse
    {
        $validated = $request->validated();

        if ($ultrasonido->secret != $validated['secret']) {
            abort(Response::HTTP_BAD_REQUEST, 'El código es incorrecto');
        }

        return new UltrasonidoResponse($ultrasonido);
    }

    /**
     * Update the specified resource in storage.
     */
    #[Endpoint('Actualizar Ultrasonido')]
    #[ResponseFromApiResource(
        UltrasonidoResponse::class,
        Ultrasonido::class
    )]
    public function update(UpdateRequest $request, Ultrasonido $ultrasonido): UltrasonidoResponse
    {
        $validated = $request->validated();
        $ultrasonido->update($validated);

        return new UltrasonidoResponse($ultrasonido);
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * Update the specified resource in storage.
     */
    #[Endpoint('Eliminar Ultrasonido')]
    public function destroy(Ultrasonido $ultrasonido): JsonResponse
    {
        return $ultrasonido->delete()
            ? response()->json(null, Response::HTTP_OK)
            : response()->json(null, Response::HTTP_BAD_REQUEST);
    }
}
