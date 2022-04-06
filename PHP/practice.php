<html>
  <body>
  <form action = "" method = "POST" enctype = "multipart/form-data">
     <input type = "file" name = "image" />
     <input type = "submit" name="submit" value="submit"/>
      
     <ul>
        
        <li>Sent file:  echo $_FILES['image']['name'];  
        <li>File size:  echo $_FILES['image']['size'];  
        <li>File type:  echo $_FILES['image']['type'] 
        <li><img src=" echo 'uploaded image/'.$file_name; "> 
     </ul>
     </form>
      <?php
            if(isset($_POST['submit'])){
                require 'database_connection.php';
                $sql = "SELECT * FROM user";
                $res = mysqli_query($conn,$sql);
                echo "<table>";
                echo "<tr>";
                
                while($row=mysqli_fetch_array($res))
                {
                echo "<td>"; 
                echo '<img src="data:image/jpeg;base64,'.base64_encode($row['imag'] ).'" height="200" width="200"/>';
                echo "<br>";
                echo "</td>";
            }
            echo "</tr>";
   
            echo "</table>";
           }
     ?>
 
      </body> 
      </html>