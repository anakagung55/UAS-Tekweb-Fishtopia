@extends('layouts.frontend')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.fullscreen@2.4.0/Control.FullScreen.min.css">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            font-weight: bold;
            font-size: 1.2em;
        }
        .card-body {
            padding: 20px;
        }

        /* Style untuk gambar */
        .img-fluid {
            max-width: 50%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .image-container {
            margin-top: 20px; /* Atur jarak dari tulisan 'Gambar' ke gambar */
        }
        
        /* Style untuk judul halaman */
        h4 {
            margin-bottom: 10px;
        }

        /* Style untuk bagian detail */
        .detail-section {
            margin-bottom: 20px;
        }

        /* Responsif untuk ponsel */
        @media (max-width: 767px) {
            .leaflet-container {
                height: 300px;
            }
        }
        .leaflet-container {
            height: 400px;
            width: 600px;
            max-width: 100%;
            max-height: 100%;
        }
    </style>
@endsection


@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Map Spot</div>
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Detail Spot : {{ $spot->name }}</div>
                    <div class="card-body">
                        <div class="detail-section">
                            <h4><strong>Nama Spot :</strong></h4>
                            <h5>{{ $spot->name }}</h5>
                        </div>

                        <div class="detail-section">
                            <h4><strong>Detail :</strong></h4>
                            <p>{{ $spot->description }}</p>
                        </div>

                        <div class="detail-section">
                            <h4><strong>Gambar</strong></h4>
                            <div class="image-container">
                                <img class="img-fluid" src="{{ $spot->getImageAsset() }}" alt="Gambar Spot">
                            </div>
                        </div>
                        <h2 class="mt-16 mb-7 text-3xl text-blue-900 font-bold">Related Posts</h2>
                        <div class="w-full mb-5">
                            <div class="grid grid-cols-3 gap-10 w-full">
                                @foreach ($latestPosts as $post)
                                    <x-posts.post-card :post="$post" class="md:col-span-1 col-span-3" />
                                @endforeach
                            </div>
                        </div>
                        <a class="mt-10 block text-center text-lg text-blue-900 hover:text-blue-500 font-semibold" href="http://127.0.0.1:8000/blog">More
                            Posts</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet.fullscreen@2.4.0/Control.FullScreen.min.js"></script>

    <script>
        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        });

        var Stadia_Dark = L.tileLayer(
            'https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
                maxZoom: 20,
                attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
            });

        var Esri_WorldStreetMap = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012'
            });

        var map = L.map('map', {
            center: [{{ $spot->coordinates }}],
            zoom: 10,
            layers: [osm],
            fullscreenControl: {
                pseudoFullscreen: false
            }
        })

        const baseLayers = {
            'Openstreetmap': osm,
            'StadiaDark': Stadia_Dark,
            'Esri': Esri_WorldStreetMap
        }

        const layerControl = L.control.layers(baseLayers).addTo(map)
        var curLocation = [{{ $spot->coordinates }}] 

        var marker = new L.marker(curLocation,{
            draggable:false
        })
        map.addLayer(marker)
        
    </script>
@endpush