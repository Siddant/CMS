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



changeReport = function(link)
	{
		var target  = document.getElementsByClassName('body-content');
		request(link, target[0]);
		//document.getElementById("body-content").innerHTML  = "<p>Hold Up...</p>";

	}

