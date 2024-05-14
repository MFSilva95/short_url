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
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
            return ApiResponseHandler::sendResponse(new LinkResource($existsLongUrl), 'Shortned url retrieved. ', 200);
        } else {
            try {

                $tryAgain = false;
                $useSalt = false;
                while ($tryAgain === false) {
                    $tinyHash = $this->shortUrlService->createShortUrl($details, $useSalt);
                    $details['shortUrl'] = $tinyHash;
                    // lets try to insert new tinyurl
                    DB::beginTransaction();
                    $newEntry = $this->linkRepositoryInterface->createShortUrl($details);
                    DB::commit();
                    if (isset($newEntry["status"]) && $newEntry["status"] === false) {
                        $useSalt = true;
                        // we need to try again with salt

                    } else if (isset($newEntry["short_url"])) {
                        $tryAgain = true; // return

                    }


                }
                return ApiResponseHandler::sendResponse(new LinkResource($newEntry), 'Shortned url created. ', 200);


            } catch (\Exception $e) {
                return ApiResponseHandler::rollback($e->getMessage(), 'Error creating short url. ');
            }
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
    public function redirectToUrl($shortUrl)
    {
        // Assuming you have a mapping of short URLs to full URLs
        $fullUrl = $this->linkRepositoryInterface->findByShortUrl($shortUrl);


        if ($fullUrl) {
            if (!preg_match('#^https?://#i', $fullUrl)) {
                $fullUrl = 'http://' . $fullUrl;
            }
            return Redirect::away($fullUrl);
        } else {
            abort(404);
        }
    }
}