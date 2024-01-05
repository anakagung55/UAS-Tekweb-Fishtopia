<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-GIS</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>

     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

     <script src="https://unpkg.com/esri-leaflet@3.0.10/dist/esri-leaflet.js"></script>

     <script src="https://unpkg.com/esri-leaflet-vector@4.2.3/dist/esri-leaflet-vector.js" crossorigin=""></script>
    
    <style>
        #map { height: 400px; }
    </style>
</head>
<body>
<div id="map"></div>
<div>
<a href="{{ route('simple-map') }}" >Simple Map </a>
</div>
    
</body>

<script>
    var map = L.map('map').setView([ -4.1143244, 119.8739319], 11);
    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);

</script>
</html>

<tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->coordinates }}</td>
                                    <td>
                                        <!-- Button Edit -->
                                        <a href="{{ route('centre-point.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        
                                        <!-- Button Delete -->
                                        <form action="{{ route('centre-point.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
