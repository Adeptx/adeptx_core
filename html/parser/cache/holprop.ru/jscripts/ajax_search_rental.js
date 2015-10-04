function DoCallback(data)
{	
	///
	// branch for native XMLHttpRequest object
	if (window.XMLHttpRequest) {		
		req = new XMLHttpRequest();
		req.onreadystatechange = processReqChange;
		req.open('POST', url, true);
		req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		req.send(data);
		//alert(data);
	// branch for IE/Windows ActiveX version
	} else if (window.ActiveXObject) {		
		req = new ActiveXObject('Microsoft.XMLHTTP')
		if (req) {			
			req.onreadystatechange = processReqChange;
			req.open('POST', url, true);
			req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');			
			req.send(data);
			//alert(data);
		}
	}
}

function processReqChange() {
	// only if req shows 'loaded'
	if (req.readyState == 4) {
		// only if 'OK'
		if (req.status == 200) {
			eval(what);
		} else {

		}
	}
}

function SetSubcat(Values, obj)
{
	//alert(Values)
	var dropDown = document.getElementById(obj);

	if(Values != "")
	{
		var divContent = '';
		var retValue = Values.split("?");
		var arrValues = retValue[0].split("~");		
		for(i = 0; i < arrValues.length; i++)
		{
			if(arrValues[i] != "")
			{
				dropDown.options[dropDown.options.length] = new Option(arrValues[i], arrValues[i]);
			}
		}

		if(retValue[1])
		{
			//dropDown = document.getElementById('sltcity');
			arrValues = retValue[1].split("~");		
			for(i = 0; i < arrValues.length; i++)
			{
				if(arrValues[i] != "")
				{
					divContent = divContent + "<input type='checkbox' name='sltcity' value='"+ arrValues[i] +"' onclick=anyClear('searchrentalfrm','sltcity')><font class='text-small3' >" + arrValues[i] + "</font><br>";

					//dropDown.options[dropDown.options.length] = new Option(arrValues[i], arrValues[i]);
				}
			}
			//alert(divContent);
			if(divContent!=''){
				divContent = "<input type='checkbox' name='sltcity' value='Any' onclick=allClear('searchrentalfrm','sltcity')><font class='text-small3'>Any</font><br>" + divContent;
				document.getElementById('gridcont').style.height = "80";
				document.getElementById('gridcont').style.width = "190";
				document.getElementById('gridcont').innerHTML = divContent;
			}
			else
			{
				document.getElementById('gridcont').style.height = "18";
				document.getElementById('gridcont').style.width = "90";
				document.getElementById('gridcont').innerHTML = '<select name="sltcity" id="sltcity" class="text-small3"><option value="">Any</option></select>';
			}
		}
	}
	else
	{
		document.getElementById('gridcont').style.height = "18";
		document.getElementById('gridcont').style.width = "90";
		document.getElementById('gridcont').innerHTML = '<select name="sltcity" id="sltcity" class="text-small3"><option value="">Any</option></select>';
	}
	
}



function Initialize(Value, obj)
{
	var dropDown = document.getElementById(obj);
	
	if(dropDown)
	{
		dropDown.options.length = 0;

		if(Value != "")
		{
			dropDown.options[dropDown.options.length] = new Option(Value, "");
		}
	}
}

//Function for select multiple checkbox
function selchkmultiple(strFormName,strchkName,strval)
	{
			var mystring = new String(strval);
			var arr = mystring.split(',');
			//var arr = strval;			
			var objFrm = eval("document."+strFormName);
			for (var i=0; i <objFrm.elements.length; i++)
		    {
				if(objFrm.elements[i].type=="checkbox")
				{
					if(objFrm.elements[i].name==strchkName)
					{
						for (var j=0; j<arr.length; j++)
						{
							//alert(arr[j]);
							if(objFrm.elements[i].value==trim(arr[j]))
							{
								objFrm.elements[i].checked=true;
							}
						}
						
					}
				}
		    }
	}

// Functions for trailing spaces.
function trim(strText) { 
		// this will get rid of leading spaces
		while (strText.substring(0,1) == ' ')
			strText = strText.substring(1, strText.length);

		// this will get rid of trailing spaces
		while (strText.substring(strText.length-1,strText.length) == ' ')
			strText = strText.substring(0, strText.length-1);
		var pos=0
		var tevePos=0
		while(strText.indexOf("\n",pos)>-1)
		{
			tevePos=strText.indexOf("\n",pos)
			pos=tevePos+1
		}
		
	   return strText;
}

function allClear(strFormName,strchkName)
{
	var objFrm = eval("document."+strFormName);
	for (var i=0; i <objFrm.elements.length; i++)
	{
		if(objFrm.elements[i].type=="checkbox")
		{
			if(objFrm.elements[i].name==strchkName)
			{
				if(objFrm.elements[i].value!="Any")
				{
					objFrm.elements[i].checked =false;
				}
			}
		}
	}
}

function anyClear(strFormName,strchkName)
{
	var objFrm = eval("document."+strFormName);
	for (var i=0; i <objFrm.elements.length; i++)
	{
		if(objFrm.elements[i].type=="checkbox")
		{
			if(objFrm.elements[i].name==strchkName)
			{
				if(objFrm.elements[i].value=="Any" && objFrm.elements[i].checked == true)
				{
					objFrm.elements[i].checked =false;
				}
			}
		}
	}
}