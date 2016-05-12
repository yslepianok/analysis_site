'use strict';

myApp.directive('checkrelationValidator',['CONSTANTS', function (CONSTANTS) { // declaring directive for greeting text validating 
	return {
		restrict: 'A', // allowed to use only as a attribute
	    require: 'ngModel', // required ngModel attribute
	    link: function(scope, element, attrs, ctrl) {
            
            var userInfo = JSON.parse(localStorage.getItem(CONSTANTS.LOCAL_STORAGE_KEY));
            
	        ctrl.$validators.checkrelationValidator = function(modelValue, viewValue) {
                
                

                var relationLenght = userInfo.relations.length;
               
                    
                for (var i=0; i<relationLenght; i++) { 
                    if (userInfo.relations[i].relationType == viewValue) { 
                        return false;
                    }
                }
                
		        // it is valid
		        return true;
	        };
	    }
    };
}]);