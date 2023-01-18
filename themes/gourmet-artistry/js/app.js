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
});