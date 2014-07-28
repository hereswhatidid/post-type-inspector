'use strict';

ptiControllers.controller( 'PostTypesCtrl', ['$scope', '$element', 'ptiPostTypesAPI', function( $scope, $element, ptiPostTypesAPI ) {

	$scope.postTypes = [];

	$scope.postTypes = ptiPostTypesAPI.getAllData();

	console.log( $scope.postTypes );

	$scope.getPostType = function( slug ) {
		console.log( slug );
	};
}]);