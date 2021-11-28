<?php

/**
 * outputs cleaner data
 *
 * @param $string
 * @return array|string|null
 */
function clean($string): array|string|null
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

    foreach ($additional['trends'] as $trend){
        echo (
            '<div class="container-fluid">
              <h2>'
            .$trend['formattedDate']
            .'</h2>
              <div class="container-fluid">');

        foreach ($trend['trendingSearches'] as $search){
            echo('
                <div class="row">
                   <div class="card col" style="width: 18rem;">
                      <div class="card-header">
                                            
                    <a class="link-light text-decoration-none" style="width: 100%; height: 100%" type="button" data-bs-toggle="collapse" data-bs-target="#'
                .clean($search['title']['query'])
                .'" aria-expanded="false" aria-controls="'
                .clean($search['title']['query'])
                .'">
                    <img src="'
                .$search['image']['imageUrl']
                .'" class="rounded" width="100px" alt="'
                .$search['image']['source']
                .'" title="'
                .$search['image']['source']
                .'">
                        <span class="my-4 ml-5 h3">'
                .$search['title']['query']
                .'</span>
                     <sub class=" text-muted" style="font-size: .5em">Click for more</sub>
                    </a>
                      </div>
                      <ul class="list-group list-group-flush collapse" id="'
                .clean($search['title']['query'])
                .'">');

            foreach ($search['articles'] as $article){
                echo('<a class="link-light" href="'
                    .$article['url']
                    .'"><li class="list-group-item list-group-item-dark">'
                    .$article['title']
                    .'<br><small>'
                    .$article['source']
                    .' '
                    .$article['timeAgo']
                    .'</small>'
                    .'</li></a>');
            }

            echo ('</ul>
                    <div class="card-footer text-muted text-center" >
                       Traffic: '
                .$search['formattedTraffic']
                .' 
                    </div>
                  </div>
               </div>    
            ');
        }

        echo(
                '</div>
            </h1></div>'
        );
    }

