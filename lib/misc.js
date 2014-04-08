function divshowhide(one, two) {
document.getElementById('newproduct').addEventListener('click',function(divshowhide){
    swap('addproducts','addcategories');
});
document.getElementById('newcategory').addEventListener('click',function(divshowhide){
    swap('addcategories','addproducts');
});
}

function swap(one, two) {
    document.getElementById(one).style.display = 'block';
    document.getElementById(two).style.display = 'none';
}