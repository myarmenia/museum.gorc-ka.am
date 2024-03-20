<?php
namespace App\Repositories\Museum;

use App\Interfaces\Museum\MuseumRepositoryInterface;
use App\Models\Museum;
use App\Models\MuseumTranslation;



class MuseumRepository implements MuseumRepositoryInterface
{
    public function getProject()
    {
        return Museum::get();
    }

    public function createMuseum($data)
    {
        return Museum::create($data);
    }

    public function createMuseumTranslations($data)
    {
        return MuseumTranslation::insert($data);
    }

    public function getMuseumByUd($id)
    {
        return Museum::with(['user', 'translations', 'phones', 'images', 'links', 'region'])->find($id);
    }

    public function updateMuseum($data, $id)
    {
        return Museum::find($id)->update($data);
    }

    public function updateMuseumTranslations($data, $lang, $id)
    {
        return MuseumTranslation::where(['lang' => $lang, 'museum_id' => $id])->update($data);
    }

    public function getApiMuseum()
    {
        return Museum::with([
            'images', 'region',
            'translations' => function ($query) {
                $query->where('lang', session('languages'))->get();
            },
        ])->get();
    }

    public function getMuseumByLangAndId($id)
    {
        return Museum::with([
            'user', 'phones', 'images', 'links', 'region', 'museum_branches',
            'translations' => function ($query) {
                $query->where('lang', session('languages'))->get();
            }
        ])->find($id);
    }

    public function getMobileMuseumById($id)
    {
        return Museum::with([
            'user', 'translations', 'phones', 'images', 'links', 
            'region', 
            'products' => function ($query) {
                $query->orderBy('id', 'DESC')->where('status', 1)->paginate(10);
            },
            'educational_programs' => function ($query) {
                $query->orderBy('id', 'DESC')->where('status', 1)->paginate(10);
            },
            'events' => function ($query) {
                $query->orderBy('id', 'DESC')->where('status', 1)->paginate(10);
            }
        ])->find($id);
    }

}