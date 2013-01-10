$(document).ready(function(){
  $('ul.destination-list').hide();
  $('.learnmore').click(function(){
    $(this).next('ul.destination-list').slideDown('fast').addClass('active');
    if($(this).next('ul.destination-list').hasClass('active')){
      console.log('here:',$(this));
      $(this).next('ul');
    }else{
      
    }
    $('.close').click(function(){
      $(this).parent().slideUp('fast').removeClass('active');
    });
  });
});