window.onload = initPage;
var _urlfilter;
var imageHandler = function handleImage(evt) {
  imageId = evt.target.myParam;
  document.getElementById("detailImg").src = "assets/images/products"+imageId+".jpg";
  document.getElementById("content").className = "hidden";
  document.getElementById("details").className = "visible";
  getDetails(imageId);

}

function initPage() {
  getFilter();
  getProducts();
}


function getProducts() {
  var url1 = _urlfilter;
  request = new XMLHttpRequest();
  if (request == null) {
    alert("Unable to create request");
    return;
  }
  var url= "api/productList.php?filter="+url1;
  request.open("GET", url, true);
  request.onreadystatechange = displayProducts;
  request.send(null);
}

function getFilter(){
  url = getQueryVariable('filter');
  _urlfilter = url;


}

// http://css-tricks.com/snippets/javascript/get-url-variables/
function getQueryVariable(variable)
{
 var query = window.location.search.substring(1);
 var vars = query.split("&");
 for (var i=0;i<vars.length;i++) {
   var pair = vars[i].split("=");
   if(pair[0] == variable){return pair[1];}
 }
 return(false);
}

function displayProducts() {
  if (request.readyState == 4) {
    if (request.status == 200) {
      list = request.responseText;
      parsd = JSON.parse(list);
      products = parsd.Products;
      for (var i = 0; i < products.length; i++) {
        var ele = document.createElement("li");
        var img = document.createElement("img");
        img.src = "assets/images/products/"+products[i].id+".jpg";
        img.addEventListener('click', imageHandler, false);
        img.myParam = products[i].id;
        img.style.cssText = 'width:15em;'
        var name = document.createElement("h4");
        var textNode = document.createTextNode(products[i].name)
        name.appendChild(textNode);
        var price = document.createElement("p");
        var textNode1 = document.createTextNode("£"+products[i].price);
        price.appendChild(textNode1);   
        var x = document.getElementsByClassName('products');
        var ul = x[0];
        ulli = ul.appendChild(ele);
        ulli.style.cssText = 'width:250px;display:inline-block;list-style:none;vertical-align:top;padding:1em;text-align:center;';  
        
        ulli.appendChild(img);
        ulli.appendChild(name);
        ulli.appendChild(price);
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
      var titletext = document.createTextNode(product[0].name);
      title.appendChild(titletext);
      var img = document.createElement("img");
      img.src = "assets/images/products/"+product[0].id+".jpg";
      var price = document.createElement("h3");
      var textNode1 = document.createTextNode("£"+product[0].price);
      price.appendChild(textNode1);   
      prod = document.getElementById("details");
      prod.appendChild(title);
      prod.appendChild(img);
      prod.appendChild(price);
    }
  }    
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

