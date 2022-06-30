var error = document.querySelector('.info-error'),
	good = document.querySelector('.info-good');
// Ajax request add product 
var form_add_product = document.querySelector('.add_product');
form_add_product.onsubmit = function(event){
	event.preventDefault();
	var ajax = new XMLHttpRequest();
	ajax.open("POST","add-product.php", true);
	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

	var	input_count = document.querySelector('input[name="count"]'),
		input_unit = document.querySelector('input[name="unit"]'),
		input_product = document.querySelector('input[name="product"]');

	var count = input_count.value,
		unit = input_unit.value,
		product = input_product.value;

	ajax.send("count="+count+"&unit="+unit+"&product="+product);

	ajax.onload = function() {
		var response = JSON.parse(this.responseText);

		if(response['status'] == true){
			error.style.display = 'none';
			addRowTable(response['id'], response['count'], response['unit'], response['product']);
			input_count.value = '';
			input_unit.value = '';
			input_product.value = '';
			good.style.display = 'block';
			good.innerText = response['errors'];
		}else{
			good.style.display = 'none';
			error.style.display = 'block';
			error.innerText = 'ERROR: '+response['errors'];
		}
	}
};

// Ajax request edit product 
const list_form_edit = document.querySelectorAll('.edit_product');
list_form_edit.forEach(function (element) {
    edit(element);
 });
function edit(element){
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
			var response = JSON.parse(this.responseText);
			if(response['status'] == true){
				error.style.display = 'none';
				good.style.display = 'block';
				good.innerText = response['errors'];
			}else{
				good.style.display = 'none';
				error.style.display = 'block';
				error.innerText = 'ERROR: '+response['errors'];
			}
		}		
	}
}
// Ajax request delete product 
function deleteProduct(event){
	var id_product = event.getAttribute('data-id_product');

	var ajax = new XMLHttpRequest();
	ajax.open("POST","delete-product.php", true);
	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajax.send("id="+id_product);

	ajax.onload = function() {
		var response = JSON.parse(this.responseText);
		if(response['status'] == true){
			error.style.display = 'none';
			var tr = event.closest('tr');
			tr.remove();
			good.style.display = 'block';
			good.innerText = response['errors'];
		}else{
			good.style.display = 'none';
			error.style.display = 'block';
			error.innerText = 'ERROR: '+response['errors'];
		}
	}
}

function addRowTable(id, count, unit, product){
	var table = document.querySelector('.table tbody');
	var tr = document.createElement('tr');
	table.appendChild(tr);

	// ID
	var th = document.createElement('th');
	th.innerText = id;
	tr.appendChild(th);

	// Count
	var th1 = document.createElement('th');
	tr.appendChild(th1);
	var input1 = document.createElement('input');
	th1.appendChild(input1);
	input1.setAttribute('name', 'edit-count');
	input1.value = count;
	
	// Unit
	var th2 = document.createElement('th');
	tr.appendChild(th2);
	var input2 = document.createElement('input');
	th2.appendChild(input2);
	input2.setAttribute('name', 'edit-unit');
	input2.value = unit;
	
	// Product
	var th3 = document.createElement('th');
	tr.appendChild(th3);
	var input3 = document.createElement('input');
	th3.appendChild(input3);
	input3.setAttribute('name', 'edit-product');
	input3.value = product;

	// Form
	var th4 = document.createElement('th');
	tr.appendChild(th4);
	var form = document.createElement('form');
	th4.appendChild(form);
	form.method = 'POST';
	form.classList.add('edit_product');
	var input4 = document.createElement('input');
	form.appendChild(input4);
	input4.setAttribute('name', 'id_product');
	input4.setAttribute('type', 'hidden');
	input4.value = id;
	var input5 = document.createElement('input');
	form.appendChild(input5);
	edit(form);
	input5.setAttribute('name', 'edit-product');
	input5.setAttribute('type', 'submit');
	input5.value = 'Save Edited';

	// BTN Delete
	var a = document.createElement('a');
	th4.appendChild(a);
	a.innerText = 'Delete';
	a.href = 'javascript:;';
	a.setAttribute('onclick','deleteProduct(this)');
	a.setAttribute('data-id_product', id);	
}	