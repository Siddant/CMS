	function validate(form) {
	//fail = "";
	  fail = validatefirstName(form.fName.value);
	  fail += validatelastName(form.lName.value)
	  fail += validatePhonenumber(form.phoneNumber.value)
	  fail += validateEmail(form.email.value)
	  fail += validateAddress(form.deliveryAddress.value)
	  fail += validateCity(form.city.value)
	 fail += validatePostcode(form.postcode.value)
	  fail += validateCountry(form.country.value)
	 if (fail == "") return true
	 	else {alert(fail); 
	 		return false
	 	}
	};




		function validatefirstName(field) {

		if (field == "") {
			return "No first Name was entered.\n";
		}
		else if (field.length < 4) {
			return "The first Name  must be asleast 4 character.\n";
		}else if(!isNaN(field) ){
			return "The first Name cannot be a numbers.\n";

		}
		return "";
		};
	
		function validatelastName(field) {
		if (field == "") {
			return "No last Name was entered.\n";
		}
		else if (field.length < 4) {
			return "The last Name  must be asleast 4 character.\n";
		}else if(!isNaN(field) ){
			return "The last Name  cannot be a numbers.\n";

		}
		return "";
		};


		function validatePhonenumber(field) {

		if (field == "") {
			return "No phone number was entered.\n";
		}else if (field.length < 10) {
			return "phone number must have at leat 11 numbers.\n";
		}else if(isNaN(field) ){
			return "phone number must be a numbers.\n";

		}
		
		return "";
		};



		function validateEmail(field) {
			//alert(field);
		if (field == "") {
			return "No email was entered.\n";
		}
		else if (!checkEmail(field)) {
			return "please provide a valid email.\n";
		}
		return "";
		};



		function validateAddress(field) {
		if (field == "") {
			return "No address was entered.\n";
		}
		else if (field.length < 4) {
			return "The address must be asleast 4 character.\n";
		}
		return "";
		};

		function validateCity(field) {
		if (field == "") {
			return "No city was entered.\n";
		}
		else if (field.length < 4) {
			return "The city must be asleast 4 character.\n";
		}else if(!isNaN(field) ){
			return "The city cannot be a numbers.\n";

		}
		return "";
		};


		function validatePostcode(field) {
		if (field == "") {
			return "No post code was entered.\n";
		}
		else if (field.length < 4) {
			return "The post code must be asleast 4 character.\n";
		}

		return "";
		};



		function validateCountry(field) {
		if (field == "") {
			return "No country was entered.\n";
		}
		else if (field.length < 4) {
			return "The country must be asleast 4 character.\n";
		}else if(!isNaN(field) ){
			return "The country cannot be a numbers.\n";

		}
		return "";
		};


function isNumberKey(evt){

         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
}


function checkEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}