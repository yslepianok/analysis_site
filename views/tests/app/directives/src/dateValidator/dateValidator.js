'use strict';

myApp.directive('dateValidator',['$compile', '$translate', function ($compile, $translate) { // declaring directive for date validating
    return {
        restrict: 'A', // allowed to use only as a attribute
        require: 'ngModel', // required ngModel attribute
        link: function (scope, element, attrs, ctrl) {

            var dateRegexp = /^\d{4}\/\d{1,2}\/\d{1,2}$/; // regexp for validation date in YYYY/MM/DD format


            function isValidDate(dateString) { // checks if entered date exists
                if (dateString) {
                    var partsOfDate = dateString.split('/');
                    var year = partsOfDate[0];
                    var month = partsOfDate[1] - 1; //Javascript counts months from 0: January - 0, February - 1, etc
                    var day = partsOfDate[2];
                    var d = new Date(year, month, day);
                    if (d.getFullYear() == year && d.getMonth() == month && d.getDate() == day) {
                        return true;
                    }
                    return false;
                }
            }

            function changeInvalidMessage(elem, message) { // change message about invalid date 
                elem.innerHTML = message;
            }
            // alert message if text isn't valid
            var template = '<span id="invalidDateMessage" ng-show="editProfileForm.date.$error.dateValidator"></span>';
            var validMessage = $compile(template)(scope);
            element.after(validMessage);
            var invalidDateMessageElm = document.getElementById("invalidDateMessage");
            
            ctrl.$validators.dateValidator = function (modelValue, viewValue) {
                
                var invalidMessage;
                
                var translatePromises = [];
                var promise;
                var stateValidator;
                
                if (ctrl.$isEmpty(viewValue)) { // if value is empty 
                    
                    $translate('DATE_VALIDATOR.EMPTY_FIELD').then(function (translation) {
                        invalidMessage = translation;
                        changeInvalidMessage(invalidDateMessageElm, invalidMessage);
                    });
                    return false;
                    
                }

                if (!dateRegexp.test(viewValue)) { // if value in wrong format 
                    $translate('DATE_VALIDATOR.WRONG_FORMAT').then(function (translation) {
                        invalidMessage = translation;
                        changeInvalidMessage(invalidDateMessageElm, invalidMessage);
                    });
                    return false;
                }

                if (!isValidDate(viewValue)) { // if entered date doesn't exist
                    $translate('DATE_VALIDATOR.WRONG_DATE').then(function (translation) {
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