'use strict';

ptiServices.factory('ptiPostTypesAPI', ['$http', '$q', function( $http, $q ) {

	var ptiPostTypes = {},
		deferred = $q.defer();

	ptiPostTypes.getAllData = function( ) {

		var results = [];

		if ( typeof( window.PTIBootstrapData ) !== 'undefined' ) {
			results = window.PTIBootstrapData;
		}

		return results;
	};

	return ptiPostTypes;
}]);
