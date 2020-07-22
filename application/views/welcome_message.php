<!DOCTYPE html>
<html lang="en">
<button class="btn btn-info" title="Click to show/hide content" type="button" onclick="if(document.getElementById('map_one') .style.display=='none') {document.getElementById('map_one') .style.display=''}else{document.getElementById('map_one') .style.display='none'}">Peta ODP Local</button>
        <button class="btn btn-success" title="Click to show/hide content" type="button" onclick="if(document.getElementById('map_two') .style.display=='none') {document.getElementById('map_two') .style.display=''}else{document.getElementById('map_two') .style.display='none'}">Peta ODP Starclick</button>    
          </div>  
        </div>
            <div>
                    <br>
                    
                    <div id="map_one" style="display:none">
                        <div class='box-header'>
                    <h3 class='box-title'>Peta Distribusi Data</h3>
                    <br> 
                    <head>
    <?php echo $map_one['js']; ?>
</head>  
            <body>
               <div>
                
               </div>
<?php echo $map_one['html']; ?>
  <!-- TODO 1: Create a place to put the map in the HTML -->

<br>
</body>
                    </div> 

        
                    
                  </div>    
                  </div>
<!--                  -->
                  <div>
                    <br>
                    
                    <div id="map_two" style="display:none">
                        <div class='box-header'>
                    <h3 class='box-title'>Peta Distribusi Data</h3>
                    <br> 
                    <head>
    <?php echo $map_two['js']; ?>
</head>  
            <body>
               <div>
                
               </div>
<?php echo $map_two['html']; ?>
  

<br>
</body>
                    </div> 

        
                    
                  </div>    
                  </div>
</html>



