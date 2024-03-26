<?php

namespace App\Http\Controllers;

use App\Enums\MediaEnum;
use App\Http\Requests\Media\CreateRequest;
use App\Http\Requests\Media\FilterRequest;
use App\Http\Resources\MediaResponse;
use App\Models\Media;
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
#[Subgroup('Multimedia')]
class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[Endpoint('Filtrar Media')]
    #[ResponseFromApiResource(
        MediaResponse::class,
        Media::class,
        collection: true,
        simplePaginate: 10
    )]
    public function index(FilterRequest $request): AnonymousResourceCollection
    {
        $validated = $request->validated();

        return MediaResponse::collection(
            Media::query()
                ->when(
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
    #[Endpoint('Guardar Multimedia')]
    #[ResponseFromApiResource(
        MediaResponse::class,
        Media::class
    )]
    public function store(CreateRequest $request): MediaResponse|JsonResponse
    {
        $validated = $request->validated();
        $validated['disk'] = config('filesystems.default');

        // Upload File
        if (array_key_exists('image', $validated) && ! is_null($validated['image'])) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $validated['url'] = Storage::putFile('images', $request->file('image'));
            $validated['tipo'] = MediaEnum::IMAGE->name;
            // $validated['url'] = 'images/'.  $name.'.'.$extension;

        } elseif (array_key_exists('video', $validated) && ! is_null($validated['video'])) {
            $file = $request->file('video');
            $name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $validated['url'] = Storage::putFile('videos', $request->file('video'));
            // $validated['url'] = 'video/'.  $name.'.'.$extension;
            $validated['tipo'] = MediaEnum::VIDEO->name;
        } else {
            return response()->json(['message' => 'Es necesario el campo image o video']);
        }

        unset($validated['image']);
        unset($validated['video']);

        $media = Media::create($validated);

        return new MediaResponse($media);
    }

    /**
     * Display the specified resource.
     */
    #[Endpoint('Mostrar Multimedia')]
    #[ResponseFromApiResource(
        MediaResponse::class,
        Media::class
    )]
    public function show(Media $media): MediaResponse|JsonResponse
    {
        return new MediaResponse($media);
    }

    /**
     * Remove the specified resource from storage.
     */
    #[Endpoint('Eliminar Multimedia')]
    public function destroy(Media $media): JsonResponse
    {
        return $media->delete()
            ? response()->json(null, Response::HTTP_OK)
            : response()->json(null, Response::HTTP_FORBIDDEN);
    }
}
