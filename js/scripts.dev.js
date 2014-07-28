"use strict";

var ptiApp = angular.module("ptiApp", [ "ptiApp.services", "ptiApp.controllers" ]), ptiServices = angular.module("ptiApp.services", []), ptiControllers = angular.module("ptiApp.controllers", []);

ptiServices.factory("ptiPostTypesAPI", [ "$http", "$q", function($http, $q) {
    {
        var ptiPostTypes = {};
        $q.defer();
    }
    return ptiPostTypes.getAllData = function() {
        var results = [];
        return "undefined" != typeof window.PTIBootstrapData && (results = window.PTIBootstrapData), 
        results;
    }, ptiPostTypes;
} ]), ptiControllers.controller("PostTypesCtrl", [ "$scope", "$element", "ptiPostTypesAPI", function($scope, $element, ptiPostTypesAPI) {
    $scope.postTypes = [], $scope.postTypes = ptiPostTypesAPI.getAllData(), console.log($scope.postTypes), 
    $scope.getPostType = function(slug) {
        console.log(slug);
    };
} ]);