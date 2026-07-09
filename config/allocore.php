<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Allocore Hub Integration (outbound)
    |--------------------------------------------------------------------------
    |
    | AuditPro pushes its results to the Allocore Hub as KPIs when an audit is
    | completed. The hub identifies the company via the API key, so only the
    | hub URL and the per-company API key (generated on the hub's Tools page)
    | are required here.
    |
    */

    // Base URL of the Allocore Hub, e.g. https://hub.allocore.de
    'hub_url' => env('ALLOCORE_HUB_URL'),

    // Per-company API key from the hub's Tools page (X-Allocore-Api-Key).
    'api_key' => env('ALLOCORE_API_KEY'),

    // Tool slug the hub expects for this integration.
    'source' => 'audit',

    // HTTP timeout (seconds) for the push.
    'timeout' => (int) env('ALLOCORE_TIMEOUT', 5),

    // Master switch; the push is also skipped automatically when hub_url or
    // api_key are missing.
    'enabled' => (bool) env('ALLOCORE_ENABLED', true),
];
