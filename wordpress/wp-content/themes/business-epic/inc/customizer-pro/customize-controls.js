( function( api ) {

	// Extends our custom "business-epic" section.
	api.sectionConstructor['business-epic'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
