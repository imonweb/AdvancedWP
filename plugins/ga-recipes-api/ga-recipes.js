$ = jQuery.noConflict();

$(document).ready(function() {

    var rest_url = previous_posts.rest_url;

    function scroll_post() {
        var btn_load_more =  $('.previous_post_link').last();
        var mainPosition = btn_load_more.offset().top - $(window).outerHeight();
        $(window).scroll( function(event) {
            // console.log(mainPosition);
            if(mainPosition > $(window).scrollTop() ) {
                //console.log("no");
                return; 
            }
            $(this).off(event);
            call_to_post();
        });
    }

    scroll_post();

    function call_to_post() {
        var previous_post_id = jQuery('.previous_post_link').last().attr('data-previous-post');
        var json_url = rest_url + previous_post_id + '?&_embed=true';
        $.ajax({
            dataType: 'json',
            url: json_url
        })  
        .done(function(post_data) {
            display_post(post_data);
        });
        function display_post(post_data) {
            var new_post =  '<article>' + 
                                        '<div class="large-12 columns">' +
                                            '<img width="800" height="300" src="'+post_data._embedded['wp:featuredmedia'][0].media_details.sizes['single-image'].source_url +'" class="thumbnail wp-post-image" alt="">' +		
                                        '</div>'+
                                
                                        '<div class="large-12 columns">'+
            
                                                '<header class="entry-header">'+
                                                    '<h1 class="entry-title text-center separator">'+post_data.title.rendered+'</h1>' +	
                                                '</header>'+
            
                                                '<div class="entry-content">'+
                                                    '<div class="taxonomies">'+
                                                            '<div class="price-range">'+
                                                                'Price Range:' + post_data.ga_recipes_term_price_range +		
                                                            '</div>' +
                                                            '<div class="meal-type">'+
                                                                'Meal: ' + post_data.ga_recipes_term_meal_type +
                                                            '</div>'+
                                                            '<div class="course">'+
                                                               'Course:'+ post_data.ga_recipes_term_course + 					
                                                            '</div>'+
                                                            '<div class="mood">'+ 
                                                                'Mood:'+ post_data.ga_recipes_term_mood +					
                                                            '</div>'+
                                                    '</div>'+
            
                                                    '<div class="extra-information">'+
                                                        '<div class="row">'+
                                                            '<div class="calories small-6 columns">'+
                                                                        '<p>Calories: <em>'+post_data.ga_recipes_meta['input-metabox']+'</em></p>'+
                                                            '</div>'+
                                                            '<div class="rating small-6 columns">'+
                                                                '<p>Rating: <em> '+post_data.ga_recipes_meta['dropdown-metabox']+'</em> Stars</p>' +
                                                            '</div>'+
                                                        '</div>'+
            
                                                        '<blockquote><p>'+post_data.ga_recipes_meta['textarea-metabox']+'</p></blockquote>'+
                                                    '</div>'+
                                                    post_data.content.rendered +
                                                '</div>'+
                                        '</div>'+
                                        '<a class="previous_post_link" data-previous-post="'+post_data.ga_recipes_previous_ID+'">Previous Post!!</a>'+
                            '</article>';
                    jQuery('article.recipes').append(new_post);
                    scroll_post();
        }
    }
});