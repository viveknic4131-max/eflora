<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $bsiVolume = [
            ['id' => 1, 'volume' => 'Volume 1', 'name' => 'Botanical Survey of India', 'description' => 'Comprehensive survey of Indian flora', 'year' => 2020],
            ['id' => 2, 'volume' => 'Volume 2', 'name' => 'Flora of the Western Ghats', 'description' => 'Detailed account of plants in the Western Ghats', 'year' => 2021],
            ['id' => 3, 'volume' => 'Volume 3', 'name' => 'Medicinal Plants of India', 'description' => 'Exploration of medicinal flora in India', 'year' => 2022]
        ];
        $floraofIndia = [
            ['id' => 1,'volume' => 'Volume 1', 'name' => 'Flora of India Volume 1', 'description' => 'Introduction to Indian flora', 'year' => 2018],
            ['id' => 2,'volume' => 'Volume 2', 'name' => 'Flora of India Volume 2', 'description' => 'Diverse plant species in India', 'year' => 2019],
            ['id' => 3,'volume' => 'Volume 3', 'name' => 'Flora of India Volume 3', 'description' => 'Endemic plants of India', 'year' => 2020],
            ['id' => 4,'volume' => 'Volume 4', 'name' => 'Flora of India Volume 4', 'description' => 'Rare and endangered species', 'year' => 2021],
            ['id' => 5,'volume' => 'Volume 5', 'name' => 'Flora of India Volume 5', 'description' => 'Aquatic and marsh plants', 'year' => 2022],
            ['id' => 6,'volume' => 'Volume 6', 'name' => 'Flora of India Volume 6', 'description' => 'Alpine and Himalayan flora', 'year' => 2023],
            ['id' => 7,'volume' => 'Volume 7', 'name' => 'Flora of India Volume 7', 'description' => 'Desert and arid region plants', 'year' => 2024],
            ['id' => 8,'volume' => 'Volume 8', 'name' => 'Flora of India Volume 8', 'description' => 'Coastal and mangrove vegetation', 'year' => 2025],
            ['id' => 9,'volume' => 'Volume 9', 'name' => 'Flora of India Volume 9', 'description' => 'Forest ecosystems and their flora', 'year' => 2026],
            ['id' => 10,'volume' => 'Volume 10', 'name' => 'Flora of India Volume 10', 'description' => 'Grasslands and savanna plants', 'year' => 2027],
            ['id' => 11,'volume' => 'Volume 11', 'name' => 'Flora of India Volume 11', 'description' => 'Cultivated and ornamental plants', 'year' => 2028],
            ['id' => 12,'volume' => 'Volume 12', 'name' => 'Flora of India Volume 12', 'description' => 'Invasive species in India', 'year' => 2029],
            ['id' => 13,'volume' => 'Volume 13', 'name' => 'Flora of India Volume 13', 'description' => 'Climate change impact on flora', 'year' => 2030],
            ['id' => 14,'volume' => 'Volume 14', 'name' => 'Flora of India Volume 14', 'description' => 'Future prospects of Indian flora', 'year' => 2031],
            ['id' => 15,'volume' => 'Volume 15', 'name' => 'Flora of India Volume 15', 'description' => 'Conservation strategies for Indian plants', 'year' => 2032],
            ['id' => 16,'volume' => 'Volume 16', 'name' => 'Flora of India Volume 16', 'description' => 'Ethnobotany and traditional uses', 'year' => 2033],
            ['id' => 17,'volume' => 'Volume 17', 'name' => 'Flora of India Volume 17', 'description' => 'Pollination and plant-animal interactions', 'year' => 2034],
            ['id' => 18,'volume' => 'Volume 18', 'name' => 'Flora of India Volume 18', 'description' => 'Soil-plant relationships in India', 'year' => 2035],
            ['id' => 19,'volume' => 'Volume 19', 'name' => 'Flora of India Volume 19', 'description' => 'Phenology and seasonal changes', 'year' => 2036],
            ['id' => 20,'volume' => 'Volume 20', 'name' => 'Flora of India Volume 20', 'description' => 'Genetic diversity of Indian plants', 'year' => 2037],
            ['id' => 21,'volume' => 'Volume 21', 'name' => 'Flora of India Volume 21', 'description' => 'Restoration ecology and habitat management', 'year' => 2038],
            ['id' => 22,'volume' => 'Volume 22', 'name' => 'Flora of India Volume 22', 'description' => 'Urban flora and green spaces', 'year' => 2039],
            ['id' => 23,'volume' => 'Volume 23', 'name' => 'Flora of India Volume 23', 'description' => 'Agricultural biodiversity in India', 'year' => 2040],
            ['id' => 24,'volume' => 'Volume 24', 'name' => 'Flora of India Volume 24', 'description' => 'Marine and coastal plant life', 'year' => 2041],
            ['id' => 25,'volume' => 'Volume 25', 'name' => 'Flora of India Volume 25', 'description' => 'Technological advancements in botany', 'year' => 2042],
            ['id' => 26,'volume' => 'Volume 26', 'name' => 'Flora of India Volume 26', 'description' => 'Policy and legislation for plant conservation', 'year' => 2043],
            ['id' => 27,'volume' => 'Volume 27', 'name' => 'Flora of India Volume 27', 'description' => 'Public awareness and education on flora', 'year' => 2044],
            ['id' => 28,'volume' => 'Volume 28', 'name' => 'Flora of India Volume 28', 'description' => 'International collaborations in botanical research', 'year' => 2045],
            ['id' => 29,'volume' => 'Volume 29', 'name' => 'Flora of India Volume 29', 'description' => 'Technological advancements in botany', 'year' => 2046],
            ['id' => 30,'volume' => 'Volume 30', 'name' => 'Flora of India Volume 30', 'description' => 'Future directions in Indian botanical studies', 'year' => 2047],
            ['id' => 31,'volume' => 'Volume 31', 'name' => 'Flora of India Volume 31', 'description' => 'Comprehensive index of Indian plant species', 'year' => 2048],
            ['id' => 32,'volume' => 'Volume 32', 'name' => 'Flora of India Volume 32', 'description' => 'Supplementary information and updates', 'year' => 2049],

        ];
        return view('theme.home', compact('bsiVolume', 'floraofIndia'));
    }
}
