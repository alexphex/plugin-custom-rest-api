<?php
/*
Plugin Name: Custom REST API Endpoint
Description: Adds a custom endpoint to the REST API to retrieve the latest posts from a category.
Version: 1.0
Author: alex + Copilot 
*/

/*
register a new endpoint in the REST API,
which will work along the path /wp-json/custom/v1/latest-posts
*/
add_action('rest_api_init', function() {
    register_rest_route('custom/v1', '/latest-posts/', [
        'methods'  => 'GET',
        'callback' => 'get_latest_posts',
        'args'     => [
            'category' => [
                'required' => true,
                'validate_callback' => function($param) {
                    return is_numeric($param);
                }
            ]
        ]
    ]);
});

/*
get_latest_posts (callback), 
will receive posts from the specified category.
*/

add_action('rest_api_init', function() {
    register_rest_route('custom/v1', '/latest-posts/', [
        'methods'  => 'GET',
        'callback' => 'get_latest_posts',
        'args'     => [
            'category' => [
                'required' => true,
                'validate_callback' => function($param) {
                    return is_numeric($param);
                }
            ]
        ]
    ]);
});

function get_latest_posts($request) {
    $category_id = $request->get_param('category'); // Get the category ID
    
    // Check the cache (data is stored for 10 minutes)
    $cache_key = 'latest_posts_' . $category_id;
    $cached_posts = get_transient($cache_key);

    if ($cached_posts) {
        return rest_ensure_response($cached_posts);
    }

    // If there is no cache, we execute a query to the database
    $args = [
        'cat'             => $category_id, // use 'cat' instead of 'category'
        'posts_per_page'  => 5,
        'no_found_rows'   => true // Speeds up the query by eliminating row counting
    ];

    $query = new WP_Query($args);
    $posts = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $posts[] = [
                'title' => get_the_title(),
                'link'  => get_permalink(),
                'date'  => get_the_date('Y-m-d')
            ];
        }
        wp_reset_postdata();
    }

    // save the result in cache for 10 minutes
    set_transient($cache_key, $posts, 600);

    return rest_ensure_response($posts);
}
?>




