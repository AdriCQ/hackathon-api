<?php

return [
    'labels' => [
        'search' => 'Buscar',
        'base_url' => 'URL Base',
    ],

    'auth' => [
        'none' => 'Esta API no está autenticada.',
        'instruction' => [
            'query' => <<<'TEXT'
                Para autenticar las solicitudes, incluye un parámetro de consulta **`:parameterName`** en la solicitud.
                TEXT,
            'body' => <<<'TEXT'
                Para autenticar las solicitudes, incluye un parámetro **`:parameterName`** en el cuerpo de la solicitud.
                TEXT,
            'query_or_body' => <<<'TEXT'
                Para autenticar las solicitudes, incluye un parámetro **`:parameterName`** ya sea en la cadena de consulta o en el cuerpo de la solicitud.
                TEXT,
            'bearer' => <<<'TEXT'
                Para autenticar las solicitudes, incluye un encabezado **`Authorization`** con el valor **`"Bearer :placeholder"`**.
                TEXT,
            'basic' => <<<'TEXT'
                Para autenticar las solicitudes, incluye un encabezado **`Authorization`** en la forma **`"Basic {credentials}"`**.
                El valor de `{credentials}` debe ser tu nombre de usuario/ID y tu contraseña, unidos con dos puntos (:),
                y luego codificado en base64.
                TEXT,
            'header' => <<<'TEXT'
                Para autenticar las solicitudes, incluye un encabezado **`:parameterName`** con el valor **`":placeholder"`**.
                TEXT,
        ],
        'details' => <<<'TEXT'
            Todos los puntos finales autenticados están marcados con una insignia `requiere autenticación` en la documentación a continuación.
            TEXT,
    ],

    'headings' => [
        'introduction' => 'Introducción',
        'auth' => 'Autenticación de solicitudes',
    ],

    'endpoint' => [
        'request' => 'Solicitud',
        'headers' => 'Encabezados',
        'url_parameters' => 'Parámetros de URL',
        'body_parameters' => 'Parámetros del cuerpo',
        'query_parameters' => 'Parámetros de consulta',
        'response' => 'Respuesta',
        'response_fields' => 'Campos de respuesta',
        'example_request' => 'Solicitud de ejemplo',
        'example_response' => 'Respuesta de ejemplo',
        'responses' => [
            'binary' => 'Datos binarios',
            'empty' => 'Respuesta vacía',
        ],
    ],

    'try_it_out' => [
        'open' => 'Probarlo ⚡',
        'cancel' => 'Cancelar 🛑',
        'send' => 'Enviar solicitud 💥',
        'loading' => '⏱ Enviando...',
        'received_response' => 'Respuesta recibida',
        'request_failed' => 'La solicitud falló con error',
        'error_help' => <<<'TEXT'
            Consejo: Verifica que estés correctamente conectado a la red.
            Si eres un mantenedor de esta API, verifica que tu API esté en funcionamiento y hayas habilitado CORS.
            Puedes consultar la consola de Herramientas de desarrollo para obtener información de depuración.
            TEXT,
    ],

    'links' => [
        'postman' => 'Ver colección de Postman',
        'openapi' => 'Ver especificación OpenAPI',
    ],
];
