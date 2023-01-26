(function($, root, undefined) {

  $(function() {

    'use strict';
   
    // Course Filter Section

    $('#recipes > div ').not(':first').hide();
    $('#filter .course-filter li:first-child').addClass('active');

    $('#filter .course-filter a').on('click', function() {
        $('#filter .course-filter li').removeClass('active');
        $(this).parent().addClass('active');
        var recipe_link = $(this).attr('href');

        console.log(recipe_link);
        $('#recipes > div ').hide();
        $(recipe_link).show();
        return false;
    });

    // Course Filter 2
    // console.log(admin_url); 

    var meal;
    var currentTime = new Date().getHours();
    if( currentTime <= 12) {
      meal = 'breakfast';
    } else if( currentTime > 12 && currentTime < 18) {
      meal = 'lunch'
    } else {
      meal = 'dinner';
    }

    
    
    if($('#meal-per-hour').length > 0) {
         
        jQuery.ajax({

          url: admin_url.ajax_url,
          type: 'post',
          data: {
            action: 'recipe_' + meal,
          }
        }).done(function(response) {
          $.each(response, function(index, object) {
            var recipe_meal = '<li class="medium-4 small-12 columns">' +
              object.image +
              '<div class="content">' +
              '<h3 class="text-center">' +
              '<a href="' + object.link + '">' +
              object.name +
              '</a>' +
              '</h3>' +
              '</div>' +
              '</li>';
            $('#meal-per-hour').append(recipe_meal);
          });
        });
    }

  });

})(jQuery, this);