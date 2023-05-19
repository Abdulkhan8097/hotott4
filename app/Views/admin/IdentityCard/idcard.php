<!DOCTYPE html>    
<html>     
<head>    
<title>    
      
</title> 
<style>
    .container {
  position: relative;
  text-align: center;
  color: black;
}

.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>   
</head>    
<body>  
    <div class="container">
      <img src="http://165.22.219.135/hotott1/public/idcard.png" alt="Snow" style="width:40%; margin-top: 65%;"></th>
                  
              
        <div class="centered">
        
            <table style="margin-top: -10%;">
            
                <tr>
                  <th colspan="2"><img src="http://165.22.219.135/hotott1/public/admin/images/logo.jpeg" alt="Snow" width="20%">
                <br>Hotott Entertainment Pvt Ltd
              </th>
                  
                </tr>
                <br>
                <tr>
                    <th colspan="2"><img src="http://165.22.219.135/hotott1/public/frame.png" alt="Snow" width="20%"></th>
                    
                  </tr>
                
              </table>
<br>
              <table width="60%" style="margin-left: 20%;
              font-size: 14px;
              text-align: left;
              line-height: 18px;
              font-weight: 100;">
                <tr>
                    <td>Sponser id</td>
                    <td>:- <?php echo $list['username']; ?></td>
                    
                   
                  </tr>
                  <tr>
                    <td>Name</td>
                    <td>:- <?php echo $list['name']; ?></td>
                   </tr>
                   <tr>
                    <td>Mobile No.</td>
                    <td>:- <?php echo $list['mobile']; ?></td>
                   </tr>
                  <tr>
                    <td>Designation</td>
                    <td>:-Marketing Partner</td>
                   </tr>
                   
                  
                  
              </table>
        
        </div>
      </div> 
</body>    
</html>  