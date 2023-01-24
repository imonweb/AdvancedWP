jQuery(document).foundation();

jQuery(function($){

  $('#recipes > div').not(':first').hide();
  $('#filter .menu li:first-child').addClass('active');

  $('#filter .menu a').on('click', function(e){
    // console.log(this);
    // e.preventDefault();
    $('#filter .menu li').removeClass('active');
    $(this).parent().addClass('active');
    const recipeLink = $(this).attr('href');
    // console.log(recipeLink);
    $('#recipes > div').hide();
    $(recipeLink).show()
    return false;
  });

  /*  Get the current user time  */
  var date = new Date();
  var time = date.getHours();
  var meal;
  if(time < 10){
    meal = 'breakfast'
  } else if(time >=11 && time <=17){
    meal = 'lunch'
  } else {
    meal = 'dinner'
  }
  console.log(meal);
  $('h2#time').append('<span>' +meal+'</span>');

  /* AJAX  */

  jQuery.ajax({
    url: admin_url.ajax_url,
    type: 'post',
    data: {
      action: 'recipe_'+meal
    }
  }).done(function(response){
    // console.log(response);
    $.each(response, function(index, object){
      // console.log(object.name);
      const recipe_meal = '<li class="medium-4 small-12 columns">' +
                          object.image +
                          '<div class="content">' +
                          '<h3 class="text-center">' +
                          '<a href="'+object.link+'">' +
                          object.name + 
                          '</a>' +
                          '</h3>' +
                          '</div>' +
                          '</li>';
          $('#meal-per-hour').append(recipe_meal);
    });
  });
  
});

