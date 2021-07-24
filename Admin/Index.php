<?php require('Top.inc.php') ?>
<main class="dashboard-card">
        <!--========== HOME ==========-->
        <section class="dashboard-container">
          <div class="card">
              <div class="card-flex"><span>20K</span><i class="fi-rr-disk"></i></span></div>
              <p>Order</p>
          </div>

          <div class="card">
            <div class="card-flex"><span>20K</span><i class="fi-rr-disk"></i></span></div>
            <p>Customer</p>
         </div>

         <div class="card">
            <div class="card-flex"><span>20K</span><i class="fi-rr-disk"></i></span></div>
            <p>Employee</p>
         </div>
        </section>
    </main>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="./js/main.js"></script>
  <script>
     var href = window.location.href
     
     var active = getUrl(href,'/',"last")
     var link = getUrl(active,'.',"first")

    
     function getUrl(url,symble,index){
        var splitUrl = url.split(symble)
        if(index==="last")  return splitUrl[splitUrl.length-1]
        if(index==="first") return splitUrl[0] 
     }
    
    
    document.querySelectorAll('.url').forEach(function(ele,index){
      
   if(getUrl(ele.getAttribute('href'),'.',"first")==link){
     ele.classList.add('active')
   }
    })
    
  </script>
</body>
</html>