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
    
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    body{
        margin: 0;
        background-color: #F4F4F4;
        font-family: Poppins;
    }
    :root{
        --item1-transform: translateX(-100%) translateY(-5%) scale(1.5);
        --item1-filter: blur(30px);
        --item1-zIndex: 11;
        --item1-opacity: 0;

        --item2-transform: translateX(0);
        --item2-filter: blur(0px);
        --item2-zIndex: 10;
        --item2-opacity: 1;

        --item3-transform: translate(50%,10%) scale(0.8);
        --item3-filter: blur(10px);
        --item3-zIndex: 9;
        --item3-opacity: 1;

    }

    /* carousel */
    .carousel{
        position: relative;
        height: 500px;
        overflow: hidden;
    }
    .carousel .list{
        position: absolute;
        width: 1140px;
        max-width: 90%;
        height: 80%;
        left: 50%;
        transform: translateX(-50%);
    }
    .carousel .list .item{
        position: absolute;
        left: 0%;
        width: 70%;
        height: 100%;
        font-size: 15px;
        transition: left 0.5s, opacity 0.5s, width 0.5s;
    }
    .carousel .list .item:nth-child(n + 6){
        opacity: 0;
    }
    .carousel .list .item:nth-child(2){
        z-index: 10;
        transform: translateX(0);
    }
    .carousel .list .item img{
        width: 50%;
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        transition: right 1.5s;
    }

    .carousel .list .item .introduce{
        opacity: 0;
        pointer-events: none;
    }
    .carousel .list .item:nth-child(2) .introduce{
        opacity: 1;
        pointer-events: auto;
        width: 400px;
        position: absolute;
        top: 50%;
        transform:  translateY(-50%);
        transition: opacity 0.5s;
    }
    .carousel .list .item .introduce .title{
        font-size: 2em;
        font-weight: 500;
        line-height: 1em;
    }
    .carousel .list .item .introduce .topic{
        font-size: 4em;
        font-weight: 300;
    }
    .carousel .list .item .introduce .des{
        font-size: small;
        color: rgb(82, 82, 82);
    }

    .carousel .list .item:nth-child(1){
        transform: var(--item1-transform);
        filter: var(--item1-filter);
        z-index: var(--item1-zIndex);
        opacity: var(--item1-opacity);
        pointer-events: none;
    }
    .carousel .list .item:nth-child(3){
        transform: var(--item3-transform);
        filter: var(--item3-filter);
        z-index: var(--item3-zIndex);
    }

    /* animation text in item2 */
    .carousel .list .item:nth-child(2) .introduce .title,
    .carousel .list .item:nth-child(2) .introduce .topic,
    .carousel .list .item:nth-child(2) .introduce .des{
        opacity: 0;
        animation: showContent 0.5s 1s ease-in-out 1 forwards;
    }
    @keyframes showContent{
        from{
            transform: translateY(-30px);
            filter: blur(10px);
        }to{
            transform: translateY(0);
            opacity: 1;
            filter: blur(0px);
        }
    }
    .carousel .list .item:nth-child(2) .introduce .topic{
        animation-delay: 1.2s;
    }
    .carousel .list .item:nth-child(2) .introduce .des{
        animation-delay: 1.4s;
    }
    /* next click */
    .carousel.next .item:nth-child(1){
        animation: transformFromPosition2 0.5s ease-in-out 1 forwards;
    }
    @keyframes transformFromPosition2{
        from{
            transform: var(--item2-transform);
            filter: var(--item2-filter);
            opacity: var(--item2-opacity);
        }
    }
    .carousel.next .item:nth-child(2){
        animation: transformFromPosition3 0.7s ease-in-out 1 forwards;
    }
    @keyframes transformFromPosition3{
        from{
            transform: var(--item3-transform);
            filter: var(--item3-filter);
            opacity: var(--item3-opacity);
        }
    }
    .carousel.next .item:nth-child(3){
        animation: transformFromPosition4 0.9s ease-in-out 1 forwards;
    }
    @keyframes transformFromPosition4{
        from{
            transform: var(--item1-transform);
            filter: var(--item1-filter);
            opacity: var(--item1-opacity);
        }
    }

    /* previous */

    .carousel.prev .list .item:nth-child(3){
        animation: transformFromPosition2 0.9s ease-in-out 1 forwards;
    }
    .carousel.prev .list .item:nth-child(2){
        animation: transformFromPosition1 1.1s ease-in-out 1 forwards;
    }
    @keyframes transformFromPosition1{
        from{
            transform: var(--item1-transform);
            filter: var(--item1-filter);
            opacity: var(--item1-opacity);        
        }
    }


    .arrows{
        position: absolute;
        top: calc(80% - 20px); 
        width: 1140px;
        max-width: 90%;
        display: flex;
        justify-content: space-between;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1; 
    }
    #prev,
    #next{
        width: 40px;
        height: 40px;
        border-radius: 50%;
        font-family: monospace;
        border: 1px solid #5555;
        font-size: large;
    }
    #prev{
        left: 5%;
    }
    #next{
        right: 5%;
    }
    #back{
        position: absolute;
        z-index: 100;
        bottom: 0%;
        left: 50%;
        transform: translateX(-50%);
        border: none;
        border-bottom: 1px solid #555;
        font-family: Poppins;
        font-weight: bold;
        letter-spacing: 3px;
        background-color: transparent;
        padding: 10px;
        /* opacity: 0; */
        transition: opacity 0.5s;
    }
    .carousel.showDetail #back{
        opacity: 1;
    }
    .carousel.showDetail #prev,
    .carousel.showDetail #next{
        opacity: 0;
        pointer-events: none;
    }
    .carousel::before{
        width: 500px;
        height: 300px;
        content: '';
        background-image: linear-gradient(70deg, #2adc98, blue);
        position: absolute;
        z-index: -1;
        border-radius: 20% 30% 80% 10%;
        filter: blur(150px);
        top: 50%;
        left: 50%;
        transform: translate(-10%, -50%);
        transition: 1s;
    }
    #map { height: 400px; }
    .rounded-map {
    width: 70%;
    height: 400px;
    margin: 0 auto; /* Center the map horizontally */
    border-radius: 15px; /* Apply rounded corners */
    overflow: hidden; /* Ensure the map stays within the rounded border */
    }
    
    </style>
</head>
<body>
<x-app-layout>
    @section('hero')

<div class="w-full">
                    <div class="carousel">
                        <div class="list">
                            <div class="item">
                                <img src="images/img1.png">
                                <div class="introduce">
                                    <div class="title">Fishtopia</div>
                                    <div class="topic">what is it?</div>
                                    <div class="des">
                                        Fishtopia is a forum website where you can share anything about fish.
                                    </div>
                                </div>
                            </div>
                
                            <div class="item">
                                <img src="images/img2.png">
                                <div class="introduce">
                                    <div class="title">Features</div>
                                    <div class="topic">What is the features?</div>
                                    <div class="des">
                                        You can find any information about fish also with the location.
                                    </div>
                                </div>
                            </div>
                
                            <div class="item">
                                <img src="images/img3.png">
                                <div class="introduce">
                                    <div class="title">Explore</div>
                                    <div class="topic">Find what you want!</div>
                                    <div class="des">
                                        Let's start explore this website, and find want you want and what you need.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="arrows">
                            <button id="prev"><</button>
                            <button id="next">></button>
                        </div>
                    </div>
                </div>

                
                <h2 class="flex items-center justify-center mt-16 mb-7 text-3xl text-blue-900 font-bold">Endemic Map</h2>
    <div class="card-body">
         <div id="map" class="rounded-map"></div>
    </div>
    @endsection
    
    <div class="mb-10 w-full">
        <div class="mb-16">
            <h2 class="mt-16 mb-7 text-3xl text-blue-900 font-bold">Featured Posts</h2>
            <div class="w-full">
                <div class="grid grid-cols-3 gap-10 w-full">
                    @foreach ($featuredPosts as $post)
                        <x-posts.post-card :post="$post" class="md:col-span-1 col-span-3" />
                    @endforeach
                </div>
            </div>
            <a class="mt-10 block text-center text-lg text-blue-900 hover:text-blue-500 font-semibold"
                href="http://127.0.0.1:8000/blog">More
                Posts</a>
        </div>
        <hr>

        <h2 class="mt-16 mb-7 text-3xl text-blue-900 font-bold">Latest Posts</h2>
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
    <hr>
    
</x-app-layout>

</body>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script src="https://cdn.jsdelivr.net/npm/leaflet-search@3.0.9/dist/leaflet-search.src.min.js"></script>
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
        center: [6.1543779, 113.7364276], 
        zoom: 3,
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

        var datas = [
            @foreach ($spot as $key => $value)
                {
                    "loc": [{{ $value->coordinates }}],
                    "title": '{!! $value->name !!}'
                },
            @endforeach
        ]

        var markersLayer = new L.layerGroup()
        map.addLayer(markersLayer)

        var controlSearch = new L.Control.Search({
            position: 'topleft',
            layer: markersLayer,
            zoom: 15,
            markerLocation: true
        })

        map.addControl(controlSearch)

        for (i in datas) {
            var title = datas[i].title,
                loc = datas[i].loc,
                marker = new L.Marker(new L.latLng(loc), {
                    title: title
                })
            markersLayer.addLayer(marker)

            @foreach ($spot as $item)
                L.marker([{{ $item->coordinates }}])
                    .bindPopup(
                        "<div class='my-2'><img src='{{ $item->getImageAsset() }}' class='img-fluid' width='700px'></div>" +
                        "<div class='my-2'><strong>Nama Spot : </strong> <br>{{ $item->name }}</div>" +
                        "<div><a href='{{ route('detail-spot',$item->slug) }}' class='btn btn-outline-info'>Detail Spot</a></div>"
                    )
                    .addTo(map)
            @endforeach
        }

        const layerControl = L.control.layers(baseLayers).addTo(map)
    </script>


<script>
    let nextButton = document.getElementById('next');
    let prevButton = document.getElementById('prev');
    let carousel = document.querySelector('.carousel');
    let listHTML = document.querySelector('.carousel .list');
    
    nextButton.onclick = function(){
        showSlider('next');
    }
    prevButton.onclick = function(){
        showSlider('prev');
    }
    let unAcceppClick;
    const showSlider = (type) => {
        nextButton.style.pointerEvents = 'none';
        prevButton.style.pointerEvents = 'none';
    
        carousel.classList.remove('next', 'prev');
        let items = document.querySelectorAll('.carousel .list .item');
        if(type === 'next'){
            listHTML.appendChild(items[0]);
            carousel.classList.add('next');
        }else{
            listHTML.prepend(items[items.length - 1]);
            carousel.classList.add('prev');
        }
        clearTimeout(unAcceppClick);
        unAcceppClick = setTimeout(()=>{
            nextButton.style.pointerEvents = 'auto';
            prevButton.style.pointerEvents = 'auto';
        }, 2000)
    }
    </script>
   

    