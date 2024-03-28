<?php

namespace App\Jobs\Ultrasonido;

use App\Models\Ultrasonido;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendSecretJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly Ultrasonido $ultrasonido)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $paciente = $this->ultrasonido->paciente;
        $n8nHook = 'https://umss-n8n.terio.xyz/webhook/02a70849-f8b9-446c-95c7-985b8cee1ae8';

        $data = [
            'secret' => 'QY^XvzoTM7*UqZ%33vAQTi&JJM%k',
            'phone' => $paciente->telefono,
            'url' => config('app.url'),
            'name' => $paciente->nombre,
            'pin' => $this->ultrasonido->secret,
        ];

        Http::post($n8nHook, $data);
    }
}
