<?php
$file = "edit_fish_prices.php";
$title = "Sushi Bai Kiyoshi - Edit Fish Prices";
$banner = "Sushi Bai Kiyoshi - Edit Fish Prices";
$description = "This page is where the administrator is able to add fish price information";
$date = "20/03/2014";

require 'header.php';


/*
if (!isset($_SESSION['id'])) // Non administrators to be sent back to index
{
    $_SESSION['message'] = "You must login into access this page.";
    header('Location:./index.php');
}

if ($_SESSION['UserType'] != 'a') // If not an administrator redirect to main page
{
    $_SESSION['message'] = "You are not authorized to access this page.";
    header('Location:./index.php');
}
*/


//if (isset($_POST['submit']) alternate way
if($_SERVER["REQUEST_METHOD"] == "POST") // If the page has been submitted
{      
    // Clear out the forms
    $type = "";
    $date = "";
    $location = "";
    $supplyStatus = "";
    $price = "";
    
    // Trim the inputs
    $type = trim ($_POST ["type"]); 
    $date = trim ($_POST ["date"]); 
    $location = trim ($_POST ["location"]); 
    $supplyStatus = trim ($_POST ["supplyStatus"]); 
     $price = trim ($_POST ["price"]); 
  
    $sql = "INSERT INTO \"tblFishMarket\"(\"Type\", \"Date\", \"Price\", \"Location\", \"SupplyStatus\")
            VALUES ('$type', '$date', '$price', '$location' , '$supplyStatus')";

    // connect to the database
    //$conn = db_connect();
    
   
    $conn = pg_connect("host=localhost port=5432 dbname=sb user=postgres password=vdragon");
    //issue the query       
    $result = pg_query($conn, $sql);
      
    echo '<p class="t_c">';
      
    if (!$result)
    {
        echo "An error occurred"; 
    }
    else
    {
        echo "Pricing added!";
        
    }
    echo '</p>';
   }
?>
        <section id="MainContent">   
 <a href="./admin.php">Back</a>        
        <br/>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
             <table class="center">
                <th colspan="2" class="t_c">
                Add Fish Price Information
                </th>
                <tr>
                    <td>
                    Type
                    </td>
                    <td>
                    <input type="textbox"/ name="type">
                    </td> 
                </tr>
                <tr>
                    <td>
                    Date
                    </td>
                    <td>
                    <input type="date"/ name="date" value="<?php echo date('Y-m-d'); ?>">
                    </td> 
                </tr>
                 <tr>
                    <td>
                    Price
                    </td>
                    <td>
                    <input type="number"/ name="price">
                    </td> 
                </tr>
                <tr>
                    <td>
                    Location
                    </td>
                    <td>
                    <input type="textbox"/ name="location">
                    </td> 
                </tr>
                <tr>
                  <td>
                    Supply Status
                    </td>
                    <td>
                    <select name="supplyStatus">
                        <option value="l" >Low</option>
                        <option value="m" >Medium</option>
                        <option value="h">High</option>                        
                    </select>
                    </td> 
                </tr>
                  <tr>
                <td colspan="2" style="text-align:center;">
                    <br/>
                    <input type="submit" name="submit" value="Enter Pricing"/>
                    
                </td>
            </tr>
            </table>
            
            </form>
        </section>
            
<?php include 'footer.php'; ?>