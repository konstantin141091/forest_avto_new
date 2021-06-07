<?php


namespace App\Http\Interfaces;


interface IParser
{
    public function getProductsWhitArticle(string $article, array $products);
}
