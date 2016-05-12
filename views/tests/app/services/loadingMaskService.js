'use strict';

// this service is used to display loading mask during loading page.
// just emulates outgoing http requests 
myApp.service('loadingMaskService',['$http','$q', function ($http, $q) {
    
    var observerCallback;
    var _self = this;
    var deferTimeout; 
    this.hasPendingRequests = false; // states that represents whether there are outgoing requests
    
    //register an observer
    this.registerObserver = function(callback){
        observerCallback = callback;
    };
    
    var notifyObserver = function(){ // notify that there are changes and observer callback should be called to apply changes
       if (observerCallback) { 
           observerCallback();
       } else { 
           throw "notify observer is empty"; 
       }
    };
    

    
    this.sendRequest = function() { // emulates outgoing requests. 

        _self.hasPendingRequests = true;
        notifyObserver();
        
        
        var changeStateRequest = function() { 
             return $http({
                method: "POST",
                url: "/changeState",
             })
        }
        
        
        changeStateRequest().then(function successCallback(response) {
            if (response.data) { 
                _self.hasPendingRequests = false; 
                notifyObserver();
            }
        }, function errorCallback(response) {
            console.log("request failed or has been canceled");
        });
        
        
    }
    
}]);