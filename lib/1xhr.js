window.onload = initPage;
function initPage() {
  // find products on page
  thumbs = document.getElementById("content").getElementsByTagName('img');
  // set a handler for each image
  for (var i=0; i<thumbs.length; i++) {
    image = thumbs[i];
    // onclick function to handle click on the image
    image.onclick = function() {
      // find the image 
      imgURL = 'assets/images/products/'+ this.title + '.jpg';
      document.getElementById("detailImg").src = imgURL;
      document.getElementById("content").className = "hidden";
      document.getElementById("details").className = "visible";
      getDetails(this.title);
    }
  }
}

function getDetails(itemName) {
  request = new XMLHttpRequest();
  if (request == null) {
    alert("Unable to create request");
    return;
  }
  var url= "api/getDetails.php?ProductID=" + escape(itemName);
  request.open("GET", url, true);
  request.onreadystatechange = displayDetails;
  request.send(null);
}

function displayDetails() {
  if (request.readyState == 4) {
    if (request.status == 200) {
      decoded = JSON.parse(request.responseText)
      console.log(decoded)
    }
  }
}
