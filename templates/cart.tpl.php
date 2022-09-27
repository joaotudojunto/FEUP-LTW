<?php function drawCart() {?>

<link rel="stylesheet" href="../css/cart.css">
  
<html>
<div class="body">

    <div class="cart-page">
    <table>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
            <tr>
                <td><div class ="cart-info">
                    <img src="../images/cheese.png"> 
                    <div>
                        <p>Double Cheese</p>
                        <small>Price: 12.60€</small>
                        <br> 
                        <a href="">Remove</a>
                    </div>  
                </div>
            </td>
                <td><input type="number" value ="1"></td>
                <td>12.60€</td>
            </tr>
            
            <tr>
                <td><div class ="cart-info">
                    <img src="../images/francesinha.jpg"> 
                    <div>
                        <p>Francesinha</p>
                        <small>Price: 13.50€</small>
                        <br>
                        <a href="">Remove</a>
                    </div>  
                </div>
            </td>
                <td><input type="number" value ="1"></td>
                <td>13.50€</td>
            </tr>

            <tr>
                <td><div class ="cart-info">
                    <img src="../images/cheese.png"> 
                    <div>
                        <p>Double Cheese</p>
                        <small>Price: 12.60€</small>
                        <br>
                        <a href="">Remove</a>
                    </div>  
                </div>
            </td>
                <td><input type="number" value ="1"></td>
                <td>12.60€</td>
            </tr>

            <tr>
                <td><div class ="cart-info">
                    <img src="../images/wrap.png"> 
                    <div>
                        <p>Chicken Wrap</p>
                        <small>Price: 5.20€</small>
                        <br> 
                        <a href="">Remove</a>
                    </div>  
                </div>
            </td>
                <td><input type="number" value ="1"></td>
                <td>5.20€</td>
            </tr>
    
    </table>

<div class="total-price">
    <table> 
        <tr>
            <td>Delivery Fee</td>
            <td>5€</td>
        </tr>
        <tr>
            <td>VAT</td>
            <td>23%</td>
           
        </tr>
        <tr>
            <td>Total</td>
            <td><h3>38.7€</h3></td> 
            <br>
        </tr>      
    </div>
</table>  

</div>

</div>

<form action="checkout.php">
    <INPUT class="button1" TYPE="submit" value="Confirm and Checkout"> 
</form>

</html>



<?php } ?>