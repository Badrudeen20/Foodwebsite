$(document).ready(function(){
     
    $('.sidebar-menu ul li a').each(function(ele,val){
        
        
         val.addEventListener('click',function(){
            $('.sidebar-menu ul li a').each(function(index,li){
                li.classList.remove('active')
            })
            this.classList.add('active')
             
         })
    })


    $('#burger').click(function(){
         $('.sidebar').addClass('active')
         $('#close').css("display","flex")
    })
    
    $('#close').click(function(){
        $('.sidebar').removeClass('active')
        $('#close').css("display","none")
    })
  
 $(window).resize(function(){
   if($(window).width() > 700){
    $('.sidebar').removeClass('active')
    $('#close').css("display","none")
     
   }
 })



})