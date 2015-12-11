window.onload = initPage;
var _urlfilter;
var g_openDiv;
// Called by a click on the image of the product
var imageHandler = function handleImage(evt) {
  // takes the parameter set (product id) by the display products function and sets a new variable
  imageId = evt.target.myParam;
  // large image loaded using the previous variable 
  document.getElementById("detailImg").src = "../assets/images/products"+imageId+".jpg";
  // hides the products grid and displays the new details div 
  document.getElementById("products").style.display = "none";
  document.getElementById("details").style.display = "block";
  // calls the function that gets detailed information about the product such as a description and add to basket
  getDetails(imageId);

}

// function loaded by the page initialisation 
function initPage() {
  getProducts();
  showBasket();
}

// called on page load 
function getProducts() {
  // sets a new parameter using the parameter at the end of the url.
  var urlparam = location.search.split('filter=')[1];
  // creates a new request
  request = new XMLHttpRequest();
  if (request == null) {
    alert("Unable to create request");
    return;
  }
  // the url of the request contains the ID parameter used by the php file
  var url= "api/productList.php?filter="+urlparam;
  // the method is set to get and url from previous line.
  request.open("GET", url, true);
  // when request is completed the function display products is called.
  request.onreadystatechange = displayProducts;
  request.send(null);
}


function displayProducts() {
  // checks the integrity of the response using if statements
  if (request.readyState == 4) {
    if (request.status == 200) {
      // variables created using the responseText from the request and parsed using a Javascript method
      list = request.responseText;
      parsd = JSON.parse(list);
      products = parsd.Products;
      // for loop loops through the produces array
      for (var i = 0; i < products.length; i++) {
        // creates the html structure and places the various parameters and replys from server to create a dynamic grid
        var ele = document.createElement("li");
        var img = document.createElement("img");
        img.src = "assets/images/products/"+products[i].id+".jpg";
        img.addEventListener('click', imageHandler, false);
        img.myParam = products[i].id;
        img.style.cssText = 'width:15em;'
        var name = document.createElement("h4");
        name.innerHTML = products[i].name;
        var price = document.createElement("p");
        var textNode1 = document.createTextNode("£"+products[i].price);
        price.appendChild(textNode1);   
        var ul = document.getElementById('products');
        ulli = ul.appendChild(ele);
        ulli.style.cssText = 'width:250px;display:inline-block;list-style:none;vertical-align:top;padding:1em;text-align:center;';      
        ulli.appendChild(img);
        ulli.appendChild(name);
        ulli.appendChild(price);
        // removes empty text nodes and tidies up DOM tree 
        ulli.normalize();
      }
    }    
  }
}

function displayDetails() {
  if (request.readyState == 4) {
    if (request.status == 200) {
      response = request.responseText; 
      parsed = JSON.parse(response);
      product = parsed.Product;
      var title = document.createElement("h2");
      title.innerHTML = product[0].name;
      title.id = "title";
      var img = document.createElement("img");
      img.src = "assets/images/products/"+product[0].id+".jpg";
      var price = document.createElement("h4");
      price.innerHTML = "Price: £"+product[0].price;
      addtobask = document.createElement("button");
      addtobask.innerHTML = "+ Add to Basket";
      addtobask.value = product[0].id;
      addtobask.id = "tobasket";
      desc = document.createElement("p");
      desc.id = "description";
      desc.innerHTML = "<h4>Description:</h4>" +product[0].description;
      prod = document.getElementById("details");
      prod.appendChild(img);
      prod.appendChild(title);
      prod.appendChild(price);
      prod.appendChild(desc);
      prod.appendChild(addtobask);
      jsontoBasket();
    }
  }    
}

function jsontoBasket(){
  button = document.getElementById("tobasket");
  button.addEventListener("click", function(){
   request = new XMLHttpRequest();
   if (request == null) {
    alert("Unable to create request");
    return;
  }
  var urla= "api/basket.php?ProductID=" + escape(button.value);
  request.open("GET", urla, true);
  request.onreadystatechange = requestHandle;
  request.send(null);
}, false);

}

function getDetails(itemName) {
  request = new XMLHttpRequest();
  if (request == null) {
    alert("Unable to create request");
    return;
  }
  var urla= "api/getDetails.php?ProductID=" + escape(itemName);
  request.open("GET", urla, true);
  request.onreadystatechange = displayDetails;
  request.send(null);
}

function requestHandle(){
  if(request.readyState == 4){
    if(request.status == 200){
      response = request.responseText;
      parsed = JSON.parse(response);
      product = parsed.Product;
      id = product[0].id;
      name = product[0].name;
      price = product[0].price;
      quant = 1;
      AddToBasket(name, price, quant, id);
    }
  }
}

// BASKET
function AddToBasket(prodName, price, quantity, id)
{
  var cookieContents = getBasketCookie()
  var NewCookieValue = '';
  //  if the cookie is empty it simply adds the product
  if(cookieContents == ''){
    setBasketCookie(prodName + "|" + price + "|" + quantity + "|" + id);
  }
  else  //  if the basket has products
  {
    //  checks if the product is already in the basket
    if(cookieContents.indexOf(prodName) != -1){
      //  product is already in the basket it loops through and updates the quantity
      var basketString = cookieContents.split("|"); // Gets the content of the cookie using the getBacketCookie function and splits it at the divider
      for(var i = 0; i < basketString.length; i = i+3){
        //  Finds the product from the basket string and adds to the quantity
        if(basketString[i] == prodName){
          basketString[i+2] = Number(basketString[i+2]) + Number(quantity);
          i = basketString.length;
        }
      }
      //  loops through the products again and rebuilds the basket with the updated quantity
      for(var i = 0; i < basketString.length; i = i+3){
        if(i == 0){ // Different for the first product in the category as there is no initial divider (|)
          NewCookieValue  += basketString[i] + "|" + 
          basketString[i+1] + "|" + basketString[i+2];
        }
        else
          NewCookieValue  += "|" + basketString[i] + 
        "|" + basketString[i+1] + "|" + basketString[i+2];
      }
      //  sets the cookie value to the new updated basket
      setBasketCookie(NewCookieValue);
    }
    else  // product is not already in the basket so it just adds it to the end of the string and saves it to the cookie
      setBasketCookie(getBasketCookie() + "|" + prodName + 
        "|" + price + "|" + quantity + "|" + id);
  }
  window.alert("The product: "+prodName+" \n \nHas been added to your basket");
  window.location.reload(false);
}

function getBasketCookie(){
var name = "basket="; // Takes the name of the cookie
//console.log(document.cookie);
var ca = document.cookie.split(';'); // splits the cookie at the end to remove the ';'
for(var i=0; i<ca.length; i++){
  var c = ca[i].trim();
  //console.log(c);
  if (c.indexOf(name)==0) return c.substring(name.length,c.length);
}
return "";
} 

function setBasketCookie(cookieValue)
{
  document.cookie = "basket=" + cookieValue;
}

function showBasket() {
  bask = document.getElementById("basket"); // selects the div where the basket is
  //  If basket contains no products echo to the basket div.
  if(getBasketCookie() == ''){
    noitem = document.createElement("p");
    noitem.innerHTML = "No Items in Basket";
    bask.appendChild(noitem);
  }
  else{
    var basketString = getBasketCookie().split("|");
    for (i=0; i<basketString.length; i=i+4){
    pname = document.createElement("p");
    pname.innerHTML = " &nbsp"+basketString[i];
    pprice = document.createElement("p");
    pprice.innerHTML = basketString[i+1];
    pquant = document.createElement("p");
    pquant.innerHTML = basketString[i+2]+"<br>";
    pdelete = document.createElement("img");
    pdelete.src = "lib/style/images/deleteicon.png";
    pdelete.style.width = "12px";
    pdelete.myParam = basketString[i];
    pdelete.addEventListener("click", deletefrmBask);
    pid = document.createElement("p");
    pid.style.display = 'none';
    pid.innerHTML = basketString[i+3];
    bask.appendChild(pdelete);
    bask.appendChild(pname);
    bask.appendChild(pprice);
    bask.appendChild(pquant);
    bask.appendChild(pid);
  }
  ids = pid.innerHTML;
  checkout = document.createElement("button");
  checkout.innerHTML = "Checkout";
  checkout.id = "checkoutButton";
 // checkout.addEventListener("click", checkOut); Currently not implemented.
  bask.appendChild(checkout);
}
}

function deletefrmBask(evt){
  console.log(evt.target.myParam);
  prod2Delete = evt.target.myParam; 
  var cookieContents = getBasketCookie()
  var NewCookieValue = '';
    if(cookieContents.indexOf(prod2Delete) != -1){ // checks if the product is in the basket
      var basketString = getBasketCookie().split("|"); // Gets the content of the cookie using the getBacketCookie function and splits it at the divider
      for(var i = 0; i < basketString.length; i = i+4){
        //  Finds the product from the basket string and adds to the quantity
        if(basketString[i] == prod2Delete){
          basketString.splice(i, 4);
          break; 
        }
      }
      //  loops through the products again and rebuilds the basket with the updated quantity
      for(var i = 0; i < basketString.length; i = i+4){
        if(i == 0){ // Different for the first product in the category as there is no initial divider (|)
          NewCookieValue  += basketString[i] + "|" + 
          basketString[i+1] + "|" + basketString[i+2] + "|" + basketString[i+4];
        }
        else
          NewCookieValue  += "|" + basketString[i] + 
        "|" + basketString[i+1] + "|" + basketString[i+2] + "|" + basketString[i+3];
      }
      //  sets the cookie value to the new updated basket
      setBasketCookie(NewCookieValue);
    }
    window.alert('The product: '+prod2Delete+' \n \nHas been removed from your basket')
    window.location.reload(false);
}

/*function checkOut(){
  document.getElementById("products").style.display = "none";
  document.getElementById("checkout").style.display = "block";
  document.getElementById("userForm").style.display = "block";
  check = document.getElementById("checkout");
  var cookieContents = getBasketCookie()
  var basketString = getBasketCookie().split("|");
  for(var i = 0; i < basketString.length; i = i+4){
    check.innerHTML = basketString[i+3];
  }
}*/


