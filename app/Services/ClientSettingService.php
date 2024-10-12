<?php

namespace App\Services;

use App\Http\Requests\Client\ClientContactsRequest;
use App\Http\Resources\ContactResource;
use App\Http\Resources\OfferResource;
use App\Models\Contact;
use App\Models\Offer;

class ClientSettingService{
    public function allOffers()
    {
        $offers = Offer::with('restaurant')->paginate(3);
        if (count($offers) > 0){
            if ($offers->total() > $offers->currentPage()){
                $data = [
                    'data' => OfferResource::collection($offers),
                    'pagination links' => [
                        'current page' => $offers->currentPage(),
                        'total' => $offers->total(),
                        'link' => [
                            'first page' => $offers->url(1),
                            'next page' => $offers->nextPageUrl(),
                            'perv page' => $offers->previousPageUrl(),
                            'last page' => $offers->url($offers->lastPage()),
                        ],
                    ],
                ];
            }else{
                $data = OfferResource::collection($offers);
            }
            return responseJson(200,'All Offers',$data);
        }
        return responseJson(404,'No offers found',[]);
    }

    public function clientContactUs(ClientContactsRequest $request)
    {
        $contact = Contact::create($request->all());
        return responseJson(200,'Contact Send Successfully!',new ContactResource($contact));
    }

}
