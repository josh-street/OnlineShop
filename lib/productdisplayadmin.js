window.onload = initPage;
var _urlfilter;

function initPage() {
  showhidediv();
  getProducts();
  eventHandler();
}

function eventHandler() {
  // Set up the "submit to add an entry" event handler
  document.getElementById("psubmit").addEventListener( "click", insertProduct );
  document.getElementById("csubmit").addEventListener( "click", insertCategory );
  var menu = document.getElementById("adminmenu");
  images = menu.getElementsByTagName("img");
  imlen = images.length;
  for (i=0; i < imlen; i++){
    images[i].addEventListener( "click", deleteCategory );
  }
  delimg = document.getElementById("productlist");
  deleteimage = delimg.getElementsByTagName("img");
  dellen = deleteimage.length;
  for (v=0; v < dellen; v++){
    delimg[v].addEventListener( "click", deleteProduct, false);
  }
}


insertProduct = function() {
  var form = document.getElementById("addproductform");
  var progress = document.getElementById("fileprogress");
  var request = new XMLHttpRequest();
  request.open("POST", "../api/addproducts.php", true);
  request.onload = function() {
    if (this.readyState == 4){
      if (this.status == 200) {
        var res = JSON.parse(this.response);
        alert(res.details);
      }
    }
  }
  request.send(new FormData(form));
  form.reset();
}


insertCategory = function() {
  var form = document.getElementById("addcategoryform");
  var request = new XMLHttpRequest();
  request.open("POST", "../api/addcategory.php", true);
  request.onload = function() {
    if (this.readyState == 4){
      if (this.status == 200) {
        var res = JSON.parse(this.response);
        alert(res.details);
      }
    }
  }
  request.send(new FormData(form));
  form.reset();
  setTimeout(refresh, 200);
}

refresh = function(){
  location.reload();
}

xhr = function (p){
  var i, payload, xhr = new XMLHttpRequest();
  xhr.open(p.method, p.url, true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
  xhr.onreadystatechange = displayProducts;
  xhr.send(null);
}


function getProducts() {
  var url1 = getFilter('filter');
  var url= "../api/productList.php?filter="+url1;
  xhr(
  {
    "method": "GET",
    "url": url
  }
  );
}


function getFilter(x)
{
 var query = window.location.search.substring(1);
 var vars = query.split("&");
 for (var i=0;i<vars.length;i++) {
   var pair = vars[i].split("=");
   if(pair[0] == x){return pair[1];}
 }
 return(false);
}

function displayProducts(e) {
  if (e.target.readyState == 4) {
    if (e.target.status == 200) {
      list = e.target.responseText;
      parsd = JSON.parse(list);
      products = parsd.Products;
      for (var i = 0; i < products.length; i++) {
        var ele = document.createElement("li");
        var p = document.createElement("p");
        edit = document.createElement("a");
        var del = document.createElement("img");
        p.appendChild(edit);
        p.appendChild(del);
        edit.href = "index.php?editid="+products[i].id;
        edit.innerHTML = "Edit ";
        del.src = "../lib/style/images/deleteicon.png";
        del.id = products[i].id
        del.name = "delete";
        del.style.cssText = 'width:12px;margin-bottom:-2px;';
        var img = document.createElement("img");
        img.src = "../assets/images/products/thumbs/"+products[i].id+".jpg";
        //img.myParam = products[i].id;
        img.style.cssText = 'width:15em;'
        var name = document.createElement("p");
        var textNode = document.createTextNode(products[i].name)
        name.appendChild(textNode);
        var price = document.createElement("p");
        var textNode1 = document.createTextNode("£"+products[i].price);
        price.appendChild(textNode1);   
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

function showhidediv(one, two) {
  document.getElementById('newproduct').addEventListener('click',function(showhidediv){
    swap('addproducts','addcategory');
  });
  document.getElementById('newcategory').addEventListener('click',function(showhidediv){
    swap('addcategory','addproducts');
  });
}

function swap(one, two) {
  document.getElementById(one).style.display = 'block';
  document.getElementById(two).style.display = 'none';
}


deleteCategory = function(){
  catindex = this.id;
  var con = confirm("Are you sure you want to delete this category?");
  if (con ==  true) {
    categoryID = "id="+catindex; 
    request = new XMLHttpRequest();
    if (request == null) {
      alert("Unable to create request");
      return;
    }
    var urldel= "../api/deletecat.php";
    request.open("POST", urldel, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.setRequestHeader("Content-length", categoryID.length);
    request.setRequestHeader("Connection", "close");
    request.send(categoryID);
    setTimeout(refresh, 100);
    alert("Category Deleted.");
  }
  else {
    console.log("Action cancelled.");
  }
}

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
    setTimeout(refresh, 100);
    alert("Product Deleted.");
  }
  else {
    console.log("Action cancelled.");
  }
}

