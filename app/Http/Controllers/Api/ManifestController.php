<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TokenManifestCollection;
use App\Models\Asset;

class ManifestController extends Controller
{
    public function __invoke()
    {
        return (new TokenManifestCollection(Asset::with('network')->get()));
    }
}
