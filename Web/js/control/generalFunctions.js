/*
 *@name: showErrors
 *@author: Juan Antonio Muñoz
 *@versio: 1.0
 *@description: this function 
 *@date: 2015/05/05
 *@params: errors -> array with the errors
 *@return: alert wih errorss
 *
*/
function showErrors(errors){
	var errorString = "";
	
	if(errors!=null){
		for (i = 0; i < errors.length; i++){
			errorString+=errors[i]+"\n";
		}
	}
	alert(errorString);
}
