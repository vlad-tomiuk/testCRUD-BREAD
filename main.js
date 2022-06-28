// Ajax request add product 
var form_add_product = document.querySelector('.add_product');
form_add_product.onsubmit = function(event){
	event.preventDefault();
	var ajax = new XMLHttpRequest();
	ajax.open("POST","add-product.php", true);
	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

	var count = document.querySelector('input[name="count"]').value,
		unit = document.querySelector('input[name="unit"]').value,
		product = document.querySelector('input[name="product"]').value;

	ajax.send("count="+count+"&unit="+unit+"&product="+product);

	ajax.onload = function() {
		document.querySelector(".table").innerHTML += this.responseText;
	}
};

// Ajax request delete product 
function deleteProduct(event){
	var id_product = event.getAttribute('data-id_product');

	var ajax = new XMLHttpRequest();
	ajax.open("POST","delete-product.php", true);
	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajax.send("id="+id_product);

	ajax.onload = function() {
		if (this.responseText == 'true'){
			var tr = event.closest('tr');
			tr.remove();
		}
	}
}

// Ajax request edit product 
const list_form_edit = document.querySelectorAll('.edit_product');
	list_form_edit.forEach(function (element) {
    	element.onsubmit = function(event){
		event.preventDefault();
		var id_product = element.children[0].value,
			count = element.closest('tr').querySelector('input[name="edit-count"]').value,
			unit = element.closest('tr').querySelector('input[name="edit-unit"]').value,
			product = element.closest('tr').querySelector('input[name="edit-product"]').value;
		
		var ajax = new XMLHttpRequest();
		ajax.open("POST","edit-product.php", true);
		ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		ajax.send("id="+id_product+"&count="+count+"&unit="+unit+"&product="+product);

		ajax.onload = function() {
			if (this.responseText == 'true'){
				
			}
		}		
	}
 });