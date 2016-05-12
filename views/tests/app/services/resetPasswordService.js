'use strict';

// service that emulates sending request to email to reset password
// also notifies to display modal window on login page
myApp.service('resetPasswordService', ['$timeout', function ($timeout) {
    
    var observerCallback;
    this.emailHasBeenSent = false;
    
    //register an observer
    this.registerObserver = function(callback){
        observerCallback = callback;
    };
    
    var notifyObserver = function(){
       if (observerCallback) { 
           observerCallback();
       } else { 
           console.log("notify observer is empty");   
       }
    };
    
    this.sendEmail = function() { // sending email to reset password
        var _self = this;
        this.emailHasBeenSent = true;
        $timeout(function() {
            _self.emailHasBeenSent = false;
            notifyObserver();
        }, 3000);
    }
}]);