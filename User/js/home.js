$(document).ready(function(){
  $('.burger').click(function(){
       if( $('#navigation-menu').hasClass('active')){
         $('#navigation-menu').removeClass('active')
       }else{
         $('#navigation-menu').addClass('active')
       }

  })

  $('#navigation-menu').click(function(){
   if( $('#navigation-menu').hasClass('active')){
     $('#navigation-menu').removeClass('active')
   }else{
     $('#navigation-menu').addClass('active')
   }

})

 $('.fi-rr-plus-small').click(function(){
   const id = this.getAttribute('data-qty')
 var minus =  parseInt($('#qty'+id).html())
 $('#qty'+id).html(minus + 1)
 })

$('.fi-rr-minus-small').click(function(){
 const id = this.getAttribute('data-qty')
 var minus =  parseInt($('#qty'+id).html())
 if(minus < 2) return
 $('#qty'+id).html(minus - 1)
})


})