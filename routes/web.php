<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('theme.home');
});

Route::get('/about', function () {
    return view('theme.about');
})->name('about');


Route::get('/search', function () {

    $data = [
        [
            "accepted" => true,
            "author" => "(Jaub. & Spach) Nevski",
            "family" => "Plumbaginaceae",
            "fqId" => "urn:lsid:ipni.org:names:32165-1",
            "images" => "http://127.0.0.1:8000/storage/plants/basil.jpg",
            "kingdom" => "Plantae",
            "name" => "Psylliostachys",
            "rank" => "Genus",
            "snippet" => "<b>Appearance</b>: Flowers white or rose-coloured, spikelets 2",
            "url" => "/taxon/urn:lsid:ipni.org:names:32165-1"
        ],
        [
            "accepted" => true,
            "author" => "L.",
            "family" => "Rosaceae",
            "fqId" => "urn:lsid:ipni.org:names:731002-1",
            "images" => "http://127.0.0.1:8000/storage/plants/rosaindica.jpg",
            "kingdom" => "Plantae",
            "name" => "Rosa indica",
            "rank" => "Species",
            "snippet" => "<b>Appearance</b>: Popular garden rose, red fragrant flowers",
            "url" => "/taxon/urn:lsid:ipni.org:names:731002-1"
        ],
        [
            "accepted" => true,
            "author" => "(L.) Benth.",
            "family" => "Fabaceae",
            "fqId" => "urn:lsid:ipni.org:names:503141-1",
            "images" => "http://127.0.0.1:8000/storage/plants/Cajanus.jpg",
            "kingdom" => "Plantae",
            "name" => "Cajanus cajan",
            "rank" => "Species",
            "snippet" => "Commonly called <b>Pigeon pea</b>, important food crop.",
            "url" => "/taxon/urn:lsid:ipni.org:names:503141-1"
        ],
        [
            "accepted" => true,
            "author" => "Hook.",
            "family" => "Asteraceae",
            "fqId" => "urn:lsid:ipni.org:names:239773-1",
            "images" => "http://127.0.0.1:8000/storage/plants/Helianthus.jpg",
            "kingdom" => "Plantae",
            "name" => "Helianthus annuus",
            "rank" => "Species",
            "snippet" => "Large yellow flower heads, oilseed crop.",
            "url" => "/taxon/urn:lsid:ipni.org:names:239773-1"
        ],
        [
            "accepted" => true,
            "author" => "(DC.) Merr.",
            "family" => "Fabaceae",
            "fqId" => "urn:lsid:ipni.org:names:495840-1",
            "images" => "http://127.0.0.1:8000/storage/plants/Parkia.jpg",
            "kingdom" => "Plantae",
            "name" => "Parkia timoriana",
            "rank" => "Species",
            "snippet" => "Known as <b>Tree Bean</b>, edible pods and seeds.",
            "url" => "/taxon/urn:lsid:ipni.org:names:495840-1"
        ],
        [
            "accepted" => true,
            "author" => "J.König",
            "family" => "Sapotaceae",
            "fqId" => "urn:lsid:ipni.org:names:78747-1",
            "images" => "http://127.0.0.1:8000/storage/plants/Madhuca.jpg",
            "kingdom" => "Plantae",
            "name" => "Madhuca longifolia",
            "rank" => "Species",
            "snippet" => "Indian butter tree, flowers used for liquor.",
            "url" => "/taxon/urn:lsid:ipni.org:names:78747-1"
        ],
        [
            "accepted" => true,
            "author" => "L.",
            "family" => "Rutaceae",
            "fqId" => "urn:lsid:ipni.org:names:302982-1",
            "images" => null,
            "kingdom" => "Plantae",
            "name" => "Citrus limon",
            "rank" => "Species",
            "snippet" => "Commonly known as <b>Lemon</b>, citrus fruit crop.",
            "url" => "/taxon/urn:lsid:ipni.org:names:302982-1"
        ],
        [
            "accepted" => true,
            "author" => "R.Br.",
            "family" => "Orchidaceae",
            "fqId" => "urn:lsid:ipni.org:names:64816-1",
            "images" => null,
            "kingdom" => "Plantae",
            "name" => "Dendrobium nobile",
            "rank" => "Species",
            "snippet" => "Epiphytic orchid, beautiful ornamental plant.",
            "url" => "/taxon/urn:lsid:ipni.org:names:64816-1"
        ],
        [
            "accepted" => true,
            "author" => "L.",
            "family" => "Poaceae",
            "fqId" => "urn:lsid:ipni.org:names:316780-2",
            "images" => null,
            "kingdom" => "Plantae",
            "name" => "Oryza sativa",
            "rank" => "Species",
            "snippet" => "Cultivated <b>Rice</b>, staple food crop worldwide.",
            "url" => "/taxon/urn:lsid:ipni.org:names:316780-2"
        ],
        [
            "accepted" => true,
            "author" => "Mill.",
            "family" => "Lamiaceae",
            "fqId" => "urn:lsid:ipni.org:names:44923-1",
            "images" => null,
            "kingdom" => "Plantae",
            "name" => "Ocimum basilicum",
            "rank" => "Species",
            "snippet" => "Known as <b>Basil</b>, aromatic herb.",
            "url" => "/taxon/urn:lsid:ipni.org:names:44923-1"
        ],


    ];


    // dd($data);

    return view('theme.searchlist', compact('data'));
})->name('search');





include 'admin.php';
