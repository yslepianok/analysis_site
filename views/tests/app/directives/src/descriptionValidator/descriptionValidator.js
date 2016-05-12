'use strict';

myApp.directive('descriptionValidator',['$compile', '$translate', function ($compile, $translate) { // declaring directive for greeting text validating 
	return {
		restrict: 'A', // allowed to use only as a attribute
	    require: 'ngModel', // required ngModel attribute
	    link: function(scope, element, attrs, ctrl) {
            
            var moreThanThreeRegexp = /^[А-яа-я\s]{3,}$/; // text should be more than 3 symbols 
	        
            var firstLetterUpRegexp = /^[А-Я]/; // this regexp checks whether first letter of description about user is in UPPERCASE
            
            var onlyFirstLetterUpRegexp = /^[А-Я][а-я\s]+$/; // this regexp checks whether only first letter of description about user is UPPERCASE
            
            var russianSymbolsRegexp = /^[А-я\s]+$/; // this regexp checks whether all letters are russian 

            function changeInvalidMessage(elem, message) { // change message about invalid date 
                elem.innerHTML = message;
            }
            
            // alert message if text isn't valid
	    	var template = '<span id="invalidDescriptionMessage" ng-show="editProfileForm.descriptionField.$error.descriptionValidator"></span>';
			var validMessage = $compile(template)(scope);
			element.after(validMessage);	
            var invalidDateMessageElm = document.getElementById("invalidDescriptionMessage");
	        ctrl.$validators.descriptionValidator = function(modelValue, viewValue) {

                
                var invalidMessage;

		        if (ctrl.$isEmpty(viewValue)) { // consider empty view value to be invalid
                  $translate('DESCRIPTION_VALIDATOR.EMPTY_FIELD').then(function (translation) {
                    invalidMessage = translation;
                    changeInvalidMessage(invalidDateMessageElm, invalidMessage);
                  });
		          return false;
		        }
                
                if (!russianSymbolsRegexp.test(viewValue)) { // if description isn't in Russian
		          $translate('DESCRIPTION_VALIDATOR.ONLY_RUSSIAN').then(function (translation) {
                    invalidMessage = translation;
                    changeInvalidMessage(invalidDateMessageElm, invalidMessage);
                  });
		          return false;
		        }
                
                if (!firstLetterUpRegexp.test(viewValue)) { // if first letter isn't UPPERCASE
		          $translate('DESCRIPTION_VALIDATOR.UP_FIRST').then(function (translation) {
                    invalidMessage = translation;
                    changeInvalidMessage(invalidDateMessageElm, invalidMessage);
                  });
		          return false;
		        }
                
                
                if (!moreThanThreeRegexp.test(viewValue)) { // if there is no more than three symbols 
		          $translate('DESCRIPTION_VALIDATOR.THREE_SYMBOLS').then(function (translation) {
                    invalidMessage = translation;
                    changeInvalidMessage(invalidDateMessageElm, invalidMessage);
                  });
		          return false;
		        }
                
                if (!onlyFirstLetterUpRegexp.test(viewValue)) { // if not only first letter of description about user is UPPERCASE
		          $translate('DESCRIPTION_VALIDATOR.ONLY_FIRST_UP').then(function (translation) {
                    invalidMessage = translation;
                    changeInvalidMessage(invalidDateMessageElm, invalidMessage);
                  });
		          return false;
		        }

		        // it is valid
		        return true;
	        };
	    }
    };
}]);