<?php

namespace App\Jobs\Ultrasonido;

use App\Models\Ultrasonido;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
        $url = 'https://umss-n8n.terio.xyz/webhook/02a70849-f8b9-446c-95c7-985b8cee1ae8';

        $params = [
            'secret' => 'QY^XvzoTM7*UqZ%33vAQTi&JJM%k',
            'phone' => $paciente->telefono,
            'url' => config('app.url'),
            'name' => $paciente->nombre,
            'pin' => (int) $this->ultrasonido->secret,
        ];

        $encodeParams = json_encode($params);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => $encodeParams,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
            ],
        ]);

        curl_exec($curl);

        curl_close($curl);
    }
}
