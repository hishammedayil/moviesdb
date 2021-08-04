<?php

declare(strict_types=1);

namespace App\Services;

use Faker\Provider\Image;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Utils;
use Illuminate\Http\UploadedFile;
//use Imgur;
use Illuminate\Support\Facades\Http;
use SplFileInfo;
//use Yish\Imgur\Upload;

class ImageUploadService
{
//    /**
//     * @var Upload
//     */
//    private $imgur;
//
//    /**
//     * FileUploadService constructor.
//     * @param Upload $imgur
//     */
//    public function __construct(Upload $imgur)
//    {
//        $this->imgur = $imgur;
//    }

    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var string
     */
    private $endPoint;
    /**
     * @var string
     */
    private $clientId;

    /**
     * ImageUploadService constructor.
     * @param Client $httpClient
     */
    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->endPoint = env('IMGUR_API_URl');
        $this->clientId = env('IMGUR_CLIENT_ID');
    }

    /**
     * @throws GuzzleException
     */
    public function upload(SplFileInfo $file): string
    {
        $payload = [
            'headers' => [
                'authorization' => 'Client-ID ' . $this->clientId,
                'content-type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'image' => base64_encode(file_get_contents($file->getRealPath()))
            ]
        ];
        $response = $this->httpClient->post($this->endPoint, $payload);
        $responseData = Utils::jsonDecode($response->getBody()->getContents());

        return $responseData->data->link;
//        return $this->imgur->upload($file)->link();
    }
}
