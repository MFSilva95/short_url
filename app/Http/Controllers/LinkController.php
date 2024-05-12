<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Http\Requests\StoreLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Interfaces\LinkRepositoryInterface;
use App\Classes\ApiResponseHandler;
use App\Classes\ShortUrlService;
use App\Http\Resources\LinkResource;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller
{
    private LinkRepositoryInterface $linkRepositoryInterface;
    private ShortUrlService $shortUrlService;

    public function __construct(LinkRepositoryInterface $linkRepositoryInterface, ShortUrlService $shortUrlService)
    {
        $this->linkRepositoryInterface = $linkRepositoryInterface;
        $this->shortUrlService = $shortUrlService;
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

        $details = [
            'longUrl' => $request->longUrl
        ];
        $existsLongUrl = $this->linkRepositoryInterface->findByLongUrl($details['longUrl']);
        if ($existsLongUrl) { // long url already exists in DB
            //return existing long url   
        } else {
            //create
            $newLink = $this->shortUrlService->createShortUrl($details['longUrl']);
            print_r($newLink);
            die();
        }

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