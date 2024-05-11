<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Interfaces\LinkRepositoryInterface;
use App\Classes\ApiResponseHandler;
use App\Http\Resources\LinkResource;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller
{

    private LinkRepositoryInterface $linkRepositoryInterface;

    public function __construct(LinkRepositoryInterface $linkRepositoryInterface)
    {
        $this->linkRepositoryInterface = $linkRepositoryInterface; // 
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->linkRepositoryInterface->getAll();

        return ApiResponseHandler::sendResponse(new LinkResource($data), 'List of shortned url\'s retrieved with success. ', 200);
    }

    /**
     * Create new short url
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created short_url in storage.
     */
    public function store(StoreLinkRequest $request) //POST
    {
        //
        $details = [
            'shortUrl' => $request->shortUrl
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLinkRequest $request, Link $link)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        //
    }
}