<?php

namespace Leaflet\Layer\Tile;

/**
 * Cloudmade Provider.
 * You'll need an Api key in order to make requests
 * 
 * @extends Layer
 * @implements IProvider
 */
class Esri extends Layer {
	
	const jsName = 'L.tileLayer';
	
	/**
	 * Some Styles:
	 * ------------
	 * World_Light_Gray_Base
	 * NatGeo_World_Map
	 * Ocean_Basemap
	 * World_Physical_Map
	 * World_Shaded_Relief
	 * World_Terrain_Base
	 * World_Imagery
	 * World_Topo_Map
	 * World_Street_Map
	 * ------------
	 *
	 * @var mixed
	 * @access protected
	 */
	protected $config = array(
		'location'=> 'http://server.arcgisonline.com/ArcGIS/rest/services/{style}/MapServer/tile/{z}/{y}/{x}',
		'options'	=> array(
			'style' => 'World_Street_Map',
		)
	);
	
}