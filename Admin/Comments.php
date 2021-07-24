<?php require('Top.inc.php') ?>
      <main class="main-table">
        <!--========== HOME ==========-->
        <section class="table-container">
            <div>
               <h3>Dish Detail</h3>
             <div class="btn-group">
                 <a href="#">Dish</a>
                 <a href="Manage.category.php">+Add</a>
             </div>  
<table id="customers">
    <tr>
      <th>Name</th>
      <th>Category</th>
      <th>Status</th>
      <th>Action</th>
      
    </tr>
    <tr>
      <td>Alfreds Futterkiste</td>
      <td>Germany</td>
     
      <td>
          <a class="btn" href="?type=Deactive&id=">Active</a>
      </td>
      <td>
        <a class="btn" href="?type=Edite&id=">Edit</a>
        <a class="btn" href="?type=Delete&id=">Delete</a>
      </td>
    </tr>

    <tr>
        <td>Alfreds Futterkiste</td>
        <td>Maria Anders</td>
        <td>
            <a class="btn" href="?type=Deactive&id=">Active</a>
        </td>
        <td>
          <a class="btn" href="?type=Edite&id=">Edit</a>
          <a class="btn" href="?type=Delete&id=">Delete</a>
        </td>
      </tr>
 
      
  </table>
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