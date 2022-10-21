<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatAndDogController extends Controller
{
    //
    public function getBreeds(){
        $page = $_GET['page'];
        $limit = $_GET['limit'];
        
        //get list for dog usig thedogapi.com
        $dogCurlUrl = 'https://api.thedogapi.com/v1/breeds?page='.$page.'&limit='.$limit;
        $dogBreeds = $this->curl($dogCurlUrl);

        //get list for dog usig thecatapi.com
        $catCurlUrl = 'https:///api.thecatapi.com/v1/breeds?page='.$page.'&limit='.$limit;
        $catBreeds = $this->curl($catCurlUrl);

        //combine data of breeds
        $combinedBreeds = json_encode(array_merge(json_decode($dogBreeds), json_decode($catBreeds)));

        //Return values
        $data = json_decode($combinedBreeds);
        return [
            'page' => $page,
            'limit' => $limit,
            'results' => $data
        ];
    }

    public function getBreedImagesPerType($type){
        $page = $_GET['page'];
        $limit = $_GET['limit'];
        $breedType = $type;
        
        //Indentify which API to be used
        $curlUrl = $breedType=='dog'?'https://api.thedogapi.com/v1/images/search?page='.$page.'&limit='.$limit : 'https://api.thecatapi.com/v1/images/search?page='.$page.'&limit='.$limit;
        $images = $this->curl($curlUrl);

        //Return values
        $data = json_decode($images);

        return [
            'page' => $page,
            'limit' => $limit,
            'results' => $data
        ];
    }

    public function getImageList(){
        $page = $_GET['page'];
        $limit = $_GET['limit'];

        //get list for dog usig TheDogAPI.com
        $dogCurlUrl = 'https://api.thedogapi.com/v1/images/search?page='.$page.'&limit='.$limit;
        $dogList = $this->curl($dogCurlUrl);

        //get list for dog usig thecatapi.com
        $catCurlUrl = 'https://api.thecatapi.com/v1/images/search?page='.$page.'&limit='.$limit;
        $catList = $this->curl($catCurlUrl);

        //combine data of breeds
        $combinedList = json_encode(array_merge(json_decode($dogList), json_decode($catList)));

        //Return values
        $data = json_decode($combinedList);
        return [
            'page' => $page,
            'limit' => $limit,
            'results' => $data
        ];
    }

    public function curl($curlURL){
        //All API calls to both cats and dogs are processed here...
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $curlURL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        return $response;
    }
}
