window.onload = initPage; // When the page loads it runs a second function that then runs the required functions.

function initPage() { // The first function it calls enables the add 
  showhidediv();      // products and categories div to appear and hide on click.
  getProducts();      // The second calls the function to show all products inserted into the database.
  eventHandler();     // Finally the last one calls the event handler.             
}

function eventHandler() {
  // Set up the submit event handler for the new product and new category form.
  document.getElementById("psubmit").addEventListener( "click", insertProduct );
  document.getElementById("pupdate").addEventListener( "click", updateProduct );
  document.getElementById("csubmit").addEventListener( "click", insertCategory );
  // Selects the admin menu div and loops through the images within it and 
  // adds an event listener to all delete icons for the corresponding category.
  var cmsMenu = document.getElementById("cmsmenu");
  catDelIcon = cmsMenu.getElementsByTagName("img");
  catDelIconLen = catDelIcon.length;
  for (i=0; i < catDelIconLen; i++){
    catDelIcon[i].addEventListener( "click", deleteCategory );
  }
}

// Function is called by init page.
function showhidediv(one, two) {
  // An event listener is added to the button '+ Add New Product'. When the button is clicked the function calls a secondary 
  // function called 'swap' that takes 2 parameters and sets one to display:block and the other to display:none. 
  document.getElementById('newproduct').addEventListener('click',function(showhidediv){
    swap('addproducts','addcategory');
  });
  // Identical to previous line although the event listener is looking at the '+ Add Categories' div.
  document.getElementById('newcategory').addEventListener('click',function(showhidediv){
    swap('addcategory','addproducts');
  });
}
// This is the function that shows and hides the two divs.
function swap(one, two) {
  document.getElementById(one).style.display = 'block';
  document.getElementById(two).style.display = 'none';
}



// This function is called by the event listener when a new product is submitted
insertProduct = function() {
  // Selects the add products form
  var prodForm = document.getElementById("addproductform");
  // var progress = document.getElementById("fileprogress"); Used to implement a progress feedback of image upload
  // Sets up a json request to the addproducts php file
  var request = new XMLHttpRequest();
  request.open("POST", "../api/addproducts.php", true);
  // Once the request is loaded this function gets the response from the php and display a feedback alert to the user
  request.onload = function() {
    if (this.readyState == 4){
      if (this.status == 200) {
        var res = JSON.parse(this.response);
        alert(res.details);
      }
    }
  }
  // The request is sent with the FormData from the add products form
  request.send(new FormData(prodForm));
  // The fields within the form are reset
  prodForm.reset();
  // Calls the getProducts function to display the newly added product after a period of 200ms
  //setTimeout(refresh, 200);
}


insertCategory = function() {
  // Selects the add categories form
  var catForm = document.getElementById("addcategoryform");
  // Sets up a JSON request to the addcategories php file
  var request = new XMLHttpRequest();
  request.open("POST", "../api/addcategory.php", true);
  // Once the request is loaded this function gets the response from the php and display a feedback alert to the user
  request.onload = function() {
    if (this.readyState == 4){
      if (this.status == 200) {
        var res = JSON.parse(this.response);
        // An alert takes the response from the json request which contains either a success or failure.
        alert(res.details);
        // The page is reloaded to show the updated categories
        setTimeout(refresh, 200);
      }
    }
  }
  // The request is sent with the FormData from the add categories form
  request.send(new FormData(catForm));
  // All fields within the form are reset
  catForm.reset();
}

// This function just reloads the page
refresh = function(){
  location.reload();
}

// XHR function takes an array (parameter p), and sets up and send a request.
xhr = function (p){
  var i, payload, xhr = new XMLHttpRequest();
  // The array contains a "method" and "url" which are then used as the 
  // method (e.g. GET) and url (e.g. ../api/addproducts.php) of the request.
  xhr.open(p.method, p.url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
  // After a response has been received from the request it calls the function displayProducts.
  xhr.onreadystatechange = displayProducts;
  xhr.send(null);
}

// This function is called at page load and it gets the parameter at the end of the url as set by the category filters.
function getProducts() {
  var urlExt = location.search.split('filter=')[1];
  var url= "../api/productList.php?filter="+urlExt;
  xhr(
  {
    "method": "GET",
    "url": url
  }
  );
}

// This is the function that is called after the request is completed.
function displayProducts(e) {
  // First it checks if the request is ready and no errors occured.
  if (e.target.readyState == 4) {
    if (e.target.status == 200) {
      // The JSON response is placed in a variable and then parsed by JS.
      list = e.target.responseText;
      parsd = JSON.parse(list);
      // The result is an array called "Products".
      products = parsd.Products;
      // A for loop loops through the array creating a li element of the product, 
      // containing the name, image and and edit link and delete icon.
      for (var i = 0; i < products.length; i++) {
        var ele = document.createElement("li");
        var p = document.createElement("p");
        edit = document.createElement("img");
        var del = document.createElement("img");
        p.appendChild(edit);
        p.appendChild(del);
        edit.src = "../lib/style/images/editicon.png";
        edit.id = products[i].id;
        edit.addEventListener("click", editProduct);
        edit.style.width = '12px';
        del.src = "../lib/style/images/deleteicon.png";
        del.id = products[i].id;
        del.addEventListener("click", deleteProduct);
        del.style.width = '18px';
        var img = document.createElement("img");
        img.src = "../assets/images/products/thumbs/"+products[i].id+".jpg";
        img.style.width = '15em';
        var name = document.createElement("p");
        var textNode = document.createTextNode(products[i].name)
        name.appendChild(textNode);
        var ul= document.getElementById('productlist');
        ulli = ul.appendChild(ele);
        ulli.style.cssText = 'display:inline-block;list-style:none;vertical-align:top;text-align:center;';  
        ulli.appendChild(p);
        ulli.appendChild(img);
        ulli.appendChild(name);
      }
    }    
  }
}


// This function is called when the event handler is fired
deleteCategory = function(){
  // It takes the 'id' from the delete image when the click event is fired.
  catindex = this.id;
  // A confirm dialog box is used to confirm the delete of the category.
  var con = confirm("Are you sure you want to delete this category?");
  if (con ==  true) {
    // If the user clicks 'ok', the 'id' is appended to a string which is sent to the php file.
    categoryID = "id="+catindex; 
    // A new json request is made.
    request = new XMLHttpRequest();
    if (request == null) {
      alert("Unable to create request");
      return;
    }
    // The url of the delete category php file is stored in a variable
    var urldel= "../api/deletecat.php";
    // The request is opened with a POST method and the url as previously set.
    request.open("POST", urldel, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.setRequestHeader("Content-length", categoryID.length);
    request.setRequestHeader("Connection", "close");
    // The request is sent with the category index as a parameter.
    request.send(categoryID);
    // An alert is displayed  informing the user of the deleted category.
    alert("Category Deleted.");
    // The page is then refreshed to show the removed category
    setTimeout(refresh, 100);
  }
  else {
    console.log("Action cancelled.");
  }
}

// Pretty much identical to the previous function but the event handler is fired when the delete icon
// next to the products is clicked.
deleteProduct = function(){
  prodindex = this.id;
  var conf = confirm("Are you sure you want to delete this product?");
  if (conf ==  true) {
    productID = "id="+prodindex; 
    request = new XMLHttpRequest();
    if (request == null) {
      alert("Unable to create request");
      return;
    }
    var urldel= "../api/deleteprod.php";
    request.open("POST", urldel, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.setRequestHeader("Content-length", productID.length);
    request.setRequestHeader("Connection", "close");
    request.send(productID);
    alert("Product Deleted.");
    setTimeout(refresh, 100);
  }
  else {
    console.log("Action cancelled.");
  }
}

editProduct = function(){
  prodEditindex = this.id;
  form = document.getElementById('addproducts');
  form.style.display = 'block';
  add = document.getElementById('psubmit');
  add.style.display = 'none';
  update = document.getElementById('pupdate');
  update.style.display = 'block';
  request = new XMLHttpRequest();
  if (request == null) {
    alert("Unable to create request");
    return;
  }
  var urla= "../api/getDetails.php?ProductID=" + escape(prodEditindex);
  request.open("GET", urla, true);
  request.onreadystatechange = function(){
    response = request.responseText; 
    parsed = JSON.parse(response);
    product = parsed.Product;
    document.getElementById('product_id').value = product[0].id;
    document.getElementById('product_name').value = product[0].name;
    document.getElementById('price').value = product[0].price;
    document.getElementById('description').value = product[0].description;
    document.getElementById('category').value = product[0].category;
    document.getElementById('sub_category').value = product[0].subcategory;
  };
  request.send(null);
}

updateProduct = function() {
  // Selects the add products form
  var prodForm = document.getElementById("addproductform");
  var request = new XMLHttpRequest();
  request.open("POST", "../api/addproducts.php", true);
  // Once the request is loaded this function gets the response from the php and display a feedback alert to the user
  request.onload = function() {
    if (this.readyState == 4){
      if (this.status == 200) {
        var res = JSON.parse(this.response);
        alert(res.details);
      }
    }
  }
  // The request is sent with the FormData from the add products form
  request.send(new FormData(prodForm));
  // The fields within the form are reset
  prodForm.reset();
  // Calls the getProducts function to display the newly added product after a period of 200ms
  //setTimeout(refresh, 200);
}

