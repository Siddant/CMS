	function validate(form) {
	 fail = validateName(form.ProductName.value)
	 fail += validatePrice(form.Cost.value)
	 fail += validateDescription(form.ProductDescription.value)
	 fail += validateStock(form.Quantity.value)
	 if (fail == "") return true
	 	else {alert(fail); return false}
	};
		function validateName(field) {
		if (field == "") {
			return "No Name was entered.\n";
		}
		else if (field.length < 4) {
			return "The product Name must be asleast 4 character.\n";
		}else if(!isNaN(field) ){
			return "The product Name cannot be a numbers.\n";

		}
		return "";
		};
		function validateStock(field) {
			if (field == "") {
				return "Stock at least one. \n";
			}
			else if (!/\d/.test(field)) {
				return "Stock can only be a number."
			}
			return "";
		};
		function validatePrice(field) {
			if (field == "") return "No Price was entered.\n"
			else if (!/\d{1,6}/.test(field))
				return "Price can only be a number and less than million";
			return "" 
		};
		function validateDescription(field) {
			if (field == "") return "No description was entered.\n";
			else if (field.length > 200){
				return "description is too long!!.\n";
			}
			return "";
		};


function isNumberKey(evt){

         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
}



function validateCategory(form){
	fail = validateCategoryName(form.categoryName.value)
	 if (fail == "") return true
	 	else {alert(fail); return false}
	};
	function validateCategoryName(field) {
		if (field == "") {
			return "No Name was entered.\n";
		}
		else if (field.length < 4) {
			return "The category Name must be asleast 4 character.\n";
		}else if(!isNaN(field) ){
			return "The category Name cannot be a numbers.\n";

		}
		return "";
	};
