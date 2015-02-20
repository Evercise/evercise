<?php

class SiteMapController extends Controller
{


    public function index()
    {
        /** HomePage */
        Sitemap::addTag(url('/'), date('Y-m-d H').':00:00', 'daily', '1');



        /** All Articles */
        $articles = Articles::all();

        foreach ($articles as $article) {
            Sitemap::addTag(Articles::createUrl($article, true), $article->created_at, 'daily', '0.8');
        }


        /** Classes */
        $classes = Evercisegroup::where('published', 1)->get();

        foreach ($classes as $class) {
            Sitemap::addTag(route('class.show', ['id' => $class->slug]), $class->created_at, 'daily', '0.8');
        }



        /** Trainers */
        $trainers = Trainer::where('confirmed', 1)->get();

        foreach ($trainers as $trainer) {
            Sitemap::addTag(route('trainer.show', ['id' => $trainer->user->display_name]), $trainer->created_at, 'daily', '0.8');
        }


        /** Search Terms */

        /** LOOP the search terms and add them to the SiteMap */


        return Sitemap::renderSitemap();


    }

}