createXmlHttpRequestObject = function(){
	var xhr;
	//for interbrowser older and above
	if(window.ActiveXObject){
		try{
		xhr = new ActiveXObject("Microsoft.xmlHttp");
		}catch(e){
			xhr = false;
		}
	}else{
		try{
			xhr = new XMLHttpRequest();
		}catch(e){
			xhr = false;	
		}
	}
	if(!xhr){
		alert("something went wrong sorry");
	}else{
		return xhr;
	}
}




request = function(link, target	)
{
	var changeListener;
    var xhr =  createXmlHttpRequestObject();
	 changeListener = function()
	    	{

	    	if (xhr.readyState == 4) {
				if(xhr.status == 200){
			    	target.innerHTML = xhr.responseText;
				}else{
			    	target.innerHTML = "<p>Hold Up...</p>";

				}
			}			    	else
			    		{
			    			target.innerHTML = "<p>Hold Up...</p>";
			    		}
			};


	    xhr.open("GET", link, true);
	    xhr.onreadystatechange = changeListener;
	    xhr.send();
}



// changeReport = function(link)
// 	{
// 		var target;
// 		target = document.getElementById("body-content");
// 		request(link, target);
// 		//document.getElementById("body-content").innerHTML  = "<p>Hold Up...</p>";

// 	}


searchProduct =function()
{
	var x = document.getElementById("search");
	var target = document.getElementsByClassName('body-content');
	request("search-result.php?search="+(x).value, target[0]);
}


changeCategory =function(id)
{
	var x = document.getElementById("search");
	var target = document.getElementsByClassName('body-content');
	request("category-page.php?cat="+id, target[0]);
}
